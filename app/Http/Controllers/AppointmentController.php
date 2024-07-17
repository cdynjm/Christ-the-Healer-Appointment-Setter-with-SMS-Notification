<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Services\AppointmentService;
use Illuminate\Http\Request;  

class AppointmentController extends Controller
{
    protected $AppointmentService;
    protected $ResetService;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(AppointmentService $AppointmentService) {

        $this->AppointmentService = $AppointmentService;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getAppointments($page) {
        return $this->AppointmentService->getAppointmentsService($page);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getTimeSlots() {
        return $this->AppointmentService->getTimeSlotsService();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createTimeSlots(Request $request) {
        return $this->AppointmentService->createTimeSlotsService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateTimeSlots(Request $request) {
        return $this->AppointmentService->updateTimeSlotsService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function deleteTimeSlots(Request $request) {
        return $this->AppointmentService->deleteTimeSlotsService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createDateSchedule(Request $request) {
        return $this->AppointmentService->createDateScheduleService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createAppointment(Request $request) {
        return $this->AppointmentService->createAppointmentService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateAppointment(Request $request) {
        return $this->AppointmentService->updateAppointmentService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function approveAppointment(Request $request) {
        return $this->AppointmentService->approveAppointmentService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function checkAppointment(Request $request) {
        return $this->AppointmentService->checkAppointmentService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function deleteAppointment(Request $request) {
        return $this->AppointmentService->deleteAppointmentService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchClientAppointment(Request $request) {
        return $this->AppointmentService->searchClientAppointmentService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchClientAppointmentDate(Request $request) {
        return $this->AppointmentService->searchClientAppointmentDateService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function readNotification(Request $request) {
        return $this->AppointmentService->readNotificationService($request);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function failedToVisit(Request $request) {
        return $this->AppointmentService->failedToVisitService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function startServing(Request $request) {
        return $this->AppointmentService->startServingService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function pauseServing(Request $request) {
        return $this->AppointmentService->pauseServingService($request);
    }
}