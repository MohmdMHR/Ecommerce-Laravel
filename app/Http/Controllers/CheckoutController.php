<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Mail;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        return view('checkout');
    }


    public function pay(){
        //third party applicaion for payement;
        Stripe::setApiKey("sk_test_wQk8NP6r77IoK8WdagcjmRv6");



        $charge= Charge::create([
           'amount'=>(Cart::total())*100,
           'currency'=>'usd',
            'description'=>'buy some',
            'source'=>request()->stripeToken,
        ]);

        // Empty the cart
        Cart::destroy();

        // Sendig verification email
        Mail::to(request()->stripeEmail)->send(new \App\Mail\PaySuccess);

        // Redirecting to home
        return redirect('/');

    }
}
