<?php session_start(); ?>
<?php require 'header.php'; ?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style.css">
        <title>猫の里親-更新画面-</title>
	</head>
	<body>
        <div class="bg_pattern Paper_v2"></div>
		<a href="index.html" class="btn btn-border"><span>戻る</span></a>
        <h1 class="sample">更新</h1>
			<?php
			$name=$hinsyu=$text='';
			if(isset($_SESSION['Cat'])){
				$name=$_SESSION['Cat']['catname'];
				$text=$_SESSION['Cat']['text'];
			}
			echo '<form action="update-output.php" method="post">';
			echo '<table>';
			echo '<tr><td>猫のお名前</td><td>';
			echo '<input type="text" name="name" value="', $name,'">';
			echo '</td></tr>';
			echo '<tr><td>説明</td><td>';
			echo '<input type="text" name="text" value="', $text,'">';
			echo '</td></tr>';
			echo '</table>';
			echo '<input type="submit" value="確定">';
			echo '</form>';
			?>
	</dody>
</html>