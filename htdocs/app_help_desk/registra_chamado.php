<?php

	session_start();

	$save = true;
	
	//Tratando o texto para que não haja nenhum problema
	foreach ($_POST as $key => $value) {
		if(empty($_POST[$key])){
			//Caso algum dos parâmetros esteja vazio ele não salva
			//também não escreve no arquivo de texto
			foreach ($_POST as $key => $value) {
				unset($_POST[$key]);
			}
			$save = false;
			break;
		}
		
		$_POST[$key] = str_replace('#', '-', $_POST[$key]);
	}


	if($save){
		$texto = $_SESSION['id'] . '#' . implode('#', $_POST) . PHP_EOL;

		//Escrevendo no arquivo de texto
		$arquivo = fopen('../../app_help_desk/arquivo.txt', 'a');
		fwrite($arquivo, $texto);
		fclose($arquivo);
	}

	header('Location: abrir_chamado.php');

?>