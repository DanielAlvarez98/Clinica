<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{Role,Employee,User,Weekday};
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['rol'=>'Administrador'],
            ['rol'=>'Médico'],
            ['rol'=>'Enfermero/ra']
        ];
        foreach ($data as $roles) {
            Role::create($roles);
        }
        Employee::create([
        'id_rol'=>'1',
        'name'=>'Daniel',
        'lastname'=>'Alvarez',
        'dni'=>'75440348',
        'email'=>'daniel.laura98@hotmail.com',
        'birthdate'=>'1998-02-12',
        'gender'=>'Masculino',
        'photo'=>''
        ]);

        User::create([
            'id_employee'=>'1',
            'username' => 'daniel98',
            'password'=>Hash::make('griceldaX66')
        ]);

        $days=[
            ['day'=>'Lunes'],
            ['day'=>'Martes'],
            ['day'=>'Miercoles'],
            ['day'=>'Jueves'],
            ['day'=>'Viernes'],
            ['day'=>'Sabado'],
            ['day'=>'Domingo'],
        ];
        foreach ($days as $day) {
            Weekday::create($day);
        }
    }
}
