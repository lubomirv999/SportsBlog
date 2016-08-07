<?php

class UsersModel extends BaseModel
{
    public function register (string $username, string $password, string $fullName)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $statement = self::$db->prepare("INSERT INTO users (UserName, Password, FullName) VALUES (?,?,?)");
        $statement -> bind_param("sss", $username, $passwordHash, $fullName);
        $statement-> execute();
        if ($statement->affected_rows!=1)
            return false;
        $userId = self::$db->query("SELECT LAST_INSERT_Id()")->fetch_row()[0];
        return $userId;
    }
}
