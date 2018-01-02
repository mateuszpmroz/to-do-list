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
     * Update task, when we check the checkbox or uncheck it
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

    /**
     * Checking if table already exist and insert some data
     */
    public function check()
    {
        $query = $this->instance->query("SELECT 1 FROM todolist LIMIT 1");
        if (!$query) {
            $statement = $this->instance->prepare("CREATE TABLE IF NOT EXISTS todolist 
(id int(11) auto_increment NOT NULL PRIMARY KEY,text varchar(40) COLLATE utf8_polish_ci NOT NULL,
status tinyint(1) NOT NULL DEFAULT '0') ");
            $statement->execute();
                $statement = $this->instance->prepare("INSERT INTO todolist ( `text`, `status`) 
VALUES ('Make a new post about...', 1), ('Proof read the new post.', 0), 
('Publish new post.', 0), ('Make research for tomorrows post.', 0), 
('Take the day off.', 1), ('Go to bed.', 1)");
                $statement->execute();
        }
    }
}
