<?php

namespace App\Listeners\Auth;

use App\Services\CompanyService;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SetupCompanySessionListener
{
    /**
     * Create the event listener.
     */
    public function __construct(protected CompanyService $companyService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $company = $this->companyService->createNew($event->user);
        session()->put('company_id', $company->id);
    }
}
