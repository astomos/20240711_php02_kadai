<?php
//1. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_bookmark_table;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError:' . $e->getMessage());
}

//2. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bookmark_table");

// 実行
$status = $stmt->execute();

//3. データ表示
if ($status == false) {
  //SQL実行時にエラーがある場合
  $error = $stmt->errorInfo();
  exit("ErrorQuery:" . $error[2]);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ブックマーク表示</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/style.css" rel="stylesheet">
</head>
<body id="main">
  <header>
    <nav>
      <a href="index.php">ブックマーク登録</a>
    </nav>
  </header>
  <main>
    <div class="container">
      <h1>ブックマーク一覧</h1>
      <div class="bookmark-list">
        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
          <p>
            <?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?> : 
            <?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?> - 
            <?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?> - 
            <?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?> 
          </p>
        <?php endwhile; ?>
      </div>
    </div>
  </main>
</body>
</html>