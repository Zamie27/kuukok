<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HostingPackage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HostingUpgradeController extends Controller
{
    /**
     * Show available upgrade packages
     */
    public function index(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        if ($order->status !== 'active') {
            return redirect()->route('user.hosting.my-services')->with('error', 'Hanya layanan aktif yang dapat diupgrade.');
        }

        $currentPackage = $order->hostingPackage;
        
        // Fetch packages with higher rank
        $packages = HostingPackage::where('status', 'active')
            ->where('rank', '>', $currentPackage->rank)
            ->orderBy('rank')
            ->get();

        // Specific rule: If current is Pro (Rank 20, no custom domain) or Custom Domain (Rank 20, is custom domain)
        // User said: "Pro diarahkan ke Full Service", "Custom Domain diarahkan ke Full Service"
        // This is naturally handled if Pro/Custom have rank 20 and Full Service has rank 30.

        return view('user.hosting.upgrade_select', compact('order', 'packages', 'currentPackage'));
    }

    /**
     * Show the upgrade form
     */
    public function create(Order $order, HostingPackage $package)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        
        $currentPackage = $order->hostingPackage;
        if ($package->rank <= $currentPackage->rank) {
            return redirect()->route('user.hosting.upgrade.index', $order->id)->with('error', 'Anda hanya dapat upgrade ke paket yang lebih tinggi.');
        }

        return view('user.hosting.upgrade_form', compact('order', 'package', 'currentPackage'));
    }

    /**
     * Store the upgrade order
     */
    public function store(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        $request->validate([
            'hosting_package_id' => 'required|exists:hosting_packages,id',
            'domain_name' => 'required|string|max:255',
        ]);

        $package = HostingPackage::findOrFail($request->hosting_package_id);
        $currentPackage = $order->hostingPackage;

        // Calculate basic price difference
        // If Custom Domain/Full Service, set to 0 and wait for admin
        $priceTotal = 0;
        $status = 'waiting_price';

        if (!$package->is_custom_domain) {
            $priceTotal = max(0, $package->price - $currentPackage->price);
            $status = 'pending_payment';
        }

        $upgradeOrder = Order::create([
            'user_id' => Auth::id(),
            'type' => 'upgrade',
            'parent_id' => $order->id,
            'hosting_package_id' => $package->id,
            'customer_name' => $order->customer_name,
            'customer_email' => $order->customer_email,
            'project_name' => $order->project_name,
            'framework' => $order->framework,
            'database' => $order->database,
            'whatsapp_number' => $order->whatsapp_number,
            'github_repo_url' => $order->github_repo_url,
            'domain_type' => $package->is_custom_domain ? 'custom' : 'subdomain',
            'domain_name' => $request->domain_name,
            'price_total' => $priceTotal,
            'unique_code' => $priceTotal > 0 ? rand(1, 999) : 0,
            'status' => $status,
        ]);

        if ($status === 'waiting_price') {
            return redirect()->route('user.hosting.my-services')->with('success', 'Permintaan upgrade berhasil dikirim. Admin akan segera mengecek ketersediaan domain dan menentukan harga.');
        }

        return redirect()->route('user.hosting.payment', $upgradeOrder->id);
    }
}
