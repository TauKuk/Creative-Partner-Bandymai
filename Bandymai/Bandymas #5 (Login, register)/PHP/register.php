<!DOCTYPE html>

<html>
    <head>
        <meta charset = "UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Registracija</title>

        <link rel="stylesheet" href="../CSS/site_style.css" />
    </head>

    <header>
        <?php include "site_header.html" ?>
    </header>

    <body>
        <div>
            <h1>Registracija</h1>
            <b>Pateikite registracijos duomenis: </b> 
        </div>
        
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                El. paštas: <input type="email" name="email">
                <br>
                Vartotojo vardas: <input type="text" name="user_name">
                <br>
                Slaptažodis: <input type="password" name="password">
                <br>
                <input type="submit" value="Pateikti" name="submit">
            </form>

            <?php 
                include "require_once.php";

                $email = $user_name = $password = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $email = cleanup($_POST["email"]);
                    $user_name = cleanup($_POST["user_name"]);
                    $password = cleanup($_POST["password"]);
                }

                if (isset($_POST["submit"]))
                {
                    if (validate_registration($email, $user_name, $password) == true) 
                    {
                        add_user($email, $user_name, $password); 
                        echo "Registracija sėkminga!";
                    }  
                } 
            ?>

        </div>

        <br>

        <div>Turite paskyrą? <a href="login.php">Prisijunkite čia</a></div>

    </body>

    <br> 

    <footer>
        <?php include "site_footer.html" ?>
    </footer>
</html>