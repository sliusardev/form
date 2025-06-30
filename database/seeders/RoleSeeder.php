<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::query()->get();

        foreach (RoleEnum::values() as $role) {
            if ($roles->contains('name', $role)) {
                continue;
            }

            Role::create([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }
    }
}
