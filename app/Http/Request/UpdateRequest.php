<?php

namespace App\Http\Request;

use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UpdateRequest {

    protected $Client;
    protected $User;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(Client $Client, User $User) {
        
        $this->Client = $Client;
        $this->User = $User;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateAdmin($request) {

        $this->User->where(['id' => $request->update_id])->update(['email' => null]);
                
        foreach($this->User->get() as $get) {
            if($get->email == $request->email) {
                return response()->json(['Error' => 1, 'Message'=> 'Username is already taken']); 
            }
        }

        $this->User->where(['id' => $request->update_id])->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'middlename' => $request->middlename,
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Your account updated successfully']);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateAdminPhoto($request) {

        date_default_timezone_set("Asia/Singapore"); 
        $datetime = date('Ymd-His');
        
        foreach($this->User->where(['id' => $request->update_id])->get() as $get) {
            File::delete(public_path("storage/photo/{$get->photo}"));
        }

        $photoFilename = \Str::slug($request->lastname.'-'.$datetime).'.'.$request->photo->extension(); 
        $transferfile = $request->file('photo')->storeAs('public/photo/', $photoFilename);

        $this->User->where(['id' => $request->update_id])->update(['photo' => $photoFilename]);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateAdminPassword($request) {
        
        if(Hash::check($request->old_password, Auth::user()->password)) {
            $this->User->where(['id' => $request->update_id])->update([
                'password' => bcrypt($request->new_password)
            ]);

            return true;
        }
        else {
            return false;
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function resubmitCredentials($request) {

        $this->User->where(['client_id' => $request->update_id])->update(['email' => null]);
                
        foreach($this->User->get() as $get) {
            if($get->email == $request->email) {
                return response()->json(['Error' => 1, 'Message'=> 'Email is already taken']); 
            }
        }

        date_default_timezone_set("Asia/Singapore"); 
        $datetime = date('Ymd-His');

        $photoFilename = \Str::slug($request->lastname.'-'.$datetime).'.'.$request->photo->extension(); 
        $transferfile = $request->file('photo')->storeAs('public/photo/', $photoFilename);      
        
        $validIDFilename = \Str::slug('id-'.$request->lastname.'-'.$datetime).'.'.$request->photo->extension(); 
        $transferfile = $request->file('validID')->storeAs('public/photo/', $validIDFilename);  

        $this->Client->where(['id' => $request->update_id])->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'middlename' => $request->middlename,
            'photo' => $photoFilename,
            'valid_id' => $validIDFilename
        ]);

        $this->User->where(['client_id' => $request->update_id])->update([
            'email' => $request->email,
            'status' => 1
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Your credentials has been re-submitted successfully for verification']);

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateClient($request) {

        $this->User->where(['client_id' => $request->update_id])->update(['email' => null]);
                
        foreach($this->User->get() as $get) {
            if($get->email == $request->email) {
                return response()->json(['Error' => 1, 'Message'=> 'Contact Number is already taken']); 
            }
        }

        $this->Client->where(['id' => $request->update_id])->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'contact_number' => $request->email,
        ]);

        $this->User->where(['client_id' => $request->update_id])->update([
            'email' => $request->email
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Your account updated successfully']);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateClientPhoto($request) {

        date_default_timezone_set("Asia/Singapore"); 
        $datetime = date('Ymd-His');
        
        foreach($this->Client->where(['id' => $request->update_id])->get() as $get) {
            File::delete(public_path("storage/photo/{$get->photo}"));
        }

        $photoFilename = \Str::slug($request->lastname.'-'.$datetime).'.'.$request->photo->extension(); 
        $transferfile = $request->file('photo')->storeAs('public/photo/', $photoFilename);

        $this->Client->where(['id' => $request->update_id])->update(['photo' => $photoFilename]);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateClientPassword($request) {
        
        if(Hash::check($request->old_password, Auth::user()->password)) {
            $this->User->where(['client_id' => $request->update_id])->update([
                'password' => bcrypt($request->new_password)
            ]);

            return true;
        }
        else {
            return false;
        }
    }
}

?>