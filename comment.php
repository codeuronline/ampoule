<?php
require_once 'models/ampoule.php';
require_once 'models/users.php';
require_once 'models/message.php';
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');
echo utf8_encode(strftime('%A %d %B %Y, %H:%M'));
session_start();

$newMessage = new Message;
$newUser = new User;
$newAmpoule = new Ampoule;
extract(($_GET));
if (@$id) {
    $messages = $newMessage->select($id);
}
var_dump($messages);
error_log("LIST des commenataires pour cette intervention" .print_r($messages,1));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>
        Commentaires </title>
    <style>
    .navbar-nav {
        width: 100%
    }

    @media(min-width:568px) {
        .end {
            margin-left: auto
        }
    }

    @media(max-width:768px) {
        #post {
            width: 100%
        }
    }

    #clicked {
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        width: 100%;
        background-color: #ecb21f;
        border-color: #a88734 #9c7e31 #846a29;
        color: black;
        border-width: 1px;
        border-style: solid;
        border-radius: 13px
    }

    #profile {
        background-color: unset
    }

    #post {
        margin: 10px;
        padding: 6px;
        padding-top: 2px;
        padding-bottom: 2px;
        text-align: center;
        background-color: #ecb21f;
        border-color: #a88734 #9c7e31 #846a29;
        color: black;
        border-width: 1px;
        border-style: solid;
        border-radius: 13px;
        width: 50%
    }

    body {
        background-color: black
    }

    #nav-items li a,
    #profile {
        text-decoration: none;
        color: rgb(224, 219, 219);
        background-color: black
    }

    .comments {
        margin-top: 5%;
        margin-left: 20px
    }

    .darker {
        border: 1px solid #ecb21f;
        background-color: black;
        float: right;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px
    }

    .comment {
        border: 1px solid rgba(16, 46, 46, 1);
        background-color: rgba(16, 46, 46, 0.973);
        float: left;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px
    }

    .comment h4,
    .comment span,
    .darker h4,
    .darker span {
        display: inline
    }

    .comment p,
    .comment span,
    .darker p,
    .darker span {
        color: rgb(184, 183, 183)
    }

    h1,
    h4 {
        color: white;
        font-weight: bold
    }

    label {
        color: rgb(212, 208, 208)
    }

    #align-form {
        margin-top: 20px
    }

    .form-group p a {
        color: white
    }

    #checkbx {
        background-color: black
    }

    #darker img {
        margin-right: 15px;
        position: static
    }

    .form-group input,
    .form-group textarea {
        background-color: black;
        border: 1px solid rgba(16, 46, 46, 1);
        border-radius: 12px
    }

    form {
        border: 1px solid rgba(16, 46, 46, 1);
        background-color: rgba(16, 46, 46, 0.973);
        border-radius: 5px;
        padding: 20px
    }
    </style>
</head>

<body>
    <section>
        <div class=" container">
            <div class="row">
                <?php
                $switch = [["css" => "comment mt-4 text-justify float-left", "avatar" => "https://i.imgur.com/yTFUilP.jpg"], ["css" => "c text-justify darker mt-4 float-right", "avatar" => "https://i.imgur.com/CFpa3nK.jpg"]];
                $var = 0;?>
                <div class="col-sm-5 col-md-6 col-12 pb-4">
                    <h1> Commentaires </h1>
                    <?php foreach (@$messages as $key=>$value) : ?>
                    <div class="<?= $switch[$var]['css'] ?>">
                        <img src="<?= $switch[$var]['avatar'] ?>" alt="" class="rounded-circle" width="40" height="40">
                        <h4> Intervenant : <?= $_SESSION['user_id']?></h4>
                        <span><?=date("d  F  Y",strtotime($value))?></span>
                        <br>
                        <p> <?=@$message['message']?>
                        </p>
                        <?php ($var == 1) ? 0 : 1 ?>
                    </div>
                    <br>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>