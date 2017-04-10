<?php
header("Access-Control-Allow-Origin:*");
$url  = 'http://'.$_SERVER['HTTP_HOST'];
$file = (isset($_POST["file"])) ? $_POST["file"] : '';
if($file)
{
    $data = base64_decode(str_replace('data:image/png;base64,', '', $file));  //截图得到的只能是png格式图片，所以只要处理png就行了
    $name = md5(time()) . '.png';  // 这里把文件名做了md5处理
    file_put_contents($name, $data);
    echo "$url/$name";
    die;
}
?>
 
 
<div id="box" style="width:400px;height:400px;border:1px solid;" contenteditable>
</div>
<input type="hidden" name="img" value="" id="img_puth"/>
 
<script>
    //查找box元素,检测当粘贴时候,
    document.querySelector('#box').addEventListener('paste', function(e) {
 
        //判断是否是粘贴图片
        if (e.clipboardData && e.clipboardData.items[0].type.indexOf('image') > -1) 
        {
            var that     = this,
                reader   = new FileReader();
                file     = e.clipboardData.items[0].getAsFile();
            //ajax上传图片
            reader.onload = function(e) 
            {
                var xhr = new XMLHttpRequest(),
                    fd  = new FormData();
 
                xhr.open('POST', '', true);
                xhr.onload = function () 
                {
                    var img = new Image();
                    img.src = xhr.responseText;
 
                    // that.innerHTML = '<img src="'+img.src+'" alt=""/>';
                    document.getElementById("img_puth").value = img.src;
                }
 
                // this.result得到图片的base64 (可以用作即时显示)
                fd.append('file', this.result); 
                that.innerHTML = '<img src="'+this.result+'" alt=""/>';
                xhr.send(fd);
            }
            reader.readAsDataURL(file);
        }
    }, false);
</script>