/*function $(ele) {
    if (typeof (ele) == 'string') {
        ele = document.getElementById(ele)
        if (!ele) {
            return null;
        }
    }
    return ele;
}*/
function zOpenD() {
    var diag = new Dialog("Diag1");
    diag.Width = 900;
    diag.Height = 400;
    diag.Title = "弹出窗口示例";
    diag.URL = "http://baidu.com";
    diag.ShowMessageRow = true;
    diag.MessageTitle = "弹出窗口示例";
    diag.Message = "在这儿你可以对这个窗口的内容或功能作一些说明";
    diag.OKEvent = zAlert; //点击确定后调用的方法
    diag.show();
}
function zOpen() {
    var diag = new Dialog("Diag2");
    diag.Width = 900;
    diag.Height = 400;
    diag.Title = "弹出窗口示例";
    diag.URL = "http://demo.zving.com/";
    diag.OKEvent = zAlert; //点击确定后调用的方法
    diag.show();
}
function zAlert() {
    Dialog.alert("你点击了一个按钮");
}
function zConfirm() {
    Dialog.confirm('警告：您确认要XXOO吗？', function() { Dialog.alert("yeah，周末到了，正是好时候"); });
}
function sometext(ele, n) {
    var strArr = ["可", "以", "清", "心", "也"];
    var writeStr = ""
    for (i = 0; i < n; i++) {
        index = parseInt(Math.random() * 5);
        for (j = 0; j < 5; j++) {
            str = index + j > 4 ? index + j - 5 : index + j;
            writeStr += strArr[str];
        }
    }
    $(ele).innerHTML = writeStr;
}
 
 
var current_index = null; 

/*弹出修改学生信息的窗口页面*/
function OpenEditStudentInfo(index, title, zkzh) { 
    current_index = index;
    var diag = new Dialog("Diag1");
    diag.Width = 600;
    diag.Height = 350;
    diag.Title = title == null ? "修改学生信息" : title;
    diag.URL = "/StudentInfo/studentInfoUpdate.php?zkzh=" + encodeURI(zkzh);
    diag.Message = "<span style='color:red'>请修改学生信息</span>";
    diag.ShowMessageRow = true;
    diag.MessageTitle = title;
    diag.OKEvent = zAlert; //点击确定后调用的方法
    diag.show();
}

/*弹出查看学生信息详情的窗口页面*/
function OpenViewStudentInfo(index, title, zkzh) { 
    current_index = index;
    var diag = new Dialog("Diag1");
    diag.Width = 600;
    diag.Height = 350;
    diag.Title = title == null ? "查询学生信息" : title;
    diag.URL = "/StudentInfo/studentInfoView.php?zkzh=" + encodeURI(zkzh);
    diag.Message = "<span style='color:red'>查看学生信息</span>";
    diag.ShowMessageRow = true;
    diag.MessageTitle = title;
    diag.OKEvent = zAlert; //点击确定后调用的方法
    diag.show();
}

/*弹出修改民族信息的窗口页面*/
function OpenEditNation(index, title, nationId) { 
    current_index = index;
    var diag = new Dialog("Diag1");
    diag.Width = 600;
    diag.Height = 350;
    diag.Title = title == null ? "修改民族信息" : title;
    diag.URL = "/Nation/nationUpdate.php?nationId=" + encodeURI(nationId);
    diag.Message = "<span style='color:red'>请修改民族信息</span>";
    diag.ShowMessageRow = true;
    diag.MessageTitle = title;
    diag.OKEvent = zAlert; //点击确定后调用的方法
    diag.show();
}

/*弹出查看民族信息详情的窗口页面*/
function OpenViewNation(index, title, nationId) { 
    current_index = index;
    var diag = new Dialog("Diag1");
    diag.Width = 600;
    diag.Height = 350;
    diag.Title = title == null ? "查询民族信息" : title;
    diag.URL = "/Nation/nationView.php?nationId=" + encodeURI(nationId);
    diag.Message = "<span style='color:red'>查看民族信息</span>";
    diag.ShowMessageRow = true;
    diag.MessageTitle = title;
    diag.OKEvent = zAlert; //点击确定后调用的方法
    diag.show();
}





