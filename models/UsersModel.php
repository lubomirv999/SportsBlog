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

    public function login ( string $username, string $password ){
        $statement = self::$db->prepare(
            "SELECT ID, Password FROM users WHERE UserName = ?");
        $statement ->bind_param("s", $username);
        $statement -> execute();
        $result = $statement -> get_result() -> fetch_assoc();
        if (password_verify($password,$result['Password']))
            return $result['ID'];
        return false;
    }
     public function listUsers(){
         $statement = self::$db->query("SELECT users.UserName, users.FullName, users.ID FROM users ");
         return $statement->fetch_all(MYSQLI_ASSOC);
     }

     public function pagingUsers  ($page, $recordsPerPage)
     {
         $statement = self::$db->prepare("SELECT * FROM users LIMIT ?,? ");
         $statement ->bind_param("ii", $page, $recordsPerPage );
         $statement -> execute();
         $statement -> get_result()->fetch_all();
     }

    public function checkAdmin (int $id)
    {
        $statement = self::$db->prepare("SELECT users.is_admin FROM users WHERE ID = ? ");
        $statement -> bind_param("i", $id);
        $statement-> execute();
        $resultArr = $statement -> get_result()->fetch_assoc();
        $result = $resultArr['is_admin'];
        return $result;
    }

    public function deleteUser(int $id) : bool
    {
        $statement = self::$db->prepare("DELETE FROM users WHERE ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        if($statement->affected_rows == 1){
            return true;
        }
        return false;
    }

    public function promoteUser(int $id) : bool
    {
        $statement = self::$db->prepare("UPDATE users SET is_admin = 1 WHERE ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        if($statement->affected_rows == 1){
            return true;
        }
        return false;
    }
}
