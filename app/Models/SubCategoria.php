<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;
    protected $table = 'subCategoria';
    public $timestamps = false;

    public function scopeById($query, $id)
    {
        return is_array($id) 
            ? $query->whereIn('subCategoria.id_subCategoria', $id)
            : $query->where('subCategoria.id_subCategoria', $id); 
    }


}
