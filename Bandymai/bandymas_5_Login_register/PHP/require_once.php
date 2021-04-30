<?php
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "bandymas5";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Select database
    mysqli_select_db($conn, $dbname) or die(mysql_error());

    session_start();

    function execute_query($sql)
    {
        if ($GLOBALS["conn"]->query($sql) === FALSE) {
             echo "Error with database" . $conn->error;
        } 
    }

    function add_user($email, $user_name, $password)
    {
        $sql = 
        "
            INSERT INTO user(user_name, user_email, password, role) VALUES('$user_name', '$email', '$password', 'USER');
        ";
                    
        execute_query($sql);
    }

    function cleanup($data)
    {
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);

        return $data;
    }

    function validate_registration($email, $user_name, $password)
    {
        if (user_taken($user_name, $email)) return false;

        if (registration_error($email, 40, "el. paštas") || 
            registration_error($user_name, 20, "vartotojo vardas") ||
            registration_error($password, 20, "slaptažodis")) return false; 

        return true;
    }

    function user_taken($user_name, $email)
    {
        $sql = 
        "
            SELECT * FROM user 
            WHERE user_email = '$email'
        ";
        
        $result = $GLOBALS["conn"]->query($sql);

        if ($result->num_rows > 0)
        {
            echo "El. paštas jau užimtas";
            return true;
        }

        $sql = 
        "
            SELECT * FROM user 
            WHERE user_name = '$user_name'
        ";

        $result = $GLOBALS["conn"]->query($sql);

        if ($result->num_rows > 0)
        {
            echo "Vartotojo vardas jau užimtas";
            return true;
        }

        return false;
    }

    function registration_error($variable, $char_limit, $string)
    {
        if (strlen($variable) > $char_limit)
        {
           echo "Pateiktas per ilgas $string ($char_limit simbolių limitas) <br>";
           return true; 
        }

        if ($variable == NULL)
        {
           echo "Nepateiktas $string <br>"; 
           return true;
        } 

        return false;
    }

    function login_validation($user_details, $password)
    {
        $sql = 
        "
            SELECT * FROM user
            WHERE user_email = '$user_details' AND password = '$password';
        ";

        $result = $GLOBALS["conn"]->query($sql);

        if ($result->num_rows == 1)
        {
            add_session_info($result);
            return true;
        } 

        $sql = 
        "
            SELECT * FROM user
            WHERE user_name = '$user_details' AND password = '$password';
        ";

        $result = $GLOBALS["conn"]->query($sql);

        if ($result->num_rows == 1)
        {
            add_session_info($result);
            return true;
        } 

        return false;
    }

    function add_session_info($result)
    {
        $value = $result->fetch_object();
        $_SESSION["user_name"] = $value->user_name;
        $_SESSION["user_email"] = $value->user_email;
        $_SESSION["password"] = $value->password;
        $_SESSION["user_id"] = $value->user_id;
        $_SESSION["role"] = $value->role;
    }

    function update_session_info($email, $user_name, $password)
    {
        $_SESSION["user_name"] = $user_name;
        $_SESSION["user_email"] = $email;
        $_SESSION["password"] = $password;
    }

    function delete_user($user_id)
    {
        $sql = 
        "
            DELETE FROM user
            WHERE user_id = '$user_id';
        ";

        execute_query($sql);
    }

    function update_user($new_email, $new_user_name, $new_password, $user_id)
    {
        if (registration_error($new_email, 40, "el. paštas") || 
            registration_error($new_user_name, 20, "vartotojo vardas") ||
            registration_error($new_password, 20, "slaptažodis")) return false;

        $sql = 
        "
            UPDATE user
            SET password = '$new_password', user_name = '$new_user_name', user_email = '$new_email'
            WHERE user_id = '$user_id';
        ";

        execute_query($sql);
        update_session_info($new_email, $new_user_name, $new_password);

        return true;
    }
?>   