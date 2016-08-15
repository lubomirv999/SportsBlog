<?php

class HomeController extends BaseController
{
    function index()
    {
        $lastPosts = $this->model->getLastPosts(5);
        $this->posts = array_slice($lastPosts, 0, 3);
        $this->sidebarPosts = $lastPosts;
    }

    function view($id)
    {
////<<<<<<< HEAD
//        // TODO: Load a post to be displayed here ...
//        $this->post = $this->model-> getPostById($id);
//=======
//       $this->post = $this->model-> getPostById($id);
//>>>>>>> origin/master
//    }
    }
}
