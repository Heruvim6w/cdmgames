<link rel="stylesheet" href="{{ asset('/assets/css/chat.css') }}">
<script>
    import ChatMessages from "../js/components/ChatMessages";
    export default {
        components: {ChatMessages}
    }
</script>
<style>
    .chat .conversation .conversation-wrapper .conversation-body {
        padding: 15px 0;
    }

    .chat .conversation .conversation-wrapper .conversation-body .msg:last-child {
        margin-bottom: 130px;
    }
</style>

<div class="container p-h-0 chat_block">
    <div class="row">
        <div class="col-12 col-sm-9 chat chat-app row">
            <div class="chat-content">
                <div id="app" class="conversation">
                    <div class="conversation-wrapper">
                        <div class="conversation-header justify-content-between">
                            Чат с {{ Auth::user()->role !== 2 ? 'CDM Team' : $user->name }}
                            <div class="media align-items-center">
                                <a href="javascript:void(0);"
                                   class="chat-close m-r-20 d-md-none d-block text-dark font-size-18 m-t-5">
                                    <i class="anticon anticon-left-circle"></i>
                                </a>
                            </div>
                        </div>

                        <div class="conversation-body" id="messages">
                            <chat-messages
                                    :to="{{ $user->id }}"
                                    :from="{{ auth()->user() }}"
                                    :user="{{ $user }}"
                                    :dialog_id="{{ $dialogId }}"></chat-messages>
                        </div>

                        <script type="module" src="{{ asset('js/app.js') }}"></script>
                        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-none d-sm-block col-sm-3 games_list">
            <h4 class="text-white">Прайс листы</h4>
            <ul>
                @foreach($games as $game)
                    <li>
                        <a href="{{ route('games.show', [$game->slug]) }}">{{ $game->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

