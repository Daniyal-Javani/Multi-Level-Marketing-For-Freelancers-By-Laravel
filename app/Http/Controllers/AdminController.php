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
        if ($isAdmin === null) {
            return redirect()->action('HomeController@index');
        }
    	return view('admin');
    }

    public function store(CreateInvoiceRequest $request)
    {
        $invoice = Auth::user()->invoice()->create($request->all());
        $user_id = Session::get('user_id');
        $user = User::where('id', $user_id)->first();
        $user_balance = $user->balance;
        if ($user->balance != 0) {
            session()->flash('flash_message', 'Your invoice has been created successfully! The amount minus user balance is: '.($request->amount - $user->balance));
            $user->balance = 0;
            if ($user->save()) {
                $discount_invoice = new App\Invoice;
                $discount_invoice->name = 'Paid from your balance for '.$request->name;
                $discount_invoice->amount = $user_balance * -1;
                $discount_invoice->user()->associate($user);
                $discount_invoice->save();
            }
        } else {
            session()->flash('flash_message', 'Your invoice has been created successfully!');
        }
        $first_root_id = $user->root_id;
        if ($first_root_id !== null) {
            $first_root = User::where('id', $first_root_id)->first();
            $commission_amount = $request->amount * 0.10;
            $commission = new App\Commission;
            $commission->user()->associate($first_root);
            $commission->invoice()->associate($invoice);
            $commission->amount = $commission_amount;
            $commission->save();

            $first_root->balance += $commission_amount;
            $first_root->save();

            if ($first_root->root_id !== null) {
                $second_root = User::where('id', $first_root->root_id)->first();
                $commission_amount = $request->amount * 0.05;
                $commission = new App\Commission;
                $commission->invoice()->associate($invoice);
                $commission->user()->associate($second_root);
                $commission->amount = $commission_amount;
                $commission->save();

                $second_root->balance += $commission_amount;
                $second_root->save();

                if ($second_root->root_id !== null) {
                    $third_root = User::where('id', $second_root->root_id)->first();
                    $commission_amount = $request->amount * 0.02;
                    $commission = new App\Commission;
                    $commission->invoice()->associate($invoice);
                    $commission->user()->associate($third_root);
                    $commission->amount = $commission_amount;
                    $commission->save();

                    $third_root->balance += $commission_amount;
                    $third_root->save();
                }
            }
        }
        return view('admin');
    }
}
