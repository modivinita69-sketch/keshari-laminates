<?php

$dsn = "mysql:host=localhost;dbname=keshari_laminates";
$username = "root";
$password = "password";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'theme_settings'");
    $tableExists = $stmt->rowCount() > 0;
    
    echo "Theme Settings Table exists: " . ($tableExists ? "Yes\n" : "No\n");
    
    if ($tableExists) {
        // Check table structure
        $stmt = $pdo->query("DESCRIBE theme_settings");
        echo "\nTable Structure:\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "{$row['Field']} - {$row['Type']}\n";
        }
        
        // Check table contents
        $stmt = $pdo->query("SELECT * FROM theme_settings WHERE `group` = 'colors'");
        echo "\nTheme Settings:\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "{$row['key']}: {$row['value']}\n";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}