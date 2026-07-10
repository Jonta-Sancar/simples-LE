<?php

require_once '../../controladores/movimentacao.php';

$dados = normalizarPost($_POST);

$resultado = editarCompleto($_POST['id'], $dados);

if($resultado === false){
  echo "Não deu certo não";
} else {
  header('Location: /movimentacoes'); // -> redireciona para o link especificado
}