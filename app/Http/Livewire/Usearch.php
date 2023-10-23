<?php

namespace App\Http\Livewire;

use App\Http\Resources\Dialogs\DialogCollection;
use App\Managers\DialogManager;
use App\Models\Dialog;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Usearch extends Component
{
    const PUBLISHED = 1;
    const NOT_PUBLISHED = 0;

    public $searchTerm;
    public $posts;
    public $users;

    public function render()
    {
        if (!is_null($this->searchTerm) && $this->searchTerm != '') {
            $searchTerm = $this->searchTerm . '%';
            $this->users = User::with('dialogs')->where('name', 'like', $searchTerm)->get()->toArray();
        } else {
            $this->users = [];
        }
        return view('livewire.usearch');
    }
}
