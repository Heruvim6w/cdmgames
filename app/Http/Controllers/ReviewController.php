<?php

namespace App\Http\Controllers;

use App\Models\PageStaticContent;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;

class ReviewController extends Controller
{
    protected $group_id; // ID группы
    protected $topic_id; // ID обсуждения
    protected $count; // Количество комментариев, которое будет выведено
    protected $extended; // Будут ли загружены профили
    protected $need_likes; // Будут ли загружены лайки
    protected $sort; // Отображаем с начала(asc) или конца(desc)
    protected $version; // Версия VK API (На текущий момент менять не нужно)
    protected $token; // Токен

    public function __construct()
    {
        $this->group_id = config('vk.old_group_id');
        $this->topic_id = config('vk.topic_id');
        $this->count = config('vk.count');
        $this->extended = config('vk.extended');
        $this->need_likes = config('vk.need_likes');
        $this->sort = config('vk.sort');
        $this->version = config('vk.version');
        $this->token = config('vk.token');
    }

    public function getReviews()
    {
        $this->getVkReviews();
        $reviews = Review::orderBy('comment_id', 'desc')->paginate(15);
        $reviewsLeft = PageStaticContent::where('title', 'reviews_left')->first();
        $reviewsRight = PageStaticContent::where('title', 'reviews_right')->first();

        return view('review', [
            'reviews' => $reviews,
            'reviewsLeft' => $reviewsLeft,
            'reviewsRight' => $reviewsRight
        ]);
    }

    /**
     * @throws \JsonException
     */
    private function getVkReviews(): void
    {
        $parsing = file_get_contents('https://api.vk.com/method/board.getComments?group_id=' . $this->group_id . '&topic_id=' . $this->topic_id . '&count=' . $this->count . '&extended=' . $this->extended . '&need_likes=' . $this->need_likes . '&sort=' . $this->sort . '&v=' . $this->version . '&access_token=' . $this->token);

        $parsing = json_decode($parsing, false, 512, JSON_THROW_ON_ERROR);

        if (!isset($parsing->error)) {
            foreach ($parsing->response->items as $item) {
                $profile = json_decode(
                    $this->searchProfiles($parsing->response->profiles, $item->from_id),
                    false,
                    512,
                    JSON_THROW_ON_ERROR
                );

                $review = Review::query()->where('comment_id', $item->id)->first();

                if (!$review && $profile !== null) {
                    $review = new Review();
                    $review->vk_user_id = "https://vk.com/id" . $item->from_id;
                    $review->comment_id = $item->id;
                    $review->comment = $item->text;
                    if (
                        isset($item->attachments) &&
                        $item->attachments[0]->type === 'photo' &&
                        strlen(trim($item->attachments[0]->photo->sizes[2]->url)) <= 255
                    ) {
                        $review->attachment = $item->attachments[0]->photo->sizes[2]->url;
                    }
                    $review->comment_date = Carbon::createFromTimestamp($item->date, 'Europe/Moscow')
                        ->format('Y-m-d h:m:s');
                    $review->vk_user_name = $profile->first_name . " " . $profile->last_name;
                    $review->vk_user_avatar = $profile->photo_100;
                    $review->save();
                }
            }
        }
    }

    /**
     * @param array $profiles
     * @param int $id
     * @return false|string
     * @throws \JsonException
     */
    private function searchProfiles(array $profiles, int $id) {
        foreach ($profiles as $profile) {
            if ($profile->id === $id) {
                if ($profile->photo_100 && strlen(trim($profile->photo_100)) <= 255) {
                    $avatar = $profile->photo_100;
                } else {
                    $avatar = 'no_avatar';
                }

                return json_encode(
                    [
                        'first_name' => $profile->first_name,
                        'last_name' => $profile->last_name,
                        'photo_100' => $avatar
                    ],
                    JSON_THROW_ON_ERROR
                );
            }
        }
    }

    public function reviewsConfirm(Request $request): string
    {
        if ($request) {
            return 'd1b2936c';
        }
    }
}
