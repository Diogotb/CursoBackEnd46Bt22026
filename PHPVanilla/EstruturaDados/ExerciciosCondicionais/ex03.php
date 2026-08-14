<?php 
declare(strict_types=1);

// Exercício 3: Clínica Médica (Cálculo de IMC)
// Uma clínica precisa automatizar a triagem de pacientes.
// Crie as variáveis $peso (ex: 85.5) e $altura (ex: 1.75).
// Calcule o IMC usando a fórmula: IMC = Peso / (Altura * Altura).
// Use if / elseif / else para exibir a classificação exata:
// Abaixo de 18.5 ➔ "Abaixo do Peso"
// De 18.5 a 24.9 ➔ "Peso Normal"
// De 25.0 a 29.9 ➔ "Sobrepeso"
// De 30.0 a 34.9 ➔ "Obesidade Grau I"
// 35.0 ou mais ➔ "Obesidade Grau II ou III"

$peso = 95;
$altura = 1.75;

$imc = $peso/($altura**2);
if($imc < 18.5){
    echo "Abaixo do Peso";
    } elseif($imc >=18.5){
        echo "Peso Normal";
        } elseif($imc < 30){
            echo "Sobrepeso";
            } elseif($imc < 35) {
                echo "Obesidade Grau I";
            } else{
                echo "Obesidade Grau II ou III";
}

?>