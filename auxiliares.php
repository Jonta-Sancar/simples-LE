<?php

function formatarData($data) {
  $dataFormatada = date('d/m/Y H:i', strtotime($data)); // 2026-07-06 19:51:44
  return $dataFormatada;
}

function formatarPreco($preco) {
  $precoFormatado = number_format($preco, 2, ',', '.');
  return "R$ " . $precoFormatado;
}