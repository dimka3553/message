<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class BuyProController extends Controller
{
    public function  prepare(Request $request)
    {
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => '10.00', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => "Upgrade to Pro by {auth()->user()->username}",
            'redirectUrl' => route('buy-pro.success'),
            'webhookUrl'  => route('mollie-webhook'),
            'metadata' => [
                'order_id' => '12345',
                'user_id' => auth()->id(),
            ],
        ]);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request)
    {
        $payment = Mollie::api()->payments()->get($request->paymentId);
        if ($payment->isPaid()) {
            auth()->user()->update([
                'pro' => true,
            ]);
            return redirect(route('dashboard'))->with('success', 'You have successfully upgraded to Pro!');
        }
    }

    public function webhook(Request $request)
    {
        $payment = Mollie::api()->payments()->get($request->id);
        if ($payment->isPaid()) {
            $user = User::find($payment->metadata->user_id);
            $user->update([
                'pro' => true,
            ]);
        }

        
    }
}
