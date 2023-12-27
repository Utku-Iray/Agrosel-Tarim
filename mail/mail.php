<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//Form'dan Bütün Değerler Post Methodu ile Çekiliyor
$name = trim(strip_tags($_POST['name']));
$email = trim(strip_tags($_POST['email']));
$phone = trim(strip_tags($_POST['phone']));
$subject = trim(strip_tags($_POST['subject']));
$message = trim(strip_tags($_POST['message']));

//Form'dan Bütün Değerler Post Methodu ile Çekiliyor Tamamlandı

if($name and $phone){ //Form'dan bütün değerler geliyorsa mail gönderme işlemini başlatıyoruz.

    $Mesaj = "
    İsim soyisim: $name<br>
    E_posta Adresi: $email <br>
    Telefon : $phone <br>
    Konu: $subject <br>
    Mesaj: $message <br>
    Bu mail: https://agroseltarim.com/ adresinden gelmiştir.
    ";

    //Php Smtp Mailler Sınıfını Sayfaya Dahil Ediyoruz
    include ('class.phpmailer.php');
    include ('class.smtp.php');
    //Php Smtp Mailler Sınıfını Sayfaya Dahil Ediyoruz Tamamlandı

    //Mail Bağlantı Ayarları 
    //Mail Hangi Hesaptan Gönderilecek ise onun bilgilerini yazın.
    $MailSmtpHost = "alondanbilisim.com";
    $MailUserName = "tummail@alondanbilisim.com";
    $MailPassword = "Mixled.123";
    //Mail Bağlantı Ayarları Tamamlandı

    //Doldurulan Form Mail Olarak Kime Gidecek?
    $MailKimeGidecek = "agrosel@agroseltarim.com";
    $MesajKonusu ="Agrosel Tarım İletişim Formu";
    //Doldurulan Form Mail Olarak Kime Gidecek Tamamlandı
    
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $MailSmtpHost; //Smtp Host
    $mail->SMTPSecure = 'ssl';  //yada tls
    $mail->Port = 465;  //SSL kullanacaksanız portu 465 olarak değiştiriniz - TLS Portu 587
    $mail->Username = $MailUserName; //Smtp Kullanıcı Adı
    $mail->Password = $MailPassword; //Smtp Parola
    $mail->SetFrom($mail->Username, ' Agrosel Tarım');
    $mail->AddAddress("$MailKimeGidecek", 'Agrosel Tarım'); //Mailin Gideceği Adres ve Alıcı Adı
    $mail->CharSet = 'UTF-8'; //Mail Karakter Seti
    $mail->Subject = $MesajKonusu; //Mail Konu Başlığı
    $mail->MsgHTML("$Mesaj"); //Mail Mesaj İçeriği
    
    if($mail->Send()) {
        echo '<script>alert("Your messages have been received from you!");</script>';
    } else {
        echo 'Beim Abrufen der Nachricht ist ein Fehler aufgetreten: ' . $mail->ErrorInfo;
    }


} //Mail gönderme işlemi tamamlandı end.if

?>

<script>
  setTimeout(function(){
  window.location = "https://agroseltarim.com/";
}, 1000);
</script>