<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        
        // Initialize default settings if they don't exist
        $defaults = [
            'about_title' => 'Mitra Digital Terpercaya Anda',
            'about_description' => 'Kuukok Creative Agency lahir dari semangat untuk membantu bisnis dan individu bertransformasi di era digital. Kami percaya bahwa setiap brand memiliki cerita unik yang layak didengar, dan teknologi adalah jembatan terbaik untuk menyampaikannya.',
            'about_image' => '', // Will be handled by file upload
            'vision_text' => 'Menjadi agensi kreatif digital terdepan yang memberdayakan UMKM dan bisnis di Indonesia melalui inovasi teknologi dan desain yang berdampak.',
            'mission_text' => "Menyediakan solusi digital berkualitas tinggi dengan harga terjangkau.\nMembangun ekosistem digital yang ramah pengguna dan mudah dikelola.\nMemberikan edukasi dan dukungan teknis berkelanjutan bagi klien.",
        ];

        foreach ($defaults as $key => $value) {
            Setting::firstOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'about']
            );
        }

        $settings = Setting::where('group', 'about')->get()->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $data = $request->except(['_token', '_method', 'about_image']);

        // Update text settings
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'about']
            );
        }

        // Handle Image Upload
        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $path = $file->store('settings', 'public');
            
            // Delete old image if exists
            $oldImage = Setting::where('key', 'about_image')->value('value');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            Setting::updateOrCreate(
                ['key' => 'about_image'],
                ['value' => $path, 'group' => 'about', 'type' => 'image']
            );
        }

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
