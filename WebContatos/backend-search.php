<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'contatos');
 
// Conexão mysql
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // PDO exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Não pode fazer a conexão. " . $e->getMessage());
}
 
// Attempt search query execution
try{
    if(isset($_REQUEST["term"])){
        // create prepared statement
        $sql = "SELECT * FROM contatos_crud WHERE id LIKE :term";
        $stmt = $pdo->prepare($sql);
        $term = $_REQUEST["term"] . '%';
        // bind parameters to statement
        $stmt->bindParam(":term", $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p>" . $row["name"] . "</p>";
                echo "<p>" . $row["sobrenome"] . "</p>";
                echo "<p>" . $row["telefone"] . "</p>";
                echo "<p>" . $row["email"] . "</p>";
                echo "<p>" . $row["data_nasc"] . "</p>";
                echo "<p>" . $row["idade"] . "</p>";
                echo "<p>" . $row["social"] . "</p>";
                echo "<p>" . $row["parente"] . "</p>";
                echo "<p>" . $row["sexo"] . "</p>";
                echo "<p>" . $row["onde"] . "</p>";
                echo "<p>" . $row["cidade"] . "</p>";
                echo "<p>" . $row["estado"] . "</p>";
                echo "<p>" . $row["hobby"] . "</p>";
            }
        } else{
            echo "<p>No matches found</p>";
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
?>