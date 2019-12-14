<?php
    $conn = new mysqli("localhost", "mtapia", "MiguelTapia", "mtasker");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    // Getting raw data from post
    $json = file_get_contents("php://input");
    $postObj = json_decode($json);
    $taskID = $postObj -> taskToRemove;

    $sql = "DELETE FROM task_list WHERE task_id = $taskID;";

    $conn -> query($sql);

    $conn -> close();

    $success = array("Success" => "Task Deleted");
    $responseJSON = json_encode($success);
    echo $responseJSON;
?>