<?php session_start(); ?>
<?php require 'connect.php' ;?>

<?php
try {
    if (isset($_POST['catname']) && isset($_POST['catbreedid']) && isset($_POST['text'])) {
        
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 重複したcatnameの確認
        $sql = $pdo->prepare('SELECT * FROM Cat WHERE catname = ?');
        $sql->execute([$_POST['catname']]);
        $existingUser = $sql->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            echo '<script>alert("同じ名前の猫が既に存在します。");</script>';
            echo '<a href="reg.php">登録画面に戻る</a><br>';
            exit();
        }

        // Catテーブルにデータを挿入する正しいSQLクエリ
        $sql = $pdo->prepare('INSERT INTO Cat (catname, catbreedid, text) VALUES (?, ?, ?)');
        $sql->execute([
            $_POST['catname'],
            $_POST['catbreedid'],
            $_POST['cattext']
        ]);

        // 登録が成功した場合、list.php にリダイレクト
        header('Location: list.php');
        exit();
    } else {
        // データが足りない場合の処理
        echo '<script>alert("データが不足しています。");</script>';
        echo '<a href="reg.php">登録画面に戻る</a><br>';
    }
} catch (PDOException $e) {
    // エラーハンドリング
    echo '<script>alert("データベースエラー")</script>' . htmlspecialchars($e->getMessage());
    echo '<a href="reg.php">登録画面に戻る</a><br>';
}
?>
<?php
 $pdo = null;   //DB切断
 ?>