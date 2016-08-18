<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10.8.2016 г.
 * Time: 22:57 ч.
 */
class PostsModel extends BaseModel
{
    public function getAll() : array
    {
     $statement = self::$db->query("SELECT posts.Id, title, content, FullName, date " .
         "FROM posts LEFT JOIN users ON posts.user_id = users.ID " . "ORDER BY date DESC ");
        return $statement->fetch_all(MYSQLI_ASSOC);

    }

    public function getById(int $id)
    {
        $statement = self::$db->prepare("SELECT users.UserName, posts.user_id, posts.date, posts.title, posts.content, posts.Id ".
            "FROM posts LEFT JOIN users ON posts.user_id = users.ID ".
            "WHERE posts.Id = ? ");
        $statement->bind_param("i",$id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $title, string $content, int $user_id) : bool
    {
        $statement = self::$db->prepare("INSERT INTO posts (title,content,user_id) VALUES (?,?,?) ");
        $statement->bind_param("ssi",$title,$content,$user_id);
        $statement->execute();
        if ($statement->affected_rows==0)
        {
            return false;
        }
        return self::$db->insert_id;
    }

    public function edit(string $id,string $title, string $content, string $date, int $user_id) : bool
    {
        $statement = self::$db->prepare("UPDATE posts SET title = ?, content = ?, date = ?, user_id = ? WHERE id = ?");
        $statement->bind_param("sssii", $title, $content, $date, $user_id, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }


    public function delete(int $id) : bool
    {
        $statement = self::$db->prepare("DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i",$id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function create_comment (string $content, int $user_id, int $post_id)
    {
        $statement = self::$db->prepare("INSERT INTO comments (content, post_id,user_id) VALUES (?,?,?) ");
        $statement -> bind_param("sii", $content,$post_id,$user_id);
        $statement -> execute();
        if ($statement->affected_rows==0)
        {
            return false;
        }
        return self::$db->insert_id;
    }

    public function listComments ($id)
    {
        $statement = self::$db->prepare(
            "SELECT post_id, comments.content, comments.date, users.UserName, comments.ID ".
            "FROM comments LEFT JOIN posts ON comments.post_id = posts.Id LEFT JOIN users ON comments.user_id = users.ID ".
            "WHERE posts.Id = ? ".
            "ORDER BY date DESC ");
        $statement-> bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function delete_comment(int $id)
    {

    }
}