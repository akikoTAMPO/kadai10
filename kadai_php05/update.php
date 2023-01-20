<?php
session_start();
require_once('funcs.php');
loginCheck();

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1. POSTデータ取得
$id = $_POST['id'];



// 関数作成追加
function getExtension($mime_type)
{
    $extensions = [
                    'image/jpeg' => 'jpeg',
                    'image/png' => 'png',
                    'image/gif' => 'gif',
                    'image/bmp' => 'bmp',
                    ];
    return $extensions[$mime_type];
}

// もしフォームの送信がおかしければ以下エラー文出して処理を終了させる。
if ($_POST['base64_image'] === '') {
    exit('ブラウザバックして、もう一度やり直してください。');
}

// postされたデータの文頭「data:image/png;base64」を消す
// 参考 https://stackoverflow.com/questions/15153776/convert-base64-string-to-an-image-file
$data = explode(',', $_POST['base64_image']);

// base64をデコード
$image = base64_decode($data[1]);

// fileのmimeタイプ取得(image/jpegが送られてくるので、多分この処理は不要)
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo->buffer($image);

// fileの拡張子取得
$extension = getExtension($mime_type);

// 画像保存先フォルダ（imgフォルダ）がなければ作成
// if (!file_exists('img')) {
//     mkdir('img', 0777);
// }
// imgファイルパーミッション変更がうまくいかないので明示的指定
// chmod()を実行する際は実行ユーザと対象ファイルの所有者ユーザが一緒でなければなりません
// chmod('img', 0777);

// ファイルの保存(名前は、日付 + _image.jpeg の形にしてます。)
$file_name = date('YmdHis')."_image.{$extension}";
file_put_contents('img/' . $file_name, $image);

if (file_exists('img/' . $file_name)) {
    // 作業しやすい様に、権限変えちゃってます。
    chmod('img/' . $file_name, 0777);
    echo 'imgフォルダに保存しました。';
    echo '保存名 : ' . 'img/' . $file_name;
} else {
    echo '保存できませんでした。.';
}



//2. DB接続します
// funcs.phpを呼び出す
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare(
                    'UPDATE
                        image_table 
                    SET
                        update_at = sysdate(),
                        img_file_name = :file_name
                        WHERE id = :id;');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':file_name', $file_name, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: list.php');
    exit();
}
