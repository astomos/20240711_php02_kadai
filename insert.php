<?php
//1. POSTデータ取得
$book_name = $_POST['book_name'];
$book_url = $_POST['book_url'];
$book_comment = $_POST['book_comment'];

//2. DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_bookmark_table;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError:' . $e->getMessage());
}

//3. データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bookmark_table(book_name, book_url, book_comment, date) VALUES(:book_name, :book_url, :book_comment, NOW())");

// バインド変数を用意
$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);

// 実行
$status = $stmt->execute();

// データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  // index.phpへリダイレクト
  header("Location: index.php");
}
?>