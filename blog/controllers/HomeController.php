<?php

class HomeController extends BaseController
{
    function index() {
        $lastPosts = $this -> model -> getLastPosts(5);
        $this -> posts = array_slice($lastPosts,0,3);
        $this -> slidebarPosts = $lastPosts;
    }
	
	function view($id) {
        // TODO: Load a post to be displayed here ...
    }
}
