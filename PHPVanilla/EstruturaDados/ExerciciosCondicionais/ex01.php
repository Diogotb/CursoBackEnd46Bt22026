<?php 
declare(strict_types=1);

// Sistema de Votação
// Crie uma variável $idade.
// Se a idade for menor que 16, exiba: "Voto Proibido".
// Se a idade for entre 16 e 17, ou maior/igual a 70, exiba: "Voto Facultativo".
// Se a idade for entre 18 e 69, exiba: "Voto Obrigatório".

$idade =15;

if($idade < 16) {
    echo "Voto Proibido";
}else if($idade<=17 || $idade>=70){
    echo "Voto Facultativo";
} else{
    echo "Voto Obrigatório";
}




?>