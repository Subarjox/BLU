<?php
require 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
    // Keep track POST values
    $id = $_POST['id_device'];

    $myObj = (object)array();

    // Connect to database
    $pdo = Database::connect();

    // Select query for the table
    $sql = 'SELECT * FROM read_data WHERE id_device = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Assigning data from the row to JSON object
        $myObj->id = $row['id_device'];
        $myObj->tds = $row['tds'];
        $myObj->turbidity = $row['turbidity'];
        $myObj->ph = $row['ph'];

        // Encode and output JSON
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }

    Database::disconnect();
}
?>
