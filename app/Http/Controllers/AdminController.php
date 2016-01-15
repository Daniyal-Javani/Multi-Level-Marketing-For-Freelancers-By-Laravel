<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Http\Requests\CreateInvoiceRequest;
use App\User;
use App;
use Session;

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
        $invoice = Auth::user()->invoice()->create($request->all());
        session()->flash('flash_message', 'Your invoice has been created successfully!');
        $first_root = Session::get('root_id');
        if( $first_root !== null) {
            $commission = new App\Commission;
            $commission->user()->associate($first_root);
            $commission->invoice()->associate($invoice);
            $commission->amount = $request->amount * 0.10;
            $commission->save();
            $second_root = User::where('id', $first_root)->first();
            if( $second_root->root_id !== null) {
                $commission = new App\Commission;
                $commission->invoice()->associate($invoice);
                $commission->user()->associate($second_root->root_id);
                $commission->amount = $request->amount * 0.05;
                $commission->save();
                $third_root = User::where('id', $second_root->root_id)->first();
                if( $third_root->root_id !== null) {
                    $commission = new App\Commission;
                    $commission->invoice()->associate($invoice);
                    $commission->user()->associate($third_root->root_id);
                    $commission->amount = $request->amount * 0.02;
                    $commission->save();
                }
            }
        }
        return view('admin');
    }
}
