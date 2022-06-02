<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u1 = new User();
        $u1->name = "administrador";
        $u1->email = "admin@mail.com";
        $u1->password = bcrypt("admin54321");
        $u1->save();

        $u2 = new User();
        $u2->name = "pablo";
        $u2->email = "pablo@mail.com";
        $u2->password = bcrypt("pablo54321");
        $u2->save();

        $u3 = new User();
        $u3->name = "juan";
        $u3->email = "juan@mail.com";
        $u3->password = bcrypt("juan54321");
        $u3->save();
        
        // asignamos roles
        $u1->asignarRole("admin");

        $u2->asignarRole("cajero");

        $u3->asignarRole("ventas");
    }
}
