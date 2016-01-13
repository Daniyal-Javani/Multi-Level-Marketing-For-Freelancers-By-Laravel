<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Http\Requests\CreateInvoiceRequest;

class AdminController extends Controller
{
    /**
     * To don't allow guest users access to this controller
     */
	public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Check if admin logged in
     * @return view admin page
     */
    public function index()
    {
    	$isAdmin = Auth::user()->admin;
        if($isAdmin === null) {
            return redirect()->action('HomeController@index');
        }
    	return view('admin');
    }

    public function store(CreateInvoiceRequest $request)
    {
        Auth::user()->invoice()->create($request->all());
        session()->flash('flash_message', 'Your invoice has been created successfully!');
        return view('admin');
    }
}
