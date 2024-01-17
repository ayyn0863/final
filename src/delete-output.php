<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // POSTデータでcatidが設定されているか確認
        if (isset($_POST['catid'])) {
            $catid = $_POST['catid'];

            // 削除用のクエリを準備して実行
            $stmt = $pdo->prepare("DELETE FROM Cat WHERE catid = ?");
            $stmt->execute([$catid]);

            // リダイレクト
            header('Location: list.php');
            exit();
        } else {
            echo "削除する猫を選択してください。";
        }

        $pdo = null;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo "不正なアクセスです。";
}
?>