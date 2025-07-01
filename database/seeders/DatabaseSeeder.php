<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\CompanyService;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        app(RoleSeeder::class)->run();

        $user = User::query()->where('email', 'admin@admin.com')->first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ]);

            $role = Role::query()->where('name', RoleEnum::ADMIN->value)->first();

            $user->assignRole($role);

            resolve(CompanyService::class)->createNew($user);
        }

        $clientRole = Role::query()->where('name', RoleEnum::CLIENT->value)->first();

        $fabricUsers = User::factory(1000)->create();

        foreach ($fabricUsers as $fabricUser) {
            $fabricUser->assignRole($clientRole);
        }
    }
}
