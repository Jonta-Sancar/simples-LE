<?php

require_once '../controladores/produto.php';

$produtos = listarProdutos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro - Movimentações</title>

  <style>
    *{
      font-family: Arial, Helvetica, sans-serif;
    }

    form {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;

      margin-bottom: 30px;
    }

    form div {
      display: flex;
      flex-direction: column;
    }

    input, select{
      padding: 10px 15px;
      border-radius: 5px;
      border: 1px solid #000;
    }

    div.btn{
      display: flex;
      justify-content: center;
    }

    [type="submit"]{
      text-transform: uppercase;
      cursor: pointer;
      padding: 15px 20px;
    }

    table {
      width: 100%;
      
    }

    table, th, td{
      border: 1px solid #000;
      border-collapse: collapse;
    }

    th, td{
      padding: 10px 15px;
    }
  </style>
</head>
<body>

  <h1>Indique a quantidade dos seguintes produtos:</h1>
  <form method="post" action="/movimentacoes/processos/cadastro.php">
    <input type="hidden" name="tipo" value="<?= $_POST['tipo'] ?>">

    <?php
      foreach($_POST['produtos'] as $id_produto){
        $produto = listarUmProduto($id_produto);
        ?>
          <div>
            <label for="quantidade_<?= $id_produto ?>"><?= $produto['nome'] ?>:</label>
            <input type="hidden" name="produtos[]" value="<?= $id_produto ?>">
            <input type="number" name="quantidade[]" id="quantidade_<?= $id_produto ?>">
          </div>
        <?php
      }
    ?>

    <div class="btn">
      <button type="submit">Cadastrar</button>
    </div>
  </form>
</body>
</html>