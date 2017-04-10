/**
 * Created by zhang on 2015/3/30.
 */
($(function(){
    $('#submit').click(function(){
        var title = $('#title').val();
        var tele  = $('#tele').val();
        var sex   = $('input[type="radio"]:checked').val();
        var like = "";
        $('input[type="checkbox"]:checkbox').each(function(){
            if($(this).attr("checked")){
                like += $(this).val()+'/';
            }
        });
        var content = $("#content").val();
        $.post("ajax.php",{"title":title,"tele":tele,"sex":sex,"like":like,"content":content},function(data,textStatus){alert(data.msg);alert(textStatus)},"json");
        /**
         *
         $.ajax({
            type:"POST",
            url:"/ajax.php",
            data:{"title":title,"tele":tele,"sex":sex,"like":like,"content":content},
            dataType:"json",
            success:function(data){
//                    console.log(data);return false;
                alert(data.msg);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);  //parsererror 返回类型 字符串编码的问题
            }
//                error:function(data){
//                    alert('error');
//                }
        })
         *
         */

    })
})())