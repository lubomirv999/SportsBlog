<?php

class UsersController extends BaseController
{
    public function register()
    {
		if ($this -> isPost) {
		    $username = trim($_POST['username']);
            if (strlen($username)<3||strlen($username)>45) {
                $this -> setValidationError("username", "Invalid username!");
            }
            $password = trim($_POST['password']);
            if (strlen($password)<3 || strlen($password)>50){
                $this -> setValidationError("password", "Invalid password!");
            }
            if ($password == $username){
                $this -> setValidationError("password", "Password and username cannot match!");
            }
            $confirm_password = trim($_POST['confirmPassword']);
            if (strlen($confirm_password)<3 || strlen($confirm_password)>50){
                $this -> setValidationError("confirmPassword", "Invalid password conformation!");
            }
            $fullName = $_POST['fullName'];
            if (strlen($fullName)>200){
                $this -> setValidationError("fullName", "Invalid full name!");
            }
            if ($this -> formValid()){
                $userId = $this -> model -> register($username,$password,$fullName);
                if ($userId) {
                    $_SESSION['username'] = $username;
                    $_SESSION['userId'] = $userId;
                    $this->addInfoMessage("Registration successful");
                    return $this->redirect("posts");
                }
                else {
                    $this -> addErrorMessage("Error: registration failed!");

                }
            }
        }
    }

    public function login()
    {
		if ($this->isPost) {
		    $username = $_POST['username'];
            $password = $_POST['password'];
            $loggedUserId = $this->model->login($username, $password);
            if ($loggedUserId){
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $loggedUserId;
                $this->addInfoMessage('Login successful.');
                return $this->redirect("posts");
            }
            else {
                $this->addErrorMessage("Login failed!");
            }

        }
    }

    public function logout()
    {
        session_destroy();
        $this->addInfoMessage("Logout successful!");
        $this->redirect("home");
    }

    public function index ()
    {
        $this->users=$this->model->listUsers();
    }
}
