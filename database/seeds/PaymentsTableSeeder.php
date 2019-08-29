<?php

use App\Payment;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    
    public function run()
    {
        $payments = [
            [
             'status' => 'accepted' 
            ],
            [
             'status' => 'rejected' 
            ]
         ];
 
        foreach ($payments as $payment) {
            $new_payment = new Payment();
            $new_payment->fill($payment);
            $new_payment->save();
        }
    }
}
