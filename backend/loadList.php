<?php
require 'ToDo.php';
$ToDo = new ToDo();
$list = $ToDo->read();
foreach ($list as $row) { ?>
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
<script>
    for (var i = 0; i < trash.length; i++) {
        trash[i].addEventListener("click", remove);
    }
    for (var i = 0; i < checkbox.length; i++) {
        checkbox[i].addEventListener("click", update);
    }
</script>