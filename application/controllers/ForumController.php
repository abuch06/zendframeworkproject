<?php

class ForumController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $forum = new Application_Model_ForumMapper();
        $this->view->entries = $forum->fetchAll();
    }

    public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Forum();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Forum($form->getValues());
                $mapper  = new Application_Model_ForumMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}



