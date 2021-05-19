<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CKEditor 5 – Showing content</title>
 
 
    </head>
    <body>
        <?php
            $mysqli = new mysqli("localhost", "root", "admin123", "tecnoticos");
            if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                exit();
            }
    
            $sql = "SELECT content FROM editor where id = 10";
            echo "<h2>Displaying content from database</h2>";
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                    printf($row[0]);
                }
            }
            $mysqli->close();
        ?>
    </body>
</html>