<?php

require_once 'include/head.php';
require_once 'class/Users.php';
$user = new Users();

switch($_GET['action']){
    case 'registration':
?>

<form action="cabinet.php" method="post">
    <p>Фамилия <input type="text" name="sirname"></p>
    <p>Имя     <input type="text" name="name"></p>
    <p>Отчество<input type="text" name="patronymic"></p>
    <p>логин   <input type="text" name="login"></p>
    <p>E-mail  <input type="email" name="email"></p>
    <p>дата рождения <input type="date" name="birthday"></p>

    <p>
    password: <input type="password" name="passwd"><br>
    <button type="submit">GO</button>
    </p>
</form>
<?php
    break;
    case 'enter':
?>

        <form action="cabinet.php" method="post">
            <p>логин   <input type="text" name="login"></p>
            <p>
                password: <input type="password" name="passwd"><br>
                <button type="submit">GO</button>
            </p>
        </form>
<?php
   break;
    default:
        ?>
        <p>
            <a href="cabinet.php?action=enter">ВХОД</a>&nbsp / &nbsp <a href="cabinet.php?action=registration">РЕГИСТРАЦИЯ</a>
        </p>
<?php
        break;
}
?>
<?php
$salt = 'l;k;kasjdfj;as';
if(isset($_POST['passwd'])){
    $user->setUserPatronymic($_POST['patronymic']);
    $user->setUserName($_POST['name']);
    $user->setUserSirname($_POST['sirname']);
    $user->setUserLogin($_POST['login']);
    $user->setUserBirthday($_POST['birthday']);
    if($user->checkPassword($_POST['passwd'], $salt) == false){
        $errors[]="пароль должен быть не короче 6 символов, содержать латинские строчные и прописные символы";
    }
    if($user->checkEmail($_POST['email']) == false){
        $errors[]="адрес электронной почты некорректный";
    }

    if(isset($errors)){
        foreach ($errors as $error){
            echo "<p>{$error}</p>";
        }
    }
    else{
        $data = $user->registration($pdo, $salt);
    }
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
require_once 'include/footer.php';
?>
