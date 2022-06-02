<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class);
    }

    public function allowTo($permiso)
    {
        // "crear_cliente"
        if(is_string($permiso)){
            $permiso = Permiso::where("nombre", $permiso)->firstOrFail();
        }
        $this->permisos()->sync($permiso, false);
    }
}
