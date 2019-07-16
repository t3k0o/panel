<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos de usuarios
        Permission::create([
            'name' => 'Navegar usuarios',
            'slug' => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle usuarios',
            'slug' => 'users.show',
            'description' => 'Ver en detalle cada usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion usuarios',
            'slug' => 'users.create',
            'description' => 'Crea cualquier usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Edicion usuarios',
            'slug' => 'users.edit',
            'description' => 'Editar cualquier dato de un usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar usuario',
            'slug' => 'users.destroy',
            'description' => 'Eliminar cualquier usuario del sistema',
        ]);


         //Permisos de Roles
         Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'roles.index',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle rol',
            'slug' => 'roles.show',
            'description' => 'Ver en detalle cada rol del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion rol',
            'slug' => 'roles.create',
            'description' => 'Crea cualquier rol del sistema',
        ]);
        Permission::create([
            'name' => 'Edicion rol',
            'slug' => 'roles.edit',
            'description' => 'Editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar rol',
            'slug' => 'roles.destroy',
            'description' => 'Eliminar cualquier rol del sistema',
        ]);

        //Permisos de Etiquetas
         Permission::create([
            'name' => 'Navegar etiquetas',
            'slug' => 'etiquetas.index',
            'description' => 'Lista y navega todos los etiquetas del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle etiqueta',
            'slug' => 'etiquetas.show',
            'description' => 'Ver en detalle cada etiqueta del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion etiqueta',
            'slug' => 'etiquetas.create',
            'description' => 'Crea cualquier etiqueta del sistema',
        ]);
        Permission::create([
            'name' => 'Edicion etiqueta',
            'slug' => 'etiquetas.edit',
            'description' => 'Editar cualquier dato de un etiqueta del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar etiqueta',
            'slug' => 'etiquetas.destroy',
            'description' => 'Eliminar cualquier etiqueta del sistema',
        ]);

        //Permisos de Ordenes
         Permission::create([
            'name' => 'Navegar ordenes',
            'slug' => 'ordenes.index',
            'description' => 'Lista y navega todos los ordenes del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle orden',
            'slug' => 'ordenes.show',
            'description' => 'Ver en detalle cada orden del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion orden',
            'slug' => 'ordenes.create',
            'description' => 'Crea cualquier orden del sistema',
        ]);
        Permission::create([
            'name' => 'Edicion orden',
            'slug' => 'ordenes.edit',
            'description' => 'Editar cualquier dato de un orden del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar orden',
            'slug' => 'ordenes.destroy',
            'description' => 'Eliminar cualquier orden del sistema',
        ]);


        Permission::create([
            'name' => 'Bancomer',
            'slug' => 'bancomer',
            'description' => 'visualizar el tab de bancomer',
        ]);

        Permission::create([
            'name' => 'Listar todos los logos de logo azul',
            'slug' => 'bancomer.personal.index',
            'description' => 'visualizar el tab de bancomer',
        ]);
        
    }
}
