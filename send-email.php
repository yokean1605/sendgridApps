<?php

require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom($_POST["email"], $_POST["nama"]);
$email->setSubject("[Submission] Contact Form di Petanikode");
$email->addTo("yoke.mahardika@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>".$_POST["message"]."</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
$response = $sendgrid->send($email);
// try {
//     print $response->statusCode() . "\n";
//     print_r($response->headers());
//     print $response->body() . "\n";
// } catch (Exception $e) {
//     echo 'Caught exception: '. $e->getMessage() ."\n";
// }

if($response->statusCode() == 202) {
    echo "Pesan telah terikirm. Kembali ke <a href='contact.html'>halaman sebelumnya</a>";
} else {
    echo "Pesan gagal dikirim, <a href='index.php'>Coba ulang</a>!";
}