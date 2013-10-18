<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    protected function _initDoctype()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Application', // Or default
            'basePath' => APPLICATION_PATH //if APPLICATION_PATH is defined - else use 'basePath' => 'F:\xampp\htdocs\quickstart\application'
        ));
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

}
