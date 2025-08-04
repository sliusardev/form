<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\Settings;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\CompanyService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        $user = User::query()->where('email', 'sliusardev@gmail.com')->first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'sliusardev@gmail.com',
            ]);

            $role = Role::query()->where('name', RoleEnum::ADMIN->value)->first();

            $user->assignRole($role);

            resolve(CompanyService::class)->createNew($user);
        }

        $settings = [
            'one_submission_cost_UAH' => '0.1',
            'one_form_cost_UAH' => '20',
            'min_payment_UAH' => '50',
            'one_submission_cost_USD' => '0.01',
            'one_form_cost_USD' => '1',
            'min_payment_USD' => '5',
        ];

        Settings::query()->create([
            'data' => $settings,
        ]);

//        $clientRole = Role::query()->where('name', RoleEnum::CLIENT->value)->first();
//
//        $fabricUsers = User::factory(1000)->create();
//
//        foreach ($fabricUsers as $fabricUser) {
//            $fabricUser->assignRole($clientRole);
//        }
    }
}
