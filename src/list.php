<?php session_start(); ?>
<?php require 'connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/iroiro.css">
        <title>猫の里親-一覧画面-</title>
	</head>
	<body>
        <div class="bg_pattern Paper_v2"></div>
        <h1 class="sample">一覧</h1>
		<form action="list.php" method="post">
    		品種検索
			<input type="text" name="keyword">
			<input type="submit" value="検索">
		</form>
		<hr>
		<?php
			echo '<div class="container">';
			echo '<div class="left-aligned-text">';
			echo '<table>';
			echo '<tr><th>猫no.</th><th>名前</th><th>品種</th><th>説明</th></tr>';
			$pdo = new PDO($connect, USER, PASS);
			if(isset($_POST['keyword'])){
    			$sql=$pdo->prepare('select Cat.catid, Cat.catname, Varieties.catbreedname, Cat.text
                                   from Cat
                                   join Varieties on Cat.catbreedid = Varieties.catbreedid
                                   where Varieties.catbreedname like ?');
    			$sql->execute(['%'.$_POST['keyword'].'%']);
			}else{
    			$sql=$pdo->query('select Cat.catid, Cat.catname, Varieties.catbreedname, Cat.text
				from Cat
				join Varieties on Cat.catbreedid = Varieties.catbreedid');
			}
			if ($sql->rowCount() > 0) {
				foreach ($sql as $row) {
					$id = $row['catid'];
					echo '<tr>';
					echo '<td>', $id, '</td>';
					echo '<td>', $row['catname'], '</td>';
					echo '<td>', $row['catbreedname'], '</td>';
					echo '<td>', $row['text'], '</td>';
					echo '</tr>';
				}
			} else {
				echo '<tr><td colspan="4">データがありません</td></tr>';
			}
			echo '</table>';
			echo '</div>';
			echo '</div>';
		?>
		<a href="index.html" class="btn btn-border"><span>戻る</span></a>
		</div>
		</div>
		<img src="img/3.jpg" width="200">
    </body>
</html>
<?php
 $pdo = null;   //DB切断
 ?>