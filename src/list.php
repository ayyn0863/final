<?php session_start(); ?>
<?php require 'connect.php' ;?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style.css">
        <title>猫の里親-一覧画面-</title>
	</head>
	<body>
        <div class="bg_pattern Paper_v2"></div>

        <h1 class="sample">一覧</h1>

		<form action="list.php" method="post">
    		品種検索
			<input type="text" name="keyword">
			<input type="submit" value="検索">
		</from>
	<hr>
		<?php
			echo '<table>';
			echo '<tr><th>猫no.</th><th>名前</th><th>品種</th><th>説明</th></tr>';
			$pdo = new PDO($connect,USER,PASS);
			if(isset($_POST['keyword'])){
    			$sql=$pdo->prepare('select * from Varieties where catbreedname like ?');
    			$sql->execute(['%'.$_POST['keyword'].'%']);
			}else{
    			$sql=$pdo->query('select cat.id,cat.name,Varieties.catbreedname,cat.text
				from cat,Varieties where cat.catbreedid = Varieties.catbreedid');
			}
			foreach($sql as $row){
    			$id=$row['catid'];
				echo '<tr>';
				echo '<td>',$id,'</td>';
				echo '<td>';
				echo $row['catname'];
				echo '</td>';
				echo '<td>';
				echo $row['catbreedname'];
				echo '</td>';
				echo '<td>';
				echo $row['text'];
				echo '</td>';
				echo '</tr>';
		}
		echo '</table>';
		?>
    </body>
</html>
<?php
 $pdo = null;   //DB切断
 ?>