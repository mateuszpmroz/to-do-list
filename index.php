<?php
require 'backend/ToDo.php';
$ToDo = new ToDo();
$this->instance->exec ("CREATE TABLE IF NOT EXIST 'todolist' (

  `id` int(11) NOT NULL PRIMARY KEY auto_increment,

  `text` varchar(40) COLLATE utf8_polish_ci NOT NULL,

  `status` tinyint(1) NOT NULL DEFAULT '0'

) ");
$this->instance->exec ("INSERT INTO `todolist` (`id`, `text`, `status`) VALUES

(0, 'Make a new post about...', 1),

(1, 'Proof read the new post.', 0),

(2, 'Publish new post.', 0),

(3, 'Make research for tomorrows post.', 0),

(4, 'Take the day off.', 1),

(5, 'Go to bed.', 1)

");
$list = $ToDo->read();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="frontend/css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-12">
    <div class="list">
        <div class="list__head">
            <span class="list__title-dbl-border">
                <span class="list__title">
                          ToDo List
                </span>
                </span>
        </div>
        <div class="list__body">
            <ul>
                <div id="list-elements">
                    <?php foreach ($list as $row) { ?>
                        <li id="<?php echo $row['id']; ?>" class="<?php if ($row['status']) echo 'list__done'; ?>">
                        <span class="list__checkbox">
                          <input class="list__checkbox-input" <?php if ($row['status']) echo 'CHECKED'; ?>
                                 type="checkbox">
                        </span>
                        <span class="list__text"><?php echo $row['text']; ?>
                        </span>
                          <span class="list__trash-icon">
                      <img class="trash-icon" src="assets/trash.png">
                          </span>
                        </li>
                    <?php } ?>
                </div>
                <li><span class="list__plus-icon">
                          <span id="plus-icon" class="glyphicon glyphicon-plus">
                          </span>
                    </span>
                    <span class="list__text">
                        <input type="text" id="text" maxlength="40" class="list__text-input"/>
                    </span>

                </li>

            </ul>
        </div>
    </div>
    <div id="validate"></div>
</div>
<script src="frontend/javascript/javascript.js"></script>
</body>
</html>
