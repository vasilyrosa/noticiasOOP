 <?php
 header ('Content-type: text/html; charset=UTF-8');

if(isset($_POST['cadastrar'])) {

 $admin = new Administrador;

 $admin->obrigatorio("nome", $_POST['nome']);
 $admin->obrigatorio("email", $_POST['email']);
 $admin->obrigatorio("usuario", $_POST['usuario']);
 $admin->obrigatorio("senha", $_POST['senha']);

 $erro =  $admin->getErro();

 if(!isset($erro)){
 	$admin->setNome(strip_tags(filter_input(INPUT_POST, 'nome')));
 	$admin->setEmail(strip_tags(filter_input(INPUT_POST, 'email')));
 	$admin->setLogin(strip_tags(filter_input(INPUT_POST, 'usuario')));
 	$admin->setSenha(strip_tags(filter_input(INPUT_POST, 'senha')));
 	$admin->cadastrar();
 } else {
 	echo $erro;
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
.panel-body{height: 330px; width: 800px;}

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
					<h3 class="panel-title">CADASTRAR ADMINISTRADOR</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

<div class="form">

		<form action=""method="post" class="form-inline" enctype="multipart/form-data">

			<label for="nome">Nome: </label>
			<input style="width: 300px; "type="text" name="nome"  class="form-control" maxlength="100"/>

			<label for="email">E-mail:</label>
			<input style="width: 300px; "type="email" name="email"  class="form-control" maxlength="80"/>

			<label for="usuario">Usuário:</label>
			<input type="text" name="usuario"  class="form-control" maxlength="80">

			<label for="senha">Senha:</label>
			<input type="password" name="senha"  class="form-control" maxlength="80">
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