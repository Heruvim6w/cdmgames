<!-- resources/views/components/sell_request_form.blade.php -->
<div class="modal fade sell_tg_form" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $labelId }}"
     aria-hidden="true" style="z-index: 99; color: #212529">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $labelId }}">Продать аккаунт</h5>
            </div>
            <form id="{{ $formId }}" enctype="multipart/form-data" method="POST" action="{{ route('sell.request') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="{{ $telegramId }}" class="form-label">Telegram @username</label>
                        <input type="text" class="form-control" id="{{ $telegramId }}" name="telegram" required
                               pattern="^@[a-zA-Z0-9_]{5,32}$" placeholder="@username">
                        <div class="invalid-feedback" id="telegramError">Введите корректный Telegram username, например: @my_nickname</div>
                    </div>
                    <div class="mb-3">
                        <label for="{{ $gameId }}" class="form-label">Игра</label>
                        <select class="form-select" id="{{ $gameId }}" name="game" required>
                            <option value="">Выберите игру</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}"
                                        data-hint="{{ $game->sell_hint ?? '' }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text" id="gameHint" style="display:none;"></div>
                        <div class="invalid-feedback" id="gameError">Выберите игру</div>
                    </div>
                    <div class="mb-3">
                        <label for="{{ $descriptionId }}" class="form-label">Описание аккаунта (максимум 800 символов)</label>
                        <textarea class="form-control" id="{{ $descriptionId }}" name="description" rows="4"
                                  required maxlength="800"></textarea>
                        <div class="form-text" id="descriptionCounter"></div>
                        <div class="invalid-feedback" id="descriptionError">Максимум 800 символов</div>
                    </div>
                    <div class="mb-3">
                        <label for="{{ $mediaId }}" class="form-label">Скрины/видео (jpg, jpeg, png, webp, pdf, mp4, до
                                                                       20Мб каждый, максимум 70Мб суммарно)</label>
                        <input type="file" class="form-control" id="{{ $mediaId }}" name="media[]" multiple
                               accept=".jpg,.jpeg,.png,.webp,.pdf,.mp4">
                        <div class="invalid-feedback" id="{{ $mediaErrorId }}"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Отправить заявку</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#{{ $openBtnId }}').on('click', function () {
            $('#{{ $modalId }}').modal('show');
        });

        // Валидация Telegram
        $('#{{ $telegramId }}').on('input', function () {
            const val = $(this).val();
            const re = /^@[a-zA-Z0-9_]{5,32}$/;
            if (!re.test(val)) {
                $(this)[0].setCustomValidity('Некорректный username');
                $('#telegramError').show();
            } else {
                $(this)[0].setCustomValidity('');
                $('#telegramError').hide();
            }
        });

        // Валидация описания
        $('#{{ $descriptionId }}').on('input', function () {
            const maxLen = 800;
            const val = $(this).val();
            $('#descriptionCounter').text(val.length + ' / ' + maxLen);
            if (val.length > maxLen) {
                $(this)[0].setCustomValidity('Максимум 800 символов');
                $('#descriptionError').show();
            } else {
                $(this)[0].setCustomValidity('');
                $('#descriptionError').hide();
            }
        });

        // Валидация игры
        $('#{{ $gameId }}').on('change', function () {
            if (!$(this).val()) {
                $(this)[0].setCustomValidity('Выберите игру');
                $('#gameError').show();
            } else {
                $(this)[0].setCustomValidity('');
                $('#gameError').hide();
            }
            // Подсказка для выбранной игры
            var hint = $(this).find('option:selected').data('hint');
            if (hint) {
                $('#gameHint').text(hint).show();
            } else {
                $('#gameHint').hide();
            }
        });

        // Валидация файлов
        $('#{{ $mediaId }}').on('change', function () {
            let totalSize = 0;
            let valid = true;
            let errorMsg = '';
            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf', 'video/mp4', 'image/jpg'];
            $.each(this.files, function (i, file) {
                if (file.size > 20 * 1024 * 1024) {
                    valid = false;
                    errorMsg = 'Файл ' + file.name + ' превышает 20Мб.';
                    return false;
                }
                if (!allowedTypes.includes(file.type)) {
                    valid = false;
                    errorMsg = 'Недопустимый тип файла: ' + file.name;
                    return false;
                }
                totalSize += file.size;
            });
            if (totalSize > 70 * 1024 * 1024) {
                valid = false;
                errorMsg = 'Суммарный размер файлов превышает 70Мб.';
            }
            if (!valid) {
                $('#{{ $mediaId }}')[0].setCustomValidity(errorMsg);
                $('#{{ $mediaErrorId }}').text(errorMsg).show();
            } else {
                $('#{{ $mediaId }}')[0].setCustomValidity('');
                $('#{{ $mediaErrorId }}').hide();
            }
        });

        // Скрыть ошибки при открытии формы
        $('#{{ $openBtnId }}').on('click', function () {
            $('#telegramError').hide();
            $('#gameError').hide();
            $('#descriptionError').hide();
            $('#{{ $mediaErrorId }}').hide();
            $('#{{ $modalId }}').modal('show');
        });

        // Блокировка отправки формы при ошибках
        $('#{{ $formId }}').on('submit', function (e) {
            let valid = true;

            // Telegram
            const telegramInput = $('#{{ $telegramId }}')[0];
            if (!telegramInput.checkValidity()) {
                $('#telegramError').show();
                valid = false;
            }

            // Game
            const gameInput = $('#{{ $gameId }}')[0];
            if (!gameInput.checkValidity()) {
                $('#gameError').show();
                valid = false;
            }

            // Description
            const descriptionInput = $('#{{ $descriptionId }}')[0];
            if (!descriptionInput.checkValidity()) {
                $('#descriptionError').show();
                valid = false;
            }

            // Media
            const mediaInput = $('#{{ $mediaId }}')[0];
            if (!mediaInput.checkValidity()) {
                $('#{{ $mediaErrorId }}').show();
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    });
</script>
