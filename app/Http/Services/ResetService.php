<?php

namespace App\Http\Services;

use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
use App\Models\TimeSlots;
use App\Models\Appointments;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Http\Request\UpdateRequest;

class ResetService {

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
    public function updateFailedAppointmentVisit() {

        date_default_timezone_set("Asia/Singapore"); 
        $today = date('Y-m-d');

        $this->Appointments->where(['status' => 0])->where('date', '<', $today)->update(['status' => 3]);
    }
}