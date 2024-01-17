<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 選択された猫のIDを取得
        $selectedCatId = isset($_SESSION['selectedCat']) ? $_SESSION['selectedCat'] : null;

        // POSTデータでcatnameとcattextが設定されているか確認
        if ($selectedCatId && isset($_POST['catname']) && isset($_POST['cattext'])) {
            $catname = $_POST['catname'];
            $cattext = $_POST['cattext'];

            // 選択された猫の現在の情報を取得
            $stmt = $pdo->prepare("SELECT catname, cattext FROM Cat WHERE catid = ?");
            $stmt->execute([$selectedCatId]);
            $currentCatInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            // 変更があるか確認
            if ($currentCatInfo['catname'] !== $catname || $currentCatInfo['cattext'] !== $cattext) {
                // 変更がある場合はクエリを準備して実行
                $stmt = $pdo->prepare("UPDATE Cat SET catname = ?, cattext = ? WHERE catid = ?");
                $stmt->execute([$catname, $cattext, $selectedCatId]);

                // 更新が成功したらメッセージを表示
                echo "<script>alert('更新が成功しました。'); window.location='list.php';</script>";
                exit();
            } else {
                // 変更がない場合はアラートを表示してindex.htmlにリダイレクト
                echo "<script>alert('内容が同じです。'); window.location='index.html';</script>";
                exit();
            }
        } else {
            // 選択されていない場合はアラートを表示してlist.phpにリダイレクト
            echo "<script>alert('猫を選択してください。'); window.location='list.php';</script>";
            exit();
        }

        $pdo = null;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo "不正なアクセスです。";
}
?>