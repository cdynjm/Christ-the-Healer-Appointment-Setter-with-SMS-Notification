<?php

namespace App\Http\Controllers;
use App\Http\Services\FeedbackService;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $FeedbackService;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(FeedbackService $FeedbackService) {

        $this->FeedbackService = $FeedbackService;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getFeedbackRating() {
        
        return $this->FeedbackService->getFeedbackRatingService();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createFeedback(Request $request) {

        return $this->FeedbackService->createFeedbackService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateFeedback(Request $request) {

        return $this->FeedbackService->updateFeedbackService($request);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function deleteFeedback(Request $request) {

        return $this->FeedbackService->deleteFeedbackService($request);
    }
}
