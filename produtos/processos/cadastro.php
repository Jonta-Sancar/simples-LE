<?php

require_once '../../controladores/produto.php';

cadastrarProduto($_POST);

header('Location: /produtos'); // -> redireciona para o link especificado