<html>
	<head>
    <meta charset="utf-8" />
		<title>Orçamento pessoal</title>

		<!-- Bootstrap início -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Bootstrap fim -->

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
    </style>

    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
      <div class="container">
        <a class="navbar-brand" href="#">
           <img src="logo.png" width="50" height="35" alt="Orçamento pessoal">
           APP - Despesas
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h5>Login</h5>
            </div>
            <div class="card-body">
              
              <form action="valida_login.php" method="post">
                <div class="form-group">
                  <input name="user" type="text" class="form-control" placeholder="User">
                </div>
                <div class="form-group">
                  <input name="password" type="password" class="form-control" placeholder="Senha">
                </div>

                <?php if(isset($_GET['login']) && $_GET['login'] == 'erro') { ?>

                  <div class="text-danger">
                    Usuário ou senha inválido(s)
                  </div>

                <?php } ?>

                <?php if(isset($_GET['login']) && $_GET['login'] == 'erro2') { ?>

                  <div class="text-danger">
                    Faça login antes de aceder as páginas protegidas
                  </div>
                  
                <?php } ?>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    </body>   

</html>