<?php

use App\Models\Company;
use App\Models\Settings;
use Illuminate\Support\Collection;

if (!function_exists('setSelectedCompanyId')) {
    function setSelectedCompanyId($companyId): void
    {
        session()->put('company_id', $companyId);
    }
}

if (!function_exists('selectedCompanyId')) {
    function selectedCompanyId()
    {
        return session('company_id');
    }
}

if (!function_exists('selectedCompany')) {
    function selectedCompany()
    {
        return Company::query()->find(selectedCompanyId());
    }
}

if (!function_exists('settings')) {
    function settings(): array
    {
        $setting = Settings::query()->first();
        return $setting ? $setting->data : [];
    }
}
