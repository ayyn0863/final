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
    <?php session_start(); ?>
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

        // 選択された猫の情報を初期化
        $selectedCat = null;

        // 選択された猫の情報を取得
        if (isset($_SESSION['selectedCat'])) {
            $selectedCatId = $_SESSION['selectedCat'];
            $stmt = $pdo->prepare("SELECT catname FROM Cat WHERE catid = ?");
            $stmt->execute([$selectedCatId]);
            $selectedCat = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // データベース接続を閉じる
        $pdo = null;
    } catch (PDOException $e) {
        // エラーが発生した場合はエラーメッセージを表示
        echo "エラー: " . $e->getMessage();
    }
    ?>

    <div class="bg_pattern Paper_v2"></div>
    <h1 class="sample">更新</h1>

    <div class="container">
        <div class="left-aligned-text">
            <form action="update-output.php" method="post" onsubmit="return validateForm()">
                <?php foreach ($cats as $cat): ?>
                    <label>
                        <input type="radio" name="catid" value="<?php echo $cat['catid']; ?>"
                            <?php echo ($selectedCatId == $cat['catid']) ? 'checked' : ''; ?>>
                        <?php echo $cat['catname']; ?>
                    </label><br>
                <?php endforeach; ?>
                <br>
                <a href="list.php" class="btn btn-border"><span>戻る</span></a>
                <?php if ($selectedCat): ?>
                    <button type="submit" class="btn btn-border" id="editLink"><span>更新</span></button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="script/update1.js"></script>
</body>
</html>