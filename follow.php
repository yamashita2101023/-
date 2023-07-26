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
    
    <!-- bootstrapのCSSの導入 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- 検索ボックス導入のためのcss -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- header導入のためのcss -->
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-14/css/5-1-14.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">

     <!-- このページのcss -->
     <link rel="stylesheet" href="css/follow.css">

    
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
                        <img class="col-3 img-fluid" src="img/UserIcon_default.png">
                        <h3 class="col-6 text-start ml-3 pt-2" style="text-decoration: none; color: #333333;">ユーザ名</h3>
                    </a>
                </div>


                <!-- 虫眼鏡付きの検索ボックス -->
                <li class="text-start">
                    <form action="searchResult.php" method="post" class="search_container">
                        <input type="text" size="15" placeholder="料理名・食材名">
                        <input type="submit" value="&#xf002">
                    </form>
                </li>
                <div class="mt-3" style="border-bottom: 1px solid #333;"></div>
                <li><a href="top.php">Top画面</a></li>
                <li><a href="ranking.php">ランキング</a></li>
                <li><a href="myPage.php">マイページ</a></li>
                <li><a href="createRecipe.php">レシピを作る</a></li>
            </ul>            
        </div>
    </nav>


    <div class="user">
        <?php
            echo "<img src='".$userdata['user_icon']."' alt='アイコン' class='user-icon'>
            <h1 class='user-name'>".$userdata['user_name']."</h1>";
        ?>
    </div>

    <div class="follow-content">
        <ul class="follow-content-tab">
            <li class="follow-content-list follow1 is-active">フォロー</li>
            <li class="follow-content-list follow2">フォロワー</li>
        </ul>

        <div class="follow-pane-group">
            <div class="scrollRange">
                <!-- フォロータブの中 -->
                <div class="panel follow1tab is-show">
                
                <!-- 仕様変更前の -->
                <!-- <button class='follow-user-button'>フォロー</button> -->

                    <?php
                        $followData = $dao->selectFollow($_SESSION['id']);

                        foreach ($followData as $row) {
                            $followUser = $dao->selectUser($row['follower_user_id']);
                            echo "<div class='follow-user-info'>
                                    <img src='".$followUser['user_icon']."' alt='アイコン' class='follow-user-icon' onclick='document.getElementById(form".$followUser['user_id'].".submit())'>
                                    <div class='follow-user-name' onclick='document.getElementById(form".$followUser['user_id'].".submit())'>".$followUser['user_name']."</div>
                                    <form method='post' action='userPage.php' id='form".$followUser['user_id']."'>
                                        <input type='hidden' name='user_Id' value='".$followUser['user_id']."'>
                                    </form>
                                  </div>
                                  <div class='follow-underline'></div>";
                        }

                    ?>
                </div>

                <!-- フォロワータブの中 -->
                <div class="panel follow2tab">

                    <?php
                        $followerData = $dao->selectFollower($_SESSION['id']);

                        foreach ($followerData as $row) {
                            $followerUser = $dao->selectUser($row['follower_user_id']);
                            echo "<div class='follow-user-info'>
                                    <img src='".$followerUser['user_icon']."' alt='アイコン' class='follow-user-icon' onclick='document.getElementById(form".$followerUser['user_id'].".submit())'>
                                    <div class='follow-user-name'  onclick='document.getElementById(form".$followerUser['user_id'].".submit())'>".$followerUser['user_name']."</div>
                                    <form method='post' action='userPage.php' id='form".$followerUser['user_id']."'>
                                    <input type='hidden' name='user_Id' value='".$followerUser['user_id']."'>
                                </form>
                                  </div>
                                  <div class='follow-underline'></div>";
                        }

                    ?>

                </div>
                
            </div>
        </div>
    </div>


    <!-- /この中に要素を追加 -->


    <!-- 下のナビゲーションバー -->
    <br><br><br><br><br>
    <footer class="text-center">
    <div class="row footerBar fontGothicBold">
            <a href="top.php" class="col-4" style="color: black;text-decoration: none;"><i class="bi bi-house-fill" style="margin-left:10%;font-size:40px"></i></a>
            <a href="myPage.php" class="col-4"style="color: black;text-decoration: none;"><i class="bi bi-person-circle" style="font-size:40px"></i></a>
            <a href="createRecipe.php" class="col-4"style="color: #FF7800;text-decoration: none;"><i class="bi bi-journal-check" style="margin-right:10%;font-size:40px"></i></a>
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

    <!-- このページのJs -->
    <script src="script/follow.js"></script>
</body>
</html>