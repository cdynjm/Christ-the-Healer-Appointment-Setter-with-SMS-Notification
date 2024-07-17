<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SMSService;

class SMSController extends Controller
{
    protected $SMSService;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(SMSService $SMSService) {

        $this->SMSService = $SMSService;
    }

    public function updateSMS(Request $request) {

        return $this->SMSService->updateSMSService($request);

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getSMS() {

        return $this->SMSService->getSMSService();

    }
}