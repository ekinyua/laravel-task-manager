<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage tasks']);

        // Creating Users
        $userOne = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=> Hash::make("Password"),
        ]);

        $adminOne = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admintest@example.com',
            'password'=> Hash::make("Password"),
        ]);

        // Assign permissions to roles
        $admin->givePermissionTo(['manage users', 'manage tasks']);

        // Assigning users Roles
        $userOne->assignRole('user');
        $adminOne->assignRole('admin');
    }
}
