<?php
    $useremail = 'your_mail@mail.ru';
    $userlogin = $useremail;
    $method_outmoney = 'METHOD';
    $summa_req2 = 'REQUISITE';
    $hash_out = '123123123';
?>

Необходимо подтвердить создание платежного метода
<h3>Для подтверждения нового платежного метода для аккаунта '.{{ $userlogin }}.' Платежной системы '. {{ $method_outmoney }}.' по реквизиту '.{{ $summa_req2 }}.' </h3>
<br><br>Вам необходимо перейти по
<a target="_blank" href="https://cdmdoto.com/confirm-req?hash='.{{ $hash_out }}.'">
    ссылке
</a>
<br>
Если ссылка не кликабельная - скопируйте и вставьте в браузере - https://cdmdoto.com/confirm-req?hash='.{{ $hash_out }}.'
<br>
<br>
Спасибо за использование нашего сервиса!'
