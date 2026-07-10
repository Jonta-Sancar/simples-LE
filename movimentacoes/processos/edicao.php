<?php

require_once '../../controladores/produto.php';

$id = $_POST['id'];

$dados = $_POST;

unset($dados['id']);

$resultado = editarProduto($id, $dados);

header('Location: /produtos'); // -> redireciona para o link especificado