<?php

namespace App\Managers;

use App\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use App\Models\Dialog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DialogManager
{
    public function getAllDialogs(array $pagination = []): LengthAwarePaginator
    {
        return Dialog::query()
            ->join('messages', 'messages.dialog_id', '=', 'dialogs.id')
            ->with([
                'users',
                'messages' => fn(HasMany $builder) => $builder->latest(),
            ])
            ->select('dialogs.*', DB::raw('MAX(messages.created_at) as latest_message_created_at'))
            ->orderByDesc('latest_message_created_at')
            ->groupBy('dialogs.id')
            ->paginate($pagination['per_page'] ?? 100);
    }

    public function findByUser(
        User $user,
        array $sort = [],
        array $pagination = []
    )
    {
        return $user
            ->dialogs()
            ->with([
                'users',
                'messages' => function (HasMany $builder) {
                    $builder->latest();
                },
                'messages.user',
            ])
            ->paginate(
                $pagination['per_page'] ?? 100,
                ['*'],
                'page',
                $pagination['page'] ?? null
            );
    }

    public function getDialogWithUser(User $auth, $user): Dialog
    {
        $dialog = Dialog::query()
            ->select("d.dialog_id as id")
            ->fromSub(function (Builder $builder) {
                return $builder
                    ->select("dialog_id")
                    ->from("dialog_user")
                    ->groupBy("dialog_id")
                    ->havingRaw("count(*) = ?", [2]);
            }, "d")
            ->join("dialog_user as du", "du.dialog_id", "=", "d.dialog_id")
            ->whereIn("du.user_id", [$auth->id, $user->id])
            ->groupBy("d.dialog_id")
            ->havingRaw("count(*) = ?", [2])
            ->with([
                "messages" => function (HasMany $builder) {
                    $builder->oldest();
                },
                "messages.user",
            ])
            ->first();
        if (!$dialog) {
            /** @var Dialog $dialog */
            $dialog = Dialog::query()->create(["user_id" => $auth->id]);

            $dialog->users()->attach([$auth->id, $user->id]);
        }
        return $dialog;
    }

    /**
     * @param User ...$users
     * @return Dialog
     */
    public function findOrCreateDialogWithUsers(User ...$users): Dialog
    {
        $dialog = $this->findDialogWithUsers(...$users);

        if (is_null($dialog)) {
            $dialog = $this->createDialogWithUsers(...$users);
        }

        return $dialog;
    }

    /**
     * @param User ...$users
     */
    public function findDialogWithUsers(User ...$users): \Illuminate\Database\Eloquent\Builder|Model
    {
        $users = collect($users);

        foreach ($users as $user) {
            if (is_null($user->deletad_at)) {
                $usersIds = $users->pluck("id");
                $count = $users->count();

                return Dialog::query()
                    ->select("d.dialog_id as id")
                    ->fromSub(function (Builder $builder) use ($count) {
                        return $builder
                            ->select("dialog_id")
                            ->from("dialog_user")
                            ->groupBy("dialog_id")
                            ->havingRaw("count(*) = ?", [$count]);
                    }, "d")
                    ->join("dialog_user as du", "du.dialog_id", "=", "d.dialog_id")
                    ->whereIn("du.user_id", $usersIds)
                    ->groupBy("d.dialog_id")
                    ->havingRaw("count(*) = ?", [$count])
                    ->first();
            }
        }
    }

    /**
     * @param User ...$users
     * @return Dialog
     */
    public function createDialogWithUsers(User ...$users): Dialog
    {
        $users = collect($users);
        $usersIds = $users->pluck("id");
        $creator = $users->first();

        /** @var Dialog $dialog */
        $dialog = Dialog::query()->create([
            "user_id" => $creator->id,
        ]);

        $dialog->users()->attach($usersIds);

        return $dialog;
    }
}
