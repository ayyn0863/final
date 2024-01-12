<?php session_start(); ?>
<?php require 'connect.php' ;?>

<?php
if (isset($_SESSION['Cat'])){
    $pdo = new PDO ($connect,USER,PASS);
    $sql=$pdo->prepare(
        'delete from favorite where customer_id=? and product_id=?');
    $sql->execute([$_SESSION['Cat']['catid'],$_GET['catid']]);
    echo '削除しました。';
    echo '<hr>';
}
require 'delete.php';
?>