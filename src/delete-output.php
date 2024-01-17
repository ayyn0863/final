<?php session_start(); ?>
<?php
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
                $_SESSION['message'] = "削除する猫を選択してください。";
                header('Location: delete.php');
                exit();
            }

            $pdo = null;
        } catch (PDOException $e) {
            $_SESSION['message'] = "エラー: " . $e->getMessage();
            header('Location: delete.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "不正なアクセスです。";
        header('Location: delete.php');
        exit();
    }
?>