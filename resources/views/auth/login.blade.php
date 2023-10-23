@include('layouts.header')
<!--==============================
    Team Area
    ==============================-->
<style>
    .breadcumb-wrapper {
        display: none;
    }
</style>

<section class="vs-team-wrapper bg-title space-extra-bottom">
    <div class="container">
        <section class="vs-team-wrapper bg-title space-bottom">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Вход') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="login" class="col-md-4 col-form-label text-md-end">{{ __('Email или логин') }}</label>

                                        <div class="col-md-6">
                                            <input id="login" type="text" class="form-control {{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                            @if ($errors->has('login'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('login') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Запомнить меня') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn vs-btn">
                                                {{ __('Войти') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link text-theme2" href="{{ route('password.request') }}">
                                                    {{ __('Забыл пароль?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@include('layouts.footer')
</body>

</html>

