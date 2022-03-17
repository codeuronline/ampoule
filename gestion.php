<?php
require_once 'models/Ampoule.php';
if (@$_GET['id']) {
    $newAmpoule = new Ampoule;
    $ampoule = $newAmpoule->select(@$_GET['id']);
}
if (@$_POST) {
    $form = $_POST;
    
    $form['date'] = date('Ymd');
    $newAmpoule = new Ampoule([]);

    /*if (@$_POST['flag']) {
        $newProject->up($form);
    } else {*/
        $newAmpoule->add($form);
    //}
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php if(@$_GET['id']) :?>
    <title>Modification N°
        <?=@$_GET['id']?> de changement d'Ampoule</title>
    <?php else :?>
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

        <?php if(@$_GET['id']) :?>
        <h1>Modification d'un changement d'Ampoule</h1>
        <?php else :?>
        <h1>Ajout d'un changement d'Ampoule</h1>
        <?php endif ?>
        <form action="gestion.php" method="post">
            <div class="form-group">
                <label for="id">Id:</label>
                <?php if (@$_GET['id']) :?>
                <h2><?=@$_GET['id']?></h2>

                <?php endif ?>
            </div>
            <div class=" form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" min="<?=date("Y-m-d")?>" value="<?=date("Ymd")?>">
            </div>
            <div class="form-group">
                <label for="etage">Etage</label>
                <INPUT name="etage" type="range" min="0" max="11" step="1" value="<?=@$ampoule[0]['etage']?>"
                    oninput="document.getElementById('AfficheRange').textContent=value" required />
                <SPAN id="AfficheRange">5
                </SPAN>
                <!--<input type="range" class="form-control" id="etage" name="etage" step=1
                    value="<?=@$ampoule[$key]['etage'] ?>" list="tickmarks">
                <datalist id="tickmarks">
                    <option value="0" label="rdc" <?=(@$ampoule[0]['etage']=="0")? "checked": "" ?>>Rdc</option>
                    <option value="2" <?=(@$ampoule[0]['etage']=="1")? "checked": "" ?>></option>
                    <option value="2" <?=(@$ampoule[0]['etage']=="2")? "checked": "" ?>></option>
                    <option value="3" <?=(@$ampoule[0]['etage']=="3")? "checked": "" ?>></option>
                    <option value="4" <?=(@$ampoule[0]['etage']=="4")? "checked": "" ?>></option>
                    <option value="5" <?=(@$ampoule[0]['etage']=="5")? "checked": "" ?>label="5ème">5ième
                    </option>
                    <option value="6" <?=(@$ampoule[0]['etage']=="6")? "checked": "" ?>></option>
                    <option value="7" <?=(@$ampoule[0]['etage']=="7")? "checked": "" ?>></option>
                    <option value="8" <?=(@$ampoule[0]['etage']=="8")? "checked": "" ?>></option>
                    <option value="9" <?=(@$ampoule[0]['etage']=="9")? "checked": "" ?>></option>
                    <option value="10" <?=(@$ampoule[0]['etage']=="10")? "checked": "" ?>></option>
                    <option value="11" <?=(@$ampoule[0]['etage']=="11")? "checked": "" ?>>1ième</option>
                </datalist>!-->
            </div>
            <div class="form-group">
                <label for="position">Poistion</label>
                <?php
                ?>
                <select type="text" class="form-control" id="position" name="password" size="3"
                    value="<?=@$ampoule[0]['position'] ?>">
                    <option value="gauche" <?=(@$ampoule[0]['position']=="gauche")? "checked": "" ?>>Gauche</options>
                    <option value="droite" <?=(@$ampoule[0]['position']=="droite")? "checked": "" ?>>Droite </options>
                    <option value="fond" <?=(@$ampoule[0]['position']=="fond")? "checked": "" ?>>Fond </options>
                </select>
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="number" class="form-control" min="0" step="any" id="prix" name="prix"
                    value="<?=@$ampoule[0]['prix'] ?>">
                <button type="submit" class="btn btn-primary mt-2">Valider</button>
                <?php
            if (@$_GET['id']) : ?>
                <input type="hidden" name="id" value="<?= @$_GET['id'] ?>">
                <?php
            endif ?>
                <a href="index.php"> <button class="btn btn-info mt-2">Retour</button></a>
        </form>

    </div>
</body>
<SCRIPT src="JS/dist/jquery.min.js"></SCRIPT>
<SCRIPT>
$(function() {
    $('.range').next().text('15'); // Valeur par défaut
    $('.range').on('input', function() {
        var $set = $(this).val();
        $(this).next().text($set);
    });
});
</SCRIPT>

</html>