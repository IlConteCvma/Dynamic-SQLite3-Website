<?php
//connect to the DB
//connect to the server(server_name,server_user_id,server_user_password)
 
$dbFile = dirname(__FILE__).'/../../database-origin/test.db'; 
//echo $dbFile
$connection = new SQLite3($dbFile);
$connection->busyTimeout(5000);
if (!$connection) {
    die("Connection failed: " . $connection->lastErrorMsg());
}
//echo "DONE\n";
//$result = $connection->query('SELECT * FROM users');

//while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    // Process each row
  //  print_r($row);
//}

// Close the connection when done
//$connection->close();
?>
