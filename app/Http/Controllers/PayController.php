<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\Transaction;

class PayController extends Controller
{
    protected array $data = [];

    public function home()
    {
        return view('welcome');
    }

    public function payment(PaymentRequest $request)
    {
        $this->data['items'] = [
            [
                'name' => 'test',
                'price' => $request->price,
                'desc' => 'test paypal',
                'qty' => 1
            ]
        ];

        $this->data['invoice_id'] = 1;
        $this->data['invoice_description'] = 'test';
        $this->data['return_url'] = route('success');
        $this->data['cancel_url'] = route('fail');
        $this->data['total'] = $request->price;

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($this->data, true);

        return redirect($response['paypal_link']);
    }

    public function successPayment(Request $request)
    {
        if (!$request->token) return redirect()->route('home');

        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        // Make a transaction
        auth()->user()->transactions()->create([
            'name' => $response['L_NAME0'],
            'amount' => $response['L_QTY0'],
            'total' => $response['L_AMT0'],
            'currency' => $response['PAYMENTREQUEST_0_CURRENCYCODE'],
            'status' => true
        ]);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect()->route('transactions.all')->with(['success', 'Payment successfully.']);
        }
    }

    public function failPayment()
    {
        auth()->user()->transactions()->create([
            'name' => $response['L_NAME0'],
            'amount' => $response['L_QTY0'],
            'total' => $response['L_AMT0'],
            'currency' => $response['PAYMENTREQUEST_0_CURRENCYCODE'],
            'status' => false
        ]);

        return response()->json('Payment Cancelled', 402);
    }

    public function allTransactions()
    {
        $transactions = auth()->user()->transactions;
        return view('transactions', compact('transactions'));
    }
}
