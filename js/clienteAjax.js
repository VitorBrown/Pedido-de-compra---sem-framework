$(document).ready(function(){
     carregarCliente();
});

function cuCliente(){
     $.ajax({
          url : "../php/includes/ajax/Cliente.php",
          type : 'post',
          data :  $('#formCliente').serialize(),
  
          beforeSend : function(){
  
               $("#resultado").html("ENVIANDO...");
  
          }
          }).done(function(msg){
  
              alert(msg);
              carregarCliente();
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
}

function drCliente(action, id){
     $.ajax({
          url : "../php/includes/ajax/Cliente.php",
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

              carregarCliente();
  
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
}

function carregarCliente(){
     $.ajax({
          url : "../php/includes/ajax/Cliente.php",
          type : 'post',
          data :  {
               'action':'listarTodos'
          } 
          ,beforeSend : function(){
  
               $("#resultado").html("ENVIANDO...");
  
          }
          }).done(function(cliente){
               var html = '';
               $('#resultado').fadeOut();
               $.each(JSON.parse(cliente), function( key, dado ) {
                    
                    html += "<li class='list-group-item'>";
                    html += "<div class='btn-group' role='group' >";
                    html += "<button type='button' onclick='editarCliente(this)' data-toggle='modal'  data-target='#clienteModal' data-id='"+dado.cliente_id+"' data-nome='"+dado.nome+"' data-cpf='"+dado.cpf+"' data-tipo='"+dado.tipo+"' data-email='"+dado.email+"'  class='btn btn-warning'>Editar</button>";
                    html += "<button type='button' onclick='excluirCliente(this)' data-id='"+dado.cliente_id+"' class='btn btn-danger'>Exluir</button>";
                    html += "</div>";
                    html += " Nome:"+dado.nome+", CPF:"+dado.cpf+" ";
                    html += "</li>";
               });   
               $('#resultado').html(html); 
               $('#resultado').fadeIn();
               if($('#action').val()=='criar'){
                    $('#clienteNovo').text('Adicionar Novo Cliente');
               }     
  
          }).fail(function(jqXHR, textStatus, msg){
  
               alert(msg);
  
          }); 
     }
   
   
   function editarCliente(a){
     var nome = a.getAttribute('data-nome');
     var email = a.getAttribute('data-email');
     var id = a.getAttribute('data-id');
     var cpf = a.getAttribute('data-cpf');
     var tipo = a.getAttribute('data-tipo');

     $('#titulo').text('Alterar informações - '+nome);
     $('#botaoCliente').text('Alterar Informações do cliente');
 
     $('#nome').val(nome);
     $('#email').val(email);
     $('#cpf').val(cpf);
     $('#tipo').val(tipo);
     $('#id').val(id);
     $('#action').val('alterar');
   }
 
   function adicionarClienteEdit(){
     $('#titulo').text('Adicionar novo cliente');
     $('#botaoCliente').text('Adicionar cliente');
 
     $('#nome').val('');
     $('#email').val('');
     $('#id').val('');
     $('#senha').val('');
     $('#cpf').val('');
     $('#tipo').val('');
     $('#action').val('criar');
   }
 
   function excluirCliente(a){
     var id = a.getAttribute('data-id');
 
     var excluir = confirm('Excluir Cliente?');
 
     if(excluir){
       drCliente('apagar', id)
     }
   }
 
   $('#botaoCliente').click(function(){

     if($('#senha').val() == $('#senha2').val()){
          cuCliente();
          adicionarClienteEdit();
     }else{
          alert('Senha não são iguais');
     }
    
   });
