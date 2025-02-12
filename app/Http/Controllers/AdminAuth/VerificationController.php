<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        
        
        $this->middleware('auth:admin');
        
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


   
    public function show(Request $request)
    {
       
        return $request->user()->hasVerifiedEmail()
                        ? Redirect::route('admin')
                        : view('admin.auth.verify');
 
        
    }


    public function verify(Request $request){
        
       
        // hasValidSignature instead of signed middleware !
        if (!$request->hasValidSignature()) {
            return $next($request);
        }

        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

            
        return redirect($this->redirectPath())->with('verified', true);
    }

    
    public function resend(Request $request){
     

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        
        $request->user()->sendEmailVerificationNotification();
            return back()->with('resent', true);
    }

    //test
}
