<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Str;

class CompanyService
{
    public static function connect()
    {
        try {

            $company = Company::query()->first();

            if (!$company) {
                $company = static::createNew();
            }

        } catch (\Throwable $th) {
            return null;
        }

        return $company;
    }

    public static function values(): mixed
    {
        $company = static::connect();

        return $company->data ?? [];
    }

    public static function value(string $value)
    {
        return static::values()[$value] ?? '';
    }

    public function createNew(User $user): Company
    {
        $company = $user->company;

        if (!$company) {

            $slug = $this->generateUniqueSlug($user->name);

            $company = Company::query()->create([
                'data' => [],
                'user_id' => $user->id,
                'hash' => Str::random(15),
                'name' => $user->name,
                'slug' => $slug,
            ]);
        }
        return $company;
    }

    public function generateUniqueSlug($name): string
    {
        $slug = Str::slug($name);
        $count = 1;

        $originalSlug = $slug;
        while (Company::query()->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
