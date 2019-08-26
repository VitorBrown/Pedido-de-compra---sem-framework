$(document).ready(function(){
     carregarCompra(1);
     carregarCompra(2);
});

function cuCompra(){

     $.ajax({
          url : "../php/includes/ajax/Compra.php",
          type : 'post',
          data :  $('#formCompra').serialize(),
  
          beforeSend : function(){
  
               $("#resultado").html("ENVIANDO...");
  
          }
          }).done(function(msg){
  
              alert(msg);
              carregarCompra();
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
}

function drCompra(action, id){
     $.ajax({
          url : "../php/includes/ajax/Compra.php",
          type : 'post',
          data :  {
               'action':action,
               'id':id
          }     
          ,
  
          beforeSend : function(){
  
               $("#resultado").html("ENVIANDO...");
  
          }
          }).done(function(msg){
  
              alert(msg);

              carregarCompra();
  
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
}

function carregarCompra(tipo){
     $.ajax({
          url : "../php/includes/ajax/Compra.php",
          type : 'get',
          data :  {
               'action':'listarTodos',
               'tipo':tipo
          } 
          ,beforeSend : function(){
  
               $("#resultado").html("Carregando...");
  
          }
          }).done(function(compra){
               var html = '';
               if(tipo == 1){
                    $('#compra').fadeOut();
               }

               if(tipo == 2){
                    $('#pedido').fadeOut();
               }
             
               $.each(JSON.parse(compra), function( key, dado ) {

               html +='<li class="list-group-item">';
               html +=' <p>Numero do pedido: <b>'+dado.compra_id+'</b></p>';
               html +=' <p>Nome: <b>'+dado.produto_nome+'</b>, Categoria: <b>'+dado.categoria_nome+'</b>, '; 
               html +='Preco: <b>'+dado.preco+'</b> Quantidade: <b>'+dado.quantidade+'</b> Preco: <b>'+dado.preco+'</b>, ';
               if(tipo == 2 && dado.status == 'Em Aberto'){
                    html +='Status: <a href="#" title="Clique aqui para alterar o status do pedido" ';
                    html +='data-toggle="modal" onclick="editarCompra(this)" data-status="'+dado.status+'" data-target="#statusModal"';
                    html +='data-quantidade="'+dado.quantidade+'"';
                    html +='data-compra_id="'+dado.compra_id+'"';
                    html +='data-produto_id="'+dado.produto_id+'" > <b>'+dado.status+'</b></a>,';
               }else{
                    html +='Status: <b>'+dado.status+'</b>,';
               }
               html +=' Pedido feito em: <b>'+dado.criado_em+'</b></p>';
               html +='</li>';
          
               });
               if(tipo == 1){
                    $('#compra').html(html); 
                    $('#compra').fadeIn();
               }
               if(tipo == 2){
                    $('#pedido').html(html); 
                    $('#pedido').fadeIn();
               }
                
  
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
     }
   
   
   function editarCompra(a){

     var compra_id = a.getAttribute('data-compra_id');
     var produto_id = a.getAttribute('data-produto_id');
     var status = a.getAttribute('data-status');
     var quantidade = a.getAttribute('data-quantidade');

     $('#compra_id').val(compra_id);
     $('#produto_id').val(produto_id);
     $('#status').text(status);
     $('#quantidade').val(quantidade);

   }
 
   function adicionarCompraEdit(){
     $('#compra_id').val('');
     $('#produto_id').val('');
     $('#status').text('');
     $('#quantidade').val('');

   }
 
   function excluirCompra(a){
     var id = a.getAttribute('data-id');
     
     var excluir = confirm('Excluir Compra?');
 
     if(excluir){
       drCompra('apagar', id)
     }
   }
 
   $('#botaoCompra').click(function(){
          cuCompra();
          adicionarCompraEdit();

   });

   $('#botaoCompraProduto').click(function(){
     cuCompra();
});