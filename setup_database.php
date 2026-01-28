<?php
/**
 * Database Setup Script
 * Run this file once to create the database and import the SQL file
 * Access it via: http://localhost/asigment/furniture_store_ecommerce/setup_database.php
 */

// Database configuration
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ecom";
$sql_file = __DIR__ . "/ecom (3).sql";

echo "<h2>Database Setup Script</h2>";
echo "<p>Setting up database...</p>";

try {
    // Connect to MySQL server (without selecting a database)
    $conn = new mysqli($db_host, $db_user, $db_pass);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo "<p>✓ Connected to MySQL server</p>";
    
    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    if ($conn->query($sql) === TRUE) {
        echo "<p>✓ Database '$db_name' created or already exists</p>";
    } else {
        die("Error creating database: " . $conn->error);
    }
    
    // Select the database
    $conn->select_db($db_name);
    echo "<p>✓ Selected database '$db_name'</p>";
    
    // Read and execute SQL file
    if (!file_exists($sql_file)) {
        die("<p style='color:red;'>✗ SQL file not found: $sql_file</p>");
    }
    
    echo "<p>Reading SQL file...</p>";
    $sql_content = file_get_contents($sql_file);
    
    // Remove CREATE DATABASE statement if it exists (we already created it)
    $sql_content = preg_replace('/CREATE DATABASE.*?;/i', '', $sql_content);
    $sql_content = preg_replace('/USE.*?;/i', '', $sql_content);
    
    // Split SQL file into individual queries
    $queries = array_filter(array_map('trim', explode(';', $sql_content)));
    
    $success_count = 0;
    $error_count = 0;
    
    echo "<p>Executing SQL queries...</p>";
    
    foreach ($queries as $query) {
        // Skip empty queries and comments
        if (empty($query) || preg_match('/^--/', $query) || preg_match('/^\/\*/', $query)) {
            continue;
        }
        
        // Execute query
        if ($conn->query($query) === TRUE) {
            $success_count++;
        } else {
            // Some errors are expected (like table already exists), so we'll log them
            if (strpos($conn->error, 'already exists') === false && 
                strpos($conn->error, 'Duplicate') === false) {
                echo "<p style='color:orange;'>⚠ Query warning: " . $conn->error . "</p>";
                $error_count++;
            }
        }
    }
    
    echo "<p>✓ Executed queries successfully</p>";
    echo "<p><strong>Setup completed!</strong></p>";
    echo "<p>You can now access your application at: <a href='index.php'>http://localhost/asigment/furniture_store_ecommerce/</a></p>";
    echo "<p style='color:red;'><strong>IMPORTANT: Delete this setup_database.php file for security reasons!</strong></p>";
    
    $conn->close();
    
} catch (Exception $e) {
    die("<p style='color:red;'>Error: " . $e->getMessage() . "</p>");
}
?>
