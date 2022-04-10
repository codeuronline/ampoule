<?php
session_start();

unset($_SESSION['confirm']);
unset($_SESSION['ask']);

require_once 'models/Ampoule.php';
require_once 'models/message.php';

if (@$_GET['id']) {
    $newAmpoule = new Ampoule;
    $newMessage = new Message;
    $ampoule = $newAmpoule->select(@$_GET['id']);
    extract($ampoule[0]);
    $message = $newMessage->select($id_message);
    var_dump($message);
    error_log(print_r($message,1));
}
//pb pas de GESTION DE POST
/*if (@$_POST) {
    $form = $_POST;
    $form['date'] = date('Ymd');
    $newAmpoule = new Ampoule([]);
    $newMessage = new Message([]);
    /*if (@$_POST['flag']) {
        $newProject->up($form);
    } else {
    $newAmpoule->manage($form);
    $newMessage->manage($form);
    //}
}*/
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php if (@$_GET['id']) : ?>
    <title>Modification N°
        <?= @$_GET['id'] ?> de changement d'Ampoule</title>
    <?php else : ?>
    <title>Ajout d'un changement d'Ampoule</title>
    <?php endif ?>
</head>

<body>
    <?php
    //require 'modifier.php';
    // if (isset($_GET['id']) && empty($_GET['id'])){
    //     $id = htmlspecialchars($_GET['id']);
    // }
    //print_r($_GET['id']);

    ?>
    <div class="container">
        <?php if (@$_GET['id']) : ?>
        <h1>Modification d'un changement d'Ampoule</h1>
        <?php else : ?>
        <h1>Ajout d'un changement d'Ampoule</h1>
        <?php endif ?>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="id">Id:</label>

                <?php if (@$_GET['id']) : ?>
                <h2><?= @$_GET['id'] ?></h2>

                <?php endif ?>
            </div>
            <div class=" form-group">
                <label for="date_create">Date:</label>
                <?php if (isset($_GET['id'])):?>
                <?=date("Y-m-d",@$ampoule[0]['date_create'])?>
                <input type="hidden" name="date_create" value="<?=date("Y-m-d",@$ampoule[0]['date_create'])?>">
                <?php else :?>
                <input type="date" id="date_create" name="date_create" min="<?=date("Y-m-d")?>"
                    value="<?=date("Y-m-d")?>" required>
                <?php endif ?>
            </div>
            <div class=" form-group">
                <label for="etage">Etage</label>
                <INPUT name="etage" type="range" min="0" max="11" step="1" value="<?= @$ampoule[0]['etage'] ?>"
                    oninput="document.getElementById(' AfficheRange').textContent=value" required />
                <SPAN id="AfficheRange">
                    <?= isset($ampoule[0]['etage']) ? @$ampoule[0]['etage'] : '5' ?>
                </SPAN>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <?php
                ?>
                <select type="text" class="form-control" id="position" name="position" size="3"
                    value="<?= @$ampoule[0]['position'] ?>">
                    <option value="gauche" <?= (@$ampoule[0]['position'] == "gauche") ? "selected=selected" : "" ?>>
                        Coté
                        Gauche
                        </options>
                    <option value="droite" <?= (@$ampoule[0]['position'] == "droite") ? "selected=selected" : "" ?>>
                        Coté
                        Droite
                        </options>
                    <option value="fond" <?= (@$ampoule[0]['position'] == "fond") ? "selected=selected" : "" ?>>Au
                        Fond
                        </options>
                </select>
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="number" class="form-control" min="0" step="any" id="prix" name="prix"
                    value="<?= @$ampoule[0]['prix'] ?>" required>
            </div>
            <div class=" form-group">
                <label for="commentaire"></label>
                <textarea name="message" cols="100%" value="<?=@$message[0]['auth_id']?>"
                    rows="10"><?=(@$message[0]['message']) ? $message[0]['message']:"Commentaire sur intervention"?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="date_msg" value="<?=date('Y-m-d')?>">
                <button action=" index.php" type="submit" class="btn btn-primary mt-2">Valider</button>
                <?php if (@$_GET['id']) : ?>
                <input type=" hidden" name="id_message" value="<?=@$ampoule[0]["id_message"]?>">
                <input type="hidden" name="id" value="<?= @$_GET['id'] ?>">
                <?php endif ?>
                <a href="index.php" class=" btn btn-info mt-2">Retour</a>
            </div>
        </form>
    </div>
</body>
<SCRIPT src="JS/dist/jquery.min.js"></SCRIPT>
<SCRIPT>
$(function() {
    $(' .range').next().text(
        '5'); // Valeur par défaut $('.range').on('input', function() { var $set=$(this).val();
    $(this).next().text($set);
});
</SCRIPT>

</html>