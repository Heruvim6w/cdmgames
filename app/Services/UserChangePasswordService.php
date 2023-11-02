<?php

namespace App\Services;

use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordService
{
    /**
     * Validate and update the user's password.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $messages = [
            'new_password.required'  => 'Поле новый пароль обязательно для заполнения',
            'new_password.min'       => 'Минимальная длина нового пароля - 8 символов',
            'new_password.confirmed' => 'Пароли не совпадают',
        ];

        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ], $messages);

        $user = Auth::user();

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Пароль успешно изменен!');
    }
}
