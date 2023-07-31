<?php
session_start();
if(isset($_SESSION['id']) == false  &&
     isset($_SESSION['name']) == false ){
        header('Location: login.php');
        exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>料理詳細画面</title>
    <!-- cssの導入 -->
    <link rel="stylesheet" href="css/style.css?v=2">
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

    <!-- 個別cssの読み込み場所 -->
        <link rel="stylesheet" href="css/dishDetail.css">
    <!--  -->
    <?php
        //DAOの呼び出し
        require_once 'DAO.php';
        $dao = new DAO();

        //マイページなので、セッションのidを利用して自分のユーザ情報を検索
        $userdata = $dao->selectUser($_SESSION['id']);

    ?>
</head>
<body>
    <!-- 謎のナビゲーションバー？ -->
    <!-- <div class="header_inner">
        <div class="header_comment row justify-content-between">
             なんていうか見出しのコメント的な奴
            <div class="header_caption col align-self-start">
                食費をカットしよう
            </div>
            ユーザアイコン
            <div class="col align-self-end">
                <i class="bi bi-person-circle" style="text-align:right"></i>
            </div>
        </div>
    </div> -->

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

    <!-- このdivの中に要素を書き込んでください -->
    <div class="container-fluid elements">
        
        <!-- 料理のサムネ＆タイトル -->
        <div class="row pt-2">
            <?php
            // require_once 'DAO.php';
            // $dao = new DAO();
            //レシピの画像を取りに行き、$detailRecipeで受け取る
            $detailRecipe = $dao->recipeDetail($_POST['recipeId']);
            foreach($detailRecipe as $row){//foreachで回しながら画像を出力
                //画像を表示
                echo "<img class=dishImg col-12 offset-1 img-fluid src=$row[recipe_image] alt=>";
            }
            ?>
        </div>
        <h3 style="text-align: center;">
        <!-- ぶちうまペッパーライス -->
            <?php
            //レシピ名を取りに行き、$detailRecipeで受け取る
            $detailRecipe = $dao->recipeDetail($_POST['recipeId']);
            foreach($detailRecipe as $row){//foreachで回しながらレシピ名を出力
                //レシピ名を表示
                echo $row['recipe_name'];
                $user_id = $row['user_id'];
            }
            ?>
        </h3>


        <!-- レシピを作成したユーザの情報 -->
        <div class="row mt-2 mb-2 user">
            <form action="userPage.php" method="post">
            <input type="hidden" name="user_Id" value="<?php echo $user_id; ?>" />
            <div onclick="this.parentNode.submit();">
            <?php
                foreach($detailRecipe as $row){
                     $recipe_user_id = $row['user_id'];//レシピ投稿者のuser_idを$recipe_user_idに取り出す。
                     $recipe_id = $row['recipe_id'];//レシピのidを取得
                    }
                    //display_the_iconからアイコンの情報を持ってくる→その結果を$resultUserIconに返す
                    $resultUserIcon = $dao->display_the_icon($recipe_user_id);


                    foreach($resultUserIcon as $row){
                        //$resultUserIconの情報をforeachで$result_iconに入れる
                        $result_icon = $row['user_icon'];
                       }
            ?>
                                                                    <!-- ↓ここでアイコンを表示 -->
                <img class="offset-1 col-2 img-fluid userSell1 iconsize" src=<?php echo $result_icon?>>
                </div>
            </form>
            <h3 class="col-4 ml-2 userSell2">
                
                    <?php
                $resultUsername = $dao->user_recipeDetail($recipe_user_id);
                foreach($resultUsername as $row){
                    echo $row['user_name'];
                   }

                ?>
            </h3>
            <?php 
            //163行目でユーザーがレシピ投稿者を既にフォローしているか判定するために$resultFollowに情報を入れる
            $resultFollow = $dao->follow_follower_search($_SESSION['id'],$recipe_user_id);

            // ただのブラウザ更新だと1番上に戻って鬱陶しいから、リロード前のスクロール位置を取得
            $scrollTop = isset($_COOKIE['scroll_position']) ? $_COOKIE['scroll_position'] : 0;

            if ($_SESSION['id'] != $recipe_user_id) {//自分自身をフォローしないようにif文でuser_idを比較
                
                if($resultFollow != 1){?>
        <!-- ボタンを押すと、onclickが走って、投稿者をフォロー　　　 ↓ここで、onclickに渡す引数を指定↓                          ↓ここでブラウザを更新してる-->
                <button id="followButton" onclick="follows(<?php echo $_SESSION['id']; ?>, <?php echo $recipe_user_id; ?>); window.location.reload(true);" class="col-4 p-3 orangeBtn userSell3">フォロー</button>
            <?php }else{ ?>
        <!-- ボタンを押すと、onclickが走って、投稿者のフォロー解除　　　 ↓ここで、onclickに渡す引数を指定↓                             ↓ここでブラウザを更新してる-->
                <button id="followButton" onclick="delete_follows(<?php echo $_SESSION['id']; ?>, <?php echo $recipe_user_id; ?>); window.location.reload(true);" class="col-4 p-3 orangeBtn userSell3">フォロー中</button>
            <?php }
               }?>
            <!-- <button class="col-4 p-3 orangeBtn userSell3">フォロー</button> -->


        </div>
        <?php
        // ボタンが押されたかどうかを判定する
        // if (isset($_POST['button'])) {

        //     // ボタン名を取得する
        //     $button_name = $_POST['button'];
        
        //     // フォローするユーザーのIDを取得する
        //     $follow_user_id = $_SESSION['id'];
        
        //     // フォローされるユーザーのIDを取得する
        //     $follower_user_id = 1;
        
        //     // DAOクラスのfollowメソッドを呼び出す
        //     $dao->follow_follower($follow_user_id, $follower_user_id);
        
        //     // ボタン名をフォロー中に変更する
        //     if ($button_name === 'フォロー') {
        //     $button_name = 'フォロー中';
        //     }
        // }
        
        // // ボタン名を表示する
        // echo $button_name;
        
        ?>
        <h2>紹介文</h2>
        <p>
            <!-- ガチで旨すぎてぶちぶちになる位の美味しさです。食え！ -->
            <?php
            foreach($detailRecipe as $row){
                echo $row['recipe_introduction'];//ここで紹介文を表示してる
               }
            ?>
        </p>

        <!-- いいねお気に入りボタン -->
        <div class="row pt-2" style="width:100%">
        <?php 
        //226行目でユーザーがレシピを既にいいねしているか判定するために$resultGoodに情報を入れる
        $resultGood = $dao->goodsSearch($_SESSION['id'],$recipe_id);

        //いいね数を表示させるためにデータベースからいいね数を取得
        $result_good_count = $dao->goodsCount($recipe_id);

        //233行目でユーザーがレシピを既にお気に入りしているか判定するために$resultFavoriteに情報を入れる
        $resultFavorite = $dao->favoriteSearch($_SESSION['id'],$recipe_id);

        //お気に入り数を表示させるためにデータベースからお気に入り数を取得
        $result_favorite_count = $dao->favoriteCount($recipe_id);

        if ($resultGood != 1) { ?>
        <!-- ボタンを押すと、onclickが走って、いいね登録　　　              ↓ここで、onclickに渡す引数を指定↓                   ↓ここでブラウザを更新してる                                                                                                     ↓いいね数を表示-->
            <button id="goodButton" type="button" onclick="goods(<?php echo $_SESSION['id']; ?>, <?php echo $recipe_id; ?>); window.location.reload(true);" class="defo-btn offset-1 col-5" style="height: 50px;">いいね<i class="bi bi-hand-thumbs-up"></i><?php echo number_format($result_good_count[0]) ?></button>
            <?php }else{ ?>
        <!-- ボタンを押すと、onclickが走って、いいね削除　　　                      ↓ここで、onclickに渡す引数を指定↓                       ↓ここでブラウザを更新してる                                                                                                     ↓いいね数を表示-->
                <button id="goodButton" type="button" onclick="delete_goods(<?php echo $_SESSION['id']; ?>, <?php echo $recipe_id; ?>); window.location.reload(true);" class="defo-btn offset-1 col-5" style="height: 50px;">いいね済<i class="bi bi-hand-thumbs-up"></i><?php echo number_format($result_good_count[0]) ?></button>
                <?php }
                if ($resultFavorite != 1) { ?>
        <!-- ボタンを押すと、onclickが走って、お気に入り登録　　　              ↓ここで、onclickに渡す引数を指定↓                           ↓ここでブラウザを更新してる                                                                                     ↓お気に入り数を表示-->
                <button id="favoriteButton" type="button" onclick="favorite(<?php echo $_SESSION['id']; ?>, <?php echo $recipe_id; ?>); window.location.reload(true);" class="defo-btn offset-1 col-5" >お気に入り<i class="bi bi-bookmark-star"></i><?php echo number_format($result_favorite_count[0]) ?></button>
                <?php }else{ ?>
        <!-- ボタンを押すと、onclickが走って、お気に入り削除　　　                        ↓ここで、onclickに渡す引数を指定↓                           ↓ここでブラウザを更新してる                                                                                        ↓お気に入り数を表示-->
                    <button id="favoriteButton" type="button" onclick="delete_favorite(<?php echo $_SESSION['id']; ?>, <?php echo $recipe_id; ?>); window.location.reload(true);" class="defo-btn offset-1 col-5" >お気に入り済<i class="bi bi-bookmark-star"></i><?php echo number_format($result_favorite_count[0]) ?></button>
                    <?php }?>
        </div>
            <script>
            // スクロール位置をCookieに保存
            function saveScrollPosition() {
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
                document.cookie = 'scroll_position=' + scrollTop;
            }

            // ページ読み込み時にスクロール位置を復元
            window.onload = function() {
                var scrollTop = <?php echo $scrollTop; ?>;
                window.scrollTo(0, scrollTop);
            };

            // ボタンをクリックした際にスクロール位置を保存
            document.getElementById('followButton').addEventListener('click', saveScrollPosition);
            document.getElementById('goodButton').addEventListener('click', saveScrollPosition);
            document.getElementById('favoriteButton').addEventListener('click', saveScrollPosition);
        </script>


        <!-- 都道府県ラベル 表示し河川からdb接続して持ってきて-->
        <br>
        <h6 style="margin-left:10%">都道府県ラベル： 
        <!-- 山口県 -->
            <?php
                foreach($detailRecipe as $row){
                    $recipe_prefecture_id = $row['prefecture_id'];
                }
                $resultPrefecture_name = $dao->selectPrefecture($recipe_prefecture_id);

               echo $resultPrefecture_name['prefecture_name'];
            ?>
    </h6><br>

        <!-- 食費 -->
        <h3 style="margin-left:5%">食費</h3>
        <div
            style="color:#FFE300;text-align: center;font-size:40px;"> 
            <!-- 505円/1人 -->
            <?php
            $price = 0;
            $detailRecipe = $dao->recipeDetail_materials($_POST['recipeId']);
            foreach($detailRecipe as $row){
                $price += $row['material_cost'];
            }
            echo $price."円/1人";//材料の合計を表示
            ?>
        </div>


        <!-- 材料 -->
        <h3 style="margin-left:5%">材料</h3>

            <div class="row pt-3" style="">
                
                
                <div class="offset-1 col-4" style="font-weight:bold">材料名</div>
                <div class="col-3" style="font-weight:bold">分量</div></b>
                <div class="col-4" style="font-weight:bold">値段(目安)</div>
                

                <!-- ループ開始位置 DBに接続して材料たちを詳細番号毎に出力 -->

                    <!-- 材料名 -->
                    <div class="offset-1 col-4">
                        <!-- パスタ -->
                        <?php
                        $detailRecipe = $dao->recipeDetail_materials($_POST['recipeId']);
                        foreach($detailRecipe as $row){
                            echo $row['material_name'].'<br>';//材料名を表示
                        }
                        ?>
                        </div>
                    <!--　分量 -->
                    <div class="col-3">
                        <!-- 100g -->
                        <?php
                        $detailRecipe = $dao->recipeDetail_materials($_POST['recipeId']);
                        foreach($detailRecipe as $row){
                            echo $row['material_quantity'].'<br>';//分量を表示
                        }
                        ?>
                    </div>
                    <!-- 値段 -->
                    <div class="col-3"><div style="text-align:right;">
                    <!-- 100円 -->
                    <?php
                        $detailRecipe = $dao->recipeDetail_materials($_POST['recipeId']);
                        foreach($detailRecipe as $row){
                            echo $row['material_cost'].'<br>';//値段を表示
                        }
                        ?>
                </div>
            </div>

                <!-- ループ終了位置 -->

                    <!-- 材料名 -->
                    <!-- <div class="offset-1 col-4">玉ねぎ</div> -->
                    <!--　分量 -->
                    <!-- <div class="col-3">1/4個</div> -->
                    <!-- 値段 -->
                    <!-- <div class="col-3"><div style="text-align:right;">25円</div></div> -->
                    <!-- 材料名 -->
                    <!-- <div class="offset-1 col-4">ピーマン</div> -->
                    <!--　分量 -->
                    <!-- <div class="col-3">1個</div> -->
                    <!-- 値段 -->
                    <!-- <div class="col-3"><div style="text-align:right;">40円</div></div> -->

                    

            </div>



            <br><br>
            <!-- 作り方 -->
            <div style="margin-left:5%; margin-right:5%">
                <h3 >作り方</h3>
                <!-- 必要数に応じて増やして -->
                <div style="margin-left:5%; margin-right:5%">
                    <!-- <div class="number">1</div> -->
                    <?php
                    $imagecount = 1;
                    // <img src="img/作りかた例１.webp" style="width:100%; height:auto; ml-5%; mr-5%;">
                    $detailRecipe = $dao->recipeDetail_how_to_make($_POST['recipeId']);
                        foreach($detailRecipe as $row){
                            echo "<p><div class=number>$imagecount.</div></p>";//投稿画像に番号を振る
                            echo "<img src=$row[how_to_make_image] style=width:100%; height:auto; ml-5%; mr-5%;>";//投稿画像を表示
                            echo "<div class=text>$row[how_to_make_text]</div>";//説明文を表示
                            $imagecount++;
                        }
                    ?>
                    <!-- <div class="text">キャベツは食べやすく4~5㎝のざく切りに 肉も長いものは適当な大きさに切ってかるく塩コショウしておきます</div> -->
                </div>
                <br>

                <!-- <div style="margin-left:5%; margin-right:5%">
                    <div class="number">2</div>
                    <img src="img/noimage.png" style="width:100%; height:auto; ml-5%; mr-5%;">
                    <div class="text">キャベツはまずは蒸しキャベツ♪切ったキャベツと調味料Aをフライパンに入れ蓋をして中火で2~3分蒸して皿に盛りつけておきます。</div>
                </div> -->

            </div>
            <br><br>

        

        <!-- ここまで -->
        <div class="footerCooporation">
            <p class="copyright">© 2023 Example Inc. All Rights Reserved.</p>
            <ul class="md-flex">
                <li><a href="terms.php">利用規約</a></li>
                <li><a href="privacy.php">プライバシーポリシー</a></li>
            </ul>
        </div>
    </div>
    
    


    <!-- 下のナビゲーションバー -->
    <br><br><br><br><br>
    <footer class="text-center">
        <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-4" style="color: black;text-decoration: none;"><i class="bi bi-house-fill" style="margin-left:10%;font-size:40px"></i></a>
            <a href="myPage.php" class="col-4"style="color: black;text-decoration: none;"><i class="bi bi-person-circle" style="font-size:40px"></i></a>
            <a href="createRecipe.php" class="col-4"style="color: black;text-decoration: none;"><i class="bi bi-journal-check" style="margin-right:10%;font-size:40px"></i></a>
        </div>
    </footer>

    <!-- bootstrapのjavascriptの導入(アイコンも) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    
    <!-- header導入のjs -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
    <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/js/5-1-14.js"></script>
    <script src="script/header.js"></script>
    <!-- 固有のjs -->
    <script src="script/dishDetail/follow_follower.js"></script>
    <script src="script/dishDetail/goods.js"></script>
    <script src="script/dishDetail/favorite.js"></script>
</body>
</html>