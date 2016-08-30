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
        parent::onInit();
        $this->authorize();
    }

    public function index()
    {
        $this->categories=$this->model->getAllCategories();
        if ($this->model->countPosts()!='0') {
            $currentPage  = (isset($_GET['page'])) ? $_GET['page'] : 1 ;
            if (isset($_POST['category']))
            {
                $this->posts = $this->model-> getPostByCategoryId ($_POST['category']);
            } else {
                $this->posts = $this->model->getAll($currentPage, 5);
            }
        } else {
            $this->addInfoMessage("There are no posts.");
            $this->posts = [];
        }
    }

    public function create()
    {
        $this->categories=$this->model->getAllCategories();
        $defaultCategoryID = $this->model->getOthersCategoryId();
        if ($this->isPost) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = ($_POST['category']) ? $_POST['category'] : $defaultCategoryID['id'] ;
            if (strlen($title) == 0) {
                $this->setValidationError("title", "Title cannot be empty!");
            }
            if (strlen($content) == 0) {
                $this->setValidationError("content", "Content cannot be empty!");
            }
            if ($this->formValid()) {
                $user_id = $_SESSION['userId'];
                $postId = $this->model->create($title, $content, $user_id, $category_id);
                if($postId) {
                    if ($_FILES["fileToUpload"]['size'] > 0) {
                        $uploadResult = $this->uploadFile();
                        if ($uploadResult !== false) {
                            $this->model->insertPostPicture($postId, $uploadResult);
                        }
                    }
                    $this->addInfoMessage("Post created successfully.");
                    $this->redirect('posts');
                } else {
                    $this->addErrorMessage("Cannot create post!");
                }
            }
        }

    }

    public function edit(int $id)
    {
        $this->categories=$this->model->getAllCategories();
        $defaultCategoryID = $this->model->getOthersCategoryId();
        if ($this->model->getUserIdByPostId($id)!=intval($_SESSION['userId'])){
            $this->addErrorMessage("You cannot edit this post!");
            $this->redirect('posts');
            }
        if($this->isPost){
            $category_id = ($_POST['category']) ? $_POST['category'] : $defaultCategoryID['id'] ;
            $title = $_POST['title'];
            if(strlen($title) < 1){
                $this->setValidationError("title", "This field cannot be empty!");
            }
            $content = $_POST['content'];
            if(strlen($content) < 1){
                $this->setValidationError("content", "This field cannot be empty!");
            }

            if($this->formValid()){
                if($this->model->edit($id,$title,$content,$category_id)){
                    $this->addInfoMessage("Post edited successfully.");
                }
                else{
                    $this->addErrorMessage("Post can not be edited!");
                }
                $this->redirect('posts');
            }
        }

        $post = $this->model->getById($id);
        if(!$post){
            $this->addErrorMessage("The post you are trying to edit does not exist.");
            $this->redirect('posts');
        }
        $this->post = $post;
    }

    public function delete(int $id)
    {
        if ($this->model->getUserIdByPostId($id)!=intval($_SESSION['userId'])){
            $this->addErrorMessage("You cannot delete this post!");
            $this->redirect('posts');
        }
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
            $arrayId = [$postId];
            $content = $_POST['comment'];
            if (strlen($content) == 0) {
                $this->addErrorMessage("Comment cannot be empty!");
                $this->redirect('posts','view_post',$arrayId);
            }
            if ($this->formValid()) {
                $user_id = $_SESSION['userId'];
                $this->addInfoMessage("You have commented successfully!");
                $this->model->create_comment($content, $user_id, $postId);
                $this->redirect('posts','view_post',$arrayId);
            }
        }

    }

    public function deleteComment(int $postId, int $commentId)
    {
        $postIdArray = [$postId];
        if($this->model->getUserIdByCommentId($commentId)!=intval($_SESSION['userId'])) {
            $this->addErrorMessage("You cannot delete this comment!");
            $this->redirect('posts','view_post',$postIdArray);
        }
        if ($this->model->deleteComment($commentId)) {
            $this->addInfoMessage("Comment was deleted successfully.");
        } else {
            $this->addErrorMessage("Comment cannot be deleted!");
        }

        $this->redirect('posts','view_post',$postIdArray);
    }

     private function uploadFile()
     {
         $target_dir = "content/uploads/";
         $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
         $uploadOk = 1;
         $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
         if (isset($_POST["submit"])) {
             $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
             if ($check !== false) {
                 $this->addInfoMessage("File is an image - " . $check["mime"] . ".");
                 $uploadOk = 1;
             } else {
                 $this->addErrorMessage("File is not an image.");
                 $this->redirect('posts','create');
                 $uploadOk = 0;
             }
         }
// Check if file already exists
         if (file_exists($target_file)) {
             $this->addErrorMessage("Sorry, file already exists.");
             $this->redirect('posts','create');
             $uploadOk = 0;
         }
// Check file size
         if ($_FILES["fileToUpload"]["size"] > 500000000) {
             $this->addErrorMessage("Sorry, your file is too large.");
             $this->redirect('posts','create');
             $uploadOk = 0;
         }
// Allow certain file formats
         if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
             && $imageFileType != "gif"
         ) {
             $this->addErrorMessage("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
             $this->redirect('posts','create');
             $uploadOk = 0;
         }
// Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
              $this->addErrorMessage("Sorry, your file was not uploaded.");
             $this->redirect('posts','create');
// if everything is ok, try to upload file
         } else {
             if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                 $this->addInfoMessage("The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.");
                 $result = $target_file;
               //  $this->redirect('posts','create');
             } else {
                 $this->addErrorMessage("Sorry, there was an error uploading your file.");
                 $this->redirect('posts','create');
                 $result = false;
             }
         }

         return $result;
     }
}