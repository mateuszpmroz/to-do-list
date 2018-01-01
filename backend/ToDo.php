<?php
require 'DatabaseInstance.php';

/**
 * Contains functions, that create, read, update and delete our tasks in database
 */
class ToDo
{

    /**
     * Get connection with database
     */
    public function __construct()
    {
        $this->instance = DatabaseInstance::getInstance()->getConnection();
    }

    /**
     * Save new task in database
     *
     * @param $text
     */
    public function create($text)
    {
        $statement = $this->instance->prepare("INSERT INTO `todolist`(`text`) VALUES (:text)");
        $statement->bindValue(':text', $text, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * Get array of tasks from database
     *
     * @return array
     */
    public function read()
    {
        $statement = $this->instance->query('SELECT * FROM ToDolist');
        return $statement->fetchAll();
    }

    /**
     * Update task, when we check the checkbox our uncheck it
     *
     * @param $id
     * @param $status
     */
    public function update($id, $status)
    {
        $statement = $this->instance->prepare("UPDATE `todolist` SET `status`=:status WHERE id=:id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':status', $status, PDO::PARAM_BOOL);
        $statement->execute();
    }

    /**
     * Deleting task from database
     *
     * @param $id
     */
    public function delete($id)
    {
        $statement = $this->instance->prepare("DELETE FROM `todolist` WHERE id=:id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

}