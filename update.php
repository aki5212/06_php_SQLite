<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($id) || empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "無効な入力です。<br>";
        echo "<a href='edit.php?id=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "'>戻る</a>";
        exit;
    }

    try {
        $db = new PDO('sqlite:users.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo "ユーザー情報が更新されました。<br>";
        echo "<a href='display.php'>戻る</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "このメールアドレスは既に登録されています。<br>";
        } else {
            echo "データベースエラー: " . $e->getMessage() . "<br>";
        }
        echo "<a href='edit.php?id=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "'>戻る</a>";
    }
}
?>
