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
if (@$_GET["ask"] == true) {
    $_SESSION['ask'] = true;
} else {
    unset($_SESSION['ask']);
}

/* si un POST est detecté*/
require_once 'models/ampoule.php';
require_once 'models/message.php';
$newAmpoule = new Ampoule([]);
$searchSlug = new Message([]);

/**Gestion du POST */
if (@$_POST) {
    error_log("lecture du POST");
    $form = $_POST;
    //$form['id_user'] = @$_SESSION['user_id'];
    
    $searchSlug->manage($form);
}

/**Pagination*/
@$page = $_GET['page'];

if (empty($page)) {
    $page = 1;
    //$nextPageMin=$page;
    //$nextPageMax=$page+1;
}
$nextPageMin =$page-1;
$nextPageMax = $page+1;


$nbByPage = 4;
if (isset($_POST['slug'])){
    $slugMatches = $searchSlug->search($slug);
} else{
        
    }
$nbMatch = count($slugMatches);
$nbPages = ceil($nbMatch / $nbByPage);
$debut = (abs($page - 1) * $nbByPage );
$minPage = 1;
$maxPage = $nbPages;

/*Position et affichage d'ampoule */
$matchesDisplay = $searchslug->select("*", $debut, $nbByPage);
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Recherche</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="JS/jquery-3.3.1.slim.min.js"></script>
</head>

<body>
    <center>
        <h1>Elément de Recherche
        </h1>
        <?php
              $nextPageMin =$page-1;
                $nextPageMax = $page+1;
                if (($page-1)>=$minPage) echo "<a href='?page=$nextPageMin'><button class='btn btn-info mt-2'><i class='bi bi-chevron-left'></i></button></a>";
                  for ($i = 1; $i <= $nbPages; $i++) {
                    if ($page == $i) {
                        echo "<button  class='btn btn-danger mt-2'>$i</button>";
                    } else {
                        echo "<a href='?page=$i'><button class='btn btn-info mt-2'>$i</button></a>";
                    }
                 
                }
                if (($page+1)<= $maxPage)  echo "<a href='?page=$nextPageMax'><button class='btn btn-info mt-2'><i class='bi bi-chevron-right'></i></button></a>";
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
                    <th scope="col">Actions</th>
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
                    <td><?= $ampoulesDisplay[$key]['date'] ?></td>
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
                            <button type="submit" class="btn btn-primary mt-2">Modifier</button></a> <a
                            href="index.php?id=<?= $ampoulesDisplay[$key]['id'] ?>&ask=true">
                            <button id="new-toast" type=" submit" class="btn btn-danger mt-2">Supprimer</button>
                        </a>
                    </td>
                </tr>
            </tbody>
            <?php
                }
                ?>
        </table>
        <a href="manage.php"><button type="submit" class="btn btn-info mt-2">inserer</button></a>
    </div>
</body>
<script type="text/javascript">
// Displaying toast on manual action `Try`
document.getElementById("new-toast").addEventListener("click", function() {
    Toastify({
        text: "Cliquer sur la box pour confirmer la suppression",
        duration: 3000,
        destination: "http://localhost/ampoule/delete2.php?id=<?= $_SESSION['id'] ?>",
        newWindow: false,
        close: true,
        gravity: "bottom", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function() {} // Callback after click
    }).showToast();
});

/*
Toastify({
text: "Cliquer sur la box pour confirmer la suppression",
    duration: 3000,
    destination: "http://localhost/ampoule/delete2.php?id=<?= $_SESSION['id'] ?>",
    newWindow: false,
    close: true,
    gravity: "bottom", // `top` or `bottom`
    position: "center", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
    },
    onClick: function() {} // Callback after click
}).showToast();*/

$(document).ready(function() {
    $('#bouton').click(function() {
        $('#toast1').toast('show');
    });
});
</script>

</html>