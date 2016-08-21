<?php


class CategoriesModel extends BaseModel
{
    public function getAllCategories()
    {
        $statement = self::$db->query("SELECT categories.name FROM categories ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

}