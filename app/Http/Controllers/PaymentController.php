<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check())
        {
            Stripe::setApiKey("sk_test_ryvsm2FIM5KWiH7GFVEtfmLy");
            $token = $request['token'];
            $chargeSended = $request['charge'];
            $chargeId = 1;//  TODO automatise ça
            if($chargeId == 1){
                $packageData = [
                    "reserve" => 50
                ];
                $chargeData = [
                    "amount" => 255,
                    "currency" => "CHF",
                    "description" => "Pack 50 mails",
                    "source" => $token['id']
                ];
            }
            if($chargeId == 2)
            {
                $packageData = [
                    "reserve" => 100
                ];
                $chargeData = [
                    "amount" => 495,
                    "currency" => "CHF",
                    "description" => "Pack 100 mails",
                    "source" => $token['id']
                ];

            }
            if($chargeId == 3)
            {
                $packageData = [
                    "reserve" => 300
                ];
                $chargeData = [
                    "amount" => 985,
                    "currency" => "CHF",
                    "description" => "Pack 300 mails",
                    "source" => $token['id']
                ];

            }



            $user = User::where('id', Auth::id())->first();
            User::where('id', Auth::id())->update([
                'mails_reserve' => $user->mails_reserve + $packageData['reserve']
            ]);

            $charge = Charge::create($chargeData);

            // recharge mails reserve


            return response()->json("SUper", 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentController $paymentController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentController $paymentController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentController $paymentController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentController $paymentController)
    {
        //
    }
}
