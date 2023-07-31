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
    <title>プロトタイプ</title>
    <!-- cssの導入 -->
    <link rel="stylesheet" href="css/style.css?v=2">
    <link rel="stylesheet" href="./css/createRecipe.css">

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

    <!-- このページのcss -->
    <link rel="stylesheet" href="css/myPage.css">


    <?php
        //DAOの呼び出し
        require_once 'DAO.php';
        $dao = new DAO();

        //マイページなので、セッションのidを利用して自分のユーザ情報を検索
        $userdata = $dao->selectUser($_SESSION['id']);
        $user_prefecture = $dao->selectPrefecture($userdata['prefecture_id']);

    ?>

</head>
<body>

    <!-- この中に要素を追加 -->
    
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

    <div class="user">
        <!-- ユーザートップ -->
        <div class="user-top">
            <?php 
            // require_once 'DAO.php';
            // $dao = new DAO();
            //投稿者の情報を取りに行き、$detailRecipeで受け取る
            $detailRecipe = $dao->recipeDetail_user_id($_POST['user_Id']);
            foreach($detailRecipe as $row){//foreachで回しながら画像を出力
                //user_idを取得
                $user_id = $row['user_id'];
                //recipe_idを取得
                $recipe_id = $row['recipe_id'];
            }
            //display_the_iconからアイコンの情報を持ってくる→その結果を$resultUserIconに返す
            $resultUserIcon = $dao->display_the_icon($user_id);


            foreach($resultUserIcon as $row){
                //$resultUserIconの情報をforeachで$result_iconに入れる
                $result_icon = $row['user_icon'];
               }
            ?>
            <img src=<?php echo $result_icon?> alt="アイコン" class="user-icon">
            <h1 class="user-name">
                <!-- USERNAME -->
                <?php
                $resultUsername = $dao->user_recipeDetail($user_id);
                foreach($resultUsername as $row){
                    echo $row['user_name'];
                   }
                ?>
            </h1>
            <div class="user-setting">
            <a href="setting.php" style="color: black;">
                <i class="bi bi-gear-fill"></i>
                </a>
            </div>
        </div>

        <!-- ユーザー情報 -->
        <div class="user-info">
            <p class="prefecture user-info-text">
                <!-- __県民 -->
                <?php
                foreach($detailRecipe as $row){
                    $recipe_prefecture_id = $row['prefecture_id'];
                }
                $resultPrefecture_name = $dao->selectPrefecture($recipe_prefecture_id);

               echo $resultPrefecture_name['prefecture_name'];
            ?>
            </p>
            <?php 
            $resultFollow =$dao->countFollows($user_id);
            $resultFollower =$dao->countFollowers($user_id);
            ?>

            <p class="follow user-info-text"><span class="user-info-text-bold">フォロー</span>：
            <!-- 9,999人 -->
            <?php echo number_format($resultFollow[0])."人";?>
            </p>

            <p class="follow user-info-text"><span class="user-info-text-bold">フォロワー</span>：
            <!-- 9,999人 -->
            <?php echo number_format($resultFollower[0])."人";?>
            </p>

            <!-- <textarea name="#" class="introduction user-info-text" cols="40" row="3"> -->
            <p name="#" class="introduction user-info-text-bold">
                <!-- ここにユーザーの紹介文を表示 -->

            紹介文：<?php 
                    $result_introduction =$dao->selectUser($user_id);
                    if(empty($result_introduction['user_introduction'])){//紹介文に関する情報がnullもしくは0か
                        echo "未入力";
                    }else {
                        echo $result_introduction['user_introduction'];
                    }
                    ?>
            </p>
            <!-- </textarea> -->
        </div>
    </div>



        <img class=UserIcon_default>

        
    <!-- /この中に要素を追加 -->

    <!-- ここら辺はマイページからパクってくる -->
    
    <div style="width:90%;margin-left:auto;margin-right:auto; border-top: 2px solid #000000;">
        <div class="popular"><br>
            <h1 style="text-align:left">・人気のレシピ</h1>
            <?php 
            $goods_recipe_count = $dao->getRecipesDetails($user_id);
            $latest_recipes = $dao->recipes_letest($user_id);
            // echo $price."円/1人";//材料の合計を表示
            ?>
            <!-- ここからレシピの塊 -->
            <!-- <div class="row"> -->
                <!-- 画像 -->
                <!-- <div class="col-4" style="margin-bottom: 5px; margin-top: 5px;"> -->
                    <form action="dishDetail.php" method="post">
            <?php 
            $foreach_count = 0;
            foreach($goods_recipe_count as $row){
            echo "<input type=submit id=dishDetail_recipeId".$row['recipe_id']." class=noneDisplay name=recipeId value=$row[recipe_id] />";

            echo "<div class='row' style='border-bottom: 1px solid #000000;'>

                    <div class='col-4' style='margin-bottom: 5px; margin-top: 5px;'>
                        <image src=$row[recipe_image] style='width:107%' onclick=document.getElementById('dishDetail_recipeId".$row['recipe_id']."').click()>
                     </div>

                <div class='col-8 row'>
                    <div class='post-text-name'>".$row['recipe_name']."</div>
                    <div class='post-text-budget'>予算　".$row['total_cost']."円</div>

                    <div class='post-like'>
                    <i class='bi bi-hand-thumbs-up'>".$row['goods_count']."</i>
                    <i class='bi bi-bookmark-star verylike'>".$row['favorite_count']."</i>
                    </div>
                </div>
            </div>";
            $foreach_count++;
            if($foreach_count == 5){
                break;
            }
        }
                ?>

            <div class="newpost"><br>
                <h1 style="text-align:left">・最新の投稿</h1>
                <?php 
                $for_count = 0;
                foreach($latest_recipes as $row){
                    echo "<input type=submit id=dishDetail_recipeId".$row['recipe_id']." class=noneDisplay name=recipeId value=$row[recipe_id] />";

                    echo "<div class='row' style='border-bottom: 1px solid #000000;'>
                    <div class='col-4' style='margin-bottom: 5px; margin-top: 5px;'>
                        <image src=$row[recipe_image] style='width:107%' onclick=document.getElementById('dishDetail_recipeId".$row['recipe_id']."').click()>
                    </div>
    
                    <div class='col-8 row'>
                    <div class='post-text-name'>
                            $row[recipe_name]
                        </div>
                        <div class='post-text-budget'>
                            予算　$row[total_cost]円
                        </div>

                        <div class='post-like'>
                            <i class='bi bi-hand-thumbs-up'><span style=>$row[goods_count]</span></i>
                            <i class='bi bi-bookmark-star'><span style=>$row[favorite_count]</span></i>
                        </div>
                    </div>
                </div>";
                $for_count++;
            if($for_count == 5){
                break;
                }
            }
                ?>
                </form>
            </div>
                    <!-- <image src="img/PepperRice.png"style="width:100%"> -->
                <!-- </div> -->

                <!-- <div class="col-8 row"> -->
                    <!-- タイトル -->
                    <!-- <div class="col-12"> -->
                        <!-- ペッパーライス -->
                        <?php 
                        // foreach($goods_recipe_count as $row){
                        //     echo $row['recipe_name'];
                        // }
                        ?>
                    <!-- </div> -->
                    <!-- 予算 -->
                    <!-- <div class="col-6">
                        予算
                    </div>
                    <div class="col-6">
                        100円
                    </div> -->
                    <!-- いいね、お気に入り　-->
                    <!-- <div class="col-6">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span style="">9999</span>
                    </div>
                    <div class="col-6">
                        <i class="bi bi-bookmark-star"></i>
                        <span style="">9999</span>
                    </div>
                </div> -->
                <!-- <div style="border-bottom: 1px solid #000000; margin-left:auto;margin-right:auto;"></div> -->
            <!-- </div> -->


            <!-- <div class="row" style="border-bottom: 1px solid #000000;"> -->
                <!-- 画像 -->
                <!-- <div class="col-4" style="margin-bottom: 5px; margin-top: 5px;">
                    <image src="img/PepperRice.png"style="width:100%">
                </div>

                <div class="col-8 row"> -->
                    <!-- タイトル -->
                    <!-- <div class="col-12">
                        ペッパーライス
                    </div> -->
                    <!-- 予算 -->
                    <!-- <div class="col-6">
                        予算
                    </div>
                    <div class="col-6">
                        100円
                    </div> -->
                    <!-- いいね、お気に入り　-->
                    <!-- <div class="col-6">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span style="">9999999</span>
                    </div>
                    <div class="col-6">
                        <i class="bi bi-bookmark-star"></i>
                        <span style="">9999999</span>
                    </div>
                </div>
            </div> -->

            




        </div>

        <!-- <div class="newpost"><br>
            <h1 style="text-align:left">・最新の投稿</h1>


            <div class="row" style="border-bottom: 1px solid #000000;"> -->
                <!-- 画像 -->
                <!-- <div class="col-4" style="margin-bottom: 5px; margin-top: 5px;">
                    <image src="img/PepperRice.png"style="width:100%">
                </div>

                <div class="col-8 row"> -->
                    <!-- タイトル -->
                    <!-- <div class="col-12">
                        ペッパーライス
                    </div> -->
                    <!-- 予算 -->
                    <!-- <div class="col-6">
                        予算
                    </div>
                    <div class="col-6">
                        100円
                    </div> -->
                    <!-- いいね、お気に入り　-->
                    <!-- <div class="col-6">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span style="">9999999</span>
                    </div>
                    <div class="col-6">
                        <i class="bi bi-bookmark-star"></i>
                        <span style="">9999999</span>
                    </div>
                </div>
            </div>


        </div> -->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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
</body>
</html>