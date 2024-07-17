<?php

namespace App\Http\Services;

use Hash;
use Session;
use App\Models\Client;
use App\Models\SMSToken;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Http\Request\UpdateRequest;

class ClientService {

    protected $Client;
    protected $User;

    private $UpdateRequest;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(Client $Client, User $User, UpdateRequest $UpdateRequest) {
        
        $this->Client = $Client;
        $this->User = $User;
        $this->UpdateRequest = $UpdateRequest;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function countClientService() {

        return $this->User->where('client_id', '!=', null)->where(['status' => 0])->count();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function countPendingClientService() {

        return $this->User->where('client_id', '!=', null)->where(['status' => 1])->count();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function registerClient(Request $request) {

       if($request->password == $request->password_confirmation) {

            foreach($this->User->get() as $get) {
                if($get->email == $request->contact_number) {
                    return response()->json(['Error' => 1, 'Message'=> 'Contact Number is already taken']); 
                }
            }
            
            date_default_timezone_set("Asia/Singapore"); 
            $datetime = date('Ymd-His');

            $photoFilename = \Str::slug($request->lastname.'-'.$datetime).'.'.$request->photo->extension(); 
            $transferfile = $request->file('photo')->storeAs('public/photo/', $photoFilename);      
            
            $validIDFilename = \Str::slug('id-'.$request->lastname.'-'.$datetime).'.'.$request->photo->extension(); 
            $transferfile = $request->file('validID')->storeAs('public/photo/', $validIDFilename);      

            $client = $this->Client->create([
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'address' => $request->address,
                'birthdate' => $request->birthdate,
                'contact_number' => $request->contact_number,
                'gender' => $request->gender,
                'valid_id' => $validIDFilename,
                'photo' => $photoFilename,
            ]);

            $user = $this->User->create([
                'client_id' => $client->id,
                'email' => $request->contact_number,
                'password' => $request->password,
                'type' => 2,
                'status' => 1
            ]);
            
            auth()->login($user);

            return response()->json(['Error' => 0, 'Message'=> 'Your account created successfully']); 
       }
        else {
            return response()->json(['Error' => 1, 'Message'=> 'Your password confirmation did not match']); 
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getClientsService($page) {

        if(auth()->user()->type == 1) {
            $clients = $this->Client->orderBy('lastname', 'ASC')->get();
            $count_clients = $this->User->where('client_id', '!=', null)->where(['status' => 0])->count();
            $count_pending_clients = $this->User->where('client_id', '!=', null)->where(['status' => 1])->count();

            if($page == "clients") {
                return view('pages.clients', compact('clients', 'count_clients', 'count_pending_clients'));
            }
            if($page == "pending-clients") {
                return view('pages.client.pending-clients', compact('clients'));
            }
            if($page == "validated-clients") {
                return view('pages.client.validated-clients', compact('clients'));
            }
        }
        else {
            return abort(404);
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function verifyClientService($request) {

        $smstoken = SMSToken::get();
        $client = $this->Client->where(['id' => $request->client_id])->get();

        foreach ($smstoken as $st) {
            $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
            $mobile_token = $st->access_token; // as per your creation of token
        }

        // mobile number to send text to
        foreach($client as $cl) {

            $addresses = $cl->contact_number; 
            $sms = 'From: Christ the Healer Hospital \n\nGreetings! We are pleased to inform you that your account verification process has been successfully completed. Feel free to begin exploring the page by following this link: https://web-as.ccsit.info/ \n\nThank you.';
        }

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

        foreach($this->Client->where(['id' => $request->client_id])->get() as $get) {
            File::delete(public_path("storage/photo/{$get->valid_id}"));
        }
        $this->User->where(['client_id' => $request->client_id])->update(['status' => 0]);
        $this->Client->where(['id' => $request->client_id])->update(['valid_id' => null]);
        return response()->json(['Error' => 0, 'Message'=> 'This Account has been verified successfully']); 
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function declineClientService($request) {

        $smstoken = SMSToken::get();
        $client = $this->Client->where(['id' => $request->client_id])->get();

        foreach ($smstoken as $st) {
            $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
            $mobile_token = $st->access_token; // as per your creation of token
        }

        // mobile number to send text to
        foreach($client as $cl) {

            $addresses = $cl->contact_number; 
            $sms = 'From: Christ the Healer Hospital \n\nGood day! We regret to inform you that your account has been declined due to a blurry image and/or a mismatch between the uploaded selfie and ID. Kindly consider creating a new account with a clear image and/or a matched image. \n\nThank you.';
        }

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

        foreach($this->Client->where(['id' => $request->client_id])->get() as $get) {
            File::delete(public_path("storage/photo/{$get->valid_id}"));
            File::delete(public_path("storage/photo/{$get->photo}"));
        }
        
        $this->User->where(['client_id' => $request->client_id])->delete();
        $this->Client->where(['id' => $request->client_id])->delete();

        return response()->json(['Error' => 0, 'Message'=> 'This Account has been declined successfully']); 
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateClientService($request) {

        if($request->photo == null) {

            if(!empty($request->old_password) && !empty($request->new_password)) {

                if($this->UpdateRequest->updateClientPassword($request) == true) {
                    return $this->UpdateRequest->updateClient($request);
                }
                if($this->UpdateRequest->updateClientPassword($request) == false) {
                    return response()->json(['Error' => 1, 'Message'=> 'Your old password did not match our records']);
                }
                
            }
            else {
                return $this->UpdateRequest->updateClient($request);
            }
        }
        else {

            if(!empty($request->old_password) && !empty($request->new_password)) {

                if($this->UpdateRequest->updateClientPassword($request) == true) {
                    $this->UpdateRequest->updateClientPhoto($request);
                    return $this->UpdateRequest->updateClient($request);
                }
                if($this->UpdateRequest->updateClientPassword($request) == false) {
                    return response()->json(['Error' => 1, 'Message'=> 'Your old password did not match our records']);
                }

            }
            else {
                
                $this->UpdateRequest->updateClientPhoto($request);
                return $this->UpdateRequest->updateClient($request);

            }
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function resubmitCredentialsService($request) {

        if(!empty($request->old_password) && !empty($request->new_password)) {

            if(Hash::check($request->old_password, Auth::user()->password)) {
                $this->User->where(['id' => $request->update_id])->update([
                    'password' => bcrypt($request->new_password)
                ]);
    
                return $this->UpdateRequest->resubmitCredentials($request);
            }
            else {
                return response()->json(['Error' => 1, 'Message'=> 'Your old password did not match our records']);
            }
        }
        else {
            
            return $this->UpdateRequest->resubmitCredentials($request);

        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchClientService($request) {

        $clients = $this->Client->where('lastname', 'like', '%'.$request->search_client.'%')
        ->orWhere('firstname', 'like', '%'.$request->search_client.'%')
        ->orWhere('middlename', 'like', '%'.$request->search_client.'%')
        ->orderBy('lastname', 'ASC')->get();

        return response()->json
            ([
                'Pending' => view('pages.tables.pending-client', compact('clients'))->render(), 
                'Declined' => view('pages.tables.declined-client', compact('clients'))->render(), 
                'Verified' => view('pages.tables.verified-client', compact('clients'))->render()
            ]);
    }
}