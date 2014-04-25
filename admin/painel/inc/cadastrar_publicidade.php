 <?php
 header ('Content-type: text/html; charset=UTF-8');

if(isset($_POST['cadastrar'])) {


	$publicidade = new Publicidade;

	/* Instanciando o método obrigatório para validar formulário */
	$publicidade->obrigatorio("titulo", $_POST['titulo']);
	$publicidade->obrigatorio("publicidade", $_FILES['publicidade']['name']);
	$erro =  $publicidade->getErro();


	 /* Tratamento de foto com WideImage */


	 $foto = $_FILES['publicidade']['name'];
	 $temp = $_FILES['publicidade']['tmp_name'];
	 @$explode = end(explode('.', $foto));
	 $novaFoto = uniqid().'.'.$explode;

			/*  pegando dados do formulário via post*/
			if(!isset($erro)){

			$resize =  WideImage::load($temp);
			$redimensionar = $resize->resize('531','72','fill');
			$redimensionar->saveToFile('../../publicidade/'.$novaFoto);

				if($redimensionar->isValid()){
			 	$publicidade->setTitulo( strip_tags(filter_input(INPUT_POST, 'titulo')));
			 	$publicidade->setCaminho('publicidade/'.$novaFoto);
			 	$publicidade->setStatus('inativo');
			 	$publicidade->cadastrar();
				 } else {
					echo $erro = '<p class="alert alert-danger">Nehuma foto foi selecionada !</p>';
				}

	 		} else{
	 			echo $erro;
	 			//unlink('../../publicidade/'.$novaFoto);
		 	}

}//isset

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
.panel-body{height: 200px; width: 800px;}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

  </style>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
 <body>
<div class="container">
    <div class="row">
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">CADASTRAR PUBLICIDADE</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

<div class="form">

		<form action=""method="post" class="form-inline" enctype="multipart/form-data">

			<label for="titulo">Titulo: </label>
			<input style="width: 300px; "type="text" name="titulo"  class="form-control " >

			<label for="publicidade">Publicidade:</label>
			<input type="file" name="publicidade"  class="form-control" >
			<br>
			<br />
			<label for="cadastrar"></label>
			<input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">

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


