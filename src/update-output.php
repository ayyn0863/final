<?php
session_start();
require 'connect.php';

try {
    // データベースへの接続
    $pdo = new PDO($connect, USER, PASS);
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTデータから取得
    $catid = $_POST['catid'];
    $catname = $_POST['catname'];
    $cattext = $_POST['cattext'];

    // プリペアドステートメントを作成
    $stmt = $pdo->prepare("UPDATE Cat SET catname = :catname, text = :cattext WHERE catid = :catid");

    // パラメータに値をバインド
    $stmt->bindParam(':catname', $catname);
    $stmt->bindParam(':cattext', $cattext);
    $stmt->bindParam(':catid', $catid);

    // プリペアドステートメントを実行
    $stmt->execute();

    // 更新成功時にリダイレクト
    header("Location: list.php");
    exit();

} catch (PDOException $e) {
    // エラーが発生した場合はエラーメッセージを表示
    echo "エラー: " . $e->getMessage();
}

// データベース接続を閉じる
$pdo = null;
?>