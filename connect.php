<?php
if ($_POST) {
    require_once 'models/users.php';
    $user = new User($_POST);
    extract($_POST);
    $form = $_POST;
    
    if (isset($update)) {
        $user->select("*", $email);
        $form['email'] = $user->select("*", $email);
    }
    $user->manage($form);
    $_SESSION['username']= $username;




    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

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
                <form method="POST" action="connect.php">
                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <p class="lead fw-normal mb-0 me-3">
                        <h2>
                            <i class="bi bi-lightbulb"></i>&nbsp;AmpApplipoule</p>
                        </h2>
                    </div>
                    <!-- Username-->
                    <div class="form-outline mb-4">
                        <input type="text" id="username" name="username" class="form-control form-control-lg"
                            placeholder="Entrer votre Pseudo" />
                        <label class="form-label" for="username">Email</label>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                            placeholder="Entrer une adresse valide"> <label class=" form-label"
                            for="email">Email</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" id="password" name="password" class="form-control form-control-lg"
                            placeholder="Entrer votre Mot de passe" />
                        <label class="form-label" for="password">Mot de Passe</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                                Se souvenir
                            </label>
                        </div>
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                            <input class="form-check-input me-2" name="update" type="checkbox" value="" id="update" />
                            <label class="form-check-label" for="udapete">
                                Redefinir
                            </label>
                        </div>

                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Se connecter</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Pas encore de compte? <a href="register.php"
                                class="link-danger">Créer un Compte</a></p>
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
        <!-- Copyright -->

        <!-- Right -->
        <div>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        <!-- Right -->
    </div>
</section>
</body>

</html>