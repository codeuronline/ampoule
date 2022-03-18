<?php
/* si un POST est detecté*/
if (@$_POST) {
    $form = $_POST;
    require_once 'models/ampoule.php';
    $form['date'] = date('Ymd');
    $newAmpoule = new Ampoule([]);

    /*if (@$_POST['flag']) {
$newProject->up($form);
} else {*/
    $newAmpoule->manage($form);
    //}
} else {
    require_once 'models/ampoule.php';
}
$newAmpoule = new Ampoule;
$ampoules = $newAmpoule->select();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Historique des changements</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="JS/jquery-3.3.1.slim.min.js"></script>
</head>

<body>

    <?php
    session_start();
    if (@$_SESSION["ask"]) : ?>
    <div class='m-4'>
        <div class='alert alert-warning alert-dismissible fade show'>
            <strong>
                <center>
                    <h2>confirmer la suppression</h2>
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
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast1" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <!--img src="..." class="rounded me-2" alt="..."-->
                    <strong class="me-auto">Supprimer Etat</strong>
                    <small>essai min</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Supression cours
                </div>
                <?php
                    //unset($_SESSION['toast']);
                    //unset($_SESSION['ask']);
                    ?>
            </div>
        </div>
        <?php endif ?>
        <center>
            <h1>Nombre de Changement d'ampoule enrgistré : <?= count($ampoules) ?>
            </h1>
        </center>
        <table class="table align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Etage</th>
                    <th scope="col">Position</th>
                    <th scope="col">Prix(€)</th>
                </tr>
            </thead>
            <?php $compteur = 0; ?>
            <?php foreach ($ampoules as $key => $value) {
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
                    <td><?= $ampoules[$key]['id'] ?></td>
                    <td><?= $ampoules[$key]['date'] ?></td>
                    <td><?= $ampoules[$key]['etage'] ?></td>
                    <td><?= $ampoules[$key]['position'] ?></td>
                    <td><?= $ampoules[$key]['prix'] ?>(€)</td>
                    <td>
                        <a href="gestion.php?id=<?= $ampoules[$key]['id'] ?>">
                            <button type="submit" class="btn btn-primary mt-2">Modifier</button></a>
                        <a href="delete.php?id=<?= $ampoules[$key]['id'] ?>">
                            <button type="submit" class="btn btn-danger mt-2">Supprimer</button></a>
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <a href="gestion.php"><button type="submit" class="btn btn-info mt-2">inserer</button></a>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $('#bouton').click(function() {
        $('#toast1').toast('show');
    });
});
</script>

</html>