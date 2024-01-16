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
    <?php
    require 'connect.php';

    try {
        // データベースへの接続
        $pdo = new PDO($connect, USER, PASS);
        // エラーモードを例外に設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // URLパラメータから猫のIDを取得
        $catid = $_POST['catid'];

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

    <form id="appForm" action="update.php" method="post">
        <input type="hidden" name="catid" value="<?php echo $catid; ?>">
        <div class="bg_pattern Paper_v2"></div>
        <h1 class="sample">更新</h1>

        <div class="container">
            <div class="left-aligned-text">
                猫ちゃんのお名前<br>
                <input type="text" class="text" name="catname" v-model="catname" :value="catname"><br>
                <div v-if="!catname" class="error">猫ちゃんのお名前を入力してください</div>
                <br>

                説明<br>
                <textarea class="text" name="cattext" v-model="cattext" cols="30" rows="5" :value="cattext"></textarea><br>                
                <div v-if="!cattext" class="error">説明を入力してください</div>
                <br>

                <!-- エラーメッセージ表示 -->
                <div v-if="errorMsg" class="error">{{ errorMsg }}</div>

                <div class="bobo">
                <a href="#" class="btn btn-border" @click="goBack"><span>戻る</span></a>
                <a href="#" class="btn btn-border" @click.prevent="submitForm" :disabled="!catname || !cattext"><span>更新する</span></a>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="script/update2.js"></script>

</body>
</html>