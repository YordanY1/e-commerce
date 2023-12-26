<?php

namespace App\Http\Controllers;
use App\Mail\ContactFormMail;
use App\Mail\ContactFormAutoResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        try {
            $details = [
                'name' => $request->fullname,
                'email' => $request->email,
                'message' => $request->message,
                'subject' => $request->subject
            ];

            Mail::to('nothingstar142@gmail.com')->send(new ContactFormMail($details));

            Mail::to($request->email)
            ->send(new ContactFormAutoResponse());

            return response()->json(['message' => 'Email sent successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email'], 500);
        }
    }
}
