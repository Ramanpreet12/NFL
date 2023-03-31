<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(){
        return view('backend.payment.index');
    }

    public function getAll(){
        $payment = Payment::paginate(6);
        return response()->json($payment, 200); 

    }
}
