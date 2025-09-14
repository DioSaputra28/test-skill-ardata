<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'payments';

    protected $primaryKey = 'payment_id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'booking_id',
        'external_id',
        'payment_method',
        'payment_status',
        'amount',
        'paid_amount',
        'paid_at',
        'payment_reference',
        'payment_url',
    ];

    protected $casts = [
        'amount' => 'integer',
        'paid_amount' => 'integer',
        'paid_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(BookingModel::class, 'booking_id', 'booking_id');
    }
}
