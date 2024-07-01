<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Models\User;

class StripePaymentsController extends Controller
{
    public function checkout()
    {
        $user = User::find(1);
        return $user->checkout(config('stripe.price_id'), [
            'success_url' => route('success'),
            'cancel_url' => route('cancel')
        ]);
    }




    // public function index()
    // {
    //     return view('index');
    // }

    // public function payment(Request $request)
    // {
    //     try {
    //         Stripe::setApiKey(env('STRIPE_SECRET'));

    //         $customer = Customer::create(array(
    //             'email' => $request->stripeEmail,
    //             'source' => $request->stripeToken
    //         ));

    //         $charge = Charge::create(array(
    //             'customer' => $customer->id, 'amount' => 2000, 'currency' => 'jpy'
    //         ));

    //         return redirect()->route('complete');
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function complete()
    // {
    //     return view('complete');
    // }
}
