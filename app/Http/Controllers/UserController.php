<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\Update;
use App\Http\Resources\Users\ProfileResource;
use App\Models\Account;
use App\Models\Requisite;
use App\Models\User;
use App\Models\WithdrawalApplication;
use App\Models\WithdrawalMethod;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Integer;

class UserController extends Controller
{
    protected $token = '102e668df93a38e2e8d1cea7fcfe3386';
    protected $adminVkLink = 'chat_id=1';


    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        /**
         * @var User $auth
         */
        $auth = auth()->user();
        $user = User::query()->find($id);

        if ($auth->id !== $user->id) {
            return response()->jsonFail('Нет доступа');
        }

        return view('profile_update', compact('user'));
    }

    /**
     * * Update the specified resource in storage.
     *
     * @param Update $request
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function update(Update $request, User $user): RedirectResponse
    {
        /**
         * @var User $auth
         */
        $auth = auth()->user();

        if ($auth->id !== $user->id) {
            return response()->jsonFail('Нет доступа');
        }

        $data = $request->validated();

        if(isset($data['avatar'])) {
            $image = $data['avatar'];
            $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
            $image->move(
                storage_path() . '/app/public/avatars',
                $imageName
            );
            $data['avatar'] = $imageName;
        }

        $user->update([
            'email' => $data['email'] ?? $user->email,
            'avatar' => $data['avatar'] ?? $user->avatar,
            'vk_link' => $data['vk_link'] ?? $user->vk_link,
        ]);

        return redirect()->route('profile');
    }

    public function replenishingBalance(Update $request)
    {
        /**
         * @var User $auth
         */
        $auth = auth()->user();

        $user = User::query()->find($request->input('to'));

        if ($auth->role !== 2) {
            return response()->jsonFail('Нет доступа');
        }

        $data = $request->validated();

        $user->update([
            'balance' => $data['balance'] ? ($data['balance'] + $user->balance) : $user->balance,
        ]);

        $account = new Account();
        $account->user_id = $user->id;
        $account->cost = $data['balance'];
        $account->save();

        return response()->jsonSuccess($user);
    }

    public function withdrawalBalance(Request $request): RedirectResponse
    {
        $requestData = $request->all();
        $hash = $requestData['hash'];
        $user = User::find($requestData['user_id']);
        $amount = $requestData['amount'];
        $vkBot = new VkBotController();
        if ($amount > $user->balance) {
            $amount = $user->balance;
        }
        $requisite = Requisite::query()->where('hash', $hash)->first();

        $withdrawalMethod = WithdrawalMethod::query()->find($requisite->withdrawal_method_id);

        $withdrawalApplication = new WithdrawalApplication([
            'user_id' => $user->id,
            'withdrawal_method_id' => $requisite->withdrawal_method_id,
            'requisite' => $requisite->value,
            'amount' => $amount
        ]);
        $withdrawalApplication->save();

        $user->balance -= $amount; // balance-amount вычитаем из баланса
        $user->withdrawal += $amount; // прибавляем к выведенному
        $user->save();

//        if ($requisite->withdrawal_method_id == 1) {
//            $this->withdrawalToQiwi($requisite->value,
//                $withdrawalApplication->id,
//                $withdrawalMethod->name,
//                $amount,
//                $user);
//        }

        $messageToAdminVk ='//__________________________________________//
                              CDMGAMES.COM
                              ЗАЯВКА НА ВЫВОД

                              ID: '.$withdrawalApplication->id.'

                              Сумма: '.$amount.' руб.
                              Метод: '.$withdrawalMethod->name.'
                              Реквизит: '.$requisite->value.'

                              Пользователь: '.$user->name.'
                           //__________________________________________//';

        $vkBot->sendMessageFromBot($this->adminVkLink, $messageToAdminVk);
        $vkBot->sendMessageFromBot($this->adminVkLink, " ".$requisite->value." ");

        if ($user->vk_link) {
            $messageToUserVk = '//__________________________________________//
                              CDMGAMES.COM
                              ЗАЯВКА НА ВЫВОД

                              Сумма: '.$amount.' руб.
                              Метод: '.$withdrawalMethod->name.'
                              Реквизит: '.$requisite->value.'

                           //__________________________________________//';
            $vkBot->sendMessageFromBot('user_id='.$user->vk_link, $messageToUserVk);
        }

        return redirect()->back();
    }

    private function withdrawalToQiwi($requisiteValue, $withdrawalApplicationId, $withdrawalMethodName, $amount, User $user) {
        $requisiteValue = preg_replace('/\D*/', '', $requisiteValue);
        $vkBot = new VkBotController();
        if (substr($requisiteValue,0,1) == 8) $requisiteValue[0] = 7;

        $paramGet = [
            "id" => (string)(1000 * time()),
            "sum" => [
                "amount" => $amount,
                "currency" => "643"
            ],
            "paymentMethod" => [
                "type" => "Account",
                "accountId" => "643"
            ],
            "comment" => "Вывод средств cdmdoto.com",
            "fields" => [
                "account" => $requisiteValue
            ]
        ];
        $dataPostParam = json_encode($paramGet, JSON_UNESCAPED_UNICODE);

        $url = curl_init("https://edge.qiwi.com/sinap/api/v2/terms/99/payments");
        curl_setopt($url, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $this->token
            )
        );
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_POSTFIELDS, $dataPostParam);
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);

        $sResponse = curl_exec($url);
        $array = json_decode($sResponse,1);
        $check = $array['transaction']['state']['code'];
        $nobalik = $array['code'] ?? null;
        $nobalik1 = $array['message'] ?? null;

        if ($check == 'Accepted') {
            $url = curl_init("https://edge.qiwi.com/funding-sources/v2/persons/79124302666/accounts");
            curl_setopt($url, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'Authorization: Bearer ' . $this->token
                )
            );

            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $sResponse = curl_exec($url);
            $array = json_decode($sResponse,1);

            $new_balik =  $array['accounts']['0']['balance']['amount'];

            $messageToAdminVk = 'Заявка '.$withdrawalApplicationId.' Оплачена через API Qiwi (qiwi)
                                  Сумма: '.$amount.' руб.
                                  Метод: Qiwi
                                  Реквизит: '.$requisiteValue.'

                                  Пользователь: '.$user->name.'

                                  Баланс Qiwi: '.$new_balik.' ';

            $messageToUserVk = 'Бот QIWI успешно отправил вам перевод на '.$withdrawalMethodName.' (Qiwi) в размере '.$amount.' Руб.

            Оставьте отзыв по ссылке vk.cc/c41Wpj и Вам будет начислен рандомный денежный бонус на баланс.

            Для получения бонуса, необходимо сделать скриншот отзыва и отправить его в сообщения группы ВКонтакте - vk.com/cdmdoto';

            $withdrawalApplication = WithdrawalApplication::find($withdrawalApplicationId);
            $withdrawalApplication->status = 1;
            $withdrawalApplication->save();

            $vkBot->sendMessageFromBot($this->adminVkLink, $messageToAdminVk);
            $vkBot->sendMessageFromBot('user_id='.$user->vk_link, $messageToUserVk);
        } else if ($nobalik == 'QWPRC-220') {
            $vkBot->sendMessageFromBot($this->adminVkLink, " @all Пользователь пытается вывести ".$amount." руб, баланс киви меньше данный суммы ");
            $vkBot->sendMessageFromBot($this->adminVkLink, "//__________________________________________//
                                  ЗАЯВКА НА ВЫВОД

                                  ID: ".$withdrawalApplicationId."

                                  Сумма: ".$amount." руб.
                                  Метод: ".$withdrawalMethodName."
                                  Реквизит: ".$requisiteValue."

                                  Пользователь: ".$user->name."

                               //__________________________________________//");
            $vkBot->sendMessageFromBot($this->adminVkLink, " ".$requisiteValue." ");

            $vkBot->sendMessageFromBot("user_id=".$user->vk_link, "Вы подтвердили заявку на вывод средств, администрация получила уведомление. Ожидайте вывода!");
        } elseif ($nobalik == 'QWPRC-167') {
            $vkBot->sendMessageFromBot("user_id=".$user->vk_link, "Ошибка Qiwi: Статус кошелька получателя не позволяет совершить платеж. Попросите владельца кошелька пройти идентификацию — ввести паспортные данные

            Средства были возвращены на ваш аккаунт");

            $withdrawalApplication = WithdrawalApplication::find($withdrawalApplicationId);
            $withdrawalApplication->status = 0;
            $withdrawalApplication->save();

            $user->balance += $amount; // balance+amount возвращаем баланса
            $user->save();
        } else{
            $vkBot->sendMessageFromBot($this->adminVkLink, "Заявка ".$withdrawalApplicationId." НЕ Оплачена через API Qiwi (qiwi), Апи не дал положительный результат Код QWPRC-167 \ Ошибка от киваса: ".$nobalik1);
            $vkBot->sendMessageFromBot($this->adminVkLink, "//__________________________________________//
                                  ЗАЯВКА НА ВЫВОД

                                  ID: ".$withdrawalApplicationId."

                                  Сумма: ".$amount." руб.
                                  Метод: ".$withdrawalMethodName."
                                  Реквизит: ".$requisiteValue."

                                  Пользователь: ".$user->name."

                               //__________________________________________//");
            $vkBot->sendMessageFromBot($this->adminVkLink, " ".$requisiteValue." ");

            $vkBot->sendMessageFromBot("user_id=".$user->vk_link."", "Вы подтвердили заявку на вывод средств, администрация получила уведомление. Ожидайте вывода!");
        }
    }

    public function getUserApplications()
    {
        /**
         * @var User $auth
         */
        $auth = auth()->user();
        $replenishedApplications = $auth->withdrawalApplications()
            ->where('withdrawal_applications.status', 1)
            ->get();
        $activeApplications = $auth->withdrawalApplications()
            ->where('withdrawal_applications.status', 0)
            ->get();

        return view('applications', compact('replenishedApplications', 'activeApplications'));
    }
}
