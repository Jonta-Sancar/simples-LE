<?php

require_once '../controladores/produto.php';

$produto = listarUmProduto($_GET['produto']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Produto</title>

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

    input{
      padding: 10px 15px;
      border-radius: 5px;
      border: 1px solid #000;
    }

    [type="submit"]{
      text-transform: uppercase;
      cursor: pointer;
    }
  </style>
</head>
<body>
  
  <form method="post" action="/produtos/processos/edicao.php">
    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
    <div>
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" placeholder="Nome do produto" value="<?= $produto['nome'] ?>">
    </div>

    <div>
      <label for="preco">Preço:</label>
      <input type="number" step="0.01" name="preco" id="preco" placeholder="Preço do produto" value="<?= $produto['preco'] ?>">
    </div>

    <div>
      <label for="descricao">Descrição:</label>
      <input type="text" name="descricao" id="descricao" placeholder="Descrição do produto" value="<?= $produto['descricao'] ?>">
    </div>

    <button type="submit">Editar</button>
  </form>
</body>
</html>