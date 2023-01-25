<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Models\User;

class BuyProController extends Controller
{
    public function  prepare(Request $request)
    {
        $devURL = 'https://message.sharedwithexpose.com/api/mollie';
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => '10.00', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => "Upgrade to Pro by " . auth()->user()->name,
            'redirectUrl' => route('buy-pro.success'),
            'webhookUrl'  => config('app.env')=='production'?route('mollie-webhook'): $devURL,
            'metadata' => [
                'order_id' => '12345',
                'user_id' => auth()->id(),
            ],
        ]);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request)
    {
        return redirect(route('chats.index'));
    }

    public function webhook(Request $request)
    {

        $payment = Mollie::api()->payments()->get($request->id);
        ray($payment);
        if ($payment->status == 'paid') {

            $user = User::find($payment->metadata->user_id);
            $user->pro = true;
            ray($user);

            $user->save();
        }
    }
}
