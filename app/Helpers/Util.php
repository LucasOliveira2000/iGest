<?php


if (!function_exists('formatarDinheiro')) {
    function formataDinheiro($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}

if (!function_exists('converterParaFloat')) {
    function converterParaFloat($valor) {
        $valor = preg_replace('/[^\d,]/', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return (float) $valor;
    }
}

?>