<?php
//var_dump(@$_POST);

session_start();
if ($_POST){
    extract($_POST);
    var_dump(@$_SESSION);
    if (isset($captcha) && (@$captcha==$_SESSION['captcha'])){
        unset($_SESSION['captcha']);
        header("Location: index.php");    
    }else{
        header("Location: remember.php");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Historique des changements</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="JS/jquery-3.3.1.slim.min.js"></script>
    <style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
    </style>
</head>
<section class="align-middle text-center">
    <div class="container mt-5  px-lg-5">
        <div class=" row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="JS/img/draw2.webp" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 justify-content-center align-items-center col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="remember.php" name="formulaire">
                    <div class=" d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <p class="lead fw-normal mb-0 me-3">
                        <h3>
                            <i class="bi bi-lightbulb"></i>Récupération de mot de passe</p>
                        </h3>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class=" form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                            placeholder="Entrer Votre Email">
                    </div>
                    <!-- Password-->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="username">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg"
                            placeholder="Saisisser votre nouveau mot de passe" />
                    </div>
                    <!--Passwordbis-->
                    <div class="form-outline mb-4"> <label class="form-label" for="username">Vérification de mot de
                            passe</label>
                        <input type="password" id="passwordbis" onblur="verif_pass();" name="passwordbis"
                            class="form-control form-control-lg" placeholder="Saisisser à nouveau votre mot de passe" />


                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="captcha">Code de vérification <img src="captcha.php"></label>
                            <input type="number" id="captcha" name="captcha" class="form-control form-control-lg"
                                placeholder="Saississer le code afficher" />

                        </div>

                        <div class=" d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <!--<div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                                Se souvenir
                            </label>
                    </div>-->
                            <!-- Checkbox -->
                            <!-- <div class="form-check mb-0">
                                <input class="form-check-input me-2" name="update" type="checkbox" value="erase"
                                    id="update" />
                                <label class="form-check-label" for="udapate">Redéfinir
                                </label>
                            </div>
-->
                        </div>
                        <div class="text-center text-lg-center mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Se connecter</button>
                            <!--<p class="small fw-bold mt-2 pt-1 mb-0"><a href="remember.php" class="link-danger">Mot de
                                    passe
                                    oublié</a></p>-->
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5 px-lg-5 text-center text-md-start
        justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white text-center mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
        </div>
    </div>
</section>
</body>
<script language="JavaScript">
function verif_pass() {

    // on place les saisies dans des variables pour plus de commodité
    mot_de_passe1 = document.formulaire.password.value;
    mot_de_passe2 = document.formulaire.passwordbis.value;

    // si les deux saisies sont différentes :
    if (mot_de_passe1 != mot_de_passe2) {
        window.alert('Vous n\'avez pas resaisi le meme mot de passe !');
        return false;
    }
    // si elles ne sont pas différentes (si elles sont identiques en fait ;-)
    else {
        window.alert('C\'est bon, les deux mots de passe sont identiques');
        return true;
    }
}
</script>

</html>