<?php

session_start();
/**Gestion de deconnexion */
if (@$_GET['out']) {
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['user_id']);
}
if (!(isset($_SESSION['user_id']))) { //
    header("Location: connect.php");
}
if (isset($_SESSION['captcha'])) {
    unset($_SESSION['captcha']);
}

if ((@$_GET['ask'] == true) && isset($_GET['id'])) {
    $_SESSION['ask'] = true;
    $_SESSION['id'] = $_GET['id'];
} else {
    unset($_SESSION['ask']);
}

/* si un POST est detecté*/
require_once 'models/ampoule.php';
require_once 'models/message.php';
$newAmpoule = new Ampoule([]);
$newMessage = new Message([]);

/**Gestion du POST */
if (@$_POST) {
    error_log("lecture du POST");
    $form = $_POST;
    //$form['date'] = date('Ymd');
    $form['id_user'] = @$_SESSION['user_id'];
    $newAmpoule->manage($form);
}

/**Pagination*/
@$page = $_GET['page'];

if (empty($page)) {
    $page = 1;
    //$nextPageMin=$page;
    //$nextPageMax=$page+1;
}
$nextPageMin = $page - 1;
$nextPageMax = $page + 1;


$nbByPage = 4;
$ampoules = $newAmpoule->select();
$nbAmpoules = count($ampoules);
$nbPages = ceil($nbAmpoules / $nbByPage);
$debut = (abs($page - 1) * $nbByPage);
$minPage = 1;
$maxPage = $nbPages;

/*Position et affichage d'ampoule */
$ampoulesDisplay = $newAmpoule->select("*", $debut, $nbByPage);
$ampoulesDisplay= array_reverse($ampoulesDisplay);
$light = [
    'off'   => 'JS/img/lightoff.png',
    'on'    => 'JS/img/lighton.png'
];
$position = ["gauche", "droite", "fond"];
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
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">-->
    <link rel="stylesheet" href="libs/style.css">
    <title>Historique des changements</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="JS/jquery-3.3.1.slim.min.js">
    </script>
</head>

<body>
    <?php
    if (@$_SESSION['username']) : ?>
    <center>
        <h2><a href="?out=true"><button class='btn btn-info mt-2'><?= @$_SESSION['username'] ?><i
                        class="bi bi-door-open"></i></button></a>
    </center>
    <!--<?php endif;

        if (@$_SESSION['message']) : ?> <div class='m-4'>
        <div class="alert alert-success" role="alert">
            <center>
                <h2>Mot de passe modifier</h2>
            </center>
            <?php unset($_SESSION['message']); ?>
        </div>
        </div>
        <?php endif ?>-->
    <!--Gestion message box de supression-->
    <?php if (@$_SESSION["ask"]) : ?> <div class='m-4'>
        <!--
            <div class='alert alert-warning alert-dismissible fade show'>
            <strong>
                <center>
                    <h2>Confirmer la suppression</h2>
                    <a href="delete2.php?id=<?= $_SESSION['id'] ?>">
                        <button type="submit" class="btn btn-danger mt-2" id="bouton">Supprimer</button></a>
                    <a ref="index.php">
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </a>
                    <?php //unset($_SESSION['ask']);
                    ?>
                </center>
            </strong>
        </div>
        -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast1" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <!--img src="..." class="rounded me-2" alt="..."-->
                    <strong class="me-auto">Supprimer Etat</strong>
                    <small>essai min</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <?php endif ?>
        <center>
            <h1>Nombre de Changement d'ampoule(s) enregistré : <?= $nbAmpoules ?>
            </h1>
            <?php


                $nextPageMin = $page - 1;
                $nextPageMax = $page + 1;
                if (($page - 1) >= $minPage) echo "<a href='?page=$nextPageMin'><button class='btn btn-info mt-2'><i class='bi bi-chevron-left'></i></button></a>";
                for ($i = 1; $i <= $nbPages; $i++) {
                    if ($page == $i) {
                        echo "<button  class='btn btn-danger mt-2'>$i</button>";
                    } else {
                        echo "<a href='?page=$i'><button class='btn btn-info mt-2'>$i</button></a>";
                    }
                }
                if (($page + 1) <= $maxPage)  echo "<a href='?page=$nextPageMax'><button class='btn btn-info mt-2'><i class='bi bi-chevron-right'></i></button></a>";
                ?>
        </center>
    </div>
    <div class="container align-middle text-center">
        <table class="table align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Etage</th>
                    <th scope="col">Position</th>
                    <th scope="col">Prix(€)</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <?php $compteur = 0; ?>
            <?php foreach ($ampoulesDisplay as $key => $value) {
                        $compteur++;
                        if (($compteur % 2) == 0) {
                            $class = 'table table-striped';
                        } else {
                            $class = 'table table-success';
                        }
                    ?>
            <tbody class="<?= $class ?>">

                <tr>
                    <input type="hidden" name="<?= $ampoules[$key]['id'] ?>">
                    <td><?= $ampoulesDisplay[$key]['id'] ?></td>
                    <td><?= $ampoulesDisplay[$key]['date_create'] ?></td>
                    <td><?= $ampoulesDisplay[$key]['etage'] ?></td>
                    <td>
                        <?php foreach ($position as $keyN => $valueN) : ?>
                        <img
                            src="<?= ($position[$keyN] == $ampoulesDisplay[$key]['position']) ? $light['off'] : $light['on'] ?>">
                        <?php endforeach ?>
                    </td>
                    <td><?= $ampoulesDisplay[$key]['prix'] ?>(€)
                    </td>
                    <td>
                        <a href="comment.php?id=<?= $ampoulesDisplay[$key]['id_message'] ?>">
                            <button type="submit" class="btn btn-primary mt-2">
                                <?= @$newMessage->info($ampoulesDisplay[$key]['id_message']) ?>
                                <i class="bi bi-chat-left-text"></i></button></a>
                        <a href="manage.php?id=<?= $ampoulesDisplay[$key]['id'] ?>">
                            <button type="submit" class="btn btn-primary mt-2">Modifier</button></a>
                        <!--<button id=" new-toast" type=" submit" class="btn btn-danger mt-2">
                        Supprimer</button>-->
                        <!--</a>name="confirm<?= $ampoulesDisplay[$key]['id'] ?>" -->
                    </td>
                    <td>
                        <form method="POST" action="delete.php"
                            onSubmit="return confirm('Vous vraiement supprimer l\' Intervention N° <?=$ampoulesDisplay[$key]['id']?>')">
                            <input type="hidden" name=id value="<?=$ampoulesDisplay[$key]['id']?>">
                            <button type="submit" class="btn btn-danger mt-2">Supprimer</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            <?php
                    }
                    ?>
        </table>
        <a href="manage.php"><button type="submit" class="btn btn-info mt-2">Inserer</button></a>
        <a href="search.php"><button type="submit" class="btn btn-info mt-2">Recherche</button></a>
    </div>
    <!--script type="text/javascript" src="libs/cute-alert.js">
        function getID(id_clicked) {
        console.log(id_clicked);
        return this.id;

        }
        let question = getID(this.id);
        question.addEventListener("click", () => {
        cuteAlert({
        type: "question",
        title: "Confirmation",
        message: "Voulez vous supprimer l'intervention" + question,
        confirmText: "Confirmer",
        cancelTex: "Cancel",
        }).then((e) => {
        if (e == "confirm") {
        alert("Thanks");
        } else {
        alert("bndsbfds");
        }
        });
        });
        </script-->
</body>

</html>