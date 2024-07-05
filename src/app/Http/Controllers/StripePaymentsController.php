<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Models\User;
use App\Models\Stock;

class StripePaymentsController extends Controller
{
    public function checkout(Request $request)
    {
        $user = User::find(1);
        // $stripeCustomer = $user->createOrGetStripeCustomer();
        $price = $request->course_name;
        $price_id = Stock::find($price)->price_id;
        $payment_session = $user->checkout($price_id, [
            'success_url' => route('success'),
            'cancel_url' => route('cancel')
        ]);
        return redirect($payment_session->url);
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
