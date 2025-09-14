<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuteModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'rutes';

    protected $primaryKey = 'rute_id';
    public $incrementing = true;

    protected $fillable = [
        'departure',
        'destination',
        'distance',
    ];

    protected $casts = [
        'distance' => 'integer',
        'deleted_at' => 'datetime',
    ];

    public function jadwals()
    {
        return $this->hasMany(JadwalModel::class, 'rute_id', 'rute_id');
    }
}
