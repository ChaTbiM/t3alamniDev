<?php

namespace App\Http\Controllers\TeacherAuth;

use App\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest:teacher');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $teacher = Teacher::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        // $role = Role::create(['guard_name' => 'teacher', 'name' => $data['role'] ]);

        $teacher->assignRole($data['role']);

        return $teacher;
    }

    public function showRegistrationForm()
    {
        return view('teacher.auth.register');
    }

    protected function guard()
    {
        return Auth::guard('teacher');
    }

    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered(($user = $this->create($request->all()))));

        // $role = Role::create(['guard_name' => 'teacher', 'name' => 'full-time']);

        // $user->assignRole($role);

        $this->guard()->login($user);

        return $this->registered($request, $user) ?:
            redirect($this->redirectPath());
    }
}
