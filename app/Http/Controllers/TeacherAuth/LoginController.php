<?php

namespace App\Http\Controllers\TeacherAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/teacher';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:teacher')->except('logout');
    }

    public function showLoginForm()
    {
        return view('teacher.auth.login');
    }

    public function login(Request $request)
    {
        // $this->validate($request, [
        //     'email'   => 'required|email',
        //     'password' => 'required|min:6'
        // ]);

        // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

        //     return redirect()->route('admin');
        // }
        // return back()->withInput($request->only('email', 'remember'));

        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attemp to log in
        if (
            Auth::guard('teacher')->attempt(
                [
                    'email' => request()->email,
                    'password' => request()->password
                ],
                request()->remember
            )
        ) {
            return redirect()->route('teacher');
        }
        // if success redirect

        // if failed redirect
        // return back();
        return redirect()
            ->back()
            ->withInput(request()->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        request()->flush();

        return redirect()->route('teacher.login');
    }
}
