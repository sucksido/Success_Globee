<?php

namespace PaybeeTest\Http\Controllers;

use Illuminate\Http\Request;
use PaybeeTest\User;
use Auth;


class CurrencyController extends Controller
{
    public $coincurrencies;

    public function __construct() {
        $this->middleware('dashboardauth');
        $this->coincurrencies = file_get_contents('https://api.coindesk.com/v1/bpi/supported-currencies.json'); ;
    }

   

   /**
     * Show the form for addings the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = Auth::user()->currency;
        $supportedcurrencies = array(''=>'Select a Currency');
        foreach (json_decode($this->coincurrencies) as $key => $value) {
           $supportedcurrencies[$value->currency] = $value->country;
        }
        return view('dashboard.currency.add', compact('currency', 'supportedcurrencies')); 
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->currency = $request->all()['currency'];
        $user->save();
        return redirect('home');
    }
  
    
}
