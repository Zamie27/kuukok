<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HostingPackage;
use App\Models\Order;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HostingOrderController extends Controller
{
    /**
     * Step 1: Selection
     */
    public function index()
    {
        $packages = HostingPackage::where('status', 'active')->get();
        return view('user.hosting.select', compact('packages'));
    }

    /**
     * Step 2: Order Form
     */
    public function create(HostingPackage $package)
    {
        return view('user.hosting.order_form', compact('package'));
    }

    /**
     * Step 3: Store Order
     */
    public function store(Request $request)
    {
        $request->validate([
            'hosting_package_id' => 'required|exists:hosting_packages,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'project_name' => 'required|string|max:255',
            'github_repo_url' => 'nullable|url',
            'referral_code_used' => 'nullable|string|max:10',
        ]);

        $package = HostingPackage::findOrFail($request->hosting_package_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'hosting_package_id' => $package->id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'project_name' => $request->project_name,
            'whatsapp_number' => $request->whatsapp_number,
            'github_repo_url' => $request->github_repo_url,
            'price_total' => $package->price,
            'referral_code_used' => $request->referral_code_used,
            'status' => 'pending_payment',
        ]);

        return redirect()->route('user.hosting.payment', $order->id);
    }

    /**
     * Step 4: Payment Page
     */
    public function payment(Order $hosting_order)
    {
        if ($hosting_order->user_id !== Auth::id()) abort(403);
        
        $qrisImage = Setting::where('key', 'payment_qris_image')->value('value');
        $paymentRecipient = Setting::where('key', 'payment_recipient')->value('value') ?? '';
        $paymentAccounts = Setting::where('key', 'payment_accounts')->value('value') ?? '';
        
        return view('user.hosting.payment_proof', [
            'order' => $hosting_order,
            'qrisImage' => $qrisImage,
            'paymentRecipient' => $paymentRecipient,
            'paymentAccounts' => $paymentAccounts,
        ]);
    }

    /**
     * Step 5: Submit Payment Proof
     */
    public function submitPayment(Request $request, Order $hosting_order)
    {
        if ($hosting_order->user_id !== Auth::id()) abort(403);

        $request->validate([
            'payment_method' => 'required|string',
            'account_name' => 'required|string|max:255',
            'proof_image' => 'required|image|max:2048',
        ]);

        $path = $request->file('proof_image')->store('payments', 'public');

        $hosting_order->payment()->updateOrCreate(
            ['order_id' => $hosting_order->id],
            [
                'payment_method' => $request->payment_method,
                'account_name' => $request->account_name,
                'proof_image' => $path,
                'status' => 'pending',
            ]
        );

        $hosting_order->update([
            'status' => 'waiting_confirmation',
            'payment_proof' => $path
        ]);

        return redirect()->route('user.hosting.my-services')->with('success', 'Bukti pembayaran berhasil diupload. Mohon tunggu konfirmasi admin.');
    }

    /**
     * My Services List
     */
    public function myServices()
    {
        $orders = Order::with(['hostingPackage', 'hostingAccount'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('user.hosting.my_services', compact('orders'));
    }
}
