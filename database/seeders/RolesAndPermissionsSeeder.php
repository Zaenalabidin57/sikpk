<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // TODO: buat permission role nanti fix disini
        Permission::create(['name'=>'buat-proposal']);
        Permission::create(['name'=>'lihat-proposal']);
        Permission::create(['name'=>'hapus-proposal']);
        // privilege atmint
        Permission::create(['name'=>'buat-tanggal']);
        Permission::create(['name'=>'acc-proposal']);

        Permission::create(['name'=>'buat-akun']);


        Role::create(['name'=>'admin']);
        Role::create(['name'=>'mahasiswa']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('buat-proposal');
        $roleAdmin->givePermissionTo('lihat-proposal');
        $roleAdmin->givePermissionTo('hapus-proposal');
        $roleAdmin->givePermissionTo('buat-tanggal');
        $roleAdmin->givePermissionTo('acc-proposal');
        $roleAdmin->givePermissionTo('buat-akun');

        
        $roleMahasiswa = Role::findByName('mahasiswa');

        $roleMahasiswa->givePermissionTo('buat-proposal');
        $roleMahasiswa->givePermissionTo('lihat-proposal');
        $roleMahasiswa->givePermissionTo('hapus-proposal');

    }
}
