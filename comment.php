<?php
require_once 'models/ampoule.php';
require_once 'models/users.php';
require_once 'models/message.php';
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');
session_start();

$newMessage = new Message;
$newUser = new User;
$newAmpoule = new Ampoule;
extract(($_GET));
if (@$id) {
    $messages = $newMessage->select($id);
}
error_log("LIST des commenataires pour cette intervention" .print_r($messages,1));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>
        Commentaires </title>

</head>

<body>
    <section>
        <div class=" container">
            <div class="row">
                <?php
                $switch = [["css" => "comment mt-4 text-justify float-left", "avatar" => "https://i.imgur.com/yTFUilP.jpg"], ["css" => "c text-justify darker mt-4 float-right", "avatar" => "https://i.imgur.com/CFpa3nK.jpg"]];
                $var = 0;?>
                <section class="col-sm-5 col-md-6 col-12 pb-4">
                    <div class=" card bg-light">
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <div class="ms-3">
                                    <?php foreach (@$messages as $key=>$value) : ?>
                                    <div class="<?= $switch[$var]['css'] ?>">
                                        <h2>Message:
                                        </h2>
                                        <h4>
                                            <img src="<?= $switch[$var]['avatar'] ?>" alt="" class="rounded-circle"
                                                width="40" height="40">
                                            <span>
                                                <?= $_SESSION['username']?><?=date("(d/m/Y)",strtotime($messages[0]['date']))?>
                                            </span>
                                        </h4>
                                        <br>
                                        <p> <?=@$messages[0]['message']?>
                                        </p>
                                        <?php ($var == 1) ? 0 : 1 ?>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <div class="row">
                <a href="index.php">
                    <button type="submit" class="btn btn-primary mt-2">Retour</button>
                </a>
            </div>
        </div>
        </div>
    </section>
</body>

</html>