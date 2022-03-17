<?php
session_start(); 
?>
<?php 
var_dump(@$_SESSION);
var_dump(@$_POST);
var_dump(@$_GET);
if (@$_SESSION["ask"]):?>
<div class='m-4'>
    <div class='alert alert-warning alert-dismissible fade show'>
        <strong>
            <center>
                <h2>confirmer la suppression</h2>
                <a href="delete.php?id=<?=@$_SESSION['id']?>&confirm=true">
                    <button type='button' class='btn-validate' data-bs-dismiss='alert'>

                    </button>
                </a>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </center>
        </strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <?php unset($_SESSION['ask']);?>
    </div>
    <?php endif ?>
    <?php if (@$_SESSION['confirm']):?>
    <div class=" toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded mr-2" alt="...">
            <strong class="mr-auto">Suppression</strong>
            <small class="text-muted">confirmée</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Vu?
        </div>
    </div>
    <?php 
    unset($_SESSION['confirm']);
    unset($_SESSION['ask']);
    ?>
    <?php endif ?>

    <?php
     require_once 'models/ampoule.php' ; 
     $newAmpoule=new Ampoule; 
     $ampoules=$newAmpoule->select();
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
    </head>

    <body>
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
            <?php $compteur = 0;?>
            <?php foreach ($ampoules as $key => $value) { 
            $compteur++;
            if (($compteur % 2) == 0) {
                $class = 'table table-striped';
            }else{
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

    </html>