<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Models\User;
use App\Models\Stock;
use App\Http\Requests\CheckoutRequest;

class StripePaymentsController extends Controller
{
    // 決済処理
    public function checkout(CheckoutRequest $request)
    {
        $user = User::find(1);
        $price = $request->course_name;
        $price_id = Stock::find($price)->price_id;
        $payment_session = $user->checkout($price_id, [
            'success_url' => route('success'),
            'cancel_url' => route('cancel')
        ]);
        return redirect($payment_session->url);
    }
}
