<?php
  
  include('layout/header.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Compras</h1>

<div id='background' class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
  <div class="row">
    <div class="col-lg-6 col-sm-12">
      <div class="p-5">
          <div class="card">
          <div class="card-header">
            Compras
          </div>
          <ul id='compra' class="list-group list-group-flush">
          </ul>
        </div> 
      </div>
    </div>
    <div class="col-lg-6 col-sm-12">
      <div class="p-5">
      <div class="card">
        <div class="card-header">
          Pedidos
        </div>
        <ul id='pedido' class="list-group list-group-flush">
          
        </ul>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- /.container-fluid -->

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo"> </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

        <form id="formCompra">
                <input type='hidden' name='action' value='alterar'>
                <input type='hidden' id='compra_id' name='id' value=''>
                <input type='hidden' id='produto_id' name='produto_id' value=''>
                <input type='hidden' id='quantidade' name='quantidade' value=''>
                Status Atual do pedido: <span id='status'></span>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <select class='form-control form-control-user' name='status'>
                    <option value='1'>Pago</option>
                    <option value='0'>Cancelado</option>
                  </select>
                 </div>
                </div>
                <a id='botaoCompra' href="#" class="btn btn-success btn-block">
                  Alterar Status
                </a>
           </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" charset="utf-8" src='../js/compraAjax.js'></script>
    
<?php 
    include_once('layout/footer.php');
?>