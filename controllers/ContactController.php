<?php

class ContactController extends BaseController
{
    public function send()
    {
        if ($this->isPost)
        {
            $content = $_POST['content'];
            if(strlen($content) ==0) {
                $this->setValidationError("content", "Content cannot be empty!");
            }
            if($this->formValid())
            {
                $user_id = $_SESSION['userId'];
                $this->addInfoMessage("Thank you for your feedback! We will contact you as soon as possible.");
                return $this->model->send($content, $user_id);
            }
            else{
                $this->addErrorMessage("You can't leave a blank field.");
            }
        }
    }

    public function messages()
    {
        if($this->isAdmin) {
            $this-> contact = $this->model->listMessages();
        } else {
            $this->addErrorMessage("Not Authorized!");
            $this->redirect("home");
        }
    }

    public function deleteContact($id)
    {

        if($this->model->deleteContact($id)){
            $this->addInfoMessage("Message was deleted successfully.");
            $this->redirect('contact','messages');
        } else{
            $this->addInfoMessage("Message cannot be deleted.");
        }
    }
}