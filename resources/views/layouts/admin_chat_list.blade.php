@foreach($dialogs as $dialog)
    @if(!$dialog->messages->isEmpty())
        <div class="col-12 chat-card pt-1 pb-1 {{ !$dialog->read_by_admin ? 'unread' : '' }}">
            @foreach($dialog->users as $user)
                @if($user->role !== 2)
                    <script>
                        function toggleChat() {
                            $('#iframeMessages').removeClass('d-none');
                            $('#close').removeClass('d-none');
                            $('.footer-newsletter').addClass('margin_top_18');
                            $(':input').not(':button, :submit, :reset, :hidden').val('');
                            $('.search_result').addClass('d-none');
                        }
                    </script>
                    <a href="{{ route('admin.chat', $user) }}" onclick="toggleChat()" target="messages" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                            <div class="chat_avatar rounded-circle overflow-hidden me-3 col-4 col-md-2">
                                <img src="{{ $user->avatar ? (file_exists('storage/avatars/'.$user->avatar) ? asset('storage/avatars/'.$user->avatar) : asset('assets/img/logo.png')) : asset('assets/img/logo.png') }}"
                                     alt="{{ $user->name }}"
                                     class="d-flex align-self-center shadow-1-strong"
                                     style="height: inherit">
                            </div>
                            <div class="pt-1 d-sm-none d-md-block col-10">
                                <p class="fw-bold mb-0">{{ $user->name }}</p>
                                <p class="small text-muted">{{ Str::limit(strip_tags($dialog->messages->first()->text), 7, ' ...') }}</p>
                            </div>
                        </div>
                        <div class="pt-1 d-sm-none d-lg-block">
                            <p class="small text-muted mb-1">{{ Carbon\Carbon::parse($dialog->messages->first()->created_at)->setTimezone('Europe/Moscow')->format('d-m-Y, H:i') }}</p>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    @endif
@endforeach
