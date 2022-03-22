<?php
  
  //$acao = 'recuperar';
  require_once "validador_acesso.php";
  $acao = isset($_GET['acao']) ? $_GET['acao'] : 'recuperar';
  require 'despesas_controller.php';

  /*echo '<pre>';
  print_r($despesas);
  echo '<pre>';*/

?>

<!DOCTYPE html>
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

      function editar(id, txt_tarefa, campoBD, coluna){
        //criar um form para editar tarefa
        let form = document.createElement('form')
        form.action = 'despesas_controller.php?acao=atualizar'
        form.method = 'post'

        //criar um input para entrada do texto
        let inputDespesa = document.createElement('input')
        inputDespesa.type = 'text'
        inputDespesa.name = 'valor'
        inputDespesa.className = 'form-control'
        inputDespesa.value = txt_tarefa

        //criar um input hidden para guardar o id da tarefa
        let inputId = document.createElement('input')
        inputId.type = 'hidden'
        inputId.name = 'id'
        inputId.value = id

        let inputCampo = document.createElement('input')
        inputCampo.type = 'hidden'
        inputCampo.name = 'campobd'
        inputCampo.value = campoBD

        //criar um button para o envio do form
        let button = document.createElement('button')
        button.type = 'submit'
        button.className = 'btn btn-sm btn-primary mt-1'
        button.innerHTML = 'Atualizar'
        
        //incluir o inputTarefa no form
        form.appendChild(inputDespesa)

        //incluir inputId no form
        form.appendChild(inputId)

        //incluir inputCampo no form
        form.appendChild(inputCampo)

        //incluir o button no form
        form.appendChild(button)

        //selecionar a div
        let campoEditado = ''
        if(coluna == 'coluna_data'){
          campoEditado = document.getElementById('data_edit_' + id)

        } else if(coluna == 'coluna_tipo'){
          campoEditado = document.getElementById('tipo_edit_' + id)

        } else if(coluna == 'coluna_descricao'){
          campoEditado = document.getElementById('descricao_edit_' + id)

        } else if(coluna == 'coluna_valor'){
          campoEditado = document.getElementById('valor_edit_' + id)
        }

        //limpar conteudo anterior da div tarefa
        campoEditado.innerHTML = ''

        //incluir o form na pagina
        campoEditado.insertBefore(form, campoEditado[0])

      }

      function remover(id){
        location.href = 'despesas_controller.php?acao=remover&id=' + id;
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
            <li class="nav-item">
              <a class="nav-link" href="home.php">Registo</a>
            </li>
            <li class="nav-item active">
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

    <div class="container">
      <div class="row mb-5">
        <div class="col">
          <h1 class="display-4">Consulta de despesas</h1>
        </div>
      </div>

      <!-- INICIO FORMULARIO -->
      <form class="container" method="post" action="consulta.php?acao=pesquisar">
        <div class="row mb-2">
          <div class="col-md-2 form-group">
            <select class="form-control" id="ano" name="ano">
              <option value="">Ano</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
            </select>
          </div>

          <div class="col-md-2 form-group">
            <select class="form-control" id="mes" name="mes">
              <option value="">Mês</option>
              <option value="01">Janeiro</option>
              <option value="02">Fevereiro</option>
              <option value="03">Março</option>
              <option value="04">Abril</option>
              <option value="05">Maio</option>
              <option value="06">Junho</option>
              <option value="07">Julho</option>
              <option value="08">Agosto</option>
              <option value="09">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
            </select>
          </div>
          
          <div class="col-md-2 form-group">
            <input type="text" class="form-control" placeholder="Dia" id="dia" name="dia" />
          </div>

          <div class="col-md-6 form-group">
            <select class="form-control" id="tipo" name="tipo">
              <option value="">Tipo</option>
              <option value="1">Alimentação</option>
              <option value="2">Educação</option>
              <option value="3">Lazer</option>
              <option value="5">Saúde</option>
              <option value="4">Transporte</option>
              <option value="6">Outros</option>
            </select>
          </div>
        </div>

        <div class="row  mb-5">
          <div class="col-md-8 form-group">
            <input type="text" class="form-control" placeholder="Descrição" id="descricao" name="descricao" />
          </div>

          <div class="col-md-2 form-group">
            <input type="text" class="form-control" placeholder="Valor" id="valor" name="valor" />
          </div>

          <div class="col-md-2 d-flex justify-content-end">
            <button class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <div class="row">
        <div class="col">
          <table class="table table-hover" id="tabela_despesas" >
            <thead>
              <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($despesas as $indice => $despesa){ 
                $total += $despesa->valor;
              ?>
                <tr>
                  <td>
                    <div id="data_edit_<?= $despesa->id ?>">
                      <i class="fas fa-edit fa-sm text-info mr-1" onclick="editar(<?= $despesa->id ?>, '<?= $despesa->data ?>', 'data_despesa', 'coluna_data')"></i>
                      <?= $despesa->data ?>
                    </div>
                  </td>
                  <td>
                    <div id="tipo_edit_<?= $despesa->id ?>">
                      <i class="fas fa-edit fa-sm text-info mr-1" onclick="editar(<?= $despesa->id ?>, '<?= $despesa->tipo ?>', 'id_tipo', 'coluna_tipo')"></i>
                      <?= $despesa->tipo ?>
                    </div>
                  </td>
                  <td>
                    <div id="descricao_edit_<?= $despesa->id ?>">
                      <i class="fas fa-edit fa-sm text-info mr-1" onclick="editar(<?= $despesa->id ?>, '<?= $despesa->despesa ?>', 'despesa', 'coluna_descricao')"></i>
                      <?= $despesa->despesa ?>
                    </div>
                  </td>
                  <td>
                    <div id="valor_edit_<?= $despesa->id ?>">
                      <i class="fas fa-edit fa-sm text-info mr-1" onclick="editar(<?= $despesa->id ?>, '<?= $despesa->valor ?>', 'valor', 'coluna_valor')"></i> 
                      <?= $despesa->valor ?>€
                    </div>
                  </td>
                  <td>
                    <i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $despesa->id ?>)"></i>
                  </td>
                </tr>
              <?php } ?>
                <tr class="bg-primary">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-white"><strong>Total: </strong><?= $total ?>€</td>
                  <td></td>
                </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>	

</html>