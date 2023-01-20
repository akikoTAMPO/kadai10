<?php
session_start();
require_once('funcs.php');
loginCheck();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>データ登録／JavaScriptで写真を撮影</title>
  </head>
  <body>
    <header>
      <nav>
        <div class=""><a class="" href="list.php">データ一覧</a></div>
        <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
      </nav>
  </header>
    <h1>データ登録</h1>
    <div>
      <video autoplay muted playsinline id="video" width="200"></video>
    </div>
    <div>
      <button type="button" id="button">撮影</button>
    </div>
    <div>
      <img id="image" alt="" width="200" />
    </div>
    <form action="storage.php" method="post">
      <input type="hidden" id="base64_image" name="base64_image" value="" />
      <button>画像保存</button>
    </form>
  </body>
  <script src="script.js"></script>
</html>
