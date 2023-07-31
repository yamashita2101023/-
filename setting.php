<?php
session_start();
if(isset($_SESSION['id']) == false  &&
     isset($_SESSION['name']) == false ){
      function func_alert($message){
        echo "<script>alert('$message');</script>";
        //アラートのOKを押したらログイン画面に移動
        echo "<script>location.href='login.php';</script>";
    }
    func_alert("セッションが切れたため、もう一度ログインしなおしてください");
}
?>
<!DOCTYPE html>
    <html lang="ja">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- cssの導入 -->
      <link rel="stylesheet" href="./css/style.css?v=2">
      <!-- <link rel="stylesheet" href="./css/resettingMailaddress.css">
      <link rel="stylesheet" href="./css/createRecipe.css"> -->
    <!-- javascriptの導入 -->
    <script src="./script/script.js"></script>
    
    <!-- bootstrapのCSSの導入 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- 検索ボックス導入のためのcss -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- header導入のためのcss -->
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/css/5-1-14.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">

    <!-- この画面のCSS -->
    <link rel="stylesheet" href="./css/setting.css">
    <link rel="stylesheet" href="./css/createRecipe.css">

      <title>設定画面</title>

      <?php
        //DAOの呼び出し
        require_once 'DAO.php';
        $dao = new DAO();

        //マイページなので、セッションのidを利用して自分のユーザ情報を検索
        $userdata = $dao->selectUser($_SESSION['id']);


    ?>
    
    </head>

    <body>
       <!-- ナビゲーションバー(本気) -->
   <header id="header">
        <div class="text-start">
            <a href="top.php"><img class="logo" src="img/SumaDeliIcon.png" alt="スマデリ"></a>
        </div>
        
    </header>

    <div class="openbtn1">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav id="g-nav">
        <div id="g-nav-list"><!--ナビの数が増えた場合縦スクロールするためのdiv※不要なら削除-->
            <ul>
                <!-- <li>ここに色々書くと横から出てくる奴に表示されます</li> -->
            
                <!-- ユーザ情報表示 -->
                <div>
                    <!-- マイページへ遷移 -->
                    <a href="myPage.php" class="row ml-5" style="text-decoration: none;">
                    <?php
                            echo"
                                <img class='col-3 img-fluid' id='iconsize' src='".$userdata['user_icon']."'>
                                <h3 class='col-6 text-start ml-3 pt-2' style='text-decoration: none; color: #333333;'>".$userdata['user_name']."</h3>
                            ";
                        ?>
                        <!-- <img class="col-3 img-fluid" src="img/UserIcon_default.png">
                        <h3 class="col-6 text-start ml-3 pt-2" style="text-decoration: none; color: #333333;">ユーザ名</h3> -->
                    </a>
                </div>


                <!-- 虫眼鏡付きの検索ボックス -->
                <li class="text-start">
                    <form action="searchResult.php" method="post" class="search_container">
                        <input type="text" name="recipe_name" size="15" placeholder="料理名・食材名">
                        <input type="submit" value="&#xf002">
                    </form>
                </li>
                <div class="mt-3" style="border-bottom: 1px solid #ff7800;"></div>
                <li><a href="top.php">Top画面</a></li>
                <li><a href="ranking.php">ランキング</a></li>
                <li><a href="myPage.php">マイページ</a></li>
                <li><a href="createRecipe.php">レシピを作る</a></li>
            </ul>            
        </div>
    </nav>
    <!-- <img class="resettingMailaddresslogo" src="img/SumaDeliIcon.png" alt="ロゴです"> -->

      <!-- <div class="container">
      <div class="child">
        <div class="container d-flex flex-column justify-content-center align-items-center mt-auto mb-auto
          <div class="mailaddress">メールアドレスの再設定</div> -->
      <div class="Area">
        <form action="change_user_name.php" method="post">
            <p class="changetext">ユーザー名</p>
            <p><input type="text" name="Chenge_user_name" value="" class="change-textbox" placeholder="例：麻生太郎"></p>
            <p><input type="submit" value="ユーザー名を設定する" class="change-button"></P>
            </form>

            <form action="introduction.php" method="post">
            <p class="changetext">紹介文</p>
            <p><input type="text" name="Change_introduction" value="" class="change-textbox" placeholder="例：よろしくお願いします。"></p>
            <p><input type="submit" value="紹介文を設定する" class="change-button"></p>
            </form>

            <div class="icon-area">
              <form action="update_icon.php" method="post" enctype="multipart/form-data">
              <p class="changetext">アイコン</p>
              <!-- <input type="file" id="icon_change" name="icon" /> -->
              <div id="icon_preview">
              <?php
              // require_once 'DAO.php';
              // $dao = new DAO();
              //アイコン表示する関数を起動し、returnで帰ってきた値を格納
              $result_icon = $dao->display_the_icon($_SESSION['id']);
              //result_iconをforeachで回す
              foreach($result_icon as $row){
                //アイコン情報を取得
                  $img = $row['user_icon'];
                  //アイコンを表示
                  echo "<p><img src=$img></p>";
              }
              ?>
              </div>
            
            <!-- <input type="file" class="file-input noneDisplay" name="How_To_image[]" id="How_To_image1" onchange='handleFileSelectHowTo("How_To_image1","image1")'> -->
            <input type="file" id="icon_change"  name="icon" class="noneDisplay icon-file" />
            <div class="icon-button-area">
              <input type="button" value="アイコンを選択" class="icon-change-button" onclick="document.getElementById('icon_change').click()" >   <input type="submit" name="upload" value="アイコンを確定" class="icon-change-button icon-change-button-Confirm">
            </div>
           
            </form>
            </div>

            <form action="change_prefecture.php" method="post">
            <p class="changetext">都道府県</p>
            <select name="change_user_prefecture" class="select-dropdown">
                      <option value="0">県を指定しない</option>
                      <option value="1">北海道</option>
                      <option value="2">青森県</option>
                      <option value="3">岩手県</option>
                      <option value="4">宮城県</option>
                      <option value="5">秋田県</option>
                      <option value="6">山形県</option>
                      <option value="7">福島県</option>
                      <option value="8">茨城県</option>
                      <option value="9">栃木県</option>
                      <option value="10">群馬県</option>
                      <option value="11">埼玉県</option>
                      <option value="12">千葉県</option>
                      <option value="13">東京都</option>
                      <option value="14">神奈川県</option>
                      <option value="15">新潟県</option>
                      <option value="16">富山県</option>
                      <option value="17">石川県</option>
                      <option value="18">福井県</option>
                      <option value="19">山梨県</option>
                      <option value="20">長野県</option>
                      <option value="21">岐阜県</option>
                      <option value="22">静岡県</option>
                      <option value="23">愛知県</option>
                      <option value="24">三重県</option>
                      <option value="25">滋賀県</option>
                      <option value="26">京都府</option>
                      <option value="27">大阪府</option>
                      <option value="28">兵庫県</option>
                      <option value="29">奈良県</option>
                      <option value="30">和歌山県</option>
                      <option value="31">鳥取県</option>
                      <option value="32">島根県</option>
                      <option value="33">岡山県</option>
                      <option value="34">広島県</option>
                      <option value="35">山口県</option>
                      <option value="36">徳島県</option>
                      <option value="37">香川県</option>
                      <option value="38">愛媛県</option>
                      <option value="39">高知県</option>
                      <option value="40">福岡県</option>
                      <option value="41">佐賀県</option>
                      <option value="42">長崎県</option>
                      <option value="43">熊本県</option>
                      <option value="44">大分県</option>
                      <option value="45">宮崎県</option>
                      <option value="46">鹿児島県</option>
                      <option value="47">沖縄県</option>
                  </select>
            <input type="submit" value="変更を確定する" class="change-button">
            </form>

            <p class="changetext changetext-font">メールアドレスの変更は<a href="resettingMailaddress.php">こちら</a></p>
            <p class="changetext changetext-font">パスワードの変更は<a href="resettingPassword.php">こちら</a></p>

            <div class="back-button-area">
              <input type="button" onclick="history.back()" value="戻る" class="back-button">
              <form action="logout.php" method="post">
                <input type="submit" value="ログアウト" class="back-button back-button-confirm">
              </form>
            </div>
      </div>

      <!-- 下のナビゲーションバー -->
    <br><br><br><br><br>
    <footer class="text-center">
        <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-4" style="color: black;text-decoration: none;"><i class="bi bi-house-fill" style="margin-left:10%;font-size:40px"></i></a>
            <a href="myPage.php" class="col-4"style="color: #FF7800;text-decoration: none;"><i class="bi bi-person-circle" style="font-size:40px"></i></a>
            <a href="createRecipe.php" class="col-4"style="color: black;text-decoration: none;"><i class="bi bi-journal-check" style="margin-right:10%;font-size:40px"></i></a>
        </div>
    </footer>
          

            <!-- </div>
          </div>
      </div> -->
    
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    
    <!-- 固有のjs -->
    <script src="script/icon/icon_display.js"></script>
    <!-- <script src="script/icon/change_icon_display.js"></script> -->

    <!-- header導入のjs -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
    <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/js/5-1-14.js"></script>
    <script src="script/header.js"></script>
    </html>