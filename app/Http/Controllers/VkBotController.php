<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\Update;
use App\Models\User;
use App\Models\WithdrawalApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use JsonException;

class VkBotController extends Controller
{
    private string $url;
    private string $versionApi;
    private string $accessToken;
    private string $adminVkLink;
    private string $notifyVkLink;

    public function __construct()
    {
        $this->url          = config('vk.url');
        $this->versionApi   = config('vk.versionApi');
        $this->accessToken  = config('vk.accessToken');
        $this->adminVkLink  = config('vk.adminVkLink');
        $this->notifyVkLink = config('vk.notifyVkLink');
    }

    /**
     * @throws JsonException
     */
    public function ClassVkBot(): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        if (!$user->vk_link) {
            return redirect()->back()->with(['result' => 'Нужен аккаунт  в Vk']);
        }

        $id = 'user_id=' . $user->vk_link;

        $message = "Проверка бота прошла успешно)))";

        $bot = $this->sendMessageFromBot($id, $message);

        if (isset($bot->error)) {
            return redirect()->back()->withErrors($bot->error->error_msg);
        }
        return redirect()->back()->with(['result' => 'Сообщение отправлено']);
    }

    /**
     * @throws JsonException
     */
    public function sendMessageFromBot(string $vk_id, string $message, string $attachment = null)
    {
        $url = curl_init($this->url . $vk_id . '&message=' . urlencode($message) . '&v=' . $this->versionApi . '&access_token=' . $this->accessToken . '&attachment=' . $attachment ?? '');
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($url, CURLOPT_HEADER, false);
        $html = curl_exec($url);
        curl_close($url);

        return json_decode($html, false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     */
    public function replenishmentNotification(Update $request): void
    {
        $user = User::query()->find($request->input('to'));
        if ($user->vk_link) {
            $data = $request->validated();
            $message = 'CDMGames.com!<br>Пополнение баланса на сайте для пользователя ' . $user->name . ' на ' . $data['balance'] . 'руб.';
            $vkId = 'user_id=' . $user->vk_link;
            $this->sendMessageFromBot($vkId, $message);
        }
    }

    /**
     * @throws JsonException
     */
    public function replenishmentFromBot(Request $request): void
    {
        $confirmation_token = config('vk.confirmation_token');
        $token              = config('vk.token');
        $version            = config('vk.version');
        $data               = json_decode(file_get_contents('php://input'), false, 512, JSON_THROW_ON_ERROR);

        switch ($data->type) {
            case 'confirmation':
                echo $confirmation_token;
                break;

            case 'message_new':
                $user_id = $data->object->message->peer_id;
                $out = $data->object->message;
                Log::info("Ответ VK user_id: ", [$user_id]);
                if ($user_id == '2000000001') {
                    preg_match("/Оплачено/", $out->text, $match);
                    Log::info("Ответ VK: ", [$user_id, $out, $out->text]);
                    if (isset($match[0])) {
                        preg_match("/ID: (.*?)\n/", $out->reply_message->text, $withdrawalApplicationId);
                        preg_match("/Реквизит: (.*?)\n/", $out->reply_message->text, $tel);
                        $PCREpattern = '/\r\n|\r|\n|-| /u';
                        $withdrawalApplicationId = preg_replace($PCREpattern, '', $withdrawalApplicationId[1]);

                        $debug = WithdrawalApplication::find($withdrawalApplicationId);

                        if (!$debug) {
                            $message = "❌ Ошибка (Номер заявки: " . $withdrawalApplicationId . ")";
                        } else {
                            $message = "✅ Ок";
                            $debug->status = 1;
                            $debug->save();

                            preg_match("/Метод: (.*?)\n/", $out->reply_message->text, $method);
                            $PCREpattern2 = '/\r\n|\r|\n/u';
                            $method = preg_replace($PCREpattern2, '', $method[1]);

                            preg_match("/Сумма: (.*?)\n/", $out->reply_message->text, $sum);
                            $sum = preg_replace($PCREpattern2, '', $sum[1]);

                            preg_match("/Пользователь: (.*?)\n/", $out->reply_message->text, $nick);
                            $nick = preg_replace($PCREpattern2, '', $nick[1]);

                            $user = $debug->user()->first();

                            $mess_bot = "Администрация успешно отправила вам перевод на " . $tel[1] . " (" . $method . ") в размере " . $sum . "

				Оставьте отзыв по ссылке https://vk.com/topic-176494199_40223406 и Вам будет начислен рандомный денежный бонус на баланс.

				Для получения бонуса, необходимо сделать скриншот отзыва и отправить его в сообщения группы ВКонтакте - vk.com/cdmgames";

                            $this->sendMessageFromBot("user_id=" . $user->vk_link, $mess_bot);
                        }

                        $this->sendMessageFromBot($this->adminVkLink, $message);
                    } else {
                        preg_match("/Лист/", $out->text, $match);
                        if (isset($match[0])) {
                            $this->sendMessageFromBot($this->adminVkLink, "Вот список активных заявок:");
                            $withdrawalApplications = WithdrawalApplication::where('status', 0)->get();
                            foreach ($withdrawalApplications as $withdrawalApplication) {
                                $userName = $withdrawalApplication->user->name;
                                $method = $withdrawalApplication->withdrawalMethod->name;
                                $amount = $withdrawalApplication->amount;
                                $id = $withdrawalApplication->id;
                                $requisite = $withdrawalApplication->requisite;
                                $messageToListVk ='//__________________________________________//
                                  CDMGAMES.COM
                                  ЗАЯВКА НА ВЫВОД

                                  ID: '.$id.'

                                  Сумма: '.$amount.' руб.
                                  Метод: '.$method.'
                                  Реквизит: '.$requisite.'

                                  Пользователь: '.$userName.'
                               //__________________________________________//';
                                $this->sendMessageFromBot($this->adminVkLink, $messageToListVk);
                                $this->sendMessageFromBot($this->adminVkLink, " " . $requisite . " ");
                            }
                        } elseif (str_contains($out->text, 'Оплатить'))
                        {
                            $pay = str_replace("Оплатить","",$out->text);
                            $userToPay = preg_replace('/\s+/', '', $pay);
                            $this->sendMessageFromBot($this->adminVkLink, "Оплачиваю: ".$userToPay);
                            $user = User::where('name', $userToPay)->first();
                            $withdrawalApplications = WithdrawalApplication::where('user_id', $user->id)->where('status', 0)->get();

                            if(!$withdrawalApplications){
                                $this->sendMessageFromBot($this->adminVkLink, "❌ Не найдено ".$withdrawalApplications);
                            }else{
                                foreach ($withdrawalApplications as $withdrawalApplication) {
                                    $withdrawalApplication->status = 1;
                                    $withdrawalApplication->save();

                                    $userVk = 'user_id=' . $withdrawalApplication->user->vk_link;
                                    $method = $withdrawalApplication->withdrawalMethod->name;
                                    $amount = $withdrawalApplication->amount;
                                    $id = $withdrawalApplication->id;
                                    $requisite = $withdrawalApplication->requisite;

                                    $mess_bot = "Администрация успешно отправила вам перевод на ".$requisite." (".$method.") в размере ".$amount." Руб.

            Оставьте отзывы по ссылке https://vk.com/topic-176494199_40223406  и Вам будет начислен рандомный денежный бонус на баланс.

            Для получения бонуса, необходимо сделать скриншот отзыва и отправить его в сообщения группы ВКонтакте - vk.com/cdmgames";

                                    $this->sendMessageFromBot($userVk, $mess_bot);
                                }
                                $this->sendMessageFromBot($this->adminVkLink, "✅ Оплачено - ".$userToPay);
                            }

                        } elseif (str_contains($out->text, 'Завсех'))
                        {
                            $this->sendMessageFromBot($this->adminVkLink, "Оплачиваю: Всем");
                            $users = User::join('withdrawal_applications', 'withdrawal_applications.user_id', '=', 'users.id')
                                ->with('withdrawalApplications')
                                ->where('withdrawal_applications.status', 0)
                                ->select('users.*')
                                ->groupBy('users.name')
                                ->get();

                            foreach ($users as $user) {
                                foreach ($user->withdrawalApplications->where('status', 0) as $withdrawalApplication) {
                                    $withdrawalApplication->status = 1;
                                    $withdrawalApplication->save();

                                    $userVk = 'user_id=' . $user->vk_link;
                                    $method = $withdrawalApplication->withdrawalMethod->name;
                                    $amount = $withdrawalApplication->amount;
                                    $id = $withdrawalApplication->id;
                                    $requisite = $withdrawalApplication->requisite;

                                    $mess_bot = "Администрация успешно отправила вам перевод на ".$requisite." (".$method.") в размере ".$amount." Руб.

        Оставьте отзывы по ссылке https://vk.com/topic-176494199_40223406  и Вам будет начислен рандомный денежный бонус на баланс.

        Для получения бонуса, необходимо сделать скриншот отзыва и отправить его в сообщения группы ВКонтакте - vk.com/cdmgames";

                                    $this->sendMessageFromBot($userVk, $mess_bot);
                                    $this->sendMessageFromBot($this->adminVkLink, "✅ Оплачено - ".$user->name);
                                }
                            }
                        }
                        else{
                            $message = 'Не понял команду

                        Доступные команды:
                        "Оплачено" - для оплаты заявки на вывод средств;
                        "Оплатить" - для оплаты заявки по нику;
                        "Завсех" - оплата всех заявок;
                        "Лист" - посмотреть список неоплаченных заявок;';
                            $this->sendMessageFromBot($this->adminVkLink, $message);
                        }
                    }
                } else {
                    preg_match("/Привет/", $out->text, $match);
                    Log::info("Ответ VK: ", [$user_id, $out, $out->text]);
                    if (isset($match[0])) {
                        $message = 'Под этим солнцем и небом мы тепло приветствуем тебя!';
                        $attachment = 'photo-13781728_457242493';
                        $this->sendMessageFromBot("user_id=" . $user_id, $message, $attachment);
                    }
                }
                echo('ok');
                break;
        }
    }
}
