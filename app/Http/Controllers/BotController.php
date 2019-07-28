<?php

namespace PaybeeTest\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use PaybeeTest\User;
use Auth;

class BotController extends Controller
{
    public function __construct() {
        $this->middleware('dashboardauth');
        $this->coincurrencies = file_get_contents('https://api.coindesk.com/v1/bpi/supported-currencies.json'); ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $telegram = new Api(config('telegram.bot_token'));
    	$response = $telegram->getMe();
    	return $response;
    }

    public function updates($value='')
    {
    	$telegram = new Api(config('telegram.bot_token'));
    	$response = $telegram->getUpdates();
    	return $response;
    }


    public function respond(){
	  $telegram = new Api(config('telegram.bot_token'));
	  $response = $telegram->getUpdates();
	  $request = collect(end($response)); // fetch the last request from the collection
	 
	  $chatid = $request['message']['chat']['id']; // get chatid from request
	  $text = $request['message']['text']; // get the user sent text
	 
	  $this->getBTCEquivalent($telegram, $chatid);
	}


	/**
     * get the Bitcoin equivalent based on amount and currency provided
     *
     * @param  int amount
     * @param  string currency
     * @return Telegram message
     */
	public function getBTCEquivalent($amount = '', $currency = ''){ 
		$telegram = new Api(config('telegram.bot_token'));
		$response = $telegram->getUpdates();
		$request = collect(end($response)); // fetch the last request from the collection
		
		if(!empty($request)){
			self::getResponse($telegram, $request, $amount, $currency );
		} else {

		}
		

	}

	/**
     * get the Bitcoin equivalent based on amount and currency provided
     *
     * @param  int amount
     * @param  string currency
     * @return Telegram message
     */
	private function getResponse($telegram, $request, $amount, $currency ){
		$chatid = $request['message']['chat']['id']; // get chatid from request
		$text = $request['message']['text']; // get the user sent text

		$defaultcurrency = Auth::user()->currency;
		
		$message = self::calcEquivalent($defaultcurrency, $amount, $currency);

		$response = $telegram->sendMessage(
			[
			'chat_id' => $chatid,
			'text' => $message
			]);
	}




	
	/**
     * calculate Bitcoin equivalent based on currency, amount and currency provided
     * tweaked it to return upto 10 decimal numbers to cater for large decimal places
     * @param  string default currency
     * @param  int user amount
     * @param  string user currency
     * @return string
     */
	private function calcEquivalent($defaultcurrency, $amount, $currency){
		

		//get equivalent if currency and amount is not provided. Resort to default current and amount is 1 
		if( $amount == '' && $currency == ''){
			$coincurrencies = file_get_contents('https://api.coindesk.com/v1/bpi/currentprice/'.$defaultcurrency.'.json'); 
			$result = json_decode($coincurrencies) ; 
			$rate = $result->bpi->$defaultcurrency->rate_float; 

			$num = 1/$rate; 
			$numberofzeros = self::numberFormat($num);
			$equivalent =  sprintf("%.".$numberofzeros."f", $num); 
			
			
			$message = '1 '.$defaultcurrency.' is '.$equivalent.' as at '.date('H:i:s jS F Y', strtotime($result->time->updatedISO)).' ('. number_format((float)$rate, 2) .' '.$defaultcurrency.' - 1 BTC) ';
		} 

		//get equivalent if currency is not provided and amount is  provided. Resort to default current. Check to make sure Amount is integer, if not, return error message  
		else if( $amount != '' && $currency == ''){
			if(is_numeric($amount)){
				$coincurrencies = file_get_contents('https://api.coindesk.com/v1/bpi/currentprice/'.$defaultcurrency.'.json'); 
				$result = json_decode($coincurrencies) ; 

				$rate = $result->bpi->$defaultcurrency->rate_float; 
				
				$num = $amount/$rate; 
				$numberofzeros = self::numberFormat($num);
				$equivalent =  sprintf("%.".$numberofzeros."f", $num); 
				
				
				$message = $amount.' '.$defaultcurrency.' is '.$equivalent.' as at '.date('H:i:s jS F Y', strtotime($result->time->updatedISO)).' ('. number_format((float)$rate, 2) .' '.$defaultcurrency.' - 1 BTC) ';
				 
			} else {
				$message = 'Please enter a valid amount'; 
			}
			
		} 
 
		//get equivalent if currency is  provided and amount is  provided. 
		// Check to make sure Amount is integer, if not, return error message 
		// check to see if currrency is supported. If not, return error message
		else if( $amount != '' && $currency != ''){
			if(is_numeric($amount) ){
				if(self::supportCurrency($currency)){
					$coincurrencies = file_get_contents('https://api.coindesk.com/v1/bpi/currentprice/'.$currency.'.json'); 
					$result = json_decode($coincurrencies) ;  
					$cur = strtoupper($currency);
					$rate = $result->bpi->$cur->rate_float; 
					$num = $amount/$rate; 
					$numberofzeros = self::numberFormat($num);
					$equivalent =  sprintf("%.".$numberofzeros."f", $num); 
					
					$message = $amount.' '.$cur.' is '.$equivalent.' as at '.date('H:i:s jS F Y', strtotime($result->time->updatedISO)).' ('. number_format((float)$rate, 2) .' '.$cur.' - 1 BTC) ';
				} else {
					$message = 'Oops. Your currency is not supported at the moment'; 
				}
				
				 
			} else {
				$message = 'Please enter a valid amount'; 
			}
			
		} 

		return $message;
	}


	/**
     * we need to check if number is float or exponent. Depending on reply to need to shorten the number 
     * by calculating number of zeros after the decimal
     * 
     * @param  int number
     * 
     * @return  int number
     */
	private function numberFormat($num){
		if(stristr($num, 'e')){
			$numberofzeros = substr(stristr($num, 'e'), strpos(stristr($num, 'e'), '-')+1) + 2;
		} else {
			$numberofzeros =  strspn($num, 0, strpos($num, ".")+1) + 2; 
		}
		return $numberofzeros;
	}

	/**
     * check if currency is supported by coinbase
     *
     * @param  string currency
     * @return boolean
     */
	private function supportCurrency($currency){
		$coincurrencies = file_get_contents('https://api.coindesk.com/v1/bpi/supported-currencies.json'); 

		foreach (json_decode($coincurrencies) as $value) {
			if($value->currency == strtoupper($currency)){
				return true;
			}
		}
		return false;
	}


	public function getuserid(){
		$telegram = new Api(config('telegram.bot_token'));
		$response = $telegram->getUpdates();
		$request = collect(end($response)); // fetch the last request from the collection
		 
		$chatid = $request['message']['chat']['id']; // get chatid from request
		$text = $request['message']['text']; // get the user sent text

	
		
		$message = "The current user's id is ".Auth::user()->id;

		$response = $telegram->sendMessage(
			[
			'chat_id' => $chatid,
			'text' => $message
			]);
	}
}
