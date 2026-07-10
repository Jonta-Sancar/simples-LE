<?php

require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/produto.php';
require_once __DIR__ . '/../auxiliares.php';


function cadastrarCompleto($dados){
  $movimentacao = cadastrarMovimentacao($dados);

  if(isset($movimentacao['id'])){
    foreach($dados['produtos'] as $produto_e_quantidade){
      $dados_mp = [
        'id_movimentacao' => $movimentacao['id'],
        'id_produto' => $produto_e_quantidade['id'],
        'quantidade' => $produto_e_quantidade['quantidade']
      ];

      $resultado = cadastrarMovimentacaoProduto($dados_mp);
      if(!$resultado){
        $SQL = "DELETE FROM movimentacoes WHERE id = " . $movimentacao['id'];
        executarQuery($SQL);
        
        return false;
      }
    }

    return true;
  }

  return false;
}

// C - Cadastro de movimentações
function cadastrarMovimentacao($dados){
  $tipo      = $dados['tipo'];

  $SQL = "INSERT INTO movimentacoes (tipo) VALUES ('$tipo')";

  $resultado = executarQuery($SQL);
  if($resultado){
    $SQL = "SELECT * FROM movimentacoes ORDER BY id DESC LIMIT 1"; // faz uma busca pelo último registro cadastrado

    $resultado = executarQuery($SQL)[0];
  }

  return $resultado;
}

function cadastrarMovimentacaoProduto($dados){
  $id_movimentacao = $dados['id_movimentacao'];
  $id_produto      = $dados['id_produto'];
  $quantidade      = $dados['quantidade'];

  $produto = listarUmProduto($id_produto);
  $valor_unitario  = $produto['preco'];

  $SQL = "INSERT INTO movimentacoes_produtos (id_movimentacao, id_produto, quantidade, valor_unitario) VALUES ('$id_movimentacao', '$id_produto', '$quantidade', '$valor_unitario')";

  return executarQuery($SQL);
}

function normalizarPost($dados_formulario){
  $produtos = [];

  foreach($dados_formulario['produtos'] as $i => $id){
    $produtos[$i] = [
      "id" => $id,
      "quantidade" => $dados_formulario['quantidade'][$i]
    ];
  }

  return [
    'tipo' => $dados_formulario['tipo'],
    'produtos' => $produtos
  ];
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