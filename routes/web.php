<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $testimonials = \App\Models\Testimonial::where('status', 'active')->orderBy('sort_order')->orderByDesc('created_at')->get();
    $packages = \App\Models\Package::where('status', 'active')->orderBy('sort_order')->get();
    $portfolios = \App\Models\Portfolio::where('status', 'published')->orderByDesc('published_at')->take(6)->get();
    $settings = \App\Models\Setting::where('group', 'about')->pluck('value', 'key');

    // Stats Logic
    $projectCount = \App\Models\Portfolio::count(); // Count all created projects as per request "berdasarkan di halaman projek yang dibuat"
    $projectCountText = $projectCount < 10 ? $projectCount : (floor($projectCount / 10) * 10 . '+');

    $clientCount = \App\Models\Testimonial::count(); // "menampilkan berdasarkan data testimoni"
    $clientCountText = $clientCount < 10 ? $clientCount : (floor($clientCount / 10) * 10 . '+');

    $years = date('Y') - 2020;
    $yearsText = $years . '+';

    return view('index', compact('testimonials', 'packages', 'portfolios', 'settings', 'projectCountText', 'clientCountText', 'yearsText'));
})->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{post}/track', [BlogController::class, 'trackClick'])->name('blog.track');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/pricing', function () {
    $packages = \App\Models\Package::where('status', 'active')->orderBy('sort_order')->get();
    $testimonials = \App\Models\Testimonial::where('status', 'active')->orderBy('sort_order')->orderByDesc('created_at')->get();
    $faqs = \App\Models\Faq::where('active', true)->orderBy('sort_order')->get();
    $settings = \App\Models\Setting::where('group', 'pricing')->pluck('value', 'key');
    return view('pricing', compact('packages', 'testimonials', 'faqs', 'settings'));
})->name('pricing.index');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

use App\Http\Controllers\Auth\ForgotPasswordController;

// Auth Routes (Login is handled by Breeze/Default Auth, but we override Forgot Password)
Route::get('forgot-password', [ForgotPasswordController::class, 'showEmailForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');
Route::get('forgot-password/otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp');
Route::post('forgot-password/otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify-otp');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
// Fallback for standard Laravel/Fortify reset links (redirect to our format)
Route::get('reset-password/{token}', function ($token) {
    return redirect()->route('password.reset', ['token' => $token, 'email' => request()->query('email')]);
});
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/about', function () {
    $team = \App\Models\Profile::with('user')->get();
    $settings = \App\Models\Setting::where('group', 'about')->pluck('value', 'key');

    // Stats Logic (Consistent with Home)
    $projectCount = \App\Models\Portfolio::count();
    $projectCountText = $projectCount < 10 ? $projectCount : (floor($projectCount / 10) * 10 . '+');

    $clientCount = \App\Models\Testimonial::count();
    $clientCountText = $clientCount < 10 ? $clientCount : (floor($clientCount / 10) * 10 . '+');

    $years = date('Y') - 2020;
    $yearsText = $years . '+';

    return view('about', compact('team', 'settings', 'projectCountText', 'clientCountText', 'yearsText'));
})->name('about.index');
Route::get('/team/{profile}', [App\Http\Controllers\TeamController::class, 'show'])->name('team.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::post('posts/upload-image', [PostController::class, 'uploadImage'])->name('posts.upload-image');
    Route::resource('posts', PostController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('portfolios', AdminPortfolioController::class);
    Route::resource('testimonials', TestimonialController::class);

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.destroy');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Web Settings
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Tech Stacks
    Route::resource('tech-stacks', \App\Http\Controllers\Admin\TechStackController::class);

    // User Management (Super Admin only)
    Route::middleware('can:manage-users')->resource('users', \App\Http\Controllers\Admin\UserController::class);

    // Utility route for storage link (alternative for hosting with disabled functions)
    Route::get('/fix-storage', function () {
        $target = storage_path('app/public');
        $link = public_path('storage');

        try {
            // 1. Cek apakah link/folder sudah ada
            if (file_exists($link)) {
                // Jika is_link (symlink), hapus dengan unlink
                if (is_link($link)) {
                    unlink($link);
                }
                // Jika is_dir (folder asli), biarkan saja (jangan dihapus agar data aman)
                // Kita akan menggunakan folder ini secara langsung berkat config filesystems baru
                elseif (is_dir($link)) {
                    return 'Storage folder detected (Directory Mode). Ready to use. <a href="/admin/profile">Back to Profile</a>';
                }
            }

            // 2. Coba buat Symlink
            try {
                symlink($target, $link);
                return 'Storage link RE-CREATED (Symlink Mode). <a href="/admin/profile">Back to Profile</a>';
            } catch (\Throwable $e) {
                // 3. Jika Symlink gagal (biasanya di shared hosting), buat Folder Biasa
                // Karena kita sudah ubah config filesystems 'root' ke public_path('storage'),
                // maka folder biasa pun akan berfungsi normal!
                if (!is_dir($link)) {
                    mkdir($link, 0755, true);
                }
                return 'Storage folder CREATED (Directory Mode - Fallback). <a href="/admin/profile">Back to Profile</a>';
            }
        } catch (\Throwable $e) {
            return 'Error: ' . $e->getMessage() . '<br>Please create "storage" folder manually in public_html.';
        }
    })->middleware('can:access-admin');
});
