<?php

spl_autoload_register("autoLoader");
function autoLoader($classACarregar)
{
    $ficheiroAcarregar = str_replace('\\', DIRECTORY_SEPARATOR, $classACarregar)
        . ".php";
    require_once $ficheiroAcarregar;
}