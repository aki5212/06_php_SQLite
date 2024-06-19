<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "無効な入力です。<br>";
        echo "<a href='index.php'>戻る</a>";
        exit;
    }

    try {
        $db = new PDO('sqlite:users.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo "ユーザー情報が保存されました。<br>";
        echo "<a href='index.php'>戻る</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "このメールアドレスは既に登録されています。<br>";
        } else {
            echo "データベースエラー: " . $e->getMessage() . "<br>";
        }
        echo "<a href='index.php'>戻る</a>";
    }
}
?>
