<script>
    $('#avatar_update').click(function() {
        $(this).attr('disabled','disabled');
    });
</script>

<div class="modal fade text-dark" id="avatar_update" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Сменить аватар</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <span class="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>

            <form enctype="multipart/form-data"
                  name="avatar_update"
                  action="{{ route('profile.update.data', $user, []) }}"
                  role="form"
                  method="post">
                @csrf
                <div class="modal-body">
                    <div class="field-set" style="background-size: cover;">
                        <label for="avatar" class="col-12 avatar_label {{  $user->avatar ? '' : 'bg-white' }}">
{{--                            <div class="palyer-card_img" style="{{  !$user->avatar ? 'display: none' : '' }}">--}}
{{--                                <img src="{{ $user->avatar ? asset('storage/avatars/'.$user->avatar) : asset('assets/img/logo.png') }}"--}}
{{--                                     alt="{{ $user->name }}" class="w-100">--}}
{{--                                <div>--}}
{{--                                    <span class="look_div">--}}
{{--                                        <div class="look vs-btn profile_btn">Изменить аватар (jpg, jpeg, png)</div>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <span class="d-inline-block">Выберите изображение (jpg, jpeg, png)</span>
                            <input type="file" class="" name="avatar" id="avatar">
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button name="avatar_update" id="avatar_update" type="submit" class="btn vs-btn">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>







{{--<section class="vs-team-wrapper bg-title space-top space-extra-bottom" id="avatar_update">--}}
{{--    <div class="container">--}}
{{--        <section class="vs-team-wrapper bg-title space">--}}
{{--            <div class="container">--}}
{{--                <form--}}
{{--                    action="{{ route('profile.update.data', $user, []) }}"--}}
{{--                    id="profile_update"--}}
{{--                    class="form-border"--}}
{{--                    enctype="multipart/form-data"--}}
{{--                    method="post"--}}
{{--                >--}}
{{--                    @csrf--}}
{{--                    <div class="container">--}}
{{--                        <label for="avatar" class="col-12 col-sm-4 avatar_label {{  $user->avatar ? '' : 'bg-white' }}">--}}
{{--                            <div class="palyer-card_img" style="{{  !$user->avatar ? 'display: none' : '' }}">--}}
{{--                                <img src="{{ $user->avatar ? asset('storage/avatars/'.$user->avatar) : asset('assets/img/logo.png') }}"--}}
{{--                                     alt="{{ $user->name }}" class="w-100">--}}
{{--                                <div>--}}
{{--                                    <span class="look_div">--}}
{{--                                        <button class="look vs-btn profile_btn">Изменить аватар (jpg, jpeg, png)</button>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <span class="{{  $user->avatar ? 'd-none' : 'd-inline-block' }}"><i class="far fa-solid fa-paperclip"></i>jpg, jpeg, png</span>--}}
{{--                            <input type="file" class="" name="avatar" id="avatar">--}}
{{--                        </label>--}}

{{--                        <ul class="list-inline d-flex align-items-center m-b-0 col-12 col-sm-1 col-lg-2 pl-md-4">--}}
{{--                            <li class="list-inline-item m-auto">--}}
{{--                                <button name="profile_update" type="submit" class="d-md-block look vs-btn">--}}
{{--                                    <span class="m-r-10 d-block">Сохранить</span>--}}
{{--                                </button>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--</section>--}}
