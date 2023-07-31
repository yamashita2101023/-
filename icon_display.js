const fileInputIconImage = document.getElementById('icon_change');
const iconFileSelect = () => {
    const files = fileInputIconImage.files;
        for (let i = 0; i < files.length; i++) {
            preview_icon_File(files[i]);
        }
}
function preview_icon_File(file) {
    // プレビュー画像を追加する要素
    const preview = document.getElementById('icon_preview');

    // FileReaderオブジェクトを作成
    const icon_reader = new FileReader();

    // ファイルが読み込まれたときに実行する
    icon_reader.onload = function (e) {
        const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
        const img = document.createElement("img"); // img要素を作成
        img.src = imageUrl; // 画像のURLをimg要素にセット
        img.className="icon_previewImg";
        // preview内の画像をいったん削除して表示されるのを一つにする
        preview.innerHTML="";

        preview.appendChild(img); // #previewの中に追加
    }

    // いざファイルを読み込む
    icon_reader.readAsDataURL(file);
}

// previewのidを持つ要素(fileInput)が何かしら変更されたとき(投稿される画像のアップロード、変更等)
fileInputIconImage.addEventListener('change', iconFileSelect);
