 <?php
 header ('Content-type: text/html; charset=UTF-8');
if(isset($_POST['cadastrar'])) {
	$categoria = new Categoria();
	$categoria->obrigatorio('categoria', $_POST['categoria']);

	$erro =  $categoria->getErro();

 if(!isset($erro)){
    $categoria->setCategoria($_POST['categoria']);
 	$categoria->setPosicao($_POST['posicao']);
 	$categoria->cadastrar();
 } else{
 	echo $erro;
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
.panel-body{height: 210px;}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}    </style>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    </script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">CADASTRAR CATEGORIA</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

					<div class="form">

		<form action=""method="post" class="form">
			<label for="categoria">Categoria: </label>
			<input type="text" name="categoria"  class="form-control" >
			<br>
			<label for="posicao_destaque" >Posição Destaque</label>
			<select name="posicao" class="form-control">
				<option value="0" seletcted="selected">Sem posição</option>
				<option value="1">Destaque</option>
				<option value="2">Inferior direito</option>
				<option value="3">Superior Esquerdo</option>
			</select>
			<br />
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
