<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'distrito';
    public $timestamps = false;

    public function scopeById($query, $id)
    {
        return $query->where('distrito.idDist', $id);
    }

}
