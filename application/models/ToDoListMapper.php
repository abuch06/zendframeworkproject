<?php

class Application_Model_ToDoListMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_ToDoList');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_ToDoList $todolist)
    {
        $data = array(
            'itemnum'   => $todolist->getItemnum(),
            'task' => $todolist->getTask(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $todolist->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_ToDoList $todolist)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $todolist->setId($row->id)
            ->setItemnum($row->itemnum)
            ->setTask($row->task)
            ->setCreated($row->created);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_ToDoList();
            $entry->setId($row->id)
                ->setItemnum($row->itemnum)
                ->setTask($row->task)
                ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function removeItem($itemnum)
    {
        $row = $this->getDbTable()->fetchRow('itemnum = ' . $itemnum);
        $row->delete();
    }
}

