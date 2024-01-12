<?php session_start(); ?>
<?php require 'connect.php' ;?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style.css">
        <title>猫の里親-削除画面-</title>
	</head>
	<body>
        <div class="bg_pattern Paper_v2"></div>

		<h1 class="sample">削除</h1>

		<?php
			isset($_SESSION['Cat'])
				echo '<table>';
				echo '<tr><th>猫no.</th><th>名前</th><th>品種</th><th>説明</th></tr>';
				$pdo = new PDO ($connect,USER,PASS);
				$sql=$pdo->prepare(
					'select Cat.catid,Cat.catname,Varieties.catbreedname,Cat.text
					from Cat,Varieties where Cat.catbreedid = Varieties.catbreedid');
				$sql->execute([$_SESSION['Cat']['catid']]);
				foreach ($sql as $row){
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
					echo '<td><a href="favorite-delete.php?id=',$id,'">削除</a></td>';
					echo '</tr>';
				}
				echo '</table>';
		?>
    </body>
</html>