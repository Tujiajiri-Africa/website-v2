<?php

namespace App\Http\Controllers;

use App\Mail\UserWaitListEmail;
use App\Models\WaitList;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Postmark\PostmarkClient;

class WaitListController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        try{
            $rules = [
                'email'     => 'required|email'
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => ''
                ]);
            }
            $client = new PostmarkClient(config('postmark.token'));
            
            $verification_token = hash('sha256', utf8_encode(Str::uuid()));
            $action_url = url('/waitlist/waitlist_verification'). "?invite=$verification_token";
            
            $data = [
                'email'     => $request->email,
                'invite_token' => $verification_token,
                'action_url' =>  $action_url 
            ];
            
            $existing_user = WaitList::firstWhere('email', $data['email']);

            if($existing_user && ($existing_user->confirmed == WaitList::CONFIRMED_WAITLIST || 
            $existing_user->confirmed == WaitList::CONFIRMED_WAITLIST)){
                return response()->json([
                    'success' => false,
                    'message' => 'Already Added To Waitlist!',
                    'error' => ''
                ]);
            }else{
                $created = WaitList::create([
                    'email' => $data['email'],
                    'invite_token' => $data['invite_token']
                ]);
    
                if($created){
                    //TODO send confirmation email here
                    return response()->json([
                        'success' => true,
                        'message' => 'Thank you for joining our waitlist! Keep an eye for updates!',
                        'error' => ''
                    ]);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Something went wrong adding you to waitlist, please try again later or contact our team for support!',
                        'error' => ''
                    ]);
                }
            }

        }catch(\Exception $exception){
            Log::critical('Failed to add user to waitlist. ERROR. '.$exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong adding you to waitlist, please try again later or contact our team for support!',
                'error' => ''
            ]);
        }
    }

    public function confirm(Request $request): JsonResponse
    {
        try{
            // $user = WaitList::where(function($query) use($request){
            //     $query->where('invite_token', $request->invite_token)->first();
            // });

            $user = WaitList::firstWhere('invite_token', $request->get('invite'));

            if($user && $user->confirmed ==  WaitList::CONFIRMED_WAITLIST ){
                return response()->json([
                    'success' => false,
                    'message' => 'No Action Needed!',
                    'error' => ''
                ]); //u566004116_aCk6f
            }else if($user && $user->confirmed ==  WaitList::UNCONFORMED_WAITLIST){
                $user->update(['confirmed' => WaitList::CONFIRMED_WAITLIST,'invite_token' => null ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Successfully added to waitlist! Stay tuned for more updates coming soon!',
                    'error' => ''
                ]);
                redirect(route('welcome'));
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Invite Token',
                    'error' => ''
                ]);
            }
        }catch(\Exception $exception){
            Log::critical('Failed to confirm user for waitlist. ERROR. '.$exception->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong confirming you to waitlist, please try again later or contact our team for support!',
                'error' => ''
            ]);
        }
    }

    public function loadVerificationPage(Request $request){
        $user = WaitList::firstWhere('invite_token', $request->get('invite'));
        if($user){
            $user->update([
                ['confirmed' => WaitList::CONFIRMED_WAITLIST]
            ]);
        }
        return view('mail.verification_page',['invite_token' => $request->invite_token]);
    }
}
