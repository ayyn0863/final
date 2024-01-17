<?php session_start(); ?>
<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // POSTデータでcatidが設定されているか確認
        if (isset($_SESSION['catid'])) {
            $catid = $_SESSION['catid'];
            $newCatname = $_POST['new_catname'];
            $newCattext = $_POST['new_cattext'];

            // 現在の猫の情報を取得
            $stmt = $pdo->prepare("SELECT catname, cattext FROM Cat WHERE catid = ?");
            $stmt->execute([$catid]);
            $currentCatInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            // 現在の情報と新しい情報が同じでないか確認
            if ($currentCatInfo['catname'] !== $newCatname || $currentCatInfo['cattext'] !== $newCattext) {
                // 更新用のクエリを準備して実行
                $stmt = $pdo->prepare("UPDATE Cat SET catname = ?, cattext = ? WHERE catid = ?");
                $stmt->execute([$newCatname, $newCattext, $catid]);

                // 更新が成功したらメッセージを表示
                echo "更新が成功しました。";
            } else {
                // 内容が同じ場合はアラートを表示
                echo "内容が同じです。";
            }

            // セッションのcatidを削除
            unset($_SESSION['catid']);

            // リダイレクト
            header('Location: list.php');
            exit();
        } else {
            echo "猫を選択してください。";
        }

        $pdo = null;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo "不正なアクセスです。";
}
?>