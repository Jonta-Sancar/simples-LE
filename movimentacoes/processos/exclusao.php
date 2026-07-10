<?php

require_once '../../controladores/movimentacao.php';

excluirMovimentacao($_GET['movimentacao']);

header('Location: /movimentacoes'); // -> redireciona para o link especificado