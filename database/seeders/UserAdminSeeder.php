<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@admin')->exists()) {
            User::factory()->for(Role::find(Role::ADMIN_ROLE_ID))->create(['email' => 'admin@admin', 'password' => Hash::make('admin')]);
        }
    }
}
