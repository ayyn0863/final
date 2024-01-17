<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['catid'])) {
        try {
            require 'connect.php';

            $pdo = new PDO($connect, USER, PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $catid = $_SESSION['catid'];

            // 選択された猫の情報を取得
            $stmt = $pdo->prepare("SELECT catname, text FROM Cat WHERE catid = ?");
            $stmt->execute([$catid]);
            $catInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            // データベース接続を閉じる
            $pdo = null;
        } catch (PDOException $e) {
            echo "エラー: " . $e->getMessage();
        }
    } else {
        echo "不正なアクセスです。";
        exit();
    }
} else {
    echo "不正なアクセスです。";
    exit();
}
?>

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
    <div class="container">
        <div class="left-aligned-text">
            <form action="update-output.php" method="post">
                <label for="catname">猫の名前：</label>
                <input type="text" id="catname" name="catname" value="<?php echo htmlspecialchars($catInfo['catname'], ENT_QUOTES, 'UTF-8'); ?>"><br>
                <label for="text">猫の説明：</label>
                <textarea id="text" name="text"><?php echo htmlspecialchars($catInfo['text'], ENT_QUOTES, 'UTF-8'); ?></textarea><br>
                <input type="submit" value="更新">
            </form>
        </div>
    </div>
</body>
</html>