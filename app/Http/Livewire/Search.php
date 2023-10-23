<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    const PUBLISHED = 1;
    const NOT_PUBLISHED = 0;

    public $searchTerm;
    public $posts;

    public function render()
    {
        if (!is_null($this->searchTerm) && $this->searchTerm != '') {
            $searchTerm = '%' . $this->searchTerm . '%';
            $this->posts = Post::where('is_active', self::PUBLISHED)
                ->where('title', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->get();
        } else {
            $this->posts = [];
        }
        return view('livewire.search');
    }
}
