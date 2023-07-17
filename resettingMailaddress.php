<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- cssの導入 -->
  <link rel="stylesheet" href="./css/style.css?v=2">
  <link rel="stylesheet" href="./css/resettingMailaddress.css">
      <!-- javascriptの導入 -->
<script src="./script/script.js"></script>

<!-- bootstrapのCSSの導入 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>メールアドレスの再設定画面</title>
</head>

<body>
<img class="resettingMailaddresslogo" src="img/SumaDeliIcon.png" alt="ロゴです">

<form action="resetInsertMail.php" method="post">
  <div class="container">
  <div class="child" style="text-align:center">
    <div class="container d-flex flex-column justify-content-center align-items-center mt-auto mb-auto">
      <div class="mailaddress">メールアドレスの再設定</div>
      <p class="changetext">・前のメールアドレス</p>
      <input type="email" name="beforeMail" value="" class="textbox" placeholder="既存メールアドレス">
      <p class="changetext">・新しいメールアドレス</p>
      <input type="email" name="afterMail" value="" class="textbox" placeholder="新規メールアドレス"><br>
      <input type="submit" value="変更する" class="changeButton">
        </div>
      </div>
  </div>
</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</html>