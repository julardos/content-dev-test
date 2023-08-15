<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function receive()
    {

        $callback = new CallbackService;
        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if ($callback->isSuccess()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => Order::STATUS_PAID,
                ]);
            }

            if ($callback->isExpire() || $callback->isCancelled()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => Order::STATUS_EXPIRED,
                ]);
            }

            return response()->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
