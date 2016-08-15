<?php

class HomeModel extends BaseModel
{
    public function getLastPosts ($count = 5) : array
    {
        $statement = self::$db->query(
            "SELECT posts.Id, title, content, FullName, date ".
            "FROM posts LEFT JOIN users ON posts.user_id = users.ID ".
            "ORDER BY date DESC LIMIT $count");
        return $statement -> fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById(int $id){
        $statement = self::$db->prepare(
            "SELECT posts.Id, title, content, date, FullName " .
            "FROM posts LEFT JOIN users ON posts.user_id = users.ID " .
            "WHERE posts.Id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;

    }
}
