<?php 
require_once 'models/ampoule.php';
$newAmpoule = new Ampoule;
$ampoules= $newAmpoule->select();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>utilisateur</title>
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
                    <a href="utilisateur-modif.php?id=<?= $ampoules[$key]['id'] ?>"><button type="submit"
                            class="btn btn-primary mt-2">Modifier</button></a>
                    <?php
            if (@$_GET['id']) : ?>
                    <input type="hidden" name="id" value="<?= @$_GET['id'] ?>">
                    <?php
            endif ?>
                    <a href="delete.php?id=<?= $result[$key]['id'] ?>"><button type="submit"
                            class="btn btn-danger mt-2">Supprimer</button></a>
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