<?php

require_once '../controladores/produto.php';

$produtos = listarProdutos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos</title>

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
  <form method="post" action="/produtos/processos/cadastro.php">
    <div>
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" placeholder="Nome do produto">
    </div>

    <div>
      <label for="preco">Preço:</label>
      <input type="number" step="0.01" name="preco" id="preco" placeholder="Preço do produto">
    </div>

    <div>
      <label for="descricao">Descrição:</label>
      <input type="text" name="descricao" id="descricao" placeholder="Descrição do produto">
    </div>

    <button type="submit">Cadastrar</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Descrição</th>
        <th>Data de Cadastro</th>
        <th>Ações</th>
      </tr>
    </thead>

    <tbody>
      <?php
        foreach ($produtos as $produto) {
          ?>
            <tr>
              <td><?= $produto['id']; ?></td>
              <td><?= $produto['nome']; ?></td>
              <td><?= $produto['preco_f']; ?></td>
              <td><?= $produto['descricao']; ?></td>
              <td><?= $produto['data_cadastro_f']; ?></td>
              <td>
                <a href="/produtos/editar.php?produto=<?= $produto['id'] ?>">Editar</a> | 
                <a href="/produtos/processos/exclusao.php?produto=<?= $produto['id'] ?>">Excluir</a>
              </td>
            </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</body>
</html>