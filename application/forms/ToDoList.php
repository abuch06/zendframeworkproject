<?php

class Application_Form_ToDoList extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'itemnum', array(
            'label'      => 'Your item number:',
            'required'   => true,
            'filters'    => array('StringTrim'),
        ));

        // Add the comment element
        $this->addElement('textarea', 'task', array(
            'label'      => 'Add a task:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 200))
            )
        ));


        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add Task',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }

}

