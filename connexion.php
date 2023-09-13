<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONNEXION</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--script src="script.js"></script-->
</head>
<body>
    <div id="container_login">
        <h1>Connexion</h1>
        
        <form id="form_login" method="POST">
            <label><b>Login</b></label>
            <input id="form_loginEnt" type="text" placeholder="Entrer le login" name="form_loginEnt">

            <label><b>Mot de passe</b></label>
            <input id="form_passwordEnt" type="password" placeholder="Entrer le mot de passe" name="form_passwordEnt">

            <div class="button_containerEnt">
                <button id="button_loginEnt" type='submit'>Connexion</button>
            </div>
        </form>
    </div>

    <?php
        require 'Database.php';
        require 'entreprise.php';
        require 'employe.php';

        session_start();

        if(isset($_POST['form_loginEnt'])){
            $login = $_POST['form_loginEnt'];
            if(isset($_POST['form_passwordEnt'])){
                $password = $_POST['form_passwordEnt'];

                $DB = new Database();
                $connexion = $DB->verifLoginPassword($login, $password);

                if ($connexion === null) {
                    echo "Identifiants incorrects";
                } else {
                    $_SESSION['user'] = $connexion;
                    var_dump($_SESSION['user']);
                    
                    if($connexion->getIsAdmin() == 1)
                        header('Location: index.php');
                    else{
                        header('Location: pageEmploye.php');
                    }
                    exit();
                }
            }
        }
    ?>
</body>
</html>