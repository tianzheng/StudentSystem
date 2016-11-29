<?php
	require_once '../controller/CheckLoginState.php';
?>
<html>
<head>
<title>民族信息管理</title>
<link href="/css/manage.css" rel="Stylesheet" type="text/css" />
<script src="/opennew/alert.js" type="text/javascript"></script>
<script src="/opennew/Dialog.js" type="text/javascript"></script>
<script src="/js/ajax.js" type="text/javascript"></script>
<script src="/js/util.js" type="text/javascript"></script>
<script src="../js/calendar.js"></script>
<script>
function changepage(totalPage)
{
    var pageValue=document.nationQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.nationQueryForm.pageNow.value = pageValue;
    document.nationQueryForm.submit();
}

/*跳转到查询结果的某页*/
function GoToPage(currentPage/*,totalPage*/) {
    //if(currentPage==0) return;
    //if(currentPage>totalPage) return;
    document.forms[0].pageNow.value = currentPage;
    document.forms[0].submit();
}
function OutputToExcel() {
	document.forms["nationQueryForm"].action = "/controller/NationAction.php?action=OutToExcel";
	document.forms["nationQueryForm"].submit(); 
}

function Submit() {
	document.forms["nationQueryForm"].action = "/controller/NationAction.php?action=query";
	document.forms["nationQueryForm"].submit(); 	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<div id="container">
		<div id="title">
			<table width="98%" border="0" cellpadding="0" cellspacing="2" align="center">
				<tr>
					<td height="21"><img src="../images/ico/ico08.gif" alt="" />
						<strong>民族信息管理</strong><script type="text/javascript">writeSpaces(105);</script>
						<img src="../images/print.jpg" title="打印" style="cursor: hand;" alt="" onclick="preview();">
					</td>
				</tr>
			</table>
		</div>

		<div id="content">
			<form id="nationQueryForm" name="nationQueryForm" onsubmit="Submit();"   method="post">
				<!--startprint-->
							<input type=hidden name=pageNow value="1" />
						</td>
					</tr>
				</table>


				<table width="98%" border="1" cellspacing="1" cellpadding="2" align="center" style="margin: 0px;">
					<tr class="a1" style="color: #ffffff; font-size: 12px;" height="30">
						<th>民族编号</th>
						<th>民族名称</th>
						<th width="60px">操作</th>
					</tr> 
<?php
for($i = 0; $i < count ( $fenyePage->res_array ); $i ++) {
	$row = $fenyePage->res_array [$i];
	echo "<td id=nationId_{$row['nationId']}>{$row['nationId']}</td>";
	echo "<td id=nationName_{$row['nationId']}>{$row['nationName']}</td>";
	echo "<td><div align='left'><a href='#' onclick=\"OpenEditNation('{$row['nationId']}', '修改民族信息','{$row['nationId']}');\">修改</a>&nbsp;&nbsp;</div><div align=\"right\"><a href='NationAction.php?action=del&nationId={$row['nationId']}' onclick=\"return confirm('警告：您确认删除吗？');\">删除</a></div></td>";
	echo "</tr>";
}
echo "<input type=button id='Ajax_Btn' style='display:none;' onclick='Ajax_GetNation();' />";
echo "</table>";
// 显示上一页和下一页
echo $fenyePage->navigate;
?>
&nbsp;&nbsp;<span style="color:red;text-decoration:underline;cursor:hand" onclick="OutputToExcel();">导出当前记录到excel</span>&nbsp;&nbsp;跳转到： <input name="pageValue" type="text" size="4" style="height: 20px; width: 30px; border: 1px solid #999999;" />页
<img src="../images/go.gif" style="cursor: hand;" onclick="changepage(<?php echo $fenyePage->pageCount ?>);" width="37" height="15" />
				<!--endprint-->
			</form>
		</div>
	</div>
</body>
</html>
