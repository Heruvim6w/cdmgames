<div class="search">
    {{-- The whole world belongs to you. --}}
    <h3 class="text-white d-inline" style="font-size: 24px;">Поиск статей: </h3>
    <input type="text" wire:model="searchTerm" />

    @if($posts)
        @foreach($posts as $post)
            <div class="text-start search_result">
                <a href="{{ route('posts.show', [$post->slug]) }}">
                    <h6 class="text-white">
                        {{ $post->title }}
                    </h6>
                    <p>
                        <?php
                        $description = strip_tags($post->description);
                        ?>
                        {{ Str::limit($description, 69, ' ...') }}
                    </p>
                </a>
            </div>
        @endforeach
    @endif
</div>
