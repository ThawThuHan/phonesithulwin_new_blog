<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\SiteMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function index()
    {
        $siteMaster = SiteMaster::latest()->first();
        return view('contact', ["siteMaster" => $siteMaster]);
    }

    public function sendMail(Request $request)
    {
        $details = [
            "name" => $request->yname,
            "email" => $request->email,
            "phone" => $request->phone,
            "messages" => $request->messages,
        ];
        try {
            Mail::to("support@phonesithulwin.info")->send(new ContactMail($details));
        } catch (\Throwable $th) {
            return back()->with("error", "Email sending fail! please try again later...");
        }
        return back()->with("success", "Email send success! thanks.");
    }
}
