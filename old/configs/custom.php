<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'connect.php'; 
    
	$db_host = "192.95.43.212"; 
	$db_user = "cemiteri_test";  
	$db_pass = 'PGV1478965$c$'; 
	$db_name = "cemiteri_startups";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Consulta que contabiliza resultado mais frenquente de problemas relatados em tabela 'startup'.
    $sql = "SELECT `id_problem`, COUNT( * ) as n FROM startup WHERE `id_problem` != 6 GROUP BY `id_problem` ORDER BY n DESC LIMIT 1";
    
	$result = $conn->query($sql);
	
	
	while($row = $result->fetch_assoc()) {
            //echo "id: " . $row["id_problem"]. "<br>";
            $name_problem_ref = $row['id_problem'];
			
	        }

    // Consulta que converte o valor contabilizado de resultados mais frequentes em String de tabela 'problem' relacionada.
    $sql1 = "SELECT * FROM problem WHERE id ={$name_problem_ref}";
	
    $result1 = $conn->query($sql1);
	
    while($row1 = $result1->fetch_assoc()) {
            //echo "name_problem: " . $row1["name_problem"]. "<br>";
            $name_problem = $row1["name_problem"];
        }
    
    // Consulta que contabiliza resultado mais frenquente de cidades relatadas em tabela 'startup'.
    $sql2 = "SELECT city, COUNT( * ) n FROM startup WHERE city IS NOT NULL GROUP BY city ORDER BY n DESC LIMIT 1";
    $result2 = $conn->query($sql2);
    while($row2 = $result2->fetch_assoc()) {
            //echo "city: " . $row2["city"]. "<br>";
            $city = $row2["city"];
        }

    // Consulta que retorna número total de startups cadastradas em Banco de Dados.
    $db_numRows = new Database();
    $db_numRows->connect();
    $db_numRows->select('startup');
    $res_numRows = $db_numRows->numRows();

?>