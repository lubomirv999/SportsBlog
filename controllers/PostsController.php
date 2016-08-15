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
           if(strlen($title) == 0) {
               $this->setValidationError("title", "Title cannot be empty!");
           }
           if(strlen($content) ==0) {
               $this->setValidationError("content", "Content cannot be empty!");
           }
            if($this->formValid())
            {
                $user_id = $_SESSION['userId'];
              return $this->model->create($title, $content, $user_id);
          }

       }

    }

    public function edit(int $id)
    {

    }

    public function delete(int $id)
    {
        if($this->isPost){
            if($this->model->delete($id)){
                $this->addInfoMessage("Post deleted.");
            }
            else{
                $this->addErrorMessage("Error: cannot delete post.");
            }
        $this->redirect('posts');
        } else{
        $post = $this->model->getById($id);
            if(!$post){
                $this->addErrorMessage("Error: post does not exist.");
                $this->redirect('posts');
            }
            $this->post = $post;
        }
    }

}