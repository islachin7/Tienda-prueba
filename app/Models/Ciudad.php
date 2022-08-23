<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudad';
    public $timestamps = false;

    public function scopeById($query, $id)
    {
        return $query->where('ciudad.idCiu', $id);
    }

}
