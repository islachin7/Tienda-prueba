<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';
    public $timestamps = false;

    public function scopeById($query, $id)
    {
        return $query->where('departamento.idDepa', $id);
    }

}
