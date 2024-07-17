<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Services\ClientService;
use App\Http\Services\AdminService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $ClientService;
    protected $AdminService;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(ClientService $ClientService, AdminService $AdminService) {

        $this->ClientService = $ClientService;
        $this->AdminService = $AdminService;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateAdmin(Request $request) {
        return $this->AdminService->updateAdminService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateClient(Request $request) {
        return $this->ClientService->updateClientService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function resubmitCredentials(Request $request) {
        return $this->ClientService->resubmitCredentialsService($request);
    }
}
