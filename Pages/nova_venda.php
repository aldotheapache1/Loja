<?php 
session_start();
ini_set('display_errors', 0 );
error_reporting(0);
if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
}
if(isset($_GET['acao'])){
  if($_GET['acao'] == 'adItem'){
      $id = intval($_GET['id']);
      if(!isset($_SESSION['carrinho'][$id])){
          $_SESSION['carrinho'][$id] = 1;
      }else{
        $_SESSION['carrinho'][$id] += 1;
      }
  }
   if($_GET['acao'] == 'atualizarQtd'){
          if(is_array(@$_POST['atualizar'])){
            foreach($_POST['atualizar'] as $id => $quantidade) {
              $id = intval($id);
              $quantidade = intval($quantidade);
              if(!empty($quantProduto) || $quantidade <> 0){
                $_SESSION['carrinho'][$id] = $quantidade;
              }else{
                unset($_SESSION['carrinho'][$id]);
              }
            }
          }
      }
      if($_GET['acao'] == 'deleleItem'){
          $id = intval($_GET['id']);
          if(isset($_SESSION['carrinho'][$id])){
            unset($_SESSION['carrinho'][$id]);
          }
      }
       if($_GET['acao'] == 'cancelar'){
          unset($_SESSION['carrinho']);
      }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
		<title>Karoline Modas & Perfumaria - Home</title>
		<link rel="icon" type="image/png" href="../Imgs/K.png">
		<link href="../Componets/css/cards.css" rel="stylesheet">
		<script type = "text/javascript" src = "../Componets/js/jquery-3.3.1.min.js"></script>
		<script type = "text/javascript" src = "../Componets/js/functions.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark">
		  <a class="navbar-brand" href="../index.php">
			<img src="../Imgs/K.png" width="25" height="35" class="d-inline-block align-top" alt="">
			Karoline Modas & Perfumaria
		  </a>
		  <span class="navbar-text" id="msgUsuario"><i class="fas fa-user"  style="font-size:25px"></i> <?php echo $_COOKIE['nomeUsuario']; ?> 
			<input type="button" value="Sair" id="btnLogout" class="btn btn-danger ">
		  </span>
	</nav>

<div id="content">
  <div id="content-header">
  </div>
  <div class="container-fluid">
    <hr>
    <small id="nome-page"><i class="fa fa-shopping-cart"></i> carrinho</small>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <h5 style="color: #ffffff;font-size: 13pt;">Carrinho de itens pedido</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th id="infor-item">Item</th>
                  <th id="infor-item">Preço</th>
                  <th id="infor-item">Quant</th>
                  <th id="infor-item">SubTotal</th>
                  <th></th>
                </tr>
              </thead>
              <form  action="?acao=atualizarQtd" method="post">
              <tfoot>
                <tr>
              <td colspan="6">
              <tbody>
                <tr class="odd gradeX">
                  <?php if(count($_SESSION['carrinho']) == 0){?>
                    <hr>
                   <small id="alet-carrinho"> carrinho Livre inicie um novo pedido</small>
                 <?php }else{
                  require_once '../Database/configPDO.php';
				  $pdo = DBConnect();
				  $cliente = $pdo->query("SELECT * FROM cliente");
                  $somaValorItem = 0;
                   foreach($_SESSION['carrinho'] as $id => $quantidade){
					$conectar = DBConnect();
                   $sql   = $conectar->query("SELECT * FROM produto WHERE id= '$id'");
                  $listItem    = $sql->fetch(PDO::FETCH_OBJ);
                  $subTotal = $listItem->preco * $quantidade;
                  $somaValorItem += $listItem->preco * $quantidade;
                  echo '<tr id="item-carrinho">
                  <td>'.$listItem->nome.'</td>
                  <td>R$ '.number_format($listItem->preco, 2, ',', '.').'</td>
                  <td  id="quant-td"><input  id="quant" type="text" name="atualizar['.$id.']" value="'.$quantidade.'"></td>
                  <td>R$ '.number_format($subTotal, 2, ',', '.').'</td>
				  
                  <td>
                   <a href="?acao=deleleItem&id='.$id.'">
                  <i id="icon-carrinho" class="fa fa-trash"></i></a>
                  </td>

                  </tr>';
                      }
                    }
                  ?>
                <tr>
                  <td id="total" colspan="6">Total: R$ <?= number_format($somaValorItem, 2, ',', '.');?> </td>
                </tr>
				 <tr>
                 
                </tr>
                <tr>              
                  <td>
                  <button class="btn btn-info"><i class="fa fa-refresh"></i>  Atualizar Quantidade</button>
                  </form>
                </td>
                <?php if(isset($id)){?>   
                <td>
                  <form action="../Scripts/salvar_pedido.php" method="post">

				  <?php  
				  if($listItem->quantidade>=$quantidade)
				  {
					?>
						<button class="btn btn-success"><i class="fa fa-save"></i> Finalizar Pedido  </button>
				    <?php 
				  }
				  else
				  {
					  ?>
						<button class="btn btn-danger"><i class="fa fa-save"></i> Estoque Insuficiente  </button>
				    <?php 
				  }
				   ?>
				    </td>
					<td>
						<select id="id_cliente" name="id_cliente">
							<option >Selecione um cliente</option>
								<?php if($cliente->rowCount() > 0)
										{
											while($linha = $cliente->fetch())
												{
													echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
												}
										} 
								?>	
						</select>
                   </form>
						<div class="text-danger">
							Não esqueça de selecionar o cliente
						</div>
					</td>
                 <td>
                   <a href="?acao=cancelar&id='.$id.'">
                    <button class="btn btn-danger"><i class="fa fa-remove"></i> Limpar Carrinho</button></a>
                  </td>
                  <td>
                    <a href="produtos.php">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Adicionar Produto</button></a>
                  </td>
                <?php }else{?>
                  <td>
                    <a href="produtos.php">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i>  Adicionar Produto</button></a>
                  </td>
                <?php } ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
