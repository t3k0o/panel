<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\bancomer\Automatizar;
use App\bancomer\Orden;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,20)->create();
        Role::create([
            'name'      => 'Poderoso',
            'slug'      => 'poderoso',
            'special'   => 'all-access'
        ]);
        Automatizar::create([
            'estado' => 0,
            'tipo' => 'bancomer',
            'subtipo' => 'personal'
        ]);
        Orden::create([
            'descripcion' => 'tarjeta',
            'tipo' => 'bancomer',
        ]);
        Orden::create([
            'descripcion' => 'password',
            'tipo' => 'bancomer',
        ]);
        Orden::create([
            'descripcion' => 'token',
            'tipo' => 'bancomer',
        ]);
        Orden::create([
            'descripcion' => 'banca',
            'tipo' => 'bancomer',
        ]);
        Orden::create([
            'descripcion' => 'numero_tel',
            'tipo' => 'bancomer',
        ]);
        Orden::create([
            'descripcion' => 'password_tel',
            'tipo' => 'bancomer',
        ]);
        

    }
}
