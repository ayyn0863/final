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
            <?php session_start(); ?>
            <?php
            require 'connect.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $pdo = new PDO($connect, USER, PASS);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // POSTデータでcatidが設定されているか確認
                    if (isset($_POST['catid'])) {
                        $_SESSION['catid'] = $_POST['catid'];
                        $catid = $_POST['catid'];

                        // 選択された猫の情報を取得
                        $stmt = $pdo->prepare("SELECT catname, text FROM Cat WHERE catid = ?");
                        $stmt->execute([$catid]);
                        $catInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                        // データベース接続を閉じる
                        $pdo = null;
                    } else {
                        echo "猫を選択してください。";
                        exit();
                    }
                } catch (PDOException $e) {
                    echo "エラー: " . $e->getMessage();
                }
            } else {
                echo "不正なアクセスです。";
                exit();
            }
            ?>
            <form action="update-output.php" method="post" onsubmit="return validateForm()">
                <label for="catname">猫の名前:</label>
                <input type="text" name="catname" value="<?php echo htmlspecialchars($catInfo['catname'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
                <label for="text">猫の説明:</label>
                <textarea name="text" required><?php echo htmlspecialchars($catInfo['text'], ENT_QUOTES, 'UTF-8'); ?></textarea><br>
                <input type="hidden" name="catid" value="<?php echo $catid; ?>">
                <a href="index.html" class="btn btn-border"><span>戻る</span></a>
                <button type="submit" class="btn btn-border" id="editLink"><span>変更</span></button>
            </form>
        </div>
    </div>
</body>
</html>