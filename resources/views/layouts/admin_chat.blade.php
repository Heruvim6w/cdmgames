<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
<!-- Fontawesome Icon -->
<link rel="stylesheet" href="{{ asset('/assets/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/chat.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.image_lable').css({'color':''});
        $('#image').change(function() {
            if (this.files[0]) // если выбрали файл
                $('.image_lable span').text(this.files[0].name);
                $('.image_lable').css({'color':'var(--theme-color)'});
        });
    });

    function replenishmentBalance() {
        let formData = new FormData();

        formData.append('to', {{ $user->id }});
        formData.append('balance', $("#balance").val() ?? $("#balance_mobile").val());
        formData.append('_token', "{{ csrf_token() }}");

        $.ajax({
            type: $("#replenishment").attr('method'),
            url: "{{ route('admin.replenishing') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function(user) {
                encodeURIComponent($("#replenishment").val(''));
                document.getElementById("balance").value = "";
                encodeURIComponent($("#user_balance").html(user.response.balance));
                encodeURIComponent($("#user_balance_mobile").html(user.response.balance));
                $.ajax({
                    type: 'POST',
                    url: "{{ route('replenishment_bot_notification') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
    }

    function ban() {
        let formData = new FormData();

        formData.append('user', {{ $user->id }});
        formData.append('_token', "{{ csrf_token() }}");

        $.ajax({
            type: $("#ban").attr('method'),
            url: "{{ route('admin.ban') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function() {
                encodeURIComponent($("#ban").val(''));
            }
        });
    }
</script>

<style>
    .chat.chat-app .chat-content .conversation-footer {
        padding: 0;
    }

    .vs-btn i {
        margin-left: unset;
    }

    #messages {
        overflow-x: hidden;
    }
    /*------------------- 1.5. Typography -------------------*/
    #messages::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #2A2A2A;
    }

    #messages::-webkit-scrollbar {
        width: 7px;
        background-color: #F5F5F5;
    }

    #messages::-webkit-scrollbar-thumb {
        background-color: var(--theme-color);
        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);
    }

    .modal-dialog.modal-dialog-centered {
        margin-left: 0%;
        width: 80%;
        max-width: 150%;
    }


    .close {
        font-size: 1.5rem;
    }

    .col-12 .btn_thumb {
        opacity: 0.7;
        cursor: pointer;
        width: 100%;
        object-fit: cover;
        height: 100%;
    }

    .col-12 .btn_thumb:hover {
        opacity: 1;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
<div class="container-fluid d-block d-sm-none pt-1">
    <div class="row">
        <div class="col-12">
            <h4 class="text-white fw-bold text-center">Пополнить баланс {{ $user->name }}</h4>
            <form
                action="javascript:replenishmentBalance()"
                id="replenishment"
                class="form-border"
                enctype="multipart/form-data"
                method="post"
            >
                @csrf
                <input required=""
                       id="balance_mobile"
                       name="balance"
                       minlength="2"
                       maxlength="9"
                       class="col-4 d-inline"
                       type="number"
                       placeholder="Сумма пополнения">

                <ul class="list-inline d-inline align-items-center m-b-0 col-6 pt-1">
                    <li class="list-inline-item">
                        <button name="replenishing_balance"
                                type="submit"
                                class="d-inline look vs-btn text-center"
                                onclick="return confirm('Пополнить баланс?')">
                            <span class="m-r-10">Пополнить</span>
                        </button>
                    </li>
                </ul>
            </form>
            <form
                action="javascript:ban()"
                id="ban"
                class="form-border"
                enctype="multipart/form-data"
                method="post"
            >
                @csrf

                <ul class="list-inline d-inline align-items-center m-b-0 col-6 pt-1">
                    <li class="list-inline-item">
                        <button name="ban_user"
                                type="submit"
                                class="d-inline look vs-btn text-center"
                                onclick="return confirm('Заблокировать этого пользователя?')">
                            <span class="m-r-10">Бан</span>
                        </button>
                    </li>
                </ul>
            </form>
            <h4 class="text-white fw-bold text-center">Баланс: <span id="user_balance_mobile">{{ $user->balance }}</span></h4>
            <div class="test">
                <a href="{{ route('test_bot') }}">Тест бота</a>
            </div>
            @if($user->vk_link)
                <a href="https://vk.com/id{{ $user->vk_link }}"
                   class="d-block look vs-btn text-center"
                   target="_blank">
                    Страница VK
                </a>
            @endif
        </div>
    </div>
</div>
<div class="container-fluid row p-h-0 pt-3">
    <div class="chat chat-app row col-12 col-sm-9">
        <div class="chat-content">
            <div id="app" class="conversation">
                <div id="admin" class="conversation-wrapper">
                    <div class="conversation-header justify-content-between">
                        Чат с {{ Auth::user()->role !== 2 ? 'админом' : $user->name }}
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
                                :games_links="{{ $gamesLinks }}"
                                :dialog_id="{{ $dialogId }}"></chat-messages>
                    </div>

                    <script type="module" src="{{ asset('js/app.js') }}"></script>
                </div>
            </div>
        </div>
    </div>
    <div class="replenishment col-3 d-none d-sm-block">
        <h4 class="text-white fw-bold text-center">Пополнить баланс {{ $user->name }}</h4>
        <form
            action="javascript:replenishmentBalance()"
            id="replenishment"
            class="form-border"
            enctype="multipart/form-data"
            method="post"
        >
            @csrf
            <input required=""
                   id="balance"
                   name="balance"
                   minlength="2"
                   maxlength="9"
                   class="col-12"
                   type="number"
                   placeholder="Сумма пополнения">

            <ul class="list-inline d-flex align-items-center m-b-0 col-12 pt-1">
                <li class="list-inline-item">
                    <button name="replenishing_balance"
                            type="submit"
                            class="d-md-block look vs-btn text-center"
                            onclick="return confirm('Пополнить баланс?')">
                        <span class="m-r-10">Пополнить</span>
                    </button>
                </li>
            </ul>
        </form>
        <form
            action="javascript:ban()"
            id="ban"
            class="form-border"
            enctype="multipart/form-data"
            method="post"
        >
            @csrf

            <ul class="list-inline d-inline align-items-center m-b-0 col-6 pt-1">
                <li class="list-inline-item">
                    <button name="ban_user"
                            type="submit"
                            class="d-inline look vs-btn text-center"
                            onclick="return confirm('Заблокировать этого пользователя?')">
                        <span class="m-r-10">Бан</span>
                    </button>
                </li>
            </ul>
        </form>
        <h4 class="text-white fw-bold text-center">Баланс: <span id="user_balance">{{ $user->balance }}</span></h4>
        <div class="test">
            <a href="{{ route('test_bot') }}">Тест бота</a>
        </div>
        @if($user->vk_link)
            <a href="https://vk.com/id{{ $user->vk_link }}"
               class="d-md-block look vs-btn text-center"
               target="_blank">
                Страница VK
            </a>
        @endif
    </div>
</div>
