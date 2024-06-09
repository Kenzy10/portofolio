<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;


class MessageController extends Controller
{
    public function index()
    {
        return view('portofolio.index');
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Simpan pesan ke dalam database
        Message::create($request->all());

        if (pengiriman_berhasil) {
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to send message. Please try again later.');
        }
    }

    public function sendMessage(Request $request)
{
    // Proses validasi data formulir di sini

    // Kirim email
    $details = [
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ];

    Mail::to('nurrasyawijaya@gmail.com')->send(new ContactFormMail($details));

    // Tambahkan pesan Blade berfungsi di sini, misalnya:
    return redirect()->back()->with('success', 'Your message has been sent successfully!');
}
}