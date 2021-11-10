<?php

	$pdo = new \PDO(
		'mysql:host=mysql;dbname=libras', 
		'root', 
		'32130'
	);

	$stmt = $pdo->query("SELECT * FROM usuario");
	$all = $stmt->fetchall(PDO::FETCH_ASSOC);
    
    echo "<pre>".print_r($all, true);
   
	