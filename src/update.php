<?php
session_start();
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

            // 猫の情報変更画面へリダイレクト
            header('Location: update-input.php');
            exit();
        } else {
            echo "猫を選択してください。";
        }
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo "不正なアクセスです。";
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
            <form action="update-input.php" method="post" onsubmit="return validateForm()">
                <?php foreach ($cats as $cat): ?>
                    <label>
                        <input type="radio" name="catid" value="<?php echo $cat['catid']; ?>">
                        <?php echo $cat['catname']; ?>
                    </label><br>
                <?php endforeach; ?>
                <br>
                <a href="index.html" class="btn btn-border"><span>戻る</span></a>
                <button type="submit" class="btn btn-border" id="editLink"><span>変更</span></button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="script/update1.js"></script>
</body>
</html>