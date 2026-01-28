<?php

// First connect to MySQL server without selecting a database
$server_conn = mysqli_connect("localhost", "root", "")
    or die("Couldn't connect to MySQL server");

// Check if database exists, if not create it
$db_name = "ecom";
$result = mysqli_query($server_conn, "SHOW DATABASES LIKE '$db_name'");
if (mysqli_num_rows($result) == 0) {
    // Database doesn't exist, create it
    mysqli_query($server_conn, "CREATE DATABASE `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci")
        or die("Error creating database: " . mysqli_error($server_conn));
    
    // Select the newly created database
    mysqli_select_db($server_conn, $db_name);
    
    // Check if SQL file exists and import it
    $sql_file = __DIR__ . "/../ecom (3).sql";
    if (file_exists($sql_file)) {
        $sql_content = file_get_contents($sql_file);
        // Remove CREATE DATABASE and USE statements
        $sql_content = preg_replace('/CREATE DATABASE.*?;/i', '', $sql_content);
        $sql_content = preg_replace('/USE.*?;/i', '', $sql_content);
        
        // Split and execute queries
        $queries = array_filter(array_map('trim', explode(';', $sql_content)));
        foreach ($queries as $query) {
            if (!empty($query) && !preg_match('/^--/', $query) && !preg_match('/^\/\*/', $query)) {
                mysqli_query($server_conn, $query);
            }
        }
    }
} else {
    // Database exists, select it
    mysqli_select_db($server_conn, $db_name);
}

// Now use the connection
$conn = $server_conn;

?>