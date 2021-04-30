<!DOCTYPE html>

<html>
    <head>
        <meta charset = "UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Prisijungimas</title>

        <link rel="stylesheet" href="../CSS/site_style.css" />
    </head>

    <header>
        <?php include "site_header.html" ?>
    </header>

    <body>
        <h1>
            <?php
                include "require_once.php";

                $user_name = $_SESSION["user_name"];
                $user_email = $_SESSION["user_email"];
                $password = $_SESSION["password"];
                $user_id = $_SESSION["user_id"];
                $role = $_SESSION["role"];

                echo "Sveiki, $user_name!";
            ?>
        </h1>

        <b>Pakeiskite savo prisijungimo duomenis:</b>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            Naujas vartotojo vardas: <input type="text" name="new_user_name" value="<?php echo "$user_name" ?>" >
            <br>
            Naujas el. paštas: <input type="email" name="new_email" value="<?php echo "$user_email" ?>">
            <br>
            Naujas slaptažodis: <input type="password" name="new_password">
            <br>
            <br>
            
            <strong>Patvirtinimas:</strong>
            <br>
            Įveskite slaptažodį: <input type="password" name="password">
            <br>
            Pakartokite slaptažodį: <input type="password" name="password_2">
            <br>

            <br>
            Atnaujinti duomenis: <input type="submit" name="update" value="Atnaujinti">
            <br>

            Ištrinti vartotoją: <input type="submit" name="delete" value="Ištrinti">
        </form> 

        <?php

            $new_username = $new_email = $new_password = $password_1 = $password_2 = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if ($_POST["new_user_name"] != NULL) $new_username = cleanup($_POST["new_user_name"]);
                else $new_username = $user_name;

                if ($_POST["new_email"] != NULL) $new_email = cleanup($_POST["new_email"]);
                else $new_email = $user_email;

                if ($_POST["new_password"] != NULL) $new_password = cleanup($_POST["new_password"]);
                else $new_password = $password;

                $password_1 = cleanup($_POST["password"]);
                $password_2 = cleanup($_POST["password_2"]);
            }
            
            if (isset($_POST["update"]) || isset($_POST["delete"]))
            {
                if ($password_1 != $password || $password != $password_2) echo "Pateiktas neteisingas slaptažodis";
                else
                {
                  if (isset($_POST["update"]))
                    {
                        update_user($new_email, $new_username, $new_password, $user_id);
                        
                        header("Location: " .$_SERVER['PHP_SELF']);
                        exit();
                        
                        echo "Duomenys sėkmingai atnaujinti!";
                    }

                    else if (isset($_POST["delete"])) 
                    {
                        delete_user($user_id);
                        session_destroy();
                        header("Location: register.php");
                        exit();
                    }  
                }  
            } 
        ?>

        <br>
        <a href="login.php">Atsijungti</a>

    </body>

    <footer>
        <br>
        <?php include "site_footer.html" ?>
    </footer>
</html>