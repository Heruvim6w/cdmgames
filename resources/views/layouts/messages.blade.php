@foreach(($dialogs->messages ?? $dialogs) as $message)
    <div class="msg msg-sent {{ $message['user_id'] == Auth::user()->id ? '' : 'left interlocutor' }}">
        <div class="bubble">
            <div class="bubble-wrapper">
                <div class="text-theme2 chat_underline">
                    <span>{{ $message->user->name }}</span>
                </div>
                <div class="chat_underline">
                    @if(isset($message['file']))
                        @if(!file_exists(public_path().'/storage/'.$message->file))
                            <p>
                                <span class="alert-dark">Файл отсутствует или повреждён</span>
                            </p>
                        @else
                            <div>
                                <a href="{{ asset('storage/' . $message->file) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $message->file) }}" alt="{{ $message->file }}" width="300">
                                </a>
                            </div>
                        @endif
                    @endif
                    <span style="word-break:break-all;">{{ $message['text'] }}</span>
                </div>
                <p class="text-end">
                    <small> {{ $message['created_at'] }} </small>
                </p>
            </div>
        </div>
    </div>
@endforeach
