@include('layouts.header')
<!--==============================
    Team Area
    ==============================-->
<style>
    div.team-card_label {
        font-family: DejaVu Sans;
    }
</style>

@if(session('success') || session('confirm_errors'))
<div class="alert {{ session('confirm_errors') ? 'alert-danger' : 'alert-success'}} m-auto">
        <span style="font-size: 2em">{{ session('success') ?? session('confirm_errors') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        $('.alert .close').on('click', function(){
            $(this).closest('.alert').fadeOut('slow');
        });

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
@endif

<section class="vs-team-wrapper bg-title space-top space-extra-bottom">
    <div class="container">
        <div class="title-area">
            <span class="sub-title">#CDMgames</span>
            <h2 class="sec-title text-white text-uppercase">изменить личные данные</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
            </div>
        </div>
        <section class="vs-team-wrapper bg-title space">
            <div class="d-inline-block col-md-6">
                <form
                    action="{{ route('profile.update.data', $user, []) }}"
                    id="profile_update"
                    class="form-border"
                    enctype="multipart/form-data"
                    method="post"
                >
                    @csrf
                    <div class="container">
                        <label for="email" class="col-12 col-sm-4">E-mail: </label>
                        <input id="email"
                                   name="email"
                                   minlength="2"
                                   maxlength="24"
                                   class="col-12 col-sm-4"
                                   type="email"
                                   placeholder="{{ $user->email }}"><br>
                        <label for="vk_link" class="col-12 col-sm-4">Ссылка в VK: </label>
                        <input id="vk_link"
                               name="vk_link"
                               minlength="2"
                               maxlength="50"
                               class="col-12 col-sm-4"
                               type="text"
                               placeholder="{{ $user->vk_link ?? 'ссылка на VK' }}"> <br>
                        Аватар:
                        <label for="avatar" class="col-12 col-sm-4 avatar_label {{  $user->avatar ? '' : 'bg-white' }}">
                            <div class="palyer-card_img" style="{{  !$user->avatar ? 'display: none' : '' }}">
                                <img src="{{ $user->avatar ? asset('storage/avatars/'.$user->avatar) : asset('assets/img/logo.png') }}"
                                     alt="{{ $user->name }}" class="w-100">
                                <div>
                                    <span class="look_div">
                                        <button class="look vs-btn profile_btn">Изменить аватар (jpg, jpeg, png)</button>
                                    </span>
                                </div>
                            </div>
                            <span class="{{  $user->avatar ? 'd-none' : 'd-inline-block' }}"><i class="far fa-solid fa-paperclip"></i>jpg, jpeg, png</span>
                            <input type="file" class="" name="avatar" id="avatar">
                        </label>

                        <ul class="list-inline d-flex align-items-center m-b-0 col-12 col-sm-1 col-lg-2 pl-md-4">
                            <li class="list-inline-item m-auto">
                                <button name="profile_update" type="submit" class="d-md-block look vs-btn">
                                    <span class="m-r-10 d-block">Сохранить</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="d-inline-block col-md-5">
                <form method="POST" action="{{ route('profile.update.temp_password') }}">
                    @csrf

                    <div class="container">
                        <label for="new_password" class="col-12 col-sm-4">Новый пароль:</label>
                        <input type="password" id="new_password" name="new_password" class="col-12 col-sm-4" required>
                        @error('new_password')
                        <span>{{ $message }}</span>
                        @enderror

                        <label for="new_password_confirmation" class="col-12 col-sm-4">Подтвердите пароль:</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="col-12 col-sm-4 mb-1" required>

                        <ul class="list-inline d-flex align-items-center m-b-0 col-12 col-sm-1 col-lg-2 pl-md-4">
                            <li class="list-inline-item m-auto">
                                <button name="profile_update" type="submit" class="d-md-block look vs-btn">
                                    <span class="m-r-10 d-block">Изменить</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </section>
    </div>
</section>

@include('layouts.footer')

</body>

</html>
