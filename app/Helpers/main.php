<?php

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
        return \App\Models\Company::query()->find(selectedCompanyId());
    }
}
