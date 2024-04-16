<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\ContactFormAutoResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Show the contact form view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle sending emails through the contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        try {
            // Data for the contact email
            $details = [
                'name' => $request->fullname,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            // Send the contact form email
            Mail::to('jeronimostore1@gmail.com')->send(new ContactFormMail($details));

            // Send an auto-response to the user
            Mail::to($request->email)->send(new ContactFormAutoResponse());

            // Redirect back with a success message
            return back()->with('success', 'Благодарим Ви, че се свързахте с нас. Ще Ви отговорим възможно най-скоро!');
            
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', 'Failed to send email');
        }
    }
}
