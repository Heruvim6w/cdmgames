<?php

namespace App\Http\Controllers;

use App\Models\PageStaticContent;
use App\Models\User;
use App\Services\UserChangePasswordService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private UserChangePasswordService $userChangePasswordService;

    public function __construct(UserChangePasswordService $userChangePasswordService)
    {
        $this->userChangePasswordService = $userChangePasswordService;
    }
    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        /** @var User $user */
        $user = auth()->user();
        $profileVkInfo = PageStaticContent::query()->where('title', 'profile_vk_info')->first();
        $profileMoneyInfo = PageStaticContent::query()->where('title', 'profile_money_info')->first();

        return view('profile', compact('user', 'profileVkInfo', 'profileMoneyInfo'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function updatePass(Request $request)
    {
        $data = $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|min:8',
        ]);
        $user = auth()->user();
        if(Hash::check($data['password'], $user->password)){
            if($data['password'] === $data['new_password']){
                return collect(['errors'=>['new_password'=>['Новый пароль не может быть такой же как старый.']]])->toJson();
            }
            if($data['new_password'] !== $data['confirm_new_password']){
                return collect(['errors'=>['confirm_new_password'=>['Пароли не совпадают']]])->toJson();
            } else{
                $user->password = Hash::make($data['new_password']);
                $user->save();
                return collect(['errors'=>['confirm_new_password'=>['Пароль успешно изменен']],'result'=>'reload'])->toJson();
            }
        }
        return collect(['errors'=>['password'=>['Старый пароль не подходит']]])->toJson();
    }

    public function updateTempPassword(Request $request): RedirectResponse
    {
        $this->userChangePasswordService->update($request);

        return redirect()->back()->with('success', 'Пароль успешно изменен!');
    }
}
