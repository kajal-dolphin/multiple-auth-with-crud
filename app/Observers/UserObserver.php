<?php

namespace App\Observers;

use App\Jobs\SendWelcomeEmail;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        SendWelcomeEmail::dispatch($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if($user->wasChanged('name')){
            // name has changed
            $new_name = $user->name; 
            $old_name = $user->getOriginal('name');
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
