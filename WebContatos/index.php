<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 1300px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Contatos</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar contatos</a>
                        <div class="search-box">
                            <input type="text" autocomplete="off" class="form-control  my-2" placeholder="Procurar por id..." />
                        <div class="result"></div>

                    </div>
                    <?php
                    // incluir config.php
                    require_once "config.php";
                    
                    // Tentativa de Query
                    $sql = "SELECT * FROM contatos_crud";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Sobrenome</th>";
                                        echo "<th>Telefone</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Nascimento</th>";
                                        echo "<th>Idade</th>";
                                        echo "<th>Rede S.</th>";
                                        echo "<th>Parentesco</th>";
                                        echo "<th>Sexo</th>";
                                        echo "<th>Onde conheceu</th>";
                                        echo "<th>Cidade</th>";
                                        echo "<th>Estado</th>";
                                        echo "<th>Hobby</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['sobrenome'] . "</td>";
                                        echo "<td>" . $row['telefone'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['data_nasc'] . "</td>";
                                        echo "<td>" . $row['idade'] . "</td>";
                                        echo "<td>" . $row['social'] . "</td>";
                                        echo "<td>" . $row['parente'] . "</td>";
                                        echo "<td>" . $row['sexo'] . "</td>";
                                        echo "<td>" . $row['onde'] . "</td>";
                                        echo "<td>" . $row['cidade'] . "</td>";
                                        echo "<td>" . $row['estado'] . "</td>";
                                        echo "<td>" . $row['hobby'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // remover resultados
                            unset($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Sem registro de contatos.</em></div>';
                        }
                    } else{
                        echo "Error.";
                    }
                    
                    // Fechar conexão
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>

    <!-- search -->
<script>
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("backend-search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });
        
        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>
</body>
</html>