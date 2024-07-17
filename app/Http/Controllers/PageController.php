<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SMSController;
use App\Http\Services\ResetService;
use App\Http\Services\AutoSMSService;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */

     protected $ClientController;
     protected $AppointmentController;
     protected $FeedbackController;
     protected $SMSController;
     protected $ResetService;
     protected $AutoSMSService;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(ClientController $ClientController, AppointmentController $AppointmentController, FeedbackController $FeedbackController, ResetService $ResetService, SMSController $SMSController, AutoSMSService $AutoSMSService) {

        $this->ClientController = $ClientController;
        $this->AppointmentController = $AppointmentController;
        $this->FeedbackController = $FeedbackController;
        $this->ResetService = $ResetService;
        $this->AutoSMSService = $AutoSMSService;
        $this->SMSController = $SMSController;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {

            $this->ResetService->updateFailedAppointmentVisit();
            $this->AutoSMSService->autoSendMessage();

            if($page == "clients") {
                return $this->ClientController->getClients($page);
            }
            if($page == "appointment" || $page == "appointment-history") {
                return $this->AppointmentController->getAppointments($page);
            }
            if($page == "time-slots") {
                return $this->AppointmentController->getTimeSlots();
            }
            if($page == "sms-configuration") {
                return $this->SMSController->getSMS();
            }
            if($page == "feedback-rating") {
                return $this->FeedbackController->getFeedbackRating();
            }
        }

        if (view()->exists("pages.appointment.{$page}")) {

            if($page == "pending" || $page == "today" || $page == "upcoming") {
                return $this->AppointmentController->getAppointments($page);
            }
        }

        if (view()->exists("pages.client.{$page}")) {

            if($page == "pending-clients" || $page == "validated-clients") {
                return $this->ClientController->getClients($page);
            }
        }

        return abort(404);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function vr()
    {
        return view("pages.virtual-reality");
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function rtl()
    {
        return view("pages.rtl");
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function profile()
    {
        return view("pages.profile-static");
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function signin()
    {
        return view("pages.sign-in-static");
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function signup()
    {
        return view("pages.sign-up-static");
    }
}
