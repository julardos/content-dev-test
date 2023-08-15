<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_UNPAID = 'unpaid';
    const STATUS_PAID = 'paid';
    const STATUS_EXPIRED = 'expired';

    protected $fillable = [
        'number', 'creator_id', 'user_id', 'total_price', 'payment_status', 'snap_token',
        'paid_at', 'expired_at', 'subscribed_end_date'
    ];

    protected $dates = ['created_at', 'paid_at', 'expired_at', 'subscribed_end_date', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
