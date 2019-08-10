<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin','verifiedAdmin']);
       

    }

    

    public function index(){
        // if(Auth::guard('admin')->check()){

            return view('admin.admin');
        // }
        
        // return redirect()->route('admin.login');
    }
}
