 <?php
 header ('Content-type: text/html; charset=UTF-8');

 if(isset($_POST['alterar'])) {
 	$post = new Post;
 	$post->obrigatorio("titulo", $_POST['titulo']);
	$post->obrigatorio("conteudo", $_POST['editor']);
	$id = $_POST['id'];
	$erro =  $post->getErro();

	$post->setAutor( $_SESSION['nome_adm'] );
	$id_adm = $post->adm_id();

if(!isset($erro)){
	/* Tratamento de foto com WideImage */

	if(empty($_FILES['foto']['name'])) {
		//se foto estiver vazio pega a foto atual do banco de dados
		$post->setId($id);
		$idPost = $post->post_Id();
		$picture = $idPost->post_foto;
	} else {
	/* ---------------------------------------------------------------*/
		/* antes de cadastrar uma nova foto exclui a atual do banco de dados */
		$post->setId($id);
		$idPost = $post->post_Id();
		unlink('../../'.$idPost->post_foto);
	/* ---------------------------------------------------------------*/
		//caso nao esteja vazio cadastra nova foto
		 $foto = $_FILES['foto']['name'];
		 $temp = $_FILES['foto']['tmp_name'];

		 /* explodir para pegar a extensao da foto */
		 @$explode = end(explode('.', $foto));
		 $novaFoto = uniqid().'.'.$explode;


		$resize =  WideImage::load($temp);
		$redimensionar = $resize->resize('288','163','fill');
		$redimensionar->saveToFile('../../foto/'.$novaFoto);
	    $picture = 'foto/'.$novaFoto;
	}
		/*  pegando dados do formulário via post*/

		 	$post->setTitulo(  strip_tags(filter_input(INPUT_POST, 'titulo')));
		 	$post->setCategoria(strip_tags(filter_input(INPUT_POST, 'categoria')));
		 	$post->setFoto($picture);
		 	$post->setData(     date("Y-m-d H:i:s"));
		 	$post->setAutor(    $id_adm->adm_id);
		 	$post->setConteudo( strip_tags(filter_input(INPUT_POST, 'editor')));
		 	$post->setId($id);
		 	$post->alterar();


	 } else{
	 	echo $erro;
	 	//unlink('../../foto/'.$novaFoto);
	 }

 }
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
.panel-body{height: 500px; width: 800px;}

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
        $('#editor').val();
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
<?php

 	if(isset($_GET['id'])) {
 		 $id = (int)$_GET['id'];

 		 $post = new Post;
 		 $post->setId($id);
 		 $postId = $post->post_Id();
 	} else {
 		echo "<p class='alert alert-danger'>Você deve escolher uma Post para editar !</p>";
	die();
 	}

?>
		<form action=""method="post" class="form-inline" enctype="multipart/form-data">
			<label for="titulo">Titulo: </label>
			<input style="width: 300px; "type="text" name="titulo"  class="form-control" value="<?php  echo $postId->post_titulo ?>">
			<label for="categoria">Categoria:</label>
			<select name="categoria" class="form-control">
			<?php
				$categoria = new Categoria;
				$dados = $categoria->listar();

				foreach ($dados as  $value) {  ?>
				<option value="<?php echo $value->categoria_id; ?>"
				 <?php echo $value->categoria_id == $postId->post_categoria ? "selected ='selected'" : '' ?> >
				 <?php echo $value->categoria_nome; ?>
				</option>
			  <?php  } ?>
			<hr>
			<label for="foto">Foto: </label>
			<input type="file" name="foto"  class="form-control" />
			</select>
			<br />
			<br>
			<p><strong>Conteúdo do Post:</strong> </p>
			<textarea name="editor" id="editor">
				<?php
				print $postId->post_conteudo;
				?>
			</textarea>


			<br>
			<input type="hidden" name="id" value="<?php  echo $id; ?>" />
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
