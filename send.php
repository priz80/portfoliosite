<?php
$recaptcha = $_POST['g-recaptcha-response'];
 
if(!empty($recaptcha)) {
    $recaptcha = $_REQUEST['g-recaptcha-response'];
    $secret = 'секретный ключ';
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret ."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0");
    $curlData = curl_exec($curl);
    curl_close($curl); 
    $curlData = json_decode($curlData, true);
    if($curlData['success']) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $name = htmlspecialchars($name);
        $phone = htmlspecialchars($phone);
        $name = urldecode($name);
        $phone = urldecode($phone);
        $name = trim($name);
        $phone = trim($phone);
        if (mail("kuda@otpravit.ru", "Заявка с сайта", "ФИО:".$name.". E-mail: ".$phone.","From: info@satename.ru \r\n")){  
        echo "Сообщение успешно отправлено"; 
        } else { 
        echo "При отправке сообщения возникли ошибки";
        }
    } else {
        echo "Подтвердите, что вы не робот и попробуйте еще раз";
    }
}
else {
    echo "поставьте галочку в поле 'Я не робот' для отправки сообщения";
}
?>

ini_set('display_errors','On');
error_reporting('E_ALL');