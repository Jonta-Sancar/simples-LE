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
  <form method="post" action="/movimentacoes/cadastrar2.php">
    <input type="hidden" name="tipo" value="<?= $_POST['tipo'] ?>">

    <div>
      <label for="produtos">Produtos:</label>
      <select name="produtos[]" id="produtos" multiple>
        <option selected disabled>Selecione o Produto</option>

        <?php
          foreach($produtos as $produto){
            ?>
              <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
            <?php
          }
        ?>
      </select>
    </div>

    <div class="btn">
      <button type="submit">Cadastrar</button>
    </div>
  </form>
</body>
</html>