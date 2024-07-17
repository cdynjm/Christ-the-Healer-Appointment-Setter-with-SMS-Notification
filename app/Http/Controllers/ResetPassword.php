<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\SMSToken;
use App\Models\ResetPasswordToken;
use App\Notifications\ForgotPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class ResetPassword extends Controller
{
    use Notifiable;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function show()
    {
        return view('auth.reset-password');
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function routeNotificationForMail() {
        return request()->email;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function send(Request $request)
    {
        $email = $request->validate([
            'email' => ['required']
        ]);
        $user = User::where('email', $email)->first();

        if ($user) {
            $this->notify(new ForgotPassword($user->id));
            return back()->with('succes', 'An email was send to your email address');
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function resetPassword(Request $request) {

        ResetPasswordToken::where(['email' => $request->email])->delete();

        $check = User::where(['email' => $request->email])->count();

        if($check == 0) {
            return response()->json(['Error' => 1, 'Message'=> 'Your credentials did not match our records']); 
        }

        foreach(User::where(['email' => $request->email])->get() as $get) {
            
                $reset = ResetPasswordToken::create([
                    'email' => $request->email,
                    'phone_number' => $request->email,
                    'code' => \Str::random(6)
                ]);

                $smstoken = SMSToken::get();

                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                    $addresses = $get->Client->contact_number; 
                    $sms = 'From: Christ the Healer Hospital\n\nYour Verification Code:\n\n'.$reset->code.'';
                
                $ch = curl_init();
                foreach ($smstoken as $st) {
                    curl_setopt($ch, CURLOPT_URL, $st->url);
                }
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"data\":{\"addresses\":[\"$addresses\"],\"message\":\"$sms\",\"target_device_iden\":\"$mobile_iden\"}}");

                $headers = [];
                $headers[] = 'Access-Token: '.$mobile_token;
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }

                return response()->json(['Error' => 0, 'Message'=> 'Verification Code sent successfully']); 
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function resetPasswordCode(Request $request) {

        $check = ResetPasswordToken::
                      where(['email' => $request->email])
                    ->where(['code' => $request->code])
                    ->count();

        if($check == 0) {
            return response()->json(['Error' => 1, 'Message'=> 'Your verification code did not match our records']); 
        }
        else {
            return response()->json(['Error' => 0, 'Message'=> 'You can now reset your password']); 
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function changePassword(Request $request) {

        User::where(['email' => $request->email])->update(['password' => bcrypt($request->password)]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return response()->json(['Error' => 0, 'Message'=> 'Your password resetted successfully']); 
        }
    }
}
