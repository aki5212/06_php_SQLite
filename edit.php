<?php
if (!isset($_GET['id'])) {
    echo "ユーザーIDが指定されていません。";
    exit;
}

$id = $_GET['id'];

try {
    $db = new PDO('sqlite:users.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "ユーザーが見つかりません。";
        exit;
    }
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー情報編集</title>
</head>
<body>
    <h1>ユーザー情報編集</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <input type="submit" value="更新">
    </form>
    <br>
    <a href="display.php">戻る</a>
</body>
</html>
