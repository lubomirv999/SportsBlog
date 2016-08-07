<?php

class UsersController extends BaseController
{
    public function register()
    {
		if ($this -> isPost) {
		    $username = $_POST['username'];
            if (strlen($username)<2||strlen($username)>45) {
                $this -> setValidationError("username", "Invalid username!");
            }
            $password = $_POST['password'];
            if (strlen($password)<2 || strlen($password)>50){
                $this -> setValidationError("password", "Invalid password!");
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
                    $this->addInfoMessage("Login successful");
                    return $this->redirect("posts");
                }
                else {
                    $this -> addErrorMessage("Error: login failed!");

                }
            }
        }
    }

    public function login()
    {
		// TODO: your user login functionality will come here ...
    }

    public function logout()
    {
		// TODO: your user logout functionality will come here ...
    }
}
