<?php

require_once __DIR__ . "/../controladores/movimentacao.php";

$movimentacoes = listarMovimentacoes();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movimentações</title>

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
  <form method="post" action="/movimentacoes/cadastrar.php">
    <div>
      <label for="tipo">Tipo (estoque):</label>
      <select name="tipo" id="tipo">
        <option selected disabled>Selecione...</option>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
      </select>
    </div>

    <button type="submit">Cadastrar</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Total</th>
        <th>Data de Cadastro</th>
        <th>Ações</th>
      </tr>
    </thead>

    <tbody>
      <?php
        foreach ($movimentacoes as $movimentacao) {
          ?>
            <tr>
              <td><?= $movimentacao['id']; ?></td>
              <td style="text-align: center;"><?= $movimentacao['tipo']; ?></td>
              <td style="text-align: center;color:<?= $movimentacao['tipo'] == 'entrada' ? 'red' : 'green' ?>"><?= formatarPreco($movimentacao['total']); ?></td>
              <td style="text-align: center;"><?= $movimentacao['cadastro_f']; ?></td>
              <td style="text-align: center;">
                <a href="/movimentacoes/detalhar.php?movimentacao=<?= $movimentacao['id'] ?>">Detalhes</a> | 
                <a href="/movimentacoes/editar.php?movimentacao=<?= $movimentacao['id'] ?>">Editar</a> | 
                <a href="/movimentacoes/processos/exclusao.php?movimentacao=<?= $movimentacao['id'] ?>">Excluir</a>
              </td>
            </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</body>
</html>