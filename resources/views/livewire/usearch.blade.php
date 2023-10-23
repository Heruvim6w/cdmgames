<div class="search">
{{--     The whole world belongs to you.--}}
{{--    <h3 class="text-white d-inline" style="font-size: 24px;">Поиск статей: </h3>--}}
    <input type="text" wire:model="searchTerm" class="input_search" placeholder="Поиск"/>

    @if($users)
        @foreach($users as $user)
            @if($user['role'] !== 2 && !empty($user['dialogs']))
                <div class="text-start search_result">
                    <a href="{{ route('admin.chat', $user['id']) }}"
                       onclick="toggleChat()"
                       target="messages"
                       class="d-flex justify-content-between">
                        <h6 class="text-white">
                            {{ $user['name'] }}
                        </h6>
                    </a>
                </div>
            @endif
        @endforeach
    @endif
</div>
