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

/* un POST est detecté*/
require_once 'models/ampoule.php';
require_once 'models/message.php';
$newAmpoule = new Ampoule;
$searchSlug = new Message;

/**Gestion du POST */
if (@$_POST) {
    extract($_POST);
    error_log("lecture du POST");
    //$form['id_user'] = @$_SESSION['user_id'];
    $searchSlug->search($slug);
    
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
if (isset($_POST['slug'])) {
    @$slugMatches = $searchSlug->search($slug);
} else {
}
@$nbMatch = count($slugMatches);
$nbPages = ceil($nbMatch / $nbByPage);
$debut = (abs($page - 1) * $nbByPage);
$minPage = 1;
$maxPage = $nbPages;

/*Position et affichage de message */
//@$matchesDisplay = @$searchslug->select("*", $debut, $nbByPage);
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
    <!--
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">-->
    <title>Recherche</title>

    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        
    </script>-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="JS/jquery-3.3.1.slim.min.js"></script>
</head>

<body>
    <form action="search.php" method="POST">
        <center>
            <h1>Elément de Recherche
            </h1>

        </center>
        </div>
        <div class=" container align-middle text-center">
            <form action="search.php">
                <table class="table align-middle text-center">
                    <thead>
                        <tr aria-colspan="6">
                            <div class=" form-group">
                                <label for="Recherche">
                                    <?php if (isset($_POST)):?>
                                    Nombre de match : <?=$nbMatch?>
                                    <?php endif ?> </label>
                                <input type="search" name="slug">
                            </div>

                        </tr>
                        <tr>
                            <!--<th scope="col">Id</th>-->
                            <th scope="col">Date</th>
                            <th scope="col">Message</th>
                            <!--<th scope="col">Etage</th>
                                <th scope="col">Position</th>
                                <th scope="col">Prix(€)</th>-->
                            <th scope="col">Intervenant</th>
                        </tr>
                    </thead>
                    <?php $compteur = 0; ?>
                    <?php foreach (@$slugMatches as $key => $value) {
                    $compteur++;
                    if (($compteur % 2) == 0) {
                        $class = 'table table-striped';
                    } else {
                        $class = 'table table-success';
                    }
                ?>
                    <tbody class="<?= $class ?>">

                        <tr>

                            <td><?= @$slugMatches[$key]['date_msg'] ?></td>
                            <td><?=@$slugMatches[$key]['message'] ?></td>
                            <td><?=@$slugMatches[$key]['username'] ?></td>

                        </tr>
                    </tbody>
                    <?php
                }
                ?>
                </table>
                <a href="search.php"><button type="submit" class="btn btn-info mt-2">Valider</button></a>
                <a href="index.php"><button type="submit" class="btn btn-info mt-2">Retour</button></a>
        </div>
    </form>
</body>


</html>