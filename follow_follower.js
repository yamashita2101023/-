
function follows(session_id,recipe_user_id) {
    // let followButton = document.getElementById("followButton");
    //if(followButton !== "フォロー中"){
        var xhr = new XMLHttpRequest();//ajaxを使用するためのコードらしい
        xhr.open("POST","XML/follow_follower.php");//どのページに(GET or POST)で情報を送りたいか   ※GET POST以外にもあるらしいけど知らないので割愛
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//POSTでデータを送る場合に必要なコード　　第二引数はテキストを送ると言ってるらしい
        // xhr.onload = function() {
        //     if (xhr.status === 200) {//ステータスコードが200だったら(成功したら)
        //         followButton.textContent = "フォロー中";
        //         followButton = "フォロー中";
        //     } else {
        //         console.error(xhr.statusText);
        //     }
        // };
        xhr.send("session_id=" + encodeURIComponent(session_id) + "&recipe_user_id=" + encodeURIComponent(recipe_user_id));//encodeURIComponentで変数をエンコードして、openで指定したファイルにデータを投げる！
    }
    // else{
    //     followButton.textContent = "ようこそ";
    // }
//}


function delete_follows(session_id,recipe_user_id) {
        var xhr = new XMLHttpRequest();//ajaxを使用するためのコードらしい
        xhr.open("POST","XML/delete_follow_follower.php");//どのページに(GET or POST)で情報を送りたいか   ※GET POST以外にもあるらしいけど知らないので割愛
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//POSTでデータを送る場合に必要なコード　　第二引数はテキストを送ると言ってるらしい
        xhr.send("session_id=" + encodeURIComponent(session_id) + "&recipe_user_id=" + encodeURIComponent(recipe_user_id));//encodeURIComponentで変数をエンコードして、openで指定したファイルにデータを投げる！
    }
// 参考資料
// 
// JavaScriptでAjaxを使う方法。使用例や利用方法を解説
// https://job-support.ne.jp/blog/javascript/howto-ajax#5f9a5fb9709b782d50477a7b-b3c6700a13a203fa3d2b9b55