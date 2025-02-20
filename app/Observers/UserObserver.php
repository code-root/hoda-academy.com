<?php

namespace App\Observers;

use App\Models\User;

use App\Traits\TokenTraits;

class UserObserver
{
use TokenTraits;

/**
* This function is called when a new user is created.

* * @param \App\Models\User $user
* @return void
*/
    public function created(User $user)
    {
    // Use helper request() to get the current request data
    $request = request();
    // Generate the token using the function in the Trait
    $tokenData = $this->generateCustomToken($request);

    // Update the token field in the user record
    $user->update([
    'token' => $tokenData['token']
    ]);
    }

/**
* Token can also be updated when user data is updated (optional)

* @param \App\Models\User $user
* @return void
*/
    public function updated(User $user)
    {
    // Example: Token is updated when user data is modified
    $request = request();
    $tokenData = $this->generateCustomToken($request);
    $user->update(['token' => $tokenData['token']]);
    }
}
