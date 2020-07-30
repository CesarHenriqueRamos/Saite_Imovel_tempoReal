<?php
	include('../config.php');
	$data ='teste';
	//print_r($_POST);
	    //print_r($_POST);
		$preco = @$_POST['preco'];
		$area = @$_POST['area'];
		$cidade = @$_POST['cidade'];
		$tipo = @$_POST['tipo'];
		$acao = @$_POST['acao'];
		$query ="";
		if($cidade != ''){
			$query = $query." cidade = '$cidade'";
		}
		if($area != ''){
			$query = $query." && area <= '$area'";
		}
		if($preco != ''){
			$query = $query." && preco <= '$preco'";
		}
		if($acao != ''){
			$query = $query." && tipo = '$acao'";
		}       
		//echo $query;
		/*if($tipo != ''){
			$query = $query." && tipo = '$tipo'";
		}*/
		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE $query");
		$sql->execute();
		$dados = $sql->fetchAll();
//	print_r($dados);
	
foreach($dados as $key => $value){
	$imovel = $value['id'];
	$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imovel_imagem` WHERE id_imovel = ?");
        $sql->execute(array($imovel));
        $imagem_imovel = $sql->fetch();
	echo '<div class="imovel-single">
            <div class="imagem-imovel">
				<img src="'.INCLUDE_PATH_PAINEL.'/uploads/'.$imagem_imovel['imagem'].'" alt="">
            </div>
            <div class="dados-imovel">
                <div class="w50">
                    <h2><a href="">'.$value["nome"].'</a></h2>
                    <p>Valor:'.number_format($value['preco'],2,",",".").'</p>
                    <p>'.$value["area"].'</p>
                    <p>'.$value["tipo"].'</p>
                </div>
                <div class="w50">
                    <h2>Contato:</h2>
                    <button>Contato</button>
                </div>
               
            </div>
	   </div>';
}
?>