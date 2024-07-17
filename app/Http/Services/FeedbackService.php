<?php

namespace App\Http\Services;

use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
use App\Models\Feedbacks;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Http\Request\UpdateRequest;

class FeedbackService {

    protected $Client;
    protected $User;

    private $UpdateRequest;
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(Client $Client, User $User, UpdateRequest $UpdateRequest, Feedbacks $Feedbacks) {
        
        $this->Client = $Client;
        $this->User = $User;
        $this->Feedbacks = $Feedbacks;
        $this->UpdateRequest = $UpdateRequest;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function getFeedbackRatingService() {

        if(auth()->user()->type == 1) {
            $feedbacks = $this->Feedbacks->orderBy('created_at', 'DESC')->get();
            return view('pages.feedback-rating', compact('feedbacks'));
        }
        if(auth()->user()->type == 2) {
            if(auth()->user()->status == 0) {
                $feedbacks = $this->Feedbacks->where(['client_id' => auth()->user()->Client->id])->orderBy('created_at', 'DESC')->get();
                return view('pages.feedback-rating', compact('feedbacks'));
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
    public function getRecentFeedbackService() {

        return $this->Feedbacks->orderBy('created_at', 'DESC')->limit(5)->get();
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function createFeedbackService($request) {

        $this->Feedbacks->create([
            'client_id' => auth()->user()->Client->id,
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Your rating and feedbacks has been submitted successfully']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function updateFeedbackService($request) {

        $this->Feedbacks->where(['id' => $request->feedback_id])->update([
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);

        return response()->json(['Error' => 0, 'Message'=> 'Your rating and feedbacks has been updated successfully']);
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function deleteFeedbackService($request) {

        $this->Feedbacks->where(['id' => $request->feedback_id])->delete();

        return response()->json(['Error' => 0, 'Message'=> 'Your rating and feedbacks has been deleted successfully']);
    }

}