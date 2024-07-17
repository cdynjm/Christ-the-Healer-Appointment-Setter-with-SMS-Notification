<?php

namespace App\Http\Services;

use Hash;
use DateTime;
use Session;
use App\Models\Client;
use App\Models\User;
use App\Models\TimeSlots;
use App\Models\Appointments;
use App\Models\SMSToken;
use App\Models\AutoSMSHistory;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Http\Request\UpdateRequest;

class AutoSMSService {

    protected $Client;
    protected $User;
    protected $TimeSlots;
    protected $Appointments;

    private $UpdateRequest;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(Client $Client, User $User, UpdateRequest $UpdateRequest, TimeSlots $TimeSlots, Appointments $Appointments) {
        
        $this->Client = $Client;
        $this->User = $User;
        $this->TimeSlots = $TimeSlots;
        $this->Appointments = $Appointments;

        $this->UpdateRequest = $UpdateRequest;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function autoSendMessage() {

        date_default_timezone_set("Asia/Singapore"); 

        foreach($this->Appointments->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'DESC')->get() as $get) {
            
            $date = date('Y-m-d H:i:s');
            $today = date('Y-m-d');

            $schedule = $get->date." ".'07:00:00';

            if($schedule <= $date) {
                
                foreach (AutoSMSHistory::get() as $exist) {
                    if($exist->appointment_id == $get->id && $exist->date == $get->date) {
                        return false;
                    }
                }

                $smstoken = SMSToken::get();
        
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
        
                // mobile number to send text to
            
                $addresses = $get->Client->contact_number; 
                $sms = 'From: Christ The Healer Hospital \n\nGood day! Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'. Just a message reminder of your appointment for today:\n\nPriority Number: '.$get->queue.'\nDate: '.date('M d, Y', strtotime($get->date)).'\nPurpose: '.$get->purpose.'\n\nThank you!';
        
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

                AutoSMSHistory::create([
                    'appointment_id' => $get->id,
                    'date' => $get->date
                ]);

            }

        }
       
    }
}