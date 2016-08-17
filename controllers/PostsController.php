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
        if ($this->isPost) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            if (strlen($title) == 0) {
                $this->setValidationError("title", "Title cannot be empty!");
            }
            if (strlen($content) == 0) {
                $this->setValidationError("content", "Content cannot be empty!");
            }
            if ($this->formValid()) {
                $user_id = $_SESSION['userId'];
                return $this->model->create($title, $content, $user_id);
            }

        }

    }

    public function edit(int $id)
    {
        if($this->isPost){
            $title = $_POST['title'];
            if(strlen($title) < 1){
                $this->setValidationError("title", "This field cannot be empty!");
            }
            $content = $_POST['content'];
            if(strlen($content) < 1){
                $this->setValidationError("content", "This field cannot be empty!");
            }
            $date = $_POST['date'];
            $dateRegex = '/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/';
            if(!preg_match($dateRegex, $date)){
                $this->setValidationError("date", "Invalid date.");
            }
            $user_id = $_POST['user_id'];
            if ($user_id <= 0 || $user_id > 1000000){
                $this->setValidationError("user_id", "Invalid author ID.");
            }
            if($this->formValid()){
                if($this->model->edit($id,$title,$content,$date,$user_id)){
                    $this->addInfoMessage("Post edited successfuly.");
                }
                else{
                    $this->addErrorMessage("Post can not be edited!");
                }
                $this->redirect('posts');
            }

            $post = $this->model->getById($id);
            if(!$post){
                $this->addErrorMessage("The post you are trying to edit does not exist.");
                $this->redirect('posts');
            }
            $this->post = $post;
        }
    }

    public function delete(int $id)
    {
        if ($this->isPost) {
            if ($this->model->delete($id)) {
                $this->addInfoMessage("Post deleted.");
            } else {
                $this->addErrorMessage("Error: cannot delete post.");
            }
            $this->redirect('posts');
        } else {
            $post = $this->model->getById($id);
            if (!$post) {
                $this->addErrorMessage("Error: post does not exist.");
                $this->redirect('posts');
            }
            $this->post = $post;
        }
    }

    public function view_post(int $id)
    {
        $this->post = $this->model->getById($id);
        $listComments = $this->model->listComments($id);
        $this->comments = $listComments;

    }

    public function createComment(int $postId)
    {
        if ($this->isPost) {
            $content = $_POST['comment'];
            if (strlen($content) == 0) {
                $this->setValidationError("content", "Comment cannot be empty!");
            }
            if ($this->formValid()) {
                $user_id = $_SESSION['userId'];
                $this->addInfoMessage("You have commented successful!");
                $this->model->create_comment($content, $user_id, $postId);
                $arrayId = [$postId];
                $this->redirect('posts','view_post',$arrayId);
            }
        }

    }

    public function delete_comment(int $id)
    {

    }

}