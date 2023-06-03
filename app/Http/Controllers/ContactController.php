<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function message(Request $request): JsonResponse
    {
        $rules = [
            'name'      => 'required|string|min:3|max:20',
            'email'     => 'required|email',
            'message'   => 'required|string|min:10|max:255',
            'subject'   => 'required|string|min:3|max:60'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => ''
            ]);
        }

        $data = [
            'name'      => $request->name,
            'message'   => $request->message,
            'email'     => $request->email,
            'subject'   => $request->subject,
            'url'       => route('welcome'),
        ];
        try{
            Mail::to(config('mail.support_email.to_address'))->send(new ContactEmail($data));
            /*
            $sendMail = Mail::to('dickensodera9@gmail.com')->send(new ContactEmail($data));
            if(!$sendMail){
                return response()->json([
                    'success' => false,
                    'message' => 'Communication not sent, please try again later on',
                    'error' => ''
                ]);
            }
            */
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us, our in-house team will review your message and get back to you soon',
                'error' => ''
            ]);
        }catch (\Exception $exception){
             Log::critical('Failed to send communication. ERROR. '.$exception->getMessage());
             return response()->json([
                 'success' => false,
                 'message' => 'Something went wrong sending email, please try again later',
                 'error' => ''
             ]);
        }
    }
}
