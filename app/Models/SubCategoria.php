<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;
    protected $table = 'subcategoria';
    public $timestamps = false;

    public function scopeById($query, $id)
    {
        return is_array($id) 
            ? $query->whereIn('subcategoria.id_subCategoria', $id)
            : $query->where('subcategoria.id_subCategoria', $id); 
    }


}
