<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostumerModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'costumers';

    protected $primaryKey = 'costumer_id';
    public $incrementing = true;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'nik',
        'age',
        'gender',
    ];

    protected $casts = [
        'age' => 'integer',
        'deleted_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(BookingModel::class, 'costumer_id', 'costumer_id');
    }
}
