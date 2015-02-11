<?php
$servername = "localhost";
$username = "teleinuser";
$password = "XXXXXXXXXXXXXXXX";
$dbname = "telein";

$ddd = 19;
$numero = $argv[1];
$chave = 'xxxxxxxxxxxxxxxxxxxx';
if(strlen($numero) < 10 ){
 $numero = $ddd.$numero;
}

$db = mysql_connect($servername,$username,$password) or die("Database error"); 
mysql_select_db($dbname, $db); 
$query= "SELECT `resposta` FROM `consuta` WHERE `data`  > timestampadd(day,-3,now()) and `numero` = \"".$numero."\""; 
$result = mysql_query($query) or die ("Error in query: $query " . mysql_error()); 
$row = mysql_fetch_array($result); 
$num_results = mysql_num_rows($result); 
if ($num_results > 0){ 
 $texto_resposta = $row['resposta'];
}else{
 $url = "http://consultanumero2.telein.com.br/sistema/consulta_operadora.php?numero=$numero&chave=$chave";
 $texto_resposta = file_get_contents($url);
 $query= "INSERT INTO `consuta`(`numero`,`resposta`,`data`) VALUES(\"".$numero."\",\"".$texto_resposta."\",CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE
numero=VALUES(`numero`), resposta=VALUES(`resposta`),data=VALUES(`data`)";
 $result = mysql_query($query) or die ("Error in query insert or update: $query " . mysql_error());
} 
echo $texto_resposta;
?>
