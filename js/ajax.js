var XMLHttpReq;
//创建XMLHttpRequest对象     
function createXMLHttpRequest() {
    if (window.XMLHttpRequest) { //Mozilla 浏览器
        XMLHttpReq = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) { // IE浏览器
        try {
            XMLHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                XMLHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) { }
        }
    }
}

/*通过ajax获取学生信息*/
function Ajax_GetStudentInfo() { 
    createXMLHttpRequest();
    /*为了避免浏览器读取缓存数据，加一个时间戳*/
    var timestamp = (new Date()).getTime();
    var url = "/StudentInfo/GetStudentInfo.php?zkzh=" + encodeURI(current_index) + "&timestamp=" + timestamp;
    XMLHttpReq.open("GET", url, true);
    XMLHttpReq.onreadystatechange = processStudentInfoResponse; //指定响应函数
    XMLHttpReq.send(null);  // 发送请求
}

/*处理学生信息返回的函数*/
function processStudentInfoResponse() {
    if (XMLHttpReq.readyState == 4) { // 判断对象状态
        if (XMLHttpReq.status == 200) { // 信息已经成功返回，开始处理信息
            DisplayStudentInfoInfo();
            //setTimeout("sendRequest()", 1000);
        } else { //页面不正常
            alert(XMLHttpReq.status);
            window.alert("您所请求的页面有异常。");
        }
    }
}

/*显示修改后的学生信息*/
function DisplayStudentInfoInfo() { 
    /*使用JSON数据格式*/ 
    var studentInfo = eval('(' + XMLHttpReq.responseText + ')');
    var zkzh = studentInfo["zkzh"];
    document.getElementById("zkzh_" + current_index).innerHTML = zkzh;
    var name = studentInfo["name"];
    document.getElementById("name_" + current_index).innerHTML = name;
    var sex = studentInfo["sex"];
    document.getElementById("sex_" + current_index).innerHTML = sex;
    var kslb = studentInfo["kslb"];
    document.getElementById("kslb_" + current_index).innerHTML = kslb;
    var zzmm = studentInfo["zzmm"];
    document.getElementById("zzmm_" + current_index).innerHTML = zzmm;
    var nation = studentInfo["nation"];
    document.getElementById("nation_" + current_index).innerHTML = nation;
    var byxx = studentInfo["byxx"];
    document.getElementById("byxx_" + current_index).innerHTML = byxx;
    var hkszd = studentInfo["hkszd"];
    document.getElementById("hkszd_" + current_index).innerHTML = hkszd;
    var address = studentInfo["address"];
    document.getElementById("address_" + current_index).innerHTML = address;
    var telephone = studentInfo["telephone"];
    document.getElementById("telephone_" + current_index).innerHTML = telephone;
    var zcxx = studentInfo["zcxx"];
    document.getElementById("zcxx_" + current_index).innerHTML = zcxx;
    var cardNumber = studentInfo["cardNumber"];
    document.getElementById("cardNumber_" + current_index).innerHTML = cardNumber;
    var xjh = studentInfo["xjh"];
    document.getElementById("xjh_" + current_index).innerHTML = xjh;
    var gysznj = studentInfo["gysznj"];
    document.getElementById("gysznj_" + current_index).innerHTML = gysznj;
    var gesznj = studentInfo["gesznj"];
    document.getElementById("gesznj_" + current_index).innerHTML = gesznj;
    var gssznj = studentInfo["gssznj"];
    document.getElementById("gssznj_" + current_index).innerHTML = gssznj;
    var memo = studentInfo["memo"];
    document.getElementById("memo_" + current_index).innerHTML = memo;
    var photo = studentInfo["photo"];
    document.getElementById("photo_" + current_index).innerHTML = "<img width='50px' height='50px' src=\"" + photo + "\" />";
}
/*通过ajax获取民族信息*/
function Ajax_GetNation() { 
    createXMLHttpRequest();
    /*为了避免浏览器读取缓存数据，加一个时间戳*/
    var timestamp = (new Date()).getTime();
    var url = "/Nation/GetNation.php?nationId=" + encodeURI(current_index) + "&timestamp=" + timestamp;
    XMLHttpReq.open("GET", url, true);
    XMLHttpReq.onreadystatechange = processNationResponse; //指定响应函数
    XMLHttpReq.send(null);  // 发送请求
}

/*处理民族信息返回的函数*/
function processNationResponse() {
    if (XMLHttpReq.readyState == 4) { // 判断对象状态
        if (XMLHttpReq.status == 200) { // 信息已经成功返回，开始处理信息
            DisplayNationInfo();
            //setTimeout("sendRequest()", 1000);
        } else { //页面不正常
            alert(XMLHttpReq.status);
            window.alert("您所请求的页面有异常。");
        }
    }
}

/*显示修改后的民族信息*/
function DisplayNationInfo() { 
    /*使用JSON数据格式*/ 
    var nation = eval('(' + XMLHttpReq.responseText + ')');
    var nationId = nation["nationId"];
    document.getElementById("nationId_" + current_index).innerHTML = nationId;
    var nationName = nation["nationName"];
    document.getElementById("nationName_" + current_index).innerHTML = nationName;
}

