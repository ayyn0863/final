<?php session_start(); ?>
<?php require 'connect.php' ;?>

<?php
try {
    // データベースへの接続
    $pdo = new PDO ($connect,USER,PASS);
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTデータから取得
    $catname = $_POST['catname'];
    $catbreedid = $_POST['catbreedid'];
    $cattext = $_POST['cattext'];

    // プリペアドステートメントを作成
    $stmt = $pdo->prepare("INSERT INTO Cat (catname, catbreedid, text) VALUES (:catname, :catbreedid, :cattext)");

    // パラメータに値をバインド
    $stmt->bindParam(':catname', $catname);
    $stmt->bindParam(':catbreedid', $catbreedid);
    $stmt->bindParam(':cattext', $cattext);

    // プリペアドステートメントを実行
    $stmt->execute();

    // 登録成功時にリダイレクト
    header("Location: list.php");
    exit();

} catch(PDOException $e) {
    // エラーが発生した場合はエラーメッセージを表示
    echo "エラー: " . $e->getMessage();
}

// データベース接続を閉じる
$pdo = null;
?>