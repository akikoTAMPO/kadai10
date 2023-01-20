<?php
session_start();
require_once('funcs.php');
loginCheck();

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

/**
 * DB接続のための関数をfuncs.phpに用意
 * require_onceでfuncs.phpを取得
 * 関数を使えるようにする。
 */

// DB接続　funcs.phpを呼び出す
require_once('funcs.php');
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM 
                            image_table
                        WHERE uid = :uid
                        ');
// 数字の場合 PDO::PARAM_INT
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
$status = $stmt->execute();



//３．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<div class="container jumbotron">';
        $view .= '<p>';
            $view .= '<a href="detail.php?id=' . h($result['id']) . '">';
        $view .= '作成日：' . $result['created_at'] . '<br>' . 'ファイル名：' . h($result['img_file_name']) . '<br>';
            $view .='</a>';

            $view .='<img src="./img/' . h($result['img_file_name']) . '">' . '<br>';


        $view .= '<a href="delete.php?id=' . h($result['id']) . '">';
        $view .= '[ 削除▶ ]';
        $view .='</a>';

        $view .= '<a href="retake.php?id=' . h($result['id']) . '">';
        $view .= '[ 再撮影 ]';
        $view .='</a>';


        $view .= '</p>';
        $view .= '</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>データ一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <h1 class="navbar-brand">データ一覧</h1>
                    <br>
                    <a class="navbar-brand" href="post.php">[データ登録▶]</a>
                    <a class="navbar-brand" href="logout.php">[logout▶]</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <p>
            ユーザー名：<?php echo $name ?>さん
        </p>
    </div>
    <div>
        <?= $view ?>
    </div>
    <!-- Main[End] -->

</body>

</html>
