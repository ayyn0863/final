<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/iroiro.css">
    <title>猫の里親-更新画面-</title>
</head>
<body>
		<div class="bg_pattern Paper_v2"></div>
        <h1 class="sample">更新</h1>

    <?php
    require 'connect.php';

    try {
        // データベースへの接続
        $pdo = new PDO($connect, USER, PASS);
        // エラーモードを例外に設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // URLパラメータから猫のIDを取得
        $catid = $_GET['catid'];

        // プリペアドステートメントを作成
        $stmt = $pdo->prepare("SELECT catname, text FROM Cat WHERE catid = :catid");

        // パラメータに値をバインド
        $stmt->bindParam(':catid', $catid);

        // プリペアドステートメントを実行
        $stmt->execute();

        // 猫の情報を取得
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // データベース接続を閉じる
        $pdo = null;
    } catch (PDOException $e) {
        // エラーが発生した場合はエラーメッセージを表示
        echo "エラー: " . $e->getMessage();
    }
    ?>

    <form action="update.php" method="post">
        <input type="hidden" name="catid" value="<?php echo $catid; ?>">
        <div class="bg_pattern Paper_v2"></div>
        <h1 class="sample">更新</h1>

        <div class="container">
            <div class="left-aligned-text">
                猫ちゃんのお名前<br>
                <input type="text" class="text" name="catname" value="<?php echo $row['catname']; ?>"><br>
                <br>

                説明<br>
                <textarea class="text" name="cattext" cols="30" rows="5"><?php echo $row['text']; ?></textarea><br>
                <br>

                <div class="bobo">
                    <a href="list.php" class="btn btn-border"><span>戻る</span></a>
                    <button type="submit" class="btn btn-border"><span>更新する</span></button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>