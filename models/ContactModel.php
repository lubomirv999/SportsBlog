<?php
class ContactModel extends BaseModel
{
    public function send(string $content, int $user_id) : bool
    {
        $statement = self::$db->prepare("INSERT INTO contact (content,user_id) VALUES (?,?) ");
        $statement->bind_param("si",$content,$user_id);
        $statement->execute();
        if ($statement->affected_rows==0)
        {
            return false;
        }
        return self::$db->insert_id;
    }

    public function listMessages()
    {
        $statement = self::$db->query("SELECT contact.user_id, contact.content, contact.date, contact.id FROM contact ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteContact ($id) :bool
    {
        $statement = self::$db->prepare("DELETE FROM contact WHERE id = ? ");
        $statement->bind_param("i", $id);
        $statement->execute();
        if($statement->affected_rows == 1){
            return true;
        }
        return false;
    }

}
