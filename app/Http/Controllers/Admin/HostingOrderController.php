<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Cashback;
use App\Models\Referral;
use App\Models\ReferralUse;
use App\Models\HostingAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\HostingAccountReady;
use App\Mail\HostingPriceSet;
use App\Mail\HostingPaymentApproved;

class HostingOrderController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) abort(403);

        $orders = Order::with(['user', 'hostingPackage', 'payment'])
            ->latest()
            ->paginate(15);
            
        return view('admin.hosting_orders.index', compact('orders'));
    }

    public function show(Order $hosting_order)
    {
        if (!Gate::allows('access-admin')) abort(403);

        $hosting_order->load(['user', 'hostingPackage', 'payment', 'hostingAccount']);
        return view('admin.hosting_orders.show', ['order' => $hosting_order]);
    }

    /**
     * Approve Payment & Process Referral
     */
    public function approvePayment(Order $hosting_order)
    {
        if (!Gate::allows('access-admin')) abort(403);

        if ($hosting_order->status !== 'waiting_confirmation') {
            return redirect()->back()->with('error', 'Pesanan tidak dalam status menunggu konfirmasi.');
        }

        DB::transaction(function () use ($hosting_order) {
            // 1. Update Order Status
            $hosting_order->update(['status' => 'active']);
            
            // 2. If it's an UPGRADE, mark parent as upgraded and transfer account
            if ($hosting_order->type === 'upgrade' && $hosting_order->parent_id) {
                $parentOrder = Order::find($hosting_order->parent_id);
                if ($parentOrder) {
                    $parentOrder->update(['status' => 'upgraded']);
                    
                    // Transfer hosting account from parent to this upgrade order
                    if ($parentOrder->hostingAccount) {
                        $parentOrder->hostingAccount->update(['order_id' => $hosting_order->id]);
                    }
                }
            }

            // 3. Mark User as having ordered hosting (to activate their own referral code)
            $user = $hosting_order->user;
            if (!$user->has_ordered_hosting) {
                $user->update(['has_ordered_hosting' => true]);
            }

            // 3. Process Referral Cashback
            if ($hosting_order->referral_code_used) {
                $referral = Referral::where('code', $hosting_order->referral_code_used)->first();
                $referrer = $referral ? $referral->user : null;

                if ($referrer && $referrer->id !== $user->id) {
                    // Check complex eligibility
                    if ($referrer->isReferralActive() && 
                        !$referrer->isReferralExpired() && 
                        $referrer->canEarnMoreCashback()) {
                        
                        $cashbackAmount = 10000;
                        
                        // Ensure we don't exceed 30k limit
                        $remainingLimit = 30000 - $referrer->lifetime_cashback_earned;
                        $amountToGive = min($cashbackAmount, $remainingLimit);

                        if ($amountToGive > 0) {
                            // Create Referral Use record
                            $referralUse = ReferralUse::create([
                                'referral_id' => $referral->id,
                                'used_by_user_id' => $user->id,
                                'order_id' => $hosting_order->id,
                                'status' => 'valid',
                            ]);

                            // Create Cashback record
                            Cashback::create([
                                'user_id' => $referrer->id,
                                'referral_use_id' => $referralUse->id,
                                'amount' => $amountToGive,
                                'status' => 'available',
                            ]);

                            // Update Referrer balances
                            $referrer->increment('cashback_balance', $amountToGive);
                            $referrer->increment('lifetime_cashback_earned', $amountToGive);
                        }
                    }
                }
            }
        });

        // Kirim email notifikasi bahwa pembayaran diterima
        try {
            Mail::to($hosting_order->customer_email)->send(new HostingPaymentApproved($hosting_order));
        } catch (\Exception $e) {
            \Log::error('Failed to send payment approved email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pembayaran disetujui, layanan diaktifkan, dan sistem referral diproses.');
    }

    /**
     * Provision/Update Credentials
     */
    public function provision(Request $request, Order $hosting_order)
    {
        if (!Gate::allows('access-admin')) abort(403);

        $request->validate([
            'ftp_host' => 'required|string',
            'ftp_port' => 'nullable|string',
            'ftp_username' => 'required|string',
            'ftp_password' => 'required|string',
            'db_name' => 'nullable|string',
            'db_username' => 'nullable|string',
            'db_password' => 'nullable|string',
            'pma_link' => 'nullable|url',
        ]);

        $hosting_order->hostingAccount()->updateOrCreate(
            ['order_id' => $hosting_order->id],
            $request->only(['ftp_host', 'ftp_port', 'ftp_username', 'ftp_password', 'db_name', 'db_username', 'db_password', 'pma_link'])
        );

        // Kirim email notifikasi ke customer
        try {
            $hosting_order->load('hostingAccount');
            Mail::to($hosting_order->customer_email)->send(new HostingAccountReady($hosting_order));
        } catch (\Exception $e) {
            \Log::error('Failed to send hosting ready email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Akses FTP dan Database berhasil dikirim ke user dan email notifikasi terkirim.');
    }

    public function reject(Order $hosting_order)
    {
        if (!Gate::allows('access-admin')) abort(403);
        $hosting_order->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Pesanan ditolak.');
    }

    public function setPrice(Request $request, Order $hosting_order)
    {
        if (!Gate::allows('access-admin')) abort(403);

        $request->validate([
            'price_total' => 'required|numeric|min:0',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $hosting_order->update([
            'price_total' => $request->price_total,
            'admin_notes' => $request->admin_notes,
            'unique_code' => $hosting_order->unique_code ?: rand(1, 999),
            'status' => 'pending_payment',
        ]);

        // Kirim email notifikasi bahwa harga sudah ditentukan
        try {
            Mail::to($hosting_order->customer_email)->send(new HostingPriceSet($hosting_order));
        } catch (\Exception $e) {
            \Log::error('Failed to send price set email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Harga dan keterangan berhasil ditetapkan.');
    }

    public function toggleSuspend(Order $hosting_order)
    {
        if (!Gate::allows('access-admin')) abort(403);

        $hosting_order->update([
            'is_suspended' => !$hosting_order->is_suspended
        ]);

        $status = $hosting_order->is_suspended ? 'ditangguhkan' : 'diaktifkan kembali';
        return redirect()->back()->with('success', "Layanan berhasil $status.");
    }

    public function uploadQris(Request $request)
    {
        if (!Gate::allows('access-admin')) abort(403);

        $request->validate([
            'payment_qris_image' => 'nullable|image|max:5120',
            'payment_recipient' => 'nullable|string|max:255',
            'payment_accounts' => 'nullable|string|max:2000',
        ]);

        // Handle QRIS image
        if ($request->hasFile('payment_qris_image')) {
            $file = $request->file('payment_qris_image');
            $path = $file->store('qris', 'public');

            $oldImage = \App\Models\Setting::where('key', 'payment_qris_image')->value('value');
            if ($oldImage && \Storage::disk('public')->exists($oldImage)) {
                \Storage::disk('public')->delete($oldImage);
            }

            \App\Models\Setting::updateOrCreate(
                ['key' => 'payment_qris_image'],
                ['value' => $path]
            );
        }

        // Save recipient
        if ($request->has('payment_recipient')) {
            \App\Models\Setting::updateOrCreate(
                ['key' => 'payment_recipient'],
                ['value' => $request->input('payment_recipient', '')]
            );
        }

        // Save accounts
        if ($request->has('payment_accounts')) {
            \App\Models\Setting::updateOrCreate(
                ['key' => 'payment_accounts'],
                ['value' => $request->input('payment_accounts', '')]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan pembayaran berhasil disimpan.');
    }
}
