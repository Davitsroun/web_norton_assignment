<?php
/**
 * Execute SQL File
 * This script will execute the ecom (3).sql file to set up the database
 */

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ecom";
$sql_file = __DIR__ . "/ecom (3).sql";

echo "Executing SQL file...\n\n";

try {
    // Connect to MySQL server
    $conn = new mysqli($db_host, $db_user, $db_pass);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "\n");
    }
    
    echo "✓ Connected to MySQL server\n";
    
    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    if ($conn->query($sql) === TRUE) {
        echo "✓ Database '$db_name' ready\n";
    } else {
        die("Error creating database: " . $conn->error . "\n");
    }
    
    // Select the database
    $conn->select_db($db_name);
    echo "✓ Selected database '$db_name'\n";
    
    // Read SQL file
    if (!file_exists($sql_file)) {
        die("✗ SQL file not found: $sql_file\n");
    }
    
    echo "✓ Reading SQL file: " . basename($sql_file) . "\n";
    $sql_content = file_get_contents($sql_file);
    
    // Remove CREATE DATABASE and USE statements
    $sql_content = preg_replace('/CREATE DATABASE.*?;/i', '', $sql_content);
    $sql_content = preg_replace('/USE.*?;/i', '', $sql_content);
    
    // Split SQL file into individual queries
    // Better handling of multi-line statements and comments
    $lines = explode("\n", $sql_content);
    $queries = [];
    $current_query = "";
    
    foreach ($lines as $line) {
        $line = trim($line);
        
        // Skip comment lines
        if (empty($line) || 
            preg_match('/^--/', $line) || 
            preg_match('/^\/\*/', $line) ||
            preg_match('/^\*\/$/', $line) ||
            preg_match('/^SET SQL_MODE/i', $line) ||
            preg_match('/^SET time_zone/i', $line) ||
            preg_match('/^START TRANSACTION/i', $line) ||
            preg_match('/^COMMIT/i', $line) ||
            preg_match('/^\/\*!40101/i', $line) ||
            preg_match('/^\/\*!40101/i', $line)) {
            continue;
        }
        
        // Remove inline comments
        $line = preg_replace('/--.*$/', '', $line);
        
        $current_query .= " " . $line;
        
        // If line ends with semicolon, it's a complete query
        if (substr(rtrim($line), -1) === ';') {
            $query = trim($current_query);
            if (!empty($query) && strlen($query) > 5) {
                $queries[] = $query;
            }
            $current_query = "";
        }
    }
    
    // Add any remaining query
    if (!empty(trim($current_query))) {
        $queries[] = trim($current_query);
    }
    
    $success_count = 0;
    $error_count = 0;
    $errors = [];
    
    echo "\nExecuting " . count($queries) . " SQL queries...\n";
    
    foreach ($queries as $index => $query) {
        // Skip very short queries (likely empty or just whitespace)
        if (strlen(trim($query)) < 10) {
            continue;
        }
        
        // Execute query
        if ($conn->query($query) === TRUE) {
            $success_count++;
        } else {
            // Only report actual errors, not warnings about existing tables
            $error_msg = $conn->error;
            if (strpos($error_msg, 'already exists') === false && 
                strpos($error_msg, 'Duplicate') === false &&
                strpos($error_msg, 'Unknown table') === false) {
                $errors[] = "Query " . ($index + 1) . ": " . $error_msg;
                $error_count++;
            }
        }
    }
    
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "Execution Summary:\n";
    echo "✓ Successful queries: $success_count\n";
    if ($error_count > 0) {
        echo "✗ Errors: $error_count\n";
        foreach ($errors as $error) {
            echo "  - $error\n";
        }
    } else {
        echo "✓ No errors encountered\n";
    }
    echo str_repeat("=", 50) . "\n";
    
    // Verify tables were created
    $tables_result = $conn->query("SHOW TABLES");
    $table_count = $tables_result->num_rows;
    echo "\n✓ Database '$db_name' now contains $table_count table(s):\n";
    while ($row = $tables_result->fetch_array()) {
        echo "  - " . $row[0] . "\n";
    }
    
    echo "\n✅ SQL file executed successfully!\n";
    echo "Your database is now ready to use.\n";
    
    $conn->close();
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
}
?>
