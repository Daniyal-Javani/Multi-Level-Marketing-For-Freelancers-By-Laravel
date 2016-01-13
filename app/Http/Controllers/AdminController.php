<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	$isAdmin = Auth::user()->admin;
        if($isAdmin === null) {
            return redirect()->action('HomeController@index');
        }
    	return view('admin');
    }
}
