<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10.8.2016 г.
 * Time: 22:55 ч.
 */
class PostsController extends BaseController
{
    function onInit()
    {
        $this->authorize();
    }

    public function index()
    {
        $this->posts = $this->model->getAll();
    }

    public function create()
    {
       if ($this->isPost)
       {
           $title = $_POST['title'];
           $content = $_POST['content'];
           $user_id = $_SESSION['userId'];
           return $this->model->create($title,$content,$user_id);
       }

    }

    public function edit(int $id)
    {

    }

    public function delete(int $id)
    {

    }

}