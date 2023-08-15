<?php

namespace App\Services\Midtrans;

use App\Models\Order;
use App\Services\Midtrans;
use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected Order $order;

    public function __construct(Order $order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->number,
                'gross_amount' => $this->order->total_price,
            ],
            'item_details' => [
                [
                    'id' => $this->order->id,
                    'price' => $this->order->total_price,
                    'quantity' => 1,
                    'name' => 'Subscribe '.$this->order->creator?->name.' '.$this->order->created_at->format('F Y'),
                ],
            ],
            'customer_details' => [
                'name' => $this->order->user->name,
                'email' => $this->order->user->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }

    public function createTransaction(Order $order)
    {
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->number,
                'gross_amount' => $order->total_price,
            )
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect()->to( $paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
