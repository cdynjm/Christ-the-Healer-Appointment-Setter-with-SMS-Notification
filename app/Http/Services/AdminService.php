<?php

namespace App\Http\Services;

use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Http\Request\UpdateRequest;

class AdminService {

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
    public function updateAdminService($request) {

        if($request->photo == null) {

            if(!empty($request->old_password) && !empty($request->new_password)) {

                if($this->UpdateRequest->updateAdminPassword($request) == true) {
                    return $this->UpdateRequest->updateAdmin($request);
                }
                if($this->UpdateRequest->updateAdminPassword($request) == false) {
                    return response()->json(['Error' => 1, 'Message'=> 'Your old password did not match our records']);
                }
                
            }
            else {
                return $this->UpdateRequest->updateAdmin($request);
            }
        }
        else {

            if(!empty($request->old_password) && !empty($request->new_password)) {

                if($this->UpdateRequest->updateAdminPassword($request) == true) {
                    $this->UpdateRequest->updateAdminPhoto($request);
                    return $this->UpdateRequest->updateAdmin($request);
                }
                if($this->UpdateRequest->updateAdminPassword($request) == false) {
                    return response()->json(['Error' => 1, 'Message'=> 'Your old password did not match our records']);
                }

            }
            else {
                
                $this->UpdateRequest->updateAdminPhoto($request);
                return $this->UpdateRequest->updateAdmin($request);

            }
        }
    }
}