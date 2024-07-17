<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Http\Services\ClientService;
use Illuminate\Http\Request;  

class RegisterController extends Controller
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
    public function create()
    {
        return view('auth.register');
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function store(Request $request)
    {
        return $this->ClientService->registerClient($request);
    }
}
