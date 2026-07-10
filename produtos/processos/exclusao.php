<?php

require_once '../../controladores/produto.php';

excluirProduto($_GET['produto']);

header('Location: /produtos'); // -> redireciona para o link especificado