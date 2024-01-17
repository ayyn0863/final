<?php
session_start();
require 'connect.php';

// 選択された猫のIDを取得
$selectedCatId = isset($_SESSION['selectedCat']) ? $_SESSION['selectedCat'] : null;

if (!$selectedCatId) {
    // 選択されていない場合はアラートを表示してlist.phpにリダイレクト
    echo "<script>alert('猫を選択してください。'); window.location='list.php';</script>";
    exit();
}

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 選択された猫の情報を取得
    $stmt = $pdo->prepare("SELECT catname, cattext FROM Cat WHERE catid = ?");
    $stmt->execute([$selectedCatId]);
    $catInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    // データベース接続を閉じる
    $pdo = null;
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/iroiro.css">
    <title>猫の里親-変更画面-</title>
</head>
<body>
    <div class="bg_pattern Paper_v2"></div>
    <h1 class="sample">変更</h1>

    <div class="container">
        <div class="left-aligned-text">
            <form action="update-output.php" method="post">
                <label for="catname">猫の名前：</label>
                <input type="text" id="catname" name="catname" value="<?php echo $catInfo['catname']; ?>" required><br>

                <label for="cattext">猫の説明：</label>
                <textarea id="cattext" name="cattext" required><?php echo $catInfo['cattext']; ?></textarea><br>

                <a href="list.php" class="btn btn-border"><span>戻る</span></a>
                <button type="submit" class="btn btn-border" id="editLink"><span>更新</span></button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="script/update1.js"></script>
</body>
</html>