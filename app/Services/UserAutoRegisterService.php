<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAutoRegisterService
{
    /**
     * @return User
     */
    public function register(): User
    {
        $fakeNames1 = config('userAutoRegister.fakeNames1');
        $fakeNames2 = config('userAutoRegister.fakeNames2');

        $now      = Carbon::now()->timestamp;
        $name     = array_rand($fakeNames1);
        $fakeName = array_rand($fakeNames2);
        $login    = "$fakeNames1[$name]_$fakeNames2[$fakeName]_$now";
        $password = "$fakeNames1[$name]_$now"."_$fakeNames2[$fakeName]";

        return User::create([
            'name'     => $login,
            'email'    => $login . '@example.com',
            'password' => Hash::make($password),
        ]);
    }

    /**
     * @return void
     */
    public function login(): void
    {
        Auth::login(
            $this->register(),
            true
        );
    }
}
