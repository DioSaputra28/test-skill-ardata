<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'jadwals';

    protected $primaryKey = 'jadwal_id';
    public $incrementing = true;

    protected $fillable = [
        'rute_id',
        'ship_id',
        'departure_date',
        'departure_time',
        'status',
        'price',
        'seats_kuota',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'departure_time' => 'string',
        'price' => 'integer',
        'seats_kuota' => 'integer',
        'deleted_at' => 'datetime',
    ];

    public function rute()
    {
        return $this->belongsTo(RuteModel::class, 'rute_id', 'rute_id');
    }

    public function ship()
    {
        return $this->belongsTo(ShipModel::class, 'ship_id', 'ship_id');
    }

    public function bookings()
    {
        return $this->hasMany(BookingModel::class, 'jadwal_id', 'jadwal_id');
    }
}
