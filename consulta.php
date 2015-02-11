<?php
$ddd = 19;
$numero = $argv[1];
$chave = 'xxxxxxxxxxxxxxxxxxxx';
if(strlen($numero) < 10 ){
 $numero = $ddd.$numero;
}
$url = "http://consultanumero2.telein.com.br/sistema/consulta_operadora.php?numero=$numero&chave=$chave"; 
$texto_resposta = file_get_contents($url);
echo $texto_resposta;
?>
