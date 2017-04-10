/**
 * Created by zhangb on 2015/6/1.
 * 逐渐深入地理解Ajax
 * http://web.jobbole.com/82447/
 */

function createXHR()
{
    var xhr;
    if(window.XMLHttpRequest)
    {
        //code for IE7+, Firefox, Chrome, Opera, Safari
        xhr = new XMLHttpRequest();
    }else
    {
        // code for IE6, IE5
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
    }
    return xhr;
}

var xhr = createXHR();
var url = './ajax.php';
xhr.open('get',url,false);
xhr.send(null);
if((xhr.status>=200 && xhr.status<300) || xhr.status ==304)
{
    console.log(xhr.response);
}else
{
    console.log(xhr.status);
}
