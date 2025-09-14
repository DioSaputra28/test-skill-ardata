<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'ships';

    protected $primaryKey = 'ship_id';
    public $incrementing = true;

    protected $fillable = [
        'ship_name',
        'capacity',
        'ship_type',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'deleted_at' => 'datetime',
    ];

    public function jadwals()
    {
        return $this->hasMany(JadwalModel::class, 'ship_id', 'ship_id');
    }
}
