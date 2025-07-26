<?php

namespace App\Listeners\Auth;

use App\Enums\RoleEnum;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class AssignClientRoleListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        Log::log('info', 'Assigning client role to user', [
            'user_id' => $event->user->id,
            'email' => $event->user->email,
        ]);
        $clientRole = Role::query()->where('name', RoleEnum::CLIENT->value)->first();
        if ($clientRole) {
            $event->user->assignRole($clientRole);
        }
    }
}
