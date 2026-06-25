<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $manager = Role::create(['name' => 'Manager', 'guard_name' => 'admin']);
        $cashier = Role::create(['name' => 'Cashier', 'guard_name' => 'admin']);

        // Create super admin
        $admin = Admin::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@pos.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole($superAdmin);
    }
}
