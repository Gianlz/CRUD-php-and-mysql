<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name  = $sobrenome = $telefone = $email = $idade = $data_nasc = $social = $parente = $sexo = $onde = $cidade = $estado = $hobby = "";
$name_err  = $sobrenome_err = $telefone_err = $email_err = $idade_err = $data_nasc_err = $social_err = $parente_err = $sexo_err = $onde_err = $cidade_err = $estado_err =  $hobby_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Digite um nome.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Entre um nome válido.";
    } else{
        $name = $input_name;
    }

    //Validade surname
    $input_sobrenome = trim($_POST["sobrenome"]);
    if(empty($input_sobrenome)){
        $sobrenome_err = "Por favor digite um sobrenome.";
    } elseif(!filter_var($input_sobrenome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $sobrenome_err = "Entre um sobrenome válido.";
    } else{
        $sobrenome = $input_sobrenome;
    }


    // Validate telefone
    $input_telefone = trim($_POST["telefone"]);
    if(empty($input_telefone)){
        $telefone_err = "Insira seu telefone.";     
    } elseif(!ctype_digit($input_telefone)){
        $telefone_err = "Insira um inteiro positivo.";
    } else{
        $telefone = $input_telefone;
    }

    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Por favor digite um email.";
    } elseif(!filter_var($input_email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s_@.]+$/")))){
        $email_err = "Entre um email válido.";
    } else{
        $email = $input_email;
    }

    // Validade nasc
    $input_data_nasc = trim($_POST["data_nasc"]);
    if(empty($input_data_nasc)){
        $data_nasc_err = "Please enter an data_nasc.";     
    } else{
        $data_nasc = $input_data_nasc;
    }
    // Validade idade
    $input_idade = trim($_POST["idade"]);
    if(empty($input_idade)){
        $idade_err = "Insira seu telefone.";     
    } elseif(!ctype_digit($input_idade)){
        $idade_err = "Insira um inteiro positivo.";
    } else{
        $idade = $input_idade;
    }
    // Validate social

    $input_social = trim($_POST["social"]);
    if(empty($input_social)){
        $social_err = "Digite sua rede social.";
    } elseif(!filter_var($input_social, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s_@]+$/")))){
        $social_err = "Entre uma rede social válida.";
    } else{
        $social = $input_social;
    }

    // Validate Parente
    $input_parente = trim($_POST["parente"]);
    if(empty($input_parente)){
        $parente_err = "Digite parentesco.";
    } elseif(!filter_var($input_parente, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $parente_err = "Entre um parentesco válido.";
    } else{
        $parente = $input_parente;
    }

    // Validate Sexo
    $input_sexo = trim($_POST["sexo"]);
    if(empty($input_sexo)){
        $sexo_err = "Digite um sexo.";
    } elseif(!filter_var($input_sexo, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $sexo_err = "Entre um sexo válido.";
    } else{
        $sexo = $input_sexo;
    }

    // Validade onde conheceu

    $input_onde = trim($_POST["onde"]);
    if(empty($input_onde)){
        $onde_err = "Digite o local.";
    } elseif(!filter_var($input_onde, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $onde_err = "Entre um local valido.";
    } else{
        $onde = $input_onde;
    }

    // Validate Cidade
    $input_cidade = trim($_POST["cidade"]);
    if(empty($input_cidade)){
        $cidade_err = "Digite uma cidade.";
    } elseif(!filter_var($input_cidade, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $cidade_err = "Entre uma cidade válida.";
    } else{
        $cidade = $input_cidade;
    }

    // Validade Estado

    $input_estado = trim($_POST["estado"]);
    if(empty($input_estado)){
        $estado_err = "Digite um estado.";
    } elseif(!filter_var($input_estado, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $estado_err = "Entre um estado válido.";
    } else{
        $estado = $input_estado;
    }

    // Validate Hobby
    $input_hobby = trim($_POST["hobby"]);
    if(empty($input_hobby)){
        $hobby_err = "Digite um hobby.";
    } elseif(!filter_var($input_hobby, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $hobby_err = "Entre um hobby válido.";
    } else{
        $hobby = $input_hobby;
    }

    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($sobrenome_err) && empty($telefone_err) && empty($email_err) && empty($idade_err)&& empty($data_nasc_err)&& empty($social_err) && empty($parente_err) && empty($sexo_err) 
    && empty($onde_err) && empty($cidade_err) && empty($estado_err) && empty($hobby_err)){
        // Prepare an update statement
        $sql = "UPDATE contatos_crud SET name=:name, sobrenome=:sobrenome, telefone=:telefone, email=:email, idade=:idade, data_nasc=:data_nasc, social=:social, parente=:parente, sexo=:sexo, onde=:onde, cidade=:cidade, estado=:estado, hobby=:hobby WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":sobrenome", $param_sobrenome);
            $stmt->bindParam(":telefone", $param_telefone);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":idade", $param_idade);
            $stmt->bindParam(":data_nasc", $param_data_nasc);      
            $stmt->bindParam(":social", $param_social);
            $stmt->bindParam(":parente", $param_parente);
            $stmt->bindParam(":sexo", $param_sexo);
            $stmt->bindParam(":onde", $param_onde);
            $stmt->bindParam(":cidade", $param_cidade);
            $stmt->bindParam(":estado", $param_estado);
            $stmt->bindParam(":hobby", $param_hobby);
            
            
            // Set parameters
            $param_id = $id;
            $param_name = $name;
            $param_sobrenome = $sobrenome;
            $param_telefone = $telefone;
            $param_email = $email;
            $param_idade = $idade;
            $param_data_nasc = $data_nasc;
            $param_social = $social;
            $param_parente = $parente;
            $param_sexo = $sexo;
            $param_onde = $onde;
            $param_cidade = $cidade;
            $param_estado = $estado;
            $param_hobby = $hobby;
            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Error.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM contatos_crud WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
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
                    <h2 class="mt-5">Update de Cadastro</h2>
                    <p>Editar valores no cadastro.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" maxlength="100" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Sobrenome</label>
                            <input type="text" name="sobrenome" maxlength="45" class="form-control <?php echo (!empty($sobrenome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sobrenome; ?>">
                            <span class="invalid-feedback"><?php echo $sobrenome_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="number" name="telefone" class="form-control <?php echo (!empty($telefone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefone; ?>">
                            <span class="invalid-feedback"><?php echo $telefone_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <!-- type email not working -->
                            <input type="text" name="email" maxlength="45" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>data_nasc</label>
                            <input type="date" name="data_nasc" class="form-control <?php echo (!empty($data_nasc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $data_nasc; ?>">
                            <span class="invalid-feedback"><?php echo $data_nasc_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Idade</label>
                            <input type="number" name="idade" class="form-control <?php echo (!empty($idade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $idade; ?>">
                            <span class="invalid-feedback"><?php echo $idade_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Social</label>
                            <input type="text" name="social" maxlength="45" class="form-control <?php echo (!empty($social_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $social; ?>">
                            <span class="invalid-feedback"><?php echo $social_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Parente</label>
                            <input type="text" name="parente" placeholder="Sim ou Nao" maxlength="3" class="form-control <?php echo (!empty($parente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $parente; ?>">
                            <span class="invalid-feedback"><?php echo $parente_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Sexo</label>
                            <input type="text" name="sexo" maxlength="1" placeholder="M ou F" class="form-control <?php echo (!empty($sexo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sexo; ?>">
                            <span class="invalid-feedback"><?php echo $sexo_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Onde Conheceu</label>
                            <input type="text" name="onde" maxlength="100" class="form-control <?php echo (!empty($onde_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $onde; ?>">
                            <span class="invalid-feedback"><?php echo $onde_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" name="cidade" maxlength="100" class="form-control <?php echo (!empty($cidade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cidade; ?>">
                            <span class="invalid-feedback"><?php echo $cidade_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text" name="estado" placeholder="ex: RS" minlength="2" maxlength="2" class="form-control <?php echo (!empty($estado_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $estado; ?>">
                            <span class="invalid-feedback"><?php echo $estado_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Hobby</label>
                            <input type="text" name="hobby" maxlength="100" class="form-control <?php echo (!empty($hobby_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hobby; ?>">
                            <span class="invalid-feedback"><?php echo $hobby_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>