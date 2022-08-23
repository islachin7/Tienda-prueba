<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'apellido_paterno', 'documento', 'celular', 'direccion','respuestaSecreta','urbanizacion','idDist','role_id','foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function setPasswordAttribute(string $password){
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopeById($query, $id)
    {
        return $query->where('users.id', $id);
    }

    public function scopeByEmail($query, $id)
    {
        return $query->where('users.email', $id);
    }

}
