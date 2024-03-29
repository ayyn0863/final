<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['catid'])) {
        try {
            require 'connect.php';

            $pdo = new PDO($connect, USER, PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $catid = $_SESSION['catid'];
            $catname = $_POST['catname'];
            $text = $_POST['text'];

            // 現在の猫の情報を取得
            $stmt = $pdo->prepare("SELECT catname, text FROM Cat WHERE catid = ?");
            $stmt->execute([$catid]);
            $currentCatInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            // 変更がない場合はエラーを出力して終了
            if ($currentCatInfo['catname'] === $catname && $currentCatInfo['text'] === $text) {
                echo "内容が同じです。";
                exit();
            }

            // 更新用のクエリを準備して実行
            $stmt = $pdo->prepare("UPDATE Cat SET catname = ?, text = ? WHERE catid = ?");
            $stmt->execute([$catname, $text, $catid]);

            // データベース接続を閉じる
            $pdo = null;

            // 更新が成功したらリダイレクト
            header('Location: list.php');
            exit();
        } catch (PDOException $e) {
            echo "エラー: " . $e->getMessage();
        }
    } else {
        // 不正なアクセスではなく、セッションのcatidが存在しない場合は何も出力しない
        exit();
    }
} else {
    // 不正なアクセスではなく、POSTリクエストでない場合は何も出力しない
    exit();
}
?>