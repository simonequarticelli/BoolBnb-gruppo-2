<?php

namespace App\Http\Controllers;

use App\House;

use App\Promotion;
use Braintree_Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{


    public function process(Request $request, $id, $promo_id) {

        //$data = $request->all();
        //dd($id, $promo_id);
        //dd($promo->price);

        /* recupero la casa */
        $house = House::find($id);
        /* recupero la promo */
        $promo = Promotion::find($promo_id);

        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];

        $status = Braintree_Transaction::sale([

            'amount' => $promo->price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]

        ]);

        /* salvo la relazione */
        $house->promotions()->sync($promo);
        $house->save();


        return response()->json($status);

    }


}
