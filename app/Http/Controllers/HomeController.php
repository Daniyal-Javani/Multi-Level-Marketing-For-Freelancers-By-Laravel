<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\CustomClasses\Tree;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $isAdmin = Auth::user()->admin;
        if($isAdmin !== null) {
            return redirect()->action('AdminController@index');
        }
        $root = new Tree(Auth::user()->name);
        $down_line = User::where('root_id', Auth::user()->id)->get();
        $i = 0;

        foreach ($down_line as $person) {
            $root->childs[$i] = new Tree($person->name);
            $down_line2 = User::where('root_id', $person->id)->get();

            foreach ($down_line2 as $person2) {
                $root->childs[$i]->childs[] = new Tree($person2->name);
            }

            ++$i;
        }

        $invoices = Auth::user()->invoice()->latest()->get()->take(5);
        return view('home', compact('root'), compact('invoices'));
    }
}
