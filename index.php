<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>ユーザー情報入力</title>
</head>
<body>
    <h1>ユーザー情報入力</h1>
    <form action="save.php" method="post">
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="保存">
    </form>
    <br>
    <a href="display.php">保存されたユーザー情報を表示</a>
</body>
</html>
