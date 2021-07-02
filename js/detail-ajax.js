// AJAX初始化函数
function getXmlHttpObject(){
    var XMLHttp = null;
    try{
        // 尝试使用XMLHttpRequest创建对象
        XMLHttp = new XMLHttpRequest();
    }
    catch(e){
        // 如果捕获错误则尝试使用“Msxml2.XMLHTTP”创建对象
        try{
            XMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
            // 如果捕获错误则尝试使用“Microsoft.XMLHTTP”创建对象
            XMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return XMLHttp;
}