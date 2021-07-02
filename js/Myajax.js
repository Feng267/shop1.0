// AJAX初始化函数，创建ajax异步对象
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

// 封装的函数
function $ajax({method='get', url, data, success, error}){
    var XMLHttp = getXmlHttpObject();// 创建ajax异步对象
    method = method.toUpperCase();// 转化为全大写

    if(data)
        data= queryString(data);// 对数据进行格式处理，拼接需要发送的参数
        
    if(method =='GET' && data)// get方法需要将携带的参数拼接到url中
        url += "?" + data;

    XMLHttp.open(method,url,true);// 发送请求
    if(method == 'GET')// get方法不需要发送数据
        XMLHttp.send();
    else if(method == 'POST'){
        XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");// 设置HTTP头信息
        XMLHttp.send(data);// 发送数据
    }

    // 请求发送完毕，处理返回的结果
    XMLHttp.onreadystatechange = function(){
        if(XMLHttp.readyState == 4){// 请求结果返回
            if(XMLHttp.status == 200){// 请求被处理成功，并返回正确数据
                // console.log(XMLHttp);
                if(success)
                    success(XMLHttp.responseText);// 调用成功时的回调函数
            }
            else{// 请求出现问题
                if(error)
                    error('error');// 调用失败时的回调函数
            }    
        }
    }

}

// 传入参数格式化处理
function queryString(obj){
    var str = '';
    for(var astr in obj){
        str += astr + '=' + obj[astr] + '&';
    }
    return str.substring(0, str.length - 1);// 去除最后面的&符号
}