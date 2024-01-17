<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/iroiro.css">
    <title>猫の里親-削除画面-</title>
</head>
<body>
    <?php
    require 'connect.php';

    try {
        // データベースへの接続
        $pdo = new PDO($connect, USER, PASS);
        // エラーモードを例外に設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // プリペアドステートメントを作成
        $stmt = $pdo->prepare("SELECT catid, catname FROM Cat");

        // プリペアドステートメントを実行
        $stmt->execute();

        // 猫の一覧を取得
        $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // データベース接続を閉じる
        $pdo = null;
    } catch (PDOException $e) {
        // エラーが発生した場合はエラーメッセージを表示
        echo "エラー: " . $e->getMessage();
    }
    ?>

    <div class="bg_pattern Paper_v2"></div>
    <h1 class="sample">一覧</h1>

    <div class="container">
        <div class="left-aligned-text">
            <form action="delete-output.php" method="post">
                <?php foreach ($cats as $cat): ?>
                    <label>
                        <input type="radio" name="catid" value="<?php echo $cat['catid']; ?>">
                        <?php echo $cat['catname']; ?>
                    </label><br>
                <?php endforeach; ?>
                <br>

                <div class="bobo">
                    <a href="index.html" class="btn btn-border"><span>戻る</span></a>
                    <?php if (!empty($cats)): ?>
						<a type="submit" class="btn btn-border" id="editLink"><span>削除</span></a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>