
<?php
		$conn = new mysqli("localhost", "root", "","documentos");
		mysqli_set_charset($conn,"utf8");

		$arquivo 	= $_FILES["file"]["tmp_name"];
        $nome 		= $_FILES["file"]["name"];
        $tamanho 	= $_FILES["file"]["size"];


        $fp = fopen($arquivo,"rb");//Abro o arquivo que está no $temp   
    	$documento = fread($fp, $tamanho);//Leio o binario do arquivo
    	fclose($fp);//fecho o arquivo

		$dados = bin2hex($documento);

		$sql = "INSERT INTO arquivos (nome, tamanho, conteudo, data) VALUES ('$nome','$tamanho','$dados',now())";

     	$result = $conn->query($sql)or die(mysqli_errno());

?>