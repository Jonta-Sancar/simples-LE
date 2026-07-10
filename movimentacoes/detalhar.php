<?php

require_once __DIR__ . "/../controladores/movimentacao.php";

$movimentacao = listarUmaMovimentacao($_GET['movimentacao']);
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
  <table>
    <thead>
      <tr>
        <th colspan="4"><?= $movimentacao['tipo'] ?> - <?= $movimentacao['cadastro_f'] ?></th>
      </tr>
      <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço Unitário</th>
        <th>Total</th>
      </tr>
    </thead>

    <tbody>
      <?php
        foreach($movimentacao['produtos'] as $produto){
          ?>
            <tr>
              <td><?= $produto['nome'] ?></td>
              <td style="text-align: center;"><?= $produto['quantidade'] ?></td>
              <td style="text-align: right;"><?= formatarPreco($produto['valor_unitario']) ?></td>
              <td style="text-align: right;"><?= formatarPreco($produto['quantidade'] * $produto['valor_unitario']) ?></td>
            </tr>
          <?php
        }
      ?>

      <tr>
        <th style="text-align: left;" colspan="3">TOTAL NOTA:</th>

        <?php
          if($movimentacao['tipo'] == 'entrada'){
            ?>
              <td style="text-align: right;font-weight:bold;color: red;">-<?= formatarPreco($movimentacao['total']) ?></td>
            <?php
          } else {
            ?>
              <td style="text-align: right;font-weight:bold;color: green;"><?= formatarPreco($movimentacao['total']) ?></td>
            <?php
          }
        ?>
      </tr>
    </tbody>
  </table>
</body>
</html>