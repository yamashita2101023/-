
function goods(session_id,recipe_id) {
    //let uploadOpinion = window.confirm('このレシピをいいねしますか？');//confirmメソッドで(OK or キャンセル)のアラートを表示し、変数に(true of false)を格納する
    //if(uploadOpinion){
        var xhr = new XMLHttpRequest();//ajaxを使用するためのコードらしい
        xhr.open("POST","XML/goods.php");//どのページに(GET or POST)で情報を送りたいか   ※GET POST以外にもあるらしいけど知らないので割愛
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//POSTでデータを送る場合に必要なコード　　第二引数はテキストを送ると言ってるらしい
        // xhr.onload = function() {
        //     if (xhr.status === 200) {//ステータスコードが200だったら(成功したら)
        //         goodButton.textContent = "いいね登録済";
        //     } else {
        //         console.error(xhr.statusText);
        //     }
        // };
        xhr.send("session_id=" + encodeURIComponent(session_id) + "&recipe_id=" + encodeURIComponent(recipe_id));//encodeURIComponentで変数をエンコードして、openで指定したファイルにデータを投げる！
    //}
}

function delete_goods(session_id,recipe_user_id) {
    var xhr = new XMLHttpRequest();//ajaxを使用するためのコードらしい
    xhr.open("POST","XML/delete_goods.php");//どのページに(GET or POST)で情報を送りたいか   ※GET POST以外にもあるらしいけど知らないので割愛
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//POSTでデータを送る場合に必要なコード　　第二引数はテキストを送ると言ってるらしい
    xhr.send("session_id=" + encodeURIComponent(session_id) + "&recipe_user_id=" + encodeURIComponent(recipe_user_id));//encodeURIComponentで変数をエンコードして、openで指定したファイルにデータを投げる！
}
// 参考資料
// 
// JavaScriptでAjaxを使う方法。使用例や利用方法を解説
// https://job-support.ne.jp/blog/javascript/howto-ajax#5f9a5fb9709b782d50477a7b-b3c6700a13a203fa3d2b9b55