<?php

$email = $_POST['email'];

$message = $_POST['message'];

$subject = $_POST['sujet'];

header('Content-Type: application/json');


if ($email === ''){

    print json_encode(array('message' => 'Veuillez entrer votre adresse mail !', 'code' => 0));

    exit();

} else {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){

        print json_encode(array('message' => 'Le format de votre adresse mail est incorrect !', 'code' => 0));

        exit();

    }

}

if ($subject === ''){

    print json_encode(array('message' => 'Votre sujet ne peut pas être vide !', 'code' => 0));

    exit();

}

if ($message === ''){

    print json_encode(array('message' => 'Votre message ne peut pas être vide !', 'code' => 0));

    exit();

}

$content="Adresse mail de l'expéditeur : $email \n Sujet : $subject \nMessage : $message";

$recipient = "parlonsharcelementcontact@gmail.com";

$retromail="parlonsharcelementcontact@gmail.com";

$mailheader = "From: $retromail \r\n";

mail($recipient, $subject, $content, $mailheader) or die("Error!");

print json_encode(array('message' => 'Votre mail a bien été envoyé !', 'code' => 1));

exit();

?>