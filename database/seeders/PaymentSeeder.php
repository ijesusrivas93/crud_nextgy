<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;


class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();

        $payment = new Payment;
    	$payment -> payment_type = "Contado";
    	$payment -> save();

    	$payment = new Payment;
    	$payment -> payment_type = "Credito";
    	$payment -> save();
    }
}
