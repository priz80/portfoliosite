<?php
// Настройки
$TELEGRAM_BOT_TOKEN = ''; // ← Заменить!
$CHAT_ID = ''; // ← Заменить!

// Получаем данные из формы
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$subject = trim($_POST['_subject']);

// Проверка на пустые поля
if (empty($phone)) {
    die('Телефон обязателен!');
}

// Формируем сообщение
$message = "<b>📬 Заявка</b>\n\n";
if (!empty($subject)) {
    $message .= "<b>Тема:</b> $subject\n";
}
if (!empty($name)) {
    $message .= "<b>Имя:</b> $name\n";
}
$message .= "<b>Телефон:</b> $phone\n";
$message .= "<b>Время:</b> " . date('d.m.Y H:i:s') . "\n";

// URL для отправки
$url = "https://api.telegram.org/bot$TELEGRAM_BOT_TOKEN/sendMessage";

// Отправка
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'chat_id' => $CHAT_ID,
    'text' => $message,
    'parse_mode' => 'HTML'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$result = curl_exec($ch);
curl_close($ch);

// Проверка результата
if ($result) {
    // Успешно
    header('Location: /?success=1');
} else {
    // Ошибка
    header('Location: /?error=1');
}
?>
