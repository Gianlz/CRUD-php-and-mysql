<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM contatos_crud WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $sobrenome = $row["sobrenome"];
                $telefone = $row["telefone"];
                $email = $row["email"];
                $idade = $row["idade"];
                $data_nasc = $row["data_nasc"];
                $social = $row["social"];
                $parente = $row["parente"];
                $sexo = $row["sexo"];
                $onde = $row["onde"];
                $cidade = $row["cidade"];
                $estado = $row["estado"];
                $hobby = $row["hobby"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Error.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informações</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Informações</h1>
                    <div class="form-group">
                        <label>Nome</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Sobrenome</label>
                        <p><b><?php echo $row["sobrenome"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <p><b><?php echo $row["telefone"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Idade</label>
                        <p><b><?php echo $row["idade"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Nascimento</label>
                        <p><b><?php echo  $row["data_nasc"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Social</label>
                        <p><b><?php echo $row["social"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Parente</label>
                        <p><b><?php echo $row["parente"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Sexo</label>
                        <p><b><?php echo $row["sexo"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Onde conheceu</label>
                        <p><b><?php echo $row["onde"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Cidade</label>
                        <p><b><?php echo $row["cidade"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <p><b><?php echo $row["estado"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Hobby</label>
                        <p><b><?php $row["hobby"]; ?></b></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>