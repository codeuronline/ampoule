<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <title>Formulaire de création d'utilisateur</title>
</head>
<body>
<style>
     body {
          background-color: grey;
     }
     .container {
          width: 20%;
          background-color: white;
          padding: 20px;
          border-radius: 10px;
          margin-top: 50px;
     }
</style>

     <div class="container">
     <form action="ajout.php" method="post">
          <div class="form-group">
               <label for="username">Nom</label>
               <input type="text" class="form-control" id="username" name="username" placeholder="Nom">
          </div>
          <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="form-group">
               <label for="password">Mot de passe</label>
               <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
          </div>
          <div class="form-group">
               <label for="phone">Téléphone</label>
               <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone">
          <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
     </form>
     </div>
     


</body>
</html>