<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'bookings';

    protected $primaryKey = 'booking_id';
    public $incrementing = true;

    protected $fillable = [
        'costumer_id',
        'jadwal_id',
        'booking_code',
        'token',
        'seats_total',
        'total_price',
        'booked_at',
        'status',
    ];

    protected $casts = [
        'seats_total' => 'integer',
        'total_price' => 'integer',
        'booked_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function costumer()
    {
        return $this->belongsTo(CostumerModel::class, 'costumer_id', 'costumer_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalModel::class, 'jadwal_id', 'jadwal_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentModel::class, 'booking_id', 'booking_id');
    }
}
