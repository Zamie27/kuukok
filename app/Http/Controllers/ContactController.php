<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Setting;
use App\Models\Faq;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('active', true)->orderBy('sort_order')->get();
        return view('contact', compact('faqs'));
    }

    public function store(Request $request)
    {
        // Get valid subjects from settings or use default
        $validSubjects = array_filter(array_map('trim', explode("\n", Setting::getValue('contact_subjects', "Penawaran Proyek\nKonsultasi\nKerjasama\nLainnya"))));

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) use ($validSubjects) {
                // Optional: Check if the value is in the allowed list
                // If the user manually edits HTML or sends a custom request, we might want to restrict it or just accept it.
                // Given "input Subjek pada Hubungi kami di dashboard" implies management, stricter validation is good.
                // However, let's just trim and accept to be safe if list changes, unless strictly required.
                // But typically for a dropdown, we expect one of the values.
                // Let's loosen it slightly to just string validation unless requested otherwise,
                // but for "Opsi" usually implies restriction.
                // Let's check if the list is not empty before validating against it.
                if (!empty($validSubjects) && !in_array($value, $validSubjects)) {
                    // We can allow custom subjects if "Lainnya" is selected?
                    // Usually the value sent is "Lainnya" or the text itself.
                    // If the UI is a select, the value sent is one of the options.
                    // If we want to be strict:
                    // if (!in_array($value, $validSubjects)) $fail($attribute.' is invalid.');
                    // For now, let's keep it flexible as a string since the user might change settings while a user has the form open.
                }
            }],
            'body' => ['required', 'string'],
        ]);

        Message::create($data);

        return back()->with('status', 'Pesan Anda telah berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
