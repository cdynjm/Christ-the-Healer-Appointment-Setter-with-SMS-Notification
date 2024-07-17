<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Services\AppointmentService;
use App\Http\Services\ResetService;
use App\Http\Services\ClientService;
use App\Http\Services\FeedbackService;
use App\Http\Services\AutoSMSService;
use Illuminate\Http\Request;  

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

     protected $AppointmentService;
     protected $ClientService;
     protected $ResetService;
     protected $AutoSMSService;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function __construct(AppointmentService $AppointmentService, ClientService $ClientService, ResetService $ResetService, FeedbackService $FeedbackService, AutoSMSService $AutoSMSService) {
 
         $this->AppointmentService = $AppointmentService;
         $this->ClientService = $ClientService;
         $this->ResetService = $ResetService;
         $this->AutoSMSService = $AutoSMSService;
         $this->FeedbackService = $FeedbackService;
     }
      /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function index()
    {
        $dateSelected = date('Y-m-d');
        $time_slots = $this->AppointmentService->getAvailableTimeSlotsService();
        $selected_slots = $this->AppointmentService->getSelectedSlotsService();

        $count_clients = $this->ClientService->countClientService();
        $count_pending_clients = $this->ClientService->countPendingClientService();
        $count_todays_appointment = $this->AppointmentService->countTodaysAppointmentService();
        $count_pending_appointment = $this->AppointmentService->countPendingAppointmentService();
        $count_total_appointment = $this->AppointmentService->countTotalAppointmentService();

        $appointments = $this->AppointmentService->calendarAppointmentService();
        $calendar = $this->AppointmentService->calendarService();

        $recent_appointments = $this->AppointmentService->getRecentAppointmentService();
        $recent_feedbacks = $this->FeedbackService->getRecentFeedbackService();

        $this->ResetService->updateFailedAppointmentVisit();
        $this->AutoSMSService->autoSendMessage();

        return view('pages.dashboard', compact('time_slots', 'selected_slots', 'dateSelected', 'count_clients', 'count_pending_clients', 'count_todays_appointment', 'count_pending_appointment', 'count_total_appointment', 'appointments', 'calendar', 'recent_appointments', 'recent_feedbacks'));
    }
}
