<?php
require_once 'models/project.php';
if (@$_GET['id']) {
    $newProject = new Project;
    $projets = $newProject->select(@$_GET['id']);
}
if (@$_POST) {
    $form = $_POST;
    if (@$_FILES['picture']['tmp_name'] && is_uploaded_file($_FILES['picture']['tmp_name'])) {
        if (@$_POST['id']) {
            $projetsbd = $newProject->select(@$_POST['id'],'picture');
            $picture = $projetsbd[0]['picture'];
            $extension = substr($picture, strrpos($picture, '.'));           
    
        } else {
            $picture = $_FILES['picture']['name'];
            $extension = substr($picture, strrpos($picture, '.'));           
        }
        $form['picture']= date('ymd').$picture;
        $picture_tmp = $_FILES['picture']['tmp_name'];
        move_uploaded_file($picture_tmp, 'assets/upload/' . $form['picture']);
    }
    $form['created_at'] = date('Ymd');
    $newProject = new Project([]);

    /*if (@$_POST['flag']) {
        $newProject->up($form);
    } else {*/
        $newProject->add($form);
    //}
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/styleprojet.css">
    <title>ADMIN</title>
</head>
<header>
    <nav>
        <button><a href="index.php">Présentation</a></button>
        <button><a href="projets.php"> Mes Projets</a></button>
        <button><a href="competences.php">Mes Compétences</a></button>
        <button><a href="contacter.php">Me Contacter</a></button>
        <button><a class='active' href="admin.php">Admin</a></button>
    </nav>
</header>

<body>
    <div class="container">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="containerForm">
                <fieldset>
                    <legend color="black">Projet dans la BD</legend>
                    <div class="gauche">
                        <label for="title">Nom:</label>
                        <input type="text" placeholder="Nom du projet" name="title"
                            value="<?= @$projets[0]['title'] ?>">
                        <label for="lienlocal">Lien du site:</label>
                        <input type="url" placeholder="lien vers le site" name="url_web"
                            value="<?= @$projets[0]['url_web'] ?>">
                        <label for=" liengithub">Lien Github:</label>
                        <input type="url" placeholder="lien vers github" name="url_github"
                            value="<?= @$projets[0]['url_github'] ?>">
                        <div class="card">
                            <label for="picture">
                                <input class="inputimage" type="file" onchange="handleFiles(files)" id="picture"
                                    name="picture">
                                <span id="preview"><img class="vignette"
                                        src="<?= (@$projets[0]['picture']) ? "assets/upload/" . @$projets[0]['picture'] : "assets/upload/vide.jpg" ?>"
                                        alt="vide" srcset="">
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="droite">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="80" rows="10"
                            value="<?=@$projets[0]['description']?>"><?=@$projets[0]['description'] ?>
                        </textarea>
                        <?php if (@$_GET['id']) : ?>
                        <!--<input type="hidden" name="flag" value="update">-->
                        <input type="hidden" name="id" value="<?= @$_GET['id'] ?>">
                        <?php endif ?>
                    </div>
                </fieldset>
                <button type="submit">Valider</button>
                <button type="reset">Annuler</button>
            </div>

        </form>
    </div>
    <script type="text/javascript">
    function handleFiles(files) {
        var imageType = /^image\//;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (!imageType.test(file.type)) {
                alert("veuillez sélectionner une image");
            } else {
                if (i == 0) {
                    preview.innerHTML = '';
                }
                var img = document.createElement("img");
                img.classList.add("obj");
                img.file = file;
                preview.appendChild(img);
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                })(img);

                reader.readAsDataURL(file);
            }

        }
    }
    </script>
</body>


</html>