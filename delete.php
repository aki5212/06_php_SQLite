<?php
if (!isset($_GET['id'])) {
    echo "ユーザーIDが指定されていません。";
    exit;
}

$id = $_GET['id'];

try {
    $db = new PDO('sqlite:users.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "ユーザー情報が削除されました。<br>";
    echo "<a href='display.php'>戻る</a>";
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
}
?>
