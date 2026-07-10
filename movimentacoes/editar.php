<?php

require_once __DIR__ . "/../controladores/movimentacao.php";

$movimentacao = listarUmaMovimentacao($_GET['movimentacao']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Movimentação</title>

  <style>
    *{
      font-family: Arial, Helvetica, sans-serif;
    }

    form {
      display: flex;
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
  </style>
</head>
<body>


  <form method="post" action="/movimentacoes/processos/edicao.php">
    <input type="hidden" name="id" value="<?= $movimentacao['id'] ?>">

    <div>
      <label for="tipo">Tipo (estoque):</label>
      <select name="tipo" id="tipo">
        <option selected disabled>Selecione...</option>
        <option value="entrada" <?= $movimentacao['tipo'] == 'entrada' ? 'selected' : '' ?>>Entrada</option>
        <option value="saida" <?= $movimentacao['tipo'] == 'saida' ? 'selected' : '' ?>>Saída</option>
      </select>
    </div>

    <?php
      foreach($movimentacao['produtos'] as $produto){
        ?>
          <div>
            <label for="quantidade_<?= $produto['id'] ?>"><?= $produto['nome'] ?>:</label>
            <input type="hidden" name="produtos[]" value="<?= $produto['id'] ?>">
            <input type="number" name="quantidade[]" id="quantidade_<?= $produto['id'] ?>" value="<?= $produto['quantidade'] ?>">
          </div>
        <?php
      }
    ?>

    <div class="btn">
      <button type="submit">Editar</button>
    </div>
  </form>

</body>
</html>