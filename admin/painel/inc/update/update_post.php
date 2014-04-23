 <?php
 header ('Content-type: text/html; charset=UTF-8');
 ?>

 <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .row{
    margin-top:40px;
    padding: 0 10px;
}

.clickable{
    cursor: pointer;
}

label{display: block}
.panel-body{height: 480px; width: 800px;}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

  </style>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="lib/ckeditor/adapters/jquery.js"></script>
            <!-- CODE TO START YOUR EDITOR -->
            <script>
        $(document).ready(function(){
    		$('#editor').ckeditor(function(){
       	 $('#resposta').html('<span style="color:red; font-weight: bold">CKEditor carregado!</span>');


        var editor = $('#editor').ckeditorGet();

        // Capturando o conteúdo do editor
        var data = $('#editor').val();
        // Adicionando conteúdo ao editor
        $('#editor').val('Insira seu texto...');
    },
    {
        width: 600,
        height: 100
    });
});
            </script>

<body>
<div class="container">
    <div class="row">
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">ALTERAR POST</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

<div class="form">

		<form action=""method="post" class="form-inline" enctype="multipart/form-data">
			<label for="titulo">Titulo: </label>
			<input style="width: 300px; "type="text" name="titulo"  class="form-control " >

			<label for="categoria">Categoria:</label>
			<select name="categoria" class="form-control">
			<?php
				$categoria = new Categoria;
				$dados = $categoria->listar();
				print_r($dados);
				foreach ($dados as  $value) {  ?>
					<option value="<?php  echo $value->categoria_id; ?>" selected="">"<?php  echo $value->categoria_nome; ?>"</option>
			  <?php  } ?>
			<hr>
			<label for="foto">Foto: </label>
			<input type="file" name="foto"  class="form-control" >
			</select>
			<br />
			<br>
			<p><strong>Conteúdo do Post:</strong> </p>
			<textarea name="editor" id="editor"></textarea>


			<br>
			<input type="submit" name="alterar" value="Alterar" class="btn btn-warning">
		</form>
</div>
				</div>
			</div>
		</div>
	</div>

</div><script type="text/javascript">
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})</script>
