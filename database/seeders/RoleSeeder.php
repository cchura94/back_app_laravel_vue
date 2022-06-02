<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = new Role();
        $r1->nombre = "admin";
        $r1->save();

        $r2 = new Role();
        $r2->nombre = "cajero";
        $r2->save();

        $r3 = new Role();
        $r3->nombre = "ventas";
        $r3->save();

        // asignar permisos
        $r1->allowTo("listar_persona");
        $r1->allowTo("crear_persona");
        $r1->allowTo("editar_persona");
        $r1->allowTo("mostrar_persona");
        $r1->allowTo("eliminar_persona");

        $r2->allowTo("listar_persona");
        $r2->allowTo("crear_persona");
        $r2->allowTo("mostrar_persona");

        $r3->allowTo("listar_persona");
        $r3->allowTo("mostrar_persona");
    }
}
