<?php
require './protege.php';
require './config.php';
require './lib/conexao.php';
require './lib/funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>

    <?php headCss(); ?>
  </head>
  <body>

    <?php include 'nav.php'; ?>

    <div class="container">

      <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h1><i class="fa fa-heart"></i> Clientes</h1>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Clientes</h3>
            </div>

<?php
$where = '';
$q = '';

if (isset($_GET['q'])) {
  $q = $_GET['q'];

  if (is_numeric($q)) {
    $where = "Where (cli.idcliente = $q)
    Or (cli.cpf Like '%$q%')";
  } else if ($q != '') {
    $where = "Where (cli.nome Like '%$q%')
    Or (cid.cidade Like '%$q%')";
  }
}

$sql = "Select
  cli.idcliente, cli.nome, cli.situacao, cli.idcidade,
  cid.cidade
From cliente cli
Inner Join cidade cid On cid.idcidade = cli.idcidade
$where";
$consulta = mysqli_query($con, $sql);
?>

            <form class="panel-body form-inline" role="form" method="get" action="">
              <div class="form-group">
                <label class="sr-only" for="fq">Pesquisa</label>
                <input type="search" class="form-control" id="fq" name="q" placeholder="Pesquisa" value="<?php echo $q; ?>">
              </div>
              <button type="submit" class="btn btn-default">Pesquisar</button>
            </form>

            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th></th>
                  <th>Cliente</th>
                  <th>Cidade</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
<?php
while($linha = mysqli_fetch_assoc($consulta)) {
?>
                <tr>
                  <td><?php echo $linha['idcliente']; ?></td>
                  <td>
<?php if ($linha['situacao'] == CLIENTE_ATIVO) { ?>
                    <span class="label label-success">ativo</span>
<?php } else { ?>
                    <span class="label label-warning">inativo</span>
<?php } ?>
                  </td>
                  <td><?php echo $linha['nome']; ?></td>
                  <td><?php echo $linha['cidade']; ?></td>
                  <td>
                    <a href="clientes-editar.php?idcliente=<?php echo $linha['idcliente']; ?>" title="Editar"><i class="fa fa-edit fa-lg"></i></a>
                    <a href="clientes-apagar.php?idcliente=<?php echo $linha['idcliente']; ?>" title="Remover"><i class="fa fa-times fa-lg"></i></a>
                    <a href="venda-nova.php?idcliente=<?php echo $linha['idcliente']; ?>" title="Nova Venda"><i class="fa fa-share fa-lg"></i></a>
                  </td>
                </tr>
<?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

    <script src="./lib/jquery.js"></script>
    <script src="./lib/bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>
