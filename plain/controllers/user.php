<?php
namespace Controllers;

include_once "dao/user.php";
use DAO\UserDAO;

class User {
    private $userDAO;

    public function __construct($conn = null) {
        $this->userDAO = new UserDAO($conn);
    }

    public function index() {
        
    }

    public function register() {
        include_once 'views/register.php';
    }
    
    public function doRegister() {
        
        $foto = $_FILES['foto']['name'];
        $lokasiFoto = $_FILES['foto']['tmp_name'];

        $this->userDAO->insert($_POST['username'], $_POST['email'], $_POST['password'], $foto);

        move_uploaded_file($lokasiFoto, 'plain/assets/'.$foto);
        header('location:/user/showAll');
    }

    public function login() {
        include_once 'views/login.php';
    }

    public function doLogin() {
        $user = $this->userDAO->login($_POST['username'], $_POST['password']);
        if($user == null) {
            header('location:/user/login');
        }
        else {
            include_once 'views/user.php';
        }
    }

    public function showAll() {
        $users = $this->userDAO->getAll();
        include_once 'views/users.php';
    }
}
?>