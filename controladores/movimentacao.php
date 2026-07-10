<?php

require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/produto.php';
require_once __DIR__ . '/../auxiliares.php';

// C - Cadastro de movimentações
function cadastrarMovimentacao($dados){
  $tipo      = $dados['tipo'];

  $SQL = "INSERT INTO movimentacoes (tipo) VALUES ('$tipo')";

  return executarQuery($SQL);
}

function cadastrarMovimentacaoProduto($dados){
  $id_movimentacao = $dados['id_movimentacao'];
  $id_produto      = $dados['id_produto'];
  $quantidade      = $dados['quantidade'];

  $produto = listarUmProduto($id_produto);
  $valor_unitario  = $produto['valor_unitario'];

  $SQL = "INSERT INTO movimentacoes (id_movimentacao, id_produto, quantidade, valor_unitario) VALUES ('$id_movimentacao', '$id_produto', '$quantidade', '$valor_unitario')";

  return executarQuery($SQL);
}

// R - Listagem de produtos
function listarMovimentacoes(){
  $SQL = "SELECT * FROM movimentacoes";

  $movimentacoes = executarQuery($SQL);

  foreach($movimentacoes as $key => $movimentacao){
    $SQL = "SELECT * FROM movimentacoes_produtos MP
            INNER JOIN produtos P ON P.id=MP.id_produto";

    $movimentacoes_produtos = executarQuery($SQL);

    $movimentacao['cadastro_f'] = formatarData($movimentacao['cadastro']);

    $movimentacao['produtos'] = $movimentacoes_produtos;

    $SQL = "SELECT SUM(valor_unitario * quantidade) total FROM movimentacoes_produtos WHERE id_movimentacao = " . $movimentacao['id'];

    $calcular_total = executarQuery($SQL)[0];

    $movimentacao['total'] = $calcular_total['total'];

    $movimentacoes[$key] = $movimentacao;
  }

  return $movimentacoes;
}


function listarUmaMovimentacao($id){
  $SQL = "SELECT * FROM movimentacoes WHERE id = $id";

  $movimentacao = executarQuery($SQL)[0];

  $SQL = "SELECT * FROM movimentacoes_produtos MP
          INNER JOIN produtos P ON P.id=MP.id_produto WHERE id_movimentacao = $id";

  $movimentacoes_produtos = executarQuery($SQL);

  $movimentacao['cadastro_f'] = formatarData($movimentacao['cadastro']);

  $movimentacao['produtos'] = $movimentacoes_produtos;

  $SQL = "SELECT SUM(valor_unitario * quantidade) total FROM movimentacoes_produtos WHERE id_movimentacao = $id";

  $calcular_total = executarQuery($SQL)[0];

  $movimentacao['total'] = $calcular_total['total'];

  return $movimentacao;
}

// U - Edição de produtos
// function editarProduto($id, $dados){
//   $nome = $dados['nome'];
//   $preco = $dados['preco'];
//   $descricao = $dados['descricao'];

//   $SQL = "UPDATE produtos SET nome='$nome', preco='$preco', descricao='$descricao' WHERE id = $id";

//   return executarQuery($SQL);
// }

// D - Exclusão de produtos
function excluirMovimentacao($id){
  $SQL = "DELETE FROM movimentacoes_produtos WHERE id_movimentacao = $id";
  executarQuery($SQL);

  $SQL = "DELETE FROM movimentacoes WHERE id = $id";
  return executarQuery($SQL);
}