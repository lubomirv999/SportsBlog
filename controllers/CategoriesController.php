<?php


class CategoriesController extends BaseController
{
    public function listAllCategories ()
    {
        $this->categories=$this->model->getAllCategories();
    }
}