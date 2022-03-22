<?php 
  //$acao = 'recuperar_pendentes';
  require_once "validador_acesso.php";
  require 'despesas_controller.php';

?>

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

    <script type="text/javascript">
      
      function checkValues(){
        
        let valor = document.getElementById('valor_despesa').value;

        if(isNaN(valor)){
          alert('Por favor inserir um valor válido');
          document.getElementById('valor_despesa').value = '';
        }

      }

      function checkDate(){
        let data = document.getElementById('data_despesa').value;
        let aux = false;

        //check for the pattern
        if(!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(data)){
          aux = true;
        }

        // Parse the date parts to integers
        var parts = data.split("-");
        var day = parseInt(parts[2], 10);
        var month = parseInt(parts[1], 10);
        var year = parseInt(parts[0], 10);

        // Check the ranges of month and year
        if(year < 1000 || year > 2022 || month == 0 || month > 12){
          aux = true;
        }

        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

        // Adjust for leap years
        if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)){
          monthLength[1] = 29;
        }

        // Check the range of the day
        if(day < 0 || day > monthLength[month - 1]){
          aux = true;
        }

        if(aux){
        alert('Por favor inserir uma data válida');
        }
      }

    </script>

	</head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
      <div class="container">
        <a class="navbar-brand" href="#">
           <img src="logo.png" width="50" height="35" alt="Orçamento pessoal">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Registo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="consulta.php">Consulta</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="logoff.php">SAIR</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>

    <!-- CASO EXISTA E CASO SEJA IGUAL A 1 -->
    <?php if(isset($_GET['inclusao']) && $_GET['inclusao'] == 1) { ?>
      <div class="container bg-success pt-2 text-white d-flex justify-content-center">
        <h5>Despesa inserida com sucesso!</h5>
      </div>
    <?php } else if(isset($_GET['inclusao']) && $_GET['inclusao'] == 2) { ?>
      <div class="container bg-danger pt-2 text-white d-flex justify-content-center">
        <h5>Despesa inserida sem sucesso! Todos os campos devem ser preenchidos.</h5>
      </div>
    <?php } ?>

    <div class="container">
      <div class="row mb-5">
        <div class="col">
          <h1 class="display-4">Registo de despesas</h1>
        </div>
      </div>
    </div>

    <div class="container">
      <h4>Nova despesa</h4>
      <hr>
      <!-- INICIO FORMULARIO -->
      <form class="row" method="post" action="despesas_controller.php?acao=inserir">
        
        <div class="col-md-4 form-group">
          <select class="form-control" id="tipo" name="tipo">
            <option value="">Tipo</option>
            <option value="1">Alimentação</option>
            <option value="2">Educação</option>
            <option value="3">Lazer</option>
            <option value="4">Transporte</option>
            <option value="5">Saúde</option>
            <option value="6">Outros</option>
          </select>
        </div>
        <div class="col-md-6 form-group">
          <input type="text" class="form-control" name="despesa" placeholder="Descrição da despesa">
        </div>
        <div class="col-md-4 form-group">
          <input id="data_despesa" type="text" class="form-control" name="data" placeholder="Ex: 2021-05-05" onblur="checkDate()">
        </div>
        <div class="col-md-4 form-group">
          <input id="valor_despesa" type="text" class="form-control" name="valor" placeholder="Valor €" onblur="checkValues()">
        </div>
        <div class="col-md-2 d-flex justify-content-end">
          <button class="btn btn-primary">Inserir</button>
        </div>
      </form>
    </div>

      

    <!-- Modal -->
    <div class="modal fade" id="modalRegistaDespesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div id="modal_titulo_div">
            <h5 class="modal-title" id="modal_titulo"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modal_conteudo" class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button id="modal_btn" type="button" data-dismiss="modal"></button>
          </div>
        </div>
      </div>
    </div>


  </body>	

</html>