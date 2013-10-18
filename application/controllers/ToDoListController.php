<?php

class ToDoListController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $todolist = new Application_Model_ToDoListMapper();
        $this->view->entries = $todolist->fetchAll();
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_ToDoList();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_ToDoList($form->getValues());
                $mapper  = new Application_Model_ToDoListMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }
    public function doneAction ()
    {
        $request = $this->getRequest();

        $item_to_delete = $request->getParam('itemnum');
        $mapper    = new Application_Model_ToDoListMapper();
        $mapper->removeItem($item_to_delete);
        return $this->_helper->redirector('index');

    }


}



