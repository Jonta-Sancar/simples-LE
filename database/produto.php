<?php

require_once __DIR__ . '/../conn.php';

function cadastrarProduto($dados){
  $nome      = $dados['nome'];
  $preco     = $dados['preco'];
  $descricao = $dados['descricao'];

  $SQL = "INSERT INTO produtos (nome, preco, descricao) VALUES ('$nome', '$preco', '$descricao')";

  return executarQuery($SQL);
}