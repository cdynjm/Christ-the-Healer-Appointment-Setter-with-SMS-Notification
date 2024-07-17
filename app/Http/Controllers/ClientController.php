<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Services\ClientService;
use Illuminate\Http\Request;  

class ClientController extends Controller
{
    protected $ClientService;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(ClientService $ClientService) {

        $this->ClientService = $ClientService;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getClients($page) {
        return $this->ClientService->getClientsService($page);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function verifyClient(Request $request) {
        return $this->ClientService->verifyClientService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function declineClient(Request $request) {
        return $this->ClientService->declineClientService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function searchClient(Request $request) {
        return $this->ClientService->searchClientService($request);
    }
}
