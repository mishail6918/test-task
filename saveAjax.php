<?php
var_dump($_POST);
$link = mysqli_connect("localhost", "mysql", "mysql", "checklist_test");
$query = 'SELECT * FROM `checklist` ORDER BY `user_id` DESC';
$result = $link->query($query);
while ($data = mysqli_fetch_array($result)) {
    var_export($data['user_id']);
}
//Сохраняем родительский элемент, если есть, и его дочерние
if (isset($_POST['item_name'])) {
    $check = $_POST['item_name'][0]['value'];
    $id = $_POST['user_id'];
    $item_id = $_POST['item_id'];
    $sql = "UPDATE checklist SET item_name = '$check' WHERE user_id = '$id' and item_id = '$item_id'";
    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $link->error;
    }

    foreach ($_POST["item_child_ar"] as $key => $child) {
        $child_check = $child[0]['value'];
        $key++;
        $sql = "UPDATE checklist SET item_child" . $key ." = '$child_check' WHERE user_id = '$id' and item_id = '$item_id'";
        if ($link->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error;
        }
    }
}

//Сохраняем дочерний элемент, если был отмечен только он
if (isset($_POST['item_child'])) {
    $id = $_POST['user_id'];
    $item_id = $_POST['item_id'];
    if (is_array($_POST["item_child"])) {
        $child_check_val = $_POST['item_child'][0]['value'];
        $item_key = $_POST['item_child'][0]['name'];
        $item_key = substr($item_key, -1);
    }
    else {
        $child_check_val = $_POST['item_child'];
        $item_key = $_POST['item_child_id'];
        $item_name = $_POST['item_name_change'];
        $sql = "UPDATE checklist SET item_name = '$item_name' WHERE user_id = '$id' and item_id = '$item_id'";
        if ($link->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error;
        }
    }
    $sql = "UPDATE checklist SET item_child" . $item_key ." = '$child_check_val' WHERE user_id = '$id' and item_id = '$item_id'";
    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $link->error;
    }
}