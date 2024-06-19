<?php
try {
    $db = new PDO('sqlite:users.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM users";
    $stmt = $db->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>保存されたユーザー情報</title>
</head>
<body>
    <h1>保存されたユーザー情報</h1>
    <table border="1">
        <tr>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>操作</th>
        </tr>
        <?php if ($users): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $user['id']; ?>">編集</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>" onclick="return confirm('本当に削除しますか？');">削除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">ユーザー情報がありません。</td>
            </tr>
        <?php endif; ?>
    </table>
    <br>
    <a href="index.php">戻る</a>
</body>
</html>
