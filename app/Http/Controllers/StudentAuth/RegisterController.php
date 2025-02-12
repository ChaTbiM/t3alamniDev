<?php

namespace App\Http\Controllers\StudentAuth;

use App\Student;
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
    protected $redirectTo = '/student';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:student');
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
            'name' => 'required',
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
        $student = Student::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'first_name' => 'student' . $data['name'],
            'last_name' => 'studenti' . $data['name'],
            'age' => 23,
            'cycle' => 'lycee',
            'year' => 3,
            'specialty' => 'specialty--'
        ]);

        // $role = Role::create([
        //     'guard_name' => 'student',
        //     'name' => $data['role']
        // ]);

        $student->assignRole($data['role']);

        return $student;
    }

    public function showRegistrationForm()
    {
        return view('student.auth.register');
    }

    protected function guard()
    {
        return Auth::guard('student');
    }

    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered(($user = $this->create($request->all()))));

        $this->guard()->login($user);

        return $this->registered($request, $user) ?:
            redirect($this->redirectPath());
    }
}
