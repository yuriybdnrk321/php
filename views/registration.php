<?php 
    //перевірка введених даних за допомогою регулярних виразів
    if(!empty($_POST)){ 
        $correct = true;
        if(isset($_POST["login"]) && (preg_match("/[!,.@#$%^&*()+=~?`><№;:]/",$_POST["login"]) || strlen($_POST["login"]) < 4)){
            echo("Введіть коректний логін. Логін може містити лише латинські (великі та малі), цифри. Довжина логіну має складати нe менше 4 символів.\n");
            $correct = false;
        }

        if(isset($_POST["password"]) && (!preg_match("/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{7,}/",$_POST["password"]))){
            echo("Пароль має містити в собі малі та великі літери, а також цифри.
            Довжина паролю також має складати не менше 7 символів. \n");
            $correct = false;
        }

        if(isset($_POST["repeatpassword"]) && !($_POST["password"]==$_POST["repeatpassword"])){
            echo("Паролі не співпадають.\n");
            $correct=false;
        }

        if(isset($_POST["email"]) && !preg_match("/[a-z0-9]+@[a-z]+\.[a-z]{2,}/",$_POST["email"])){
            echo("Введіть коректну електронну пошту.\n");
            $correct=false;
        }
        
        if(isset($_POST["about_user"])){
            $_POST["about_user"] = strip_tags($_POST["about_user"]);
        }
        //підключення до бази даних об'єктноо-орієнтованим стилем
        $db = new mysqli('localhost', 'root', '', 'lab');
            if(!$db){
                die('Error connection');
            }
        //якщо дані введено вірно, все записується в базу даних
        if($correct){
       
            $hash_password = password_hash($_POST["password"],PASSWORD_BCRYPT);
            $query = "INSERT INTO users(login,password,email,about_user)
                VALUES(".'"'.$_POST["login"].'","'.$hash_password.'","'.$_POST["email"].'","'.$_POST["about_user"].'");';
            $db->query($query);
            $db->close();
            require_once("./views/registration_successful.php");
            die;
        }
    }
?>

<div class="registration">
    <h3>Реєстрація</h3>
    <form action="index.php?action=registration" method="POST">
            <label>Логін</label>
            <input type="text" name="login" >
            <br>
            <br>
            <label>Пароль</label>
            <input type="password" name="password">
            <br>
            <br>
            <label>Повторіть пароль</label>
            <input type="password" name="repeatpassword">
            <br>
            <br>
            <label>EMail</label>
            <input type="text" name="email">
            <br>
            <br>
            <label>Про себе</label>
            <textarea name="about_user" cols="40" rows="3"></textarea></p>
            <input type="submit" value="Зареєструватись"/>
    </form>
</div>