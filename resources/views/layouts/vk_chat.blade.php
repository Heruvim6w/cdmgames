@if(!isset($sellApplication))
    <div class="form-group notif notif-color">
        <p class="notif__group">
            <img src="{{ asset('assets/img/TelegramIcon.svg') }}" style="" class="notif__img" width="40" height="40" alt="telegram">
            <span style="margin-left: .5em" class="d-none d-md-inline-block">Продажа аккаунта в TG</span>
        </p>
        <p class="mx-2">
            <span class="look_div">
                <a href="https://t.me/cdmgames_bot" target="_blank">
                    <button class="look vs-btn">перейти</button>
                </a>
            </span>
        </p>
    </div>
@endif
