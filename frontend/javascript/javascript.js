document.getElementById("plus-icon").addEventListener("click", add);
var trash = document.getElementsByClassName("trash-icon");
var checkbox = document.getElementsByClassName("list__checkbox-input");
var validation = document.getElementById('validate');
/**
 * Helper function that add/remove class to dom elements
 * @param status
 */
function validate(status) {
    if (status == "Warning") {
        validation.classList.remove('alert-success');
        validation.classList.add('alert', 'alert-warning');
    } else if (status == "Success") {
        validation.classList.remove('alert-warning');
        validation.classList.add('alert', 'alert-success');
    }
}
/**
 * Function that create tasks
 *
 * When text input isn't empty and plus icon is clicked,
 * that function sends data by ajax to PHP file handler
 * and new task is being added to database
 */
function add() {
    var text = document.getElementById('text').value;
    if ((text.length > 41) || (text.length == 0)) {
        validate("Warning");
        validation.innerHTML = 'Liczba znaków nieprawidłowa!';
    } else {
        $.ajax({
            type: "POST",
            data: {
                text: text
            },
            url: "backend/todoHandler.php",
            success: function () {
                validate("Success");
                validation.innerHTML = 'Dodano zadanie!';
                document.getElementById('text').value = '';
                $.reload();
            }
        });

    }
}

/**
 * Function that remove tasks
 *
 * When trash icon is clicked, that function sends data
 * by ajax to PHP file handler
 */
function remove() {
    var id = this.closest('li').id;
    $.ajax({
        type: "POST",
        data: {
            id: id,
            delete: 1
        },
        url: "backend/todoHandler.php",
        success: function () {
            validate("Success");
            validation.innerHTML = 'Usunięto zadanie!';
            document.getElementById('text').value = '';
            $.reload();
        }
    });
}
for (var i = 0; i < trash.length; i++) {
    trash[i].addEventListener("click", remove);
}
/**
 * Function that update tasks
 *
 * When task checkbox is clicked, that function sends data
 * by ajax to PHP file handler
 */
function update() {
    var id = this.closest('li').id;
    var status = this.checked;
    if (status == true) {
        this.closest('li').classList.add('list__done');
    } else if (status == false) {
        this.closest('li').classList.remove('list__done');
    }
    $.ajax({
        type: "POST",
        data: {
            id: id,
            status: status,
        },
        url: "backend/todoHandler.php",
        success: function () {
            $.reload;
        }
    });
}
for (var i = 0; i < checkbox.length; i++) {
    checkbox[i].addEventListener("click", update);
}
/**
 * Function that reloads data in real time
 */
$(function () {
    $.reload = function () {
        $("#list-elements").load('backend/loadList.php')
    };
});
