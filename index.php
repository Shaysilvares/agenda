<?php
  include_once('conexao.php');


  $sql = "SELECT * FROM contatos";
  $result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agenda de Contatos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">    
</head>
<body style="background-color: #eeeeee;">

<div class="container">
  <div class="row">
    <!-- Contatos -->    
    <div class="col-sm-5">
      <div>
        <h3 class="text-center titulo">Contatos</h3>
      </div>
      <hr>
      <div class="adicionar">
        <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus-square"></i>
        </button>         
      </div>      
      <div class="contatos">
        <div class="contato">
          <div class="col-sm-5">
            <img src="http://via.placeholder.com/80x80" width="80" height="80" class="imagem-contato rounded-circle" />
          </div>
          <div class="col-sm-7 informacoes-contato">
         
          <?php

              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {

                ?>
                
                
                  <h5> <?php echo $row['nome'] ?>  </h5>            
                  <span> <?php echo $row['telefone'] ?>  </span>
                  </br>
                  <span>End.:</span>
                  <span> <?php echo $row['rua'] ?>  </span>                  
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar" 
                  data-id="<?php echo $row['id'] ?>" 
                  data-nome="<?php echo $row['nome'] ?>" 
                  data-telefone="<?php echo $row['telefone'] ?>" 
                  data-rua="<?php echo $row['rua'] ?>" 
                  data-numero="<?php echo $row['numero'] ?>" 
                  data-bairro="<?php echo $row['bairro'] ?>" 
                  data-cidade="<?php echo $row['cidade'] ?>">Editar</button>              

                  <a href="deletar.php?id=<?php echo $row['id'] ?> "> <button type="submit" class="btn btn-primary">Excluir</button> </a>
                                    
                  <hr>
                <?php

                }
              } else {
                echo "0 results";
              }              

          ?>            
          </div>                     
        </div>        
      </div>
    </div>  

    <!-- Mapa -->
    <div class="col-sm-7">
      <div>
        <h3 class="text-center titulo">Localização</h3>
      </div>
      <hr>
      <div class="mapa">
          <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d29432.171965324644!2d-43.42667433186035!3d-22.764583530947437!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1527123565616" width="630" height="690" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>      
    </div>
  </div>
</div>

<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar um Contato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="dao.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="nome" type="text" class="form-control col-sm-6" value="">                        
                      </div>
                      <div class="form-group">
                        <label>Telefone</label>
                        <input name="telefone" type="text" class="form-control col-sm-6">
                      </div>
                      <hr>
                      <h6 class="text-center">Endereço</h6>
                      <div class="form-row">                        
                          <div class="form-group col-md-8">                              
                              <label>Rua</label>
                              <input name="rua" type="text" class="form-control">
                          </div>
                          <div class="form-group col-md-4">                          
                              <label>Número</label>
                              <input name="numero" type="text" class="form-control">
                          </div>
                          <div class="form-group col-md-6">                          
                              <label>Bairro</label>
                              <input name="bairro" type="text" class="form-control">
                          </div>
                          <div class="form-group col-md-6">                          
                              <label>Cidade</label>
                              <input name="cidade" type="text" class="form-control">
                          </div>  
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </div>                                            
                </form>
              </div>              
            </div>
          </div>
        </div>

          <!-- Modal EDITAR -->
          <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar um Contato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="atualizar.php">
                              
                  <div class="form-group">                        
                      <input name="id" id="id" type="hidden" class="form-control col-sm-6">                                                
                  </div>  
                  <div class="form-group">
                        <label>Nome</label>
                        <input name="nome" id="nome" type="text" class="form-control col-sm-6">                        
                      </div>
                      <div class="form-group">
                        <label>Telefone</label>
                        <input name="telefone" id="telefone" type="text" class="form-control col-sm-6">
                      </div>
                      <hr>
                      <h6 class="text-center">Endereço</h6>
                      <div class="form-row">                        
                          <div class="form-group col-md-8">                              
                              <label>Rua</label>
                              <input name="rua" id="rua" type="text" class="form-control" >
                          </div>
                          <div class="form-group col-md-4">                          
                              <label>Número</label>
                              <input name="numero" id="numero" type="text" class="form-control" >
                          </div>
                          <div class="form-group col-md-6">                          
                              <label>Bairro</label>
                              <input name="bairro" id="bairro" type="text" class="form-control" >
                          </div>
                          <div class="form-group col-md-6">                          
                              <label>Cidade</label>
                              <input name="cidade" id="cidade" type="text" class="form-control" >
                          </div>  
                      </div>    
                                 
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                      </div>                                            
                </form>
              </div>              
            </div>
          </div>      
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    

  <script>  
      $('#modalEditar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var id = button.data('id')
      var nome = button.data('nome')
      var telefone = button.data('telefone')
      var rua = button.data('rua')
      var numero = button.data('numero')
      var cidade = button.data('cidade')
      var bairro = button.data('bairro')      
      
      var modal = $(this)      
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #nome').val(nome)
      modal.find('.modal-body #telefone').val(telefone)
      modal.find('.modal-body #rua').val(rua)
      modal.find('.modal-body #numero').val(numero)
      modal.find('.modal-body #cidade').val(cidade)
      modal.find('.modal-body #bairro').val(bairro)
      
    })
  </script>
</body>
</html>