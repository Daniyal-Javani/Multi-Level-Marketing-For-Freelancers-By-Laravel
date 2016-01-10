<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class WelcomeController extends Controller
{
    public function index()
    {
    	if (Auth::check())
		{
		    return redirect()->action('HomeController@index');
		} else {
			return view('welcome');
		}
    }
}
