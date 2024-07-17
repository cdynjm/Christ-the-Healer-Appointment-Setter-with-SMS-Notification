<?php

namespace App\Http\Services;

use Hash;
use Session;
use DateTime;
use App\Models\Client;
use App\Models\User;
use App\Models\TimeSlots;
use App\Models\Appointments;
use App\Models\SMSToken;
use App\Models\Cancel;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Http\Request\UpdateRequest;

class AppointmentService {

    protected $Client;
    protected $User;
    protected $TimeSlots;
    protected $Appointments;
    protected $Cancel;
    private $UpdateRequest;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(Cancel $Cancel, Client $Client, User $User, UpdateRequest $UpdateRequest, TimeSlots $TimeSlots, Appointments $Appointments) {
        
        $this->Client = $Client;
        $this->User = $User;
        $this->TimeSlots = $TimeSlots;
        $this->Appointments = $Appointments;
        $this->Cancel = $Cancel;
        $this->UpdateRequest = $UpdateRequest;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function countTodaysAppointmentService() {

        date_default_timezone_set("Asia/Singapore"); 
        $today = date('Y-m-d');

        if(auth()->user()->type == 1) {
            return $this->Appointments->where(['status' => 0])->where(['date' => $today])->count();
        }
        if(auth()->user()->type == 2) {
            return $this->Appointments->where(['client_id' => auth()->user()->Client->id])->where(['status' => 0])->where(['date' => $today])->count();
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function countPendingAppointmentService() {

        if(auth()->user()->type == 1) {
            return $this->Appointments->where(['status' => 1])->count();
        }
        if(auth()->user()->type == 2) {
            return $this->Appointments->where(['client_id' => auth()->user()->Client->id])->where(['status' => 1])->count();
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function countTotalAppointmentService() {

        date_default_timezone_set("Asia/Singapore"); 
        $today = date('Y-m-d');

        if(auth()->user()->type == 2) {
            return $this->Appointments->where(['client_id' => auth()->user()->Client->id])->where('date', '>', $today)->where(['status' => 0])->count();
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getAppointmentsService($page) {

        date_default_timezone_set("Asia/Singapore"); 
        $today = date('Y-m-d');

        if(auth()->user()->type == 1) {
            $dateSelected = date('Y-m-d');
            $time_slots = $this->TimeSlots->orderBy('from_time', 'ASC')->get();
            $selected_slots = $this->Appointments->get();
            $appointments = $this->Appointments->orderBy('date', 'DESC')->orderBy('queue', 'ASC')->get();
            $calendar = $this->Appointments->select('date')->distinct()->get();

            $count_todays_appointment = $this->Appointments->where(['status' => 0])->where(['date' => $today])->count();
            $count_pending_appointment = $this->Appointments->where(['status' => 1])->count();
            $count_total_appointment = $this->Appointments->where('date', '>', $today)->where(['status' => 0])->count();

            if($page == "appointment") {
                return view('pages.appointment', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected', 'calendar', 'count_todays_appointment', 'count_pending_appointment', 'count_total_appointment'));
            }
            if($page == "appointment-history") {
                return view('pages.appointment-history', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
            }
            if($page == "pending") {
                return view('pages.appointment.pending', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
            }
            if($page == "today") {
                return view('pages.appointment.today', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
            }
            if($page == "upcoming") {
                return view('pages.appointment.upcoming', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
            }

        }

        if(auth()->user()->type == 2) {
            if(auth()->user()->status == 0) {
                $dateSelected = date('Y-m-d');
                $time_slots = $this->TimeSlots->orderBy('from_time', 'ASC')->get();
                $selected_slots = $this->Appointments->get();
                $appointments = $this->Appointments->where(['client_id' => auth()->user()->Client->id])->orderBy('date', 'DESC')->get();
                $calendar = $this->Appointments->select('date')->distinct()->get();

                $count_todays_appointment = $this->Appointments->where(['client_id' => auth()->user()->Client->id])->where(['status' => 0])->where(['date' => $today])->count();
                $count_pending_appointment = $this->Appointments->where(['client_id' => auth()->user()->Client->id])->where(['status' => 1])->count();
                $count_total_appointment = $this->Appointments->where(['client_id' => auth()->user()->Client->id])->where('date', '>', $today)->where(['status' => 0])->count();

                if($page == "appointment") {
                    return view('pages.appointment', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected', 'calendar', 'count_todays_appointment', 'count_pending_appointment', 'count_total_appointment'));
                }
                if($page == "appointment-history") {
                    return view('pages.appointment-history', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
                }
                if($page == "pending") {
                    return view('pages.appointment.pending', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
                }
                if($page == "today") {
                    return view('pages.appointment.today', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
                }
                if($page == "upcoming") {
                    return view('pages.appointment.upcoming', compact('appointments', 'time_slots', 'selected_slots', 'dateSelected'));
                }
            }
            else {
                return abort(404);
            }
        }
       
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function calendarAppointmentService() {

        return $this->Appointments->get();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function calendarService() {

        return $this->Appointments->select('date')->distinct()->get();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getSelectedSlotsService() {
        
        return $this->Appointments->get();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getAvailableTimeSlotsService() {

        return $this->TimeSlots->orderBy('from_time', 'ASC')->get();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getTimeSlotsService() {

        if(auth()->user()->type == 1) {
            $time_slots = $this->TimeSlots->orderBy('from_time', 'ASC')->get();
            return view('pages.time-slots', compact('time_slots'));
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
    public function getRecentAppointmentService() {

        return $this->Appointments->where('date', '<=', date('Y-m-d'))->where(['status' => 0])->orWhere(['status' => 2])->orderBy('date', 'DESC')->limit(10)->get();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createDateScheduleService($request) {

        $dateSelected = $request->dateValue;
        $time_slots = $this->TimeSlots->orderBy('from_time', 'ASC')->get();
        $selected_slots = $this->Appointments->get();
        
        return view('components.modals.select-time-schedule-modal', compact('time_slots', 'selected_slots', 'dateSelected')); 
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createTimeSlotsService($request) {

        $request->from_time = date('H:i:s', strtotime($request->from_time. ' +1 minutes'));

        foreach($this->TimeSlots->get() as $get) {
            if(($request->from_time > $get->from_time && $request->from_time < $get->to_time) || ($request->to_time > $get->from_time && $request->to_time < $get->to_time) || ($request->from_time < $get->from_time && $request->to_time > $get->to_time)) {
                    return response()->json(['Error' => 1, 'Message'=> 'Time Slot is conflict. Please create another schedule']);   
            }
        }

        $request->from_time = date('H:i:s', strtotime($request->from_time. ' -1 minutes'));

        $this->TimeSlots->create([
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'schedule' => date('h:i a', strtotime($request->from_time))." - ".date('h:i a', strtotime($request->to_time))
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Time Slot created successfully']); 

    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateTimeSlotsService($request) {

        $request->from_time = date('H:i:s', strtotime($request->from_time. ' +1 minutes'));

        foreach($this->TimeSlots->where('id', '!=',  $request->time_id)->get() as $get) {
            if(($request->from_time > $get->from_time && $request->from_time < $get->to_time) || ($request->to_time > $get->from_time && $request->to_time < $get->to_time) || ($request->from_time < $get->from_time && $request->to_time > $get->to_time)) {
                    return response()->json(['Error' => 1, 'Message'=> 'Time Slot is conflict. Please create another schedule']);   
            }
        }

        $request->from_time = date('H:i:s', strtotime($request->from_time. ' -1 minutes'));

        $this->TimeSlots->where(['id' => $request->time_id])->update([
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'schedule' => date('h:i a', strtotime($request->from_time))." - ".date('h:i a', strtotime($request->to_time))
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Time Slot updated successfully']); 

    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function deleteTimeSlotsService($request) {

        $this->TimeSlots->where(['id' => $request->time_id])->delete();

        return response()->json(['Error' => 0, 'Message'=> 'Time Slot deleted successfully']); 

    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createAppointmentService($request) {

      /*  date_default_timezone_set("Asia/Singapore"); 
        $time = '';
        $start_time = '';

        foreach($this->TimeSlots->where(['id' => $request->time])->get() as $get) {
            $time = $get->schedule;
            $start_time = $get->from_time;
        }

        $today = new DateTime();
        $schedule = new DateTime($request->date_scheduled." ".$start_time);
        $interval = $today->diff($schedule);

        if($interval->format("%H") <= 0 && $interval->format("%a") == 0) {
            return response()->json(['Error' => 1, 'Message'=> 'Appointment should be done 1 hour before the appointment target time']);
        }
       if($schedule < $today) {
            return response()->json(['Error' => 1, 'Message'=> 'Appointment should be done 1 hour before the appointment target time']);
       } */

       $queue = 1;

       foreach($this->Appointments->get() as $get) {
            if($get->date == $request->date_scheduled) {
                $queue += 1;
            }
       }

        $this->Appointments->create([
            'client_id' => auth()->user()->Client->id,
            'queue' => $queue,
            'purpose' => $request->purpose,
            'date' => $request->date_scheduled,
            'status' => 1,
            'admin_read' => 1,
            'user_read' => 0,
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Your appoinment schedule has been submitted for approval']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateAppointmentService($request) {

       /* $time = '';
        $start_time = '';

        if(empty($request->time)) {

            $this->Appointments->where(['id' => $request->appointment_id])->update([
                'purpose' => $request->purpose,
                'date' => $request->date_scheduled,
                'status' => 1,
                'user_read' => 0
            ]);

            return response()->json(['Error' => 0, 'Message'=> 'The appointment schedule has been updated successfully']);
        } 

       

            foreach($this->TimeSlots->where(['id' => $request->time])->get() as $get) {
                $time = $get->schedule;
                $start_time = $get->from_time;
            } */

            $queue = 1;
            

            $get = $this->Appointments->where(['date' => $request->date_scheduled])->orderBy('queue', 'DESC')->first();
            
            if(!empty($get->date)) {
                $queue += $get->queue;
            }
            

            $this->Appointments->where(['id' => $request->appointment_id])->update([
                'queue' => $queue,
                'date' => $request->date_scheduled,
            ]);

            $smstoken = SMSToken::get();
            $message = $this->Appointments->where(['id' => $request->appointment_id])->get();
    
            foreach ($smstoken as $st) {
                $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                $mobile_token = $st->access_token; // as per your creation of token
            }
    
            // mobile number to send text to
            foreach($message as $mes) {
    
                $addresses = $mes->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nGood day! Mr/Ms. '.$mes->Client->firstname.' '.$mes->Client->lastname.'. Your scheduled appointment has been rescheduled by the hospital. Your new assigned priority number is '.$mes->queue.'. Please arrive to the hospital on the specified day.\n\nDate: '.date('M d, Y', strtotime($mes->date)).'\nPurpose: '.$mes->purpose.'\n\nThank you!';
                break;
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

            return response()->json(['Error' => 0, 'Message'=> 'The appointment schedule has been rescheduled successfully']);
        
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function approveAppointmentService($request) {

        $smstoken = SMSToken::get();
        $message = $this->Appointments->where(['id' => $request->appointment_id])->get();

        foreach ($smstoken as $st) {
            $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
            $mobile_token = $st->access_token; // as per your creation of token
        }

        // mobile number to send text to
        foreach($message as $mes) {

            $addresses = $mes->Client->contact_number; 
            $sms = 'From:  Christ The Healer Hospital \n\nGood day! Mr/Ms. '.$mes->Client->firstname.' '.$mes->Client->lastname.'. Your scheduled appointment has been approved. Your assigned priority number is '.$mes->queue.'. Please arrive to the hospital on the specified day.\n\nDate: '.date('M d, Y', strtotime($mes->date)).'\nPurpose: '.$mes->purpose.'\n\nThank you!';
            break;
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

        $this->Appointments->where(['id' => $request->appointment_id])->update([
            'status' => 0,
            'user_read' => 1
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'The appointment schedule has been approved successfully']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function startServingService($request) {

        date_default_timezone_set("Asia/Singapore");
        $this->User->where(['id' => auth()->user()->id])->update(['button' => 1, 'buttonDate' => date('Y-m-d')]);

        $counter = 0;

        foreach($this->Appointments->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->get() as $get) {

            $serving = $this->Appointments->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->first();

            if($counter == 0) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nDear Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\nGood day! Your are Priority Number '.$get->queue.', and we kindly request your presence within the next 10 minutes.\n\nThank You!';
                   
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
            }

            if($counter == 1) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. You will be accommodated next. Please prepared thank you!';
                   
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
            }
            if($counter == 3) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. Please prepared thank you!';
                   
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
            }
            if($counter == 5) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. Please prepared thank you!';
                   
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
            }

            $counter += 1;
        }

        return response()->json(['Error' => 0, 'Message'=> 'Serving Client started successfully']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function pauseServingService($request) {

        date_default_timezone_set("Asia/Singapore");
        $this->User->where(['id' => auth()->user()->id])->update(['button' => 0]);
        return response()->json(['Error' => 0, 'Message'=> 'Serving Client paused successfully']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function checkAppointmentService($request) {

        date_default_timezone_set("Asia/Singapore");

        $counter = 0;

        $this->Appointments->where(['id' => $request->appointment_id])->update([
            'status' => 2,
        ]);

        foreach($this->Appointments->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->get() as $get) {

            $serving = $this->Appointments->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->first();

            if($counter == 1) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. You will be accommodated next. Please prepared thank you!';
                   
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
            }
            if($counter == 3) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. Please prepared thank you!';
                   
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
            }
            if($counter == 5) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. Please prepared thank you!';
                   
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
            }

            $counter += 1;
        }

        return response()->json(['Error' => 0, 'Message'=> 'The appointment was completed successfully.']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function deleteAppointmentService($request) {

        $smstoken = SMSToken::get();
        $message = $this->Appointments->where(['id' => $request->appointment_id])->get();

        foreach ($smstoken as $st) {
            $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
            $mobile_token = $st->access_token; // as per your creation of token
        }

        // mobile number to send text to
        foreach($message as $mes) {

            $addresses = $mes->Client->contact_number; 
            $sms = 'From: Christ the Healer Hospital \n\nGood day! We regret to inform you that your appointment has been canceled due to the following reason/s: \n\n'.$request->description.'\n\nPlease proceed to book another appointment at your earliest convenience. Thank you!';
            break;
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

        foreach($message as $mes) {
            $userid = $mes->Client->id; 
        }

        $this->Cancel->create(['userid' => $userid, 'reason' => $request->description]);

        $this->Appointments->where(['id' => $request->appointment_id])->delete();

        return response()->json(['Error' => 0, 'Message'=> 'The scheduled appointment was deleted successfully.']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchClientAppointmentService($request) {

        date_default_timezone_set("Asia/Singapore");

        $search = $request->search_client_appointment;

        $appointments = $this->Appointments->whereHas('Client', function ($query) use ($search) {
            $query->where('lastname', 'like', '%'.$search.'%')
                  ->orWhere('firstname', 'like', '%'.$search.'%')
                  ->orWhere('middlename', 'like', '%'.$search.'%')
                  ->orderBy('date', 'DESC');
        })->get();

        $today = date('Y-m-d');
        $time_slots = $this->TimeSlots->orderBy('from_time', 'ASC')->get();
        $selected_slots = $this->Appointments->get();

        return response()->json
            ([
                'Pending' => view('pages.tables.pending-appointment', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render(), 
                'Today' => view('pages.tables.today-appointment', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render(), 
                'Upcoming' => view('pages.tables.upcoming-appointment', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render(),
                'History' => view('pages.tables.appointment-history', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render()
            ]);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchClientAppointmentDateService($request) {

        date_default_timezone_set("Asia/Singapore"); 

        if(auth()->user()->type == 1) {
            $appointments = $this->Appointments
            ->where(['date' => $request->search_client_appointment_date])
            ->orderBy('date', 'DESC')->get();
        }

        if(auth()->user()->type == 2) {
            $appointments = $this->Appointments
            ->where(['client_id' => auth()->user()->Client->id])
            ->where(['date' => $request->search_client_appointment_date])
            ->orderBy('date', 'DESC')->get();
        }

        $today = date('Y-m-d');
        $time_slots = $this->TimeSlots->orderBy('from_time', 'ASC')->get();
        $selected_slots = $this->Appointments->get();

        return response()->json
        ([
            'Pending' => view('pages.tables.pending-appointment', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render(), 
            'Today' => view('pages.tables.today-appointment', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render(), 
            'Upcoming' => view('pages.tables.upcoming-appointment', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render(),
            'History' => view('pages.tables.appointment-history', compact('appointments', 'today', 'time_slots', 'selected_slots'))->render()
        ]);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function readNotificationService($request) {

        if(auth()->user()->type == 1) {
            $this->Cancel->where(['admin_read' => 1])->update(['admin_read' => 0]);
        }
        if(auth()->user()->type == 2) {
            $this->Cancel->where(['userid' => auth()->user()->Client->id])->where(['user_read' => 1])->update(['user_read' => 0]);
        }
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function failedToVisitService($request) {

        date_default_timezone_set("Asia/Singapore");

        $counter = 0;

        $this->Appointments->where(['id' => $request->appointment_id])->update([
            'status' => 3,
        ]);

        foreach($this->Appointments->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->get() as $get) {

            $serving = $this->Appointments->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->first();

            if($counter == 1) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. You will be accommodated next. Please prepared thank you!';
                   
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
            }
            if($counter == 5) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. Please prepared thank you!';
                   
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
            }
            if($counter == 9) {
                $smstoken = SMSToken::get();
                foreach ($smstoken as $st) {
                    $mobile_iden = $st->mobile_identity; // as you have copied from the url, explained above
                    $mobile_token = $st->access_token; // as per your creation of token
                }
                $addresses = $get->Client->contact_number; 
                $sms = 'From:  Christ The Healer Hospital \n\nHello Mr/Ms. '.$get->Client->firstname.' '.$get->Client->lastname.'\n\n[Your Priority Number: '.$get->queue.']. We are currently serving number '.$serving->queue.'. Please prepared thank you!';
                   
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
            }

            $counter += 1;
        }

        return response()->json(['Error' => 0, 'Message' => 'Client status updated successfully']);
        
    }
}