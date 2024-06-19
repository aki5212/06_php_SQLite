<?php
try {
    $db = new PDO('sqlite:users.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE
              )";

    $db->exec($query);
    echo "データベースとテーブルが作成されました。";
} catch (PDOException $e) {
    echo "データベースの作成に失敗しました: " . $e->getMessage();
}
?>
