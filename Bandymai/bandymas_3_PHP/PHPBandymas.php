<!DOCTYPE html>

<html>
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>

    <body> 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            Vardas: <input type="text" name="name">
            
            <br>
            Pavarde: <input type="text" name="surname">
            
            <br>
            Amzius: <input type="number" name="age">
            
            <br>
            Slaptazodis: <input type="password" name="password">
            
            <br>
            Gimimo data: <input type="date" name="date">
            
            <br>
            Lytis:
            <input type="radio" name="gender" value="M"> Vyras  
            <input type="radio" name="gender" value="F"> Moteris
            <input type="radio" name="gender" value="K"> Kita

            <br>
            Sudek du Skaicius: 
            <br>
            Skaicius #1: <input type="number" name="skaicius1">
            Skaicius #2: <input type="number" name="skaicius2">

            <input type="submit">
        </form>
    </body>

    <?php
        //Duomenu tipai
        $skaicius = 10;
        $skaicius2 = 10.5;
        $eilute = "PHP";
        $boolean = false;

        //Arrays
        $arr = array(10, 20, 30);
        $arr2 = array("Morka", "Obuolys", "Apelsinas");
        $arr3 = array("Jonas" => 12, "Petras" => 14, "Tomas" => "Penkiolika", "Vilius" => "16");

        //Loopai tokie patys kaip c++ (for, foreach, while, do while)
        for ($x = 0; $x < count($arr); $x++)
        {
            echo $arr[$x];
            echo "<br>";
        }

        echo "<br>";

        foreach ($arr2 as $val)
        {
            echo $val;
            echo " ";
        }

        echo "<br>";

        foreach ($arr3 as $key => $val)
        {
            echo "Vardas: $key, Amzius: $val";
            echo "<br>";
        } 

        echo "<br>";

        //Inputas
        $vardas = $pavarde = $amzius = $lytis = $slaptazodis = $gimimoData = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $vardas = cleanup($_POST["name"]);
            $pavarde = cleanup($_POST["surname"]);
            $amzius = cleanup($_POST["age"]);
            $lytis = cleanup($_POST["gender"]);
            $slaptazodis = cleanup($_POST["password"]);
            $gimimoData = cleanup($_POST["date"]);
        }

        // Funkcijos 
        function cleanup($data)
        {
            $data = htmlspecialchars($data);
            $data = trim($data);
            $data = stripslashes($data);

            return $data;
        }

        echo "DUOMENYS <br>";
        echo "VARDAS: $vardas <br> PAVARDE: $pavarde <br>";
        echo "AMZIUS: $amzius <br> LYTIS: $lytis <br>";

        echo "Sudeties rezultatas: <br>"; 
        echo add($_POST["skaicius1"], $_POST["skaicius2"]);

        function add($s1, $s2)
        {
             return $s1+$s2;
        } 
    ?>
</html>