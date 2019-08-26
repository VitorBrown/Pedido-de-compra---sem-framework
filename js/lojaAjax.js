$(document).ready( function(){
     filtrar();
});

function filtrar(){
    $.ajax({
        url : "../php/includes/ajax/Loja.php",
        type : 'post',
        data :$('#formLojaFiltrar').serialize()
        ,beforeSend : function(){

             $("#produtos").html("ENVIANDO...");

        }
        }).done(function(loja){

          html = '';
     
          $.each(JSON.parse(loja), function( key, dado ) {
               html += "<a href='#' data-toggle='modal' onclick='comprar(this)'  data-target='#lojaModal' title='Comprar "+dado.produto_nome+"'";
               html += "data-produto_nome='"+dado.produto_nome+"' data-produto_id='"+dado.produto_id+"'";
               html += "class='list-group-item list-group-item-action flex-column align-items-start'>";
               html += "<div class='d-flex w-100 justify-content-between'>";
               html += "<h5 class='mb-1'>"+dado.produto_nome+"</h5>";
               html += "<small class='text-muted'>"+dado.criado_em+"</small>";
               html += "</div>";
               html += "<p class='mb-1'>Categoria: "+dado.categoria_nome+"</p>";
               html += "<p class='mb-1'>Preço: "+dado.preco+"</p>";
               html += "<small class='text-muted'>Criado por: "+dado.cliente_nome+"</small>";
               html += "</a>";
          });

          $('#produtos').html(html);

        }).fail(function(jqXHR, textStatus, msg){

             alert(msg);

        });
}

function comprar(a){

     var produto_id = a.getAttribute('data-produto_id');
     var produto_nome = a.getAttribute('data-produto_nome');

     $('#produto_nome').html(produto_nome);
     $('#produto_id').val(produto_id);
}