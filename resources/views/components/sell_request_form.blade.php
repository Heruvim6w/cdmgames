<!-- resources/views/components/sell_request_form.blade.php -->
<div class="modal fade sell_tg_form" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $labelId }}" aria-hidden="true" style="z-index: 99; color: #212529">
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
            <input type="text" class="form-control" id="{{ $telegramId }}" name="telegram" required pattern="^@[a-zA-Z0-9_]{5,32}$" placeholder="@username">
            <div class="invalid-feedback">Введите корректный Telegram username, например: @my_nickname</div>
          </div>
          <div class="mb-3">
            <label for="{{ $gameId }}" class="form-label">Игра</label>
            <select class="form-select" id="{{ $gameId }}" name="game" required>
              <option value="">Выберите игру</option>
              @foreach($games as $game)
                <option value="{{ $game->id }}" data-hint="{{ $game->sell_hint ?? '' }}">{{ $game->name }}</option>
              @endforeach
            </select>
            <div class="form-text" id="gameHint" style="display:none;"></div>
          </div>
          <div class="mb-3">
            <label for="{{ $descriptionId }}" class="form-label">Описание аккаунта</label>
            <textarea class="form-control" id="{{ $descriptionId }}" name="description" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label for="{{ $mediaId }}" class="form-label">Скрины/видео (jpg, jpeg, png, webp, pdf, mp4, до 20Мб каждый, максимум 70Мб суммарно)</label>
            <input type="file" class="form-control" id="{{ $mediaId }}" name="media[]" multiple accept=".jpg,.jpeg,.png,.webp,.pdf,.mp4">
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
$(document).ready(function() {
  $('#{{ $openBtnId }}').on('click', function() {
    $('#{{ $modalId }}').modal('show');
  });

  // Валидация Telegram
  $('#{{ $telegramId }}').on('input', function() {
    const val = $(this).val();
    const re = /^@[a-zA-Z0-9_]{5,32}$/;
    if (!re.test(val)) {
      $(this)[0].setCustomValidity('Некорректный username');
    } else {
      $(this)[0].setCustomValidity('');
    }
  });

  // Валидация файлов
  $('#{{ $mediaId }}').on('change', function() {
    let totalSize = 0;
    let valid = true;
    let errorMsg = '';
    const allowedTypes = ['image/jpeg','image/png','image/webp','application/pdf','video/mp4','image/jpg'];
    $.each(this.files, function(i, file) {
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

  // Подсказка для выбранной игры
  $('#{{ $gameId }}').on('change', function() {
    var hint = $(this).find('option:selected').data('hint');
    if (hint) {
      $('#gameHint').text(hint).show();
    } else {
      $('#gameHint').hide();
    }
  });
});
</script>
