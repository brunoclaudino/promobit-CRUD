<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PROMOBIT CRUD</title>
  </head>
  <body class="text-light" style="background-color: #adb5bd;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <div class="container-fluid">
        <h1 class="text-primary">promobit CRUD</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
    <div class="container">
        <main>
            <section clas="justify-content-center">
                <div class="card mx-auto" style="width: 25rem;">
                    <div class="card-body">
                        <form name="form"  method="post">
                            <input class="form-control" id="login" name="login" placeholder="Login"></input><br>
                            <input class="form-control" id="senha" name="senha" type="password" placeholder="Senha"></input><br>
                            <input class="form-control" id="btn_login" name="btn_login" type="submit"></input><br>
                        </form>
                    </div>
                </div>
                <?php
                    if(array_key_exists('btn_login', $_POST)) {
                        logar();
                    }
                    function logar(){
                        $login = $_POST['login'];
                        $senha_login = $_POST['senha'];

                        $servidor = "localhost";
                        $usuario = "root";
                        $senha = "";
                        $dbname = "promobit";

                        $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
                        $string_busca = "SELECT * FROM acess WHERE login = \"". $login . "\"";
                        $resultado = mysqli_fetch_assoc(mysqli_query($conn, $string_busca));
                        if($senha_login == $resultado['senha']){
                            header("Location: produtos.php");
                            exit();
                        }else{
                            echo '<script>alert("Acesso Negado")</script>';
                        }
                    }
                ?>

            </section>
            
        </main>