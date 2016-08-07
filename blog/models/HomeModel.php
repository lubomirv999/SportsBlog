<?php

class HomeModel extends BaseModel
{
    public function getLastPosts ($count = 5) : array
    {
        $statement = self::$db->query(
            "SELECT posts.Id, title, content, FullName ".
            "FROM posts LEFT JOIN users ON posts.user_id = users.Id ".
            "ORDER BY date DESC LIMIT $count");
        return $statement -> fetch_all(MYSQLI_ASSOC);
    }
}
