<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10.8.2016 г.
 * Time: 22:57 ч.
 */
class PostsModel extends BaseModel
{
    public function getAll($page, $perPage = 10) : array
    {
        $from = ($page-1)*$perPage;
        $to = $page*$perPage;
        $statement = self::$db->query("SELECT posts.Id, title, content, FullName, date,
             posts.user_id, pictures.name as image " .
            "FROM posts LEFT JOIN users ON posts.user_id = users.ID ".
            "LEFT JOIN pictures ON pictures.post_id = posts.Id ".
            "ORDER BY date DESC " . "LIMIT $from, $to ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getUserIdByPostId(int $id)
    {
        $statement = self::$db->prepare("SELECT posts.user_id FROM posts WHERE Id = ? ");
        $statement -> bind_param('i', $id);
        $statement->execute();
        $resultArr = $statement->get_result()->fetch_assoc();
        $result = $resultArr['user_id'];
        return $result;
    }

    public function getById(int $id)
    {
        $statement = self::$db->prepare("SELECT users.UserName, posts.user_id, posts.date,
            posts.title, posts.content,pictures.name as image, posts.Id, categories.name as category, posts.category_id " .
            "FROM posts LEFT JOIN users ON posts.user_id = users.ID " .
            "LEFT JOIN pictures ON pictures.post_id = posts.Id ".
            "LEFT JOIN categories ON categories.id = posts.category_id ".
            "WHERE posts.Id = ? ");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $title, string $content, int $user_id, int $category_id)
    {
        $statement = self::$db->prepare("INSERT INTO posts (title,content,user_id,category_id) VALUES (?,?,?,?) ");
        $statement->bind_param("ssii", $title, $content, $user_id, $category_id);
        $statement->execute();
        if ($statement->affected_rows == 0) {
            return false;
        }
        return self::$db->insert_id;
    }

    public function edit(int $id, string $title, string $content,int $categoryId) : bool
    {
        $statement = self::$db->prepare("UPDATE posts SET posts.title = ?, posts.content = ?, posts.category_id=? ".
                                        "WHERE posts.Id = ? ");
        $statement->bind_param("ssii", $title, $content,$categoryId, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }


    public function delete(int $id) : bool
    {
        $statement = self::$db->prepare("DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

   public function countPosts ()
   {
       $statement = self::$db->query("SELECT count(Id) FROM posts ");
       $result = $statement->fetch_assoc();
       return $result['count(Id)'];
   }

    public function create_comment(string $content, int $user_id, int $post_id)
    {
        $statement = self::$db->prepare("INSERT INTO comments (content, post_id,user_id) VALUES (?,?,?) ");
        $statement->bind_param("sii", $content, $post_id, $user_id);
        $statement->execute();
        if ($statement->affected_rows == 0) {
            return false;
        }
        return self::$db->insert_id;
    }

    public function listComments($id)
    {
        $statement = self::$db->prepare(
            "SELECT post_id, comments.content, comments.date, users.UserName, comments.ID " .
            "FROM comments LEFT JOIN posts ON comments.post_id = posts.Id LEFT JOIN users ON comments.user_id = users.ID " .
            "WHERE posts.Id = ? " .
            "ORDER BY date DESC ");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteComment(int $id)
    {
        $statement = self::$db->prepare("DELETE FROM comments WHERE comments.ID=? ");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
    
    public function getUserIdByCommentId(int $id)
    {
        $statement = self::$db->prepare("SELECT comments.user_id FROM comments WHERE ID = ? ");
        $statement -> bind_param('i', $id);
        $statement->execute();
        $resultArr = $statement->get_result()->fetch_assoc();
        $result = $resultArr['user_id'];
        return $result;
    }

    public function insertPostPicture(int $postId, $imagePath) {
        $statement = self::$db->prepare("INSERT into pictures (name, post_id) VALUES (?,?) ");
        $statement ->bind_param("si",$imagePath,$postId);
        $statement -> execute();
        return self::$db->insert_id;
    }

    public function getAllCategories()
    {
        $statement = self::$db->query("SELECT*FROM categories ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

   public function getCategoriesIdByName ($category)
   {
       $statement = self::$db->prepare("SELECT categories.id FROM categories WHERE categories.name = ? ");
       $statement -> bind_param("s", $category);
       $statement -> execute();
      return $statement-> get_result()->fetch_assoc();

   }

   public function getOthersCategoryId ()
   {
       $statement = self::$db->query("SELECT categories.id FROM categories WHERE categories.name='Others' ");
       return $statement->fetch_assoc();
   }

   public function pushCategoryIdAtPosts($id):bool
   {
       $statement = self::$db-> prepare("INSERT INTO posts(posts.category_id) VALUE (?) ");
       $statement ->bind_param("i",$id);
       $statement -> execute();
       if ($statement->affected_rows!=0){
           return true;
       }
       return false;
   }
}