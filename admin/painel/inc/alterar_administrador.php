<?php
 header ('Content-type: text/html; charset=UTF-8');

include_once '../classes/lib/Pager.php';
include_once '../classes/lib/Sliding.php';

if(isset($_POST['alterar'])){
	$administrador = new Administrador;
	$administrador->obrigatorio('Nome', $_POST['nome']);
	$administrador->obrigatorio('E-mail', $_POST['email']);
	$administrador->obrigatorio('Login', $_POST['login']);
	$administrador->obrigatorio('Senha', $_POST['senha']);
	$id = (int)$_POST['id'];

	$erro = $administrador->getErro();

	if(!$erro) {

		$administrador->setNome(trim($_POST['nome']));
		$administrador->setEmail($_POST['email']);
		$administrador->setLogin(trim($_POST['login']));
		$administrador->setSenha(trim($_POST['senha']));
		$administrador->setId($id);
		$administrador->alterar();

	} else {
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
					<h3 class="panel-title">ALTERAR ADMINISTRADOR</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

<div class="form">



			<table class="table table-bordered" border="1" style="width: 700px">

					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Login</th>
						<th>Senha</th>
						<th>Alterar</th>
					</tr>


				<?php
				$admin = new Administrador;
				$dados = $admin->listar();
				$params = array(
				    'mode'       => 'sliding',
				    'perPage'    => 4,
				    'delta'      => 4,
				    'itemData'   => $dados
				);

				@$pager = & Pager::factory($params);
				$data  = $pager->getPageData();
				foreach ($data as  $value) {
					?>
				<form action=""method="post" class="form-inline" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php  echo $value->adm_id ?>">
					<tr>
						<td><input type="text" name="nome" value="<?php  echo $value->adm_nome; ?>" class="form-control"/></td>
						<td><input type="email" name="email" value="<?php  echo $value->adm_email; ?>" class="form-control"/></td>
						<td><input type="text" name="login" style="width: 90px" value="<?php  echo $value->adm_login; ?>" class="form-control"/></td>
						<td><input type="text" name="senha" style="width: 50px"value="<?php  echo $value->adm_senha; ?>" class="form-control"/></td>
						<td style="text-align: center">
							<input type="submit" name="alterar" value="Alterar" class="btn btn-warning" />
						</td>
					</tr>
				</form>
				<?php } ?>
		<tr>
			<td colspan="5" align="center" >

				<?php  $links = $pager->getLinks();
						echo $links['all'];
				 ?>
			</td>
		</tr>

			</table>


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