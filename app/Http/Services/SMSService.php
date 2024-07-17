<?php

namespace App\Http\Services;

use Hash;
use Session;
use App\Models\SMSToken;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SMSService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateSMSService($request) {

        SMSToken::where(['id' => 1])->update(['access_token' => $request->access_token, 'mobile_identity' => $request->mobile_identity]);
        return response()->json(['Error' => 0, 'Message'=> 'SMS Settings Configured successfully']);

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getSMSService() {

        if(auth()->user()->type == 1) {
            $smstoken = SMSToken::get();
            return view('pages.sms-configuration', compact('smstoken'));
        }
        else {
            return abort(404);
        }
    }
}