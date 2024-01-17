<?php session_start(); ?>
<?php
    require 'connect.php';

    // データベースから現在の情報を取得
    $currentCat = null;

    if (isset($_GET['catid'])) {
        $catid = $_GET['catid'];

        try {
            $pdo = new PDO($connect, USER, PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // プリペアドステートメントを作成
            $stmt = $pdo->prepare("SELECT catid, catname, text FROM Cat WHERE catid = ?");

            // プリペアドステートメントを実行
            $stmt->execute([$catid]);

            // 猫の情報を取得
            $currentCat = $stmt->fetch(PDO::FETCH_ASSOC);

            // データベース接続を閉じる
            $pdo = null;

        } catch (PDOException $e) {
            $_SESSION['message'] = "エラー: " . $e->getMessage();
            header('Location: list.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "猫が選択されていません。";
        header('Location: list.php');
        exit();
    }
?>
