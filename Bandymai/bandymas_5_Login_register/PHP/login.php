<!DOCTYPE html>

<?php include "connect_database.php" ?>

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
        <div>
            <h1>
                Prisijungimas
            </h1>

            <b>Pateikite prisijungimo duomenis:</b>
        </div>        

        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" method="post">
                Vartotojo vardas arba el. paštas: <input type="text" name="user_details" placeholder="">
                <br>
                Slaptažodis: <input type="password" name="password" placeholder="">
                <br>
                <input type="submit" value="Pateikti" name="submit">
            </form>

            <?php 
                include "require_once.php";

                $user_details = $password = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $user_details = cleanup($_POST["user_details"]);
                    $password = cleanup($_POST["password"]);
                }

                if (isset($_POST["submit"]))
                {
                    if (login_validation($user_details, $password))
                    {
                        header("Location: home.php");
                        exit();
                    }

                    else echo "Pateikti neteisingi prisijungimo duomenys";
                }
            ?>
        </div>
        
        <br>

        <div>
            Neturite paskyros? <a href="register.php">Susikurkite ją čia</a>
        </div>
    </body>

    <br> 
    <footer>
        <?php include "site_footer.html" ?>
    </footer>
</html>