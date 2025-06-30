<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;

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

    public static function createNew(): Company
    {
        return Company::query()->create([
            'data' => []
        ]);
    }
}
