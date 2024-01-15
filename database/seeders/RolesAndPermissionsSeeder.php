<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permisos = [
            'administrar usuarios',
            'registrar solicitud de crédito',
            'ver créditos y solicitudes',
            'cancelar solicitud',
            'ver detalles de crédito',
            'ver todas las solicitudes',
            'cambiar estado de la solicitud',
            'crear asesores',
            'ver solicitudes pendientes',
            'aprobar/rechazar crédito'

        ];

        foreach ($permisos as $permiso) {
            if (!Permission::where('name', $permiso)->exists()) {
                Permission::create(['name' => $permiso]);
            }
        }

        // Crear permisos
        // Permission::create(['name' => 'administrar usuarios']);
        // Permission::create(['name' => 'registrar solicitud de crédito']);
        // Permission::create(['name' => 'ver créditos y solicitudes']);
        // Permission::create(['name' => 'cancelar solicitud']);
        // Permission::create(['name' => 'ver detalles de crédito']);
        // Permission::create(['name' => 'ver todas las solicitudes']);
        // Permission::create(['name' => 'cambiar estado de la solicitud']);
        // Permission::create(['name' => 'crear asesores']);
        // Permission::create(['name' => 'ver solicitudes pendientes']);
        // Permission::create(['name' => 'aprobar/rechazar crédito']);

        // Crear roles y asignar permisos existentes
        $roleSuperAdmin = Role::create(['name' => 'super administrador']);
        $roleSuperAdmin->givePermissionTo('administrar usuarios');

        $roleCliente = Role::create(['name' => 'cliente']);
        $roleCliente->givePermissionTo(['registrar solicitud de crédito', 'ver créditos y solicitudes', 'cancelar solicitud', 'ver detalles de crédito']);

        $roleAsesor = Role::create(['name' => 'asesor']);
        $roleAsesor->givePermissionTo(['ver todas las solicitudes', 'cambiar estado de la solicitud']);

        $roleGerenteGeneral = Role::create(['name' => 'gerente general']);
        $roleGerenteGeneral->givePermissionTo(['crear asesores', 'ver solicitudes pendientes', 'aprobar/rechazar crédito']);
    }
}
