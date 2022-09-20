<?php


class Users
{
    private $userName;
    private $userSirname;
    private $userPatromymic;
    private $userLogin;
    private $userPasswd;
    private $userBirthday;
    private $userEmail;
    private $userPrivileges = 3;

    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function setUserSirname($userSirname){
        $this->userSirname = $userSirname;
    }

    public function setUserPatronymic($userPatronimyc){
        $this->userPatromymic = $userPatronimyc;
    }

    public function setUserLogin($userLogin){
        $this->userLogin = $userLogin;
    }

    private function setUserPasswd($userPasswd){
        $this->userPasswd = $userPasswd;
    }

    public function setUserBirthday($userBirthday){
        $this->userBirthday = $userBirthday;
    }

    private function setUserEmail($userEmail){
        $this->userEmail = $userEmail;
    }

    public function setUserPrivileges($userPrivileges=3){
        $this->userPrivileges = $userPrivileges;
    }

    public function checkPassword($passwd, $salt){
        //пароль должен быть не короче 6 символов
        //должен содержать строчные, прописные и цифры
        $pattern = '((?=.*[A-Z])(?=.*[a-z])(?=.*\d).{7,21})';//' ^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$ ';
        if(!preg_match($pattern,$passwd)){
         return false;
        }
        $passwd .= $salt;
        $passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $this->setUserPasswd($passwd);
        return true;
    }

    public function checkEmail($email){
        if(filter_var($email, FILTER_SANITIZE_EMAIL)){
            $this->setUserEmail($email);
            return true;
        }
        return false;
    }

    public function registration($pdo, $salt){
        $registrationData = array('id'=>0, 'sirname'=>$this->userSirname, 'name'=>$this->userName, 'patron'=>$this->userPatromymic,
                                  'login'=>$this->userLogin, 'email'=>$this->userEmail, 'birthday'=>$this->userBirthday,
                                  'passwd'=>$this->userPasswd, 'salt'=>$salt, 'privileges'=>$this->userPrivileges);
        $queryInsertUserData = "INSERT INTO users (user_id, user_sirname, user_name, user_patronymic,
                                                   user_login, user_email, user_birthday, user_password, salt, user_privileges)
                                        VALUES (:id, :sirname, :name, :patron, :login, :email, :birthday, :passwd, :salt, :privileges)";
        $result = $pdo->prepare($queryInsertUserData);
        if($result->execute($registrationData)){
            return true;
        }
        else{
            return false;
        }

    }

    public function getUserData($pdo, $userName, $userPassword){
        $data = array('email'=>$userName, 'login'=>$userName);
        $querySelectUser = "SELECT * FROM users WHERE user_email = :email OR user_login = :login";
        $row = $pdo->prepare($querySelectUser);
        $row->execute($data);
        $result = $row->fetch(PDO::FETCH_ASSOC);
        if(isset($result['user_login']) && password_verify($userPassword.$result['salt'], $result['user_password'])){
            $_SESSION['id'] = $result['user_id'];
            $_SESSION['name'] = $result['user_name'];
            $_SESSION['patronimyc'] = $result['user_patronymic'];
            $_SESSION['sirname'] = $result['user_sirname'];
            $_SESSION['login'] = $result['user_login'];
            $_SESSION['email'] = $result['user_email'];
            $_SESSION['privileges'] = $result['user_privileges'];
            $_SESSION['errors'] = '';
        }
        else{
            $_SESSION['errors'] = 'Неверный логин или пароль';
        }

        if(!empty($_SESSION['errors'])){
            return false;
        }
        else{
           return true;
        }
    }



}