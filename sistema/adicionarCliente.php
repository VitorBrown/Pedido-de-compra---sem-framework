<?php
  
  include('layout/header.php');

?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Cliente</h1>

          <form id='formProduto'>
            <input type='hidden' name='action' value='listarTodos'/>
          </form>

          <div id='background' class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="p-5">
              <p id='titulo'>Adicionar Cliente</p>
          
            <div class="row">

              <div class="col-lg-12 d-none d-lg-block">
                <div class="p-5">
                    
                <form id="formCliente">
                <input type='hidden' name='action' value='criar'>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name='nome' class="form-control form-control-user" placeholder="Escreva seu nome">
                  </div>
                  <div class="col-sm-6">
                    <input type="email" name='email' class="form-control form-control-user" placeholder="Escreva seu email">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="email" name='email' class="form-control form-control-user" placeholder="Escreva seu email">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" id='senha' name='senha' class="form-control form-control-user" placeholder="Digite a nova senha">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" id='senha2' class="form-control form-control-user" placeholder="Digite novamente a senha">
                  </div>
                </div>
                <a href="#" onclick='adicionarCliente()' class="btn btn-primary btn-block">
                  Adiciona novo cliente
                </a>
              </form>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        </div>
        <!-- /.container-fluid -->

        <script src="../js/clienteAjax.js"></script>
    <script>
       function adicionarCliente(){
         Cliente();
       }
    </script>
    
<?php 
    include_once('layout/footer.php');
?>