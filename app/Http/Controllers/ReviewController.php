<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;

class ReviewController extends Controller
{
    protected $group_id = 176494199; // ID группы
    protected $topic_id = 40223406; // ID обсуждения
    protected $count = 50; // Количество комментариев, которое будет выведено
    protected $extended = 1; // Будут ли загружены профили
    protected $need_likes = 1; // Будут ли загружены лайки
    protected $sort = 'esc'; // Отображаем с начала(asc) или конца(desc)
    protected $version = '5.130'; // Версия VK API (На текущий момент менять не нужно)
    protected $token='9091c24452ac3a5e312085665296bfba4280f589359e35a6528b2695e8b4cb98c4c2a2f454d7d85d33d13';

    public function getReviews()
    {
        $this->getVkReviews();
        $reviews = Review::orderBy('comment_date', 'desc')->get();

        return view('review', ['reviews' => $reviews]);
    }

    private function getVkReviews()
    {
        $parsing = file_get_contents('https://api.vk.com/method/board.getComments?sort=desc&count=29&group_id=' . $this->group_id . '&topic_id=' . $this->topic_id . '&count=' . $this->count . '&extended=' . $this->extended . '&need_likes=' . $this->need_likes . '&sort=' . $this->sort . '&v=' . $this->version . '&access_token=' . $this->token);

        $parsing = json_decode($parsing);

        foreach ($parsing->response->items as $item) {
            $profile = json_decode($this->searchProfiles($parsing->response->profiles, $item->from_id));

            $review = Review::where('comment_id', $item->id)->first();

            if (!$review && $profile !== null) {
                $review = new Review();
                $review->vk_user_id = "https://vk.com/id" . $item->from_id;
                $review->comment_id = $item->id;
                $review->comment = $item->text;
                $review->comment_date =  Carbon::createFromTimestamp($item->date, 'Europe/Moscow')->format('Y-m-d h:m:s');
                $review->vk_user_name = $profile->first_name . " " . $profile->last_name;
                $review->vk_user_avatar = $profile->photo_100;
                $review->save();
            }
        }
    }

    /**
     * @param array $profiles
     * @param int $id
     * @return false|string
     */
    private function searchProfiles(array $profiles, int $id) {
        foreach ($profiles as $profile) {
            if ($profile->id == $id) {
                return json_encode(['first_name' => $profile->first_name, 'last_name' => $profile->last_name, 'photo_100' => $profile->photo_100]);
            }
        }
    }
}
