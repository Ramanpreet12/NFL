<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Payment;

class StripeController extends Controller
{
    public function stripe()
    {
        return view('front.payment.index');
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $intent = \Stripe\PaymentIntent::create([
                'amount' => 100,
                'currency' => 'inr',
                'automatic_payment_methods' => [
                    'enabled' => 'true',
                ],
            ]);

            return response()->json($intent->client_secret);
        } catch (\Stripe\Exception\CardException $e) {
            echo 'Status is:' . $e->getHttpStatus() . '\n';
            echo 'Type is:' . $e->getError()->type . '\n';
            echo 'Code is:' . $e->getError()->code . '\n';
            // param is '' in this case
            echo 'Param is:' . $e->getError()->param . '\n';
            echo 'Message is:' . $e->getError()->message . '\n';
            if($e->getError()->code == "card_declined"){
                return redirect()->back()->with('msg','Card is declined');
            }
        } catch (\Stripe\Exception\RateLimitException $e) {
            echo 'Message is:' . $e->getError()->message . '\n';
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            echo 'Message is:' . $e->getError()->message . '\n';
        } catch (\Stripe\Exception\AuthenticationException $e) {
            echo 'Message is:' . $e->getError()->message . '\n';
            echo 'Message is:' . $e->getError()->message . '\n';
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            echo 'Message is:' . $e->getError()->message . '\n';
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo 'Message is:' . $e->getError()->message . '\n';
        }
        return redirect()->back()->with('msg', $e->getError()->message);
    }



    }


