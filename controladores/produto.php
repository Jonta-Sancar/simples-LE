<?php

require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/../auxiliares.php';

// C - Cadastro de produtos
function cadastrarProduto($dados){
  $nome      = $dados['nome'];
  $preco     = $dados['preco'];
  $descricao = $dados['descricao'];

  $SQL = "INSERT INTO produtos (nome, preco, descricao) VALUES ('$nome', '$preco', '$descricao')";

  return executarQuery($SQL);
}

// R - Listagem de produtos
function listarProdutos(){
  $SQL = "SELECT * FROM produtos";

  $produtos = executarQuery($SQL);

  foreach($produtos as $key => $produto){

    $produto['data_cadastro_f'] = formatarData($produto['data_cadastro']);
    $produto['preco_f']         = formatarPreco($produto['preco']);

    $produtos[$key] = $produto;
  }

  return $produtos;
}


function listarUmProduto($id){
  $SQL = "SELECT * FROM produtos WHERE id = $id";

  $produto = executarQuery($SQL)[0];

  return $produto;
}

// U - Edição de produtos
function editarProduto($id, $dados){
  $nome = $dados['nome'];
  $preco = $dados['preco'];
  $descricao = $dados['descricao'];

  $SQL = "UPDATE produtos SET nome='$nome', preco='$preco', descricao='$descricao' WHERE id = $id";

  return executarQuery($SQL);
}

// D - Exclusão de produtos
function excluirProduto($id){
  $SQL = "DELETE FROM produtos WHERE id = $id";

  return executarQuery($SQL);
}