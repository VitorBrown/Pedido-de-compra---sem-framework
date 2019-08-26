$(document).ready(function(){
     carregarProduto();
});

function cuProduto(){

     $.ajax({
          url : "../php/includes/ajax/Produto.php",
          type : 'post',
          data :  $('#formProduto').serialize(),
  
          beforeSend : function(){
  
               $("#resultado").html("ENVIANDO...");
  
          }
          }).done(function(msg){
  
              alert(msg);
              carregarProduto();
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
}

function drProduto(action, id){
     $.ajax({
          url : "../php/includes/ajax/Produto.php",
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

              carregarProduto();
  
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
}

function carregarProduto(){
     $.ajax({
          url : "../php/includes/ajax/Produto.php",
          type : 'post',
          data :  {
               'action':'listarTodos'
          } 
          ,beforeSend : function(){
  
               $("#resultado").html("ENVIANDO...");
  
          }
          }).done(function(produto){
               var html = '';
               $('#resultado').fadeOut();
        
               $.each(JSON.parse(produto), function( key, dado ) {

                    html += "<li class='list-group-item'>";
                    html += "<div class='btn-group' role='group' >";
                    html += "<button type='button' onclick='editarProduto(this)' data-id='"+dado.produto_id+"'  data-toggle='modal'  data-target='#produtoModal' data-nome='"+dado.produto_nome+"' data-preco='"+dado.preco+"' data-categoria_id='"+dado.categoria_id+"'  class='btn btn-warning'>Editar</button>";
                    html += "<button type='button' onclick='excluirProduto(this)' data-id='"+dado.produto_id+"' class='btn btn-danger'>Exluir</button>";
                    html += "</div>";
                    html += " Nome: "+dado.produto_nome+" Categoria: " +dado.categoria_nome + " Preço: R$"+dado.preco;
                    html += "</li>";
               });   
               $('#resultado').html(html); 
               $('#resultado').fadeIn();
               if($('#action').val()=='criar'){
                    $('#produtoNovo').text('Adicionar Novo Produto');
               }       
  
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
     }
   
   function editarProduto(a){
     var nome = a.getAttribute('data-nome');
     var categoria_id = a.getAttribute('data-categoria_id');
     var preco = a.getAttribute('data-preco');
     var id = a.getAttribute('data-id');
 
     console.log(preco);
 
     $('#titulo').text('Alterar informações - '+nome);
     $('#botaoProduto').text('Alterar Informações do produto');
 
     $('#nome').val(nome);
     $('#categoria_id').val(categoria_id);
     $('#id').val(id);
     $('#preco').val(preco);
     $('#action').val('alterar');
   }
 
   function adicionarProdutoEdit(){
     $('#titulo').text('Adicionar novo produto');
     $('#botaoProduto').text('Adicionar produto');
 
     $('#nome').val('');
     $('#categoria_id').val('');
     $('#id').val('');
     $('#preco').val('');
     $('#action').val('criar');
   }
 
   function excluirProduto(a){
     var id = a.getAttribute('data-id');
     
     console.log(id);
     var excluir = confirm('Excluir Produto?');
 
     if(excluir){
       drProduto('apagar', id)
     }
   }
 
   $('#botaoProduto').click(function(){
          cuProduto();
          adicionarProdutoEdit();

   });
