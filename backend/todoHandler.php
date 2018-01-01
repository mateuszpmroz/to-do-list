<?php
require_once 'ToDo.php';
$text = $_POST['text'];
$id = $_POST['id'];
$status = $_POST['status'];
if ($status == 'true') $status = true;
else if ($status == 'false') $status == false;

$delete = $_POST['delete'];
$ToDo = new ToDo();


if ((isset($text)) && ($text <= 40)) {
    $ToDo->create($text);
}
if (isset($delete)) {
    $ToDo->delete($id);
}
if (!empty($status)) {
    $ToDo->update($id, $status);
}