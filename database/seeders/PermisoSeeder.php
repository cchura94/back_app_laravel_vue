<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permiso = new Permiso();
        $permiso->nombre = "listar_persona";
        $permiso->accion = "listar";
        $permiso->recurso = "persona";
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "crear_persona";
        $permiso->accion = "crear";
        $permiso->recurso = "persona";
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "editar_persona";
        $permiso->accion = "editar";
        $permiso->recurso = "persona";
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "mostrar_persona";
        $permiso->accion = "mostrar";
        $permiso->recurso = "persona";
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "eliminar_persona";
        $permiso->accion = "eliminar";
        $permiso->recurso = "persona";
        $permiso->save();

        // DB::select("insert inco")
    }
}
