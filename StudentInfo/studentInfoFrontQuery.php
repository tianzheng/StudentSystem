<html>
<head>
<title>学生信息管理</title>
<link href="/css/manage.css" rel="Stylesheet" type="text/css" />
<script src="/opennew/alert.js" type="text/javascript"></script>
<script src="/opennew/Dialog.js" type="text/javascript"></script>
<script src="/js/ajax.js" type="text/javascript"></script>
<script src="/js/util.js" type="text/javascript"></script>
<script src="../js/calendar.js"></script>
<script>
function changepage(totalPage)
{
    var pageValue=document.studentInfoQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.studentInfoQueryForm.pageNow.value = pageValue;
    document.studentInfoQueryForm.submit();
}

/*跳转到查询结果的某页*/
function GoToPage(currentPage/*,totalPage*/) {
    //if(currentPage==0) return;
    //if(currentPage>totalPage) return;
    document.forms[0].pageNow.value = currentPage;
    document.forms[0].submit();
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
						<strong>学生信息查询</strong><script type="text/javascript">writeSpaces(105);</script>
						<img src="../images/print.jpg" title="打印" style="cursor: hand;" alt="" onclick="preview();">
					</td>
				</tr>
			</table>
		</div>

		<div id="content">
			<form id="studentInfoQueryForm" name="studentInfoQueryForm" action="/controller/StudentInfoAction.php?action=frontQuery" method="post">
				<!--startprint-->
				<table width="98%" border="1" cellspacing="1" cellpadding="2" align="center" style="margin: 0px;">
					<tr>
						<td colspan="9">
							准考证号: <input class="text" type="text" style="width: 120px" value="<?php echo $zkzh?>" name="zkzh" />
							姓名: <input class="text" type="text" style="width: 100px" value="<?php echo $name?>" name="name" />
							考生类别: <input class="text" type="text" style="width: 100px" value="<?php echo $kslb?>" name="kslb" />
							民族: <select name="nation">
								<option value="0">不限制</option>
							<?php
								for($i = 0; $i < count ( $nation_res ); $i ++) {
									$row = $nation_res [$i];
									if ($nation != $row ['nationId'])
										echo "<option value={$row['nationId']}>{$row['nationName']}</option>";
									else
										echo "<option selected value={$row['nationId']}>{$row['nationName']}</option>";
								}
							?>
							</select> 
							毕业学校: <input class="text" type="text" style="width: 120px" value="<?php echo $byxx?>" name="byxx" />
							户口所在地: <input class="text" type="text" style="width: 100px" value="<?php echo $hkszd?>" name="hkszd" />
							<br/>家庭地址: <input class="text" type="text" style="width: 150px" value="<?php echo $address?>" name="address" />
							联系电话: <input class="text" type="text" style="width: 120px" value="<?php echo $telephone?>" name="telephone" />
							身份证号: <input class="text" type="text" style="width: 140px" value="<?php echo $cardNumber?>" name="cardNumber" />
							 
							学籍号: <input class="text" type="text" style="width: 120px" value="<?php echo $xjh?>" name="xjh" />
							<input type="button" class="btn" value="查询" onClick="javascript:document.forms[0].submit();" />
							<input type=hidden name=pageNow value="1" />
						</td>
					</tr>
				</table>


				<table width="98%" border="1" cellspacing="1" cellpadding="2" align="center" style="margin: 0px;">
					<tr class="a1" style="color: #ffffff; font-size: 12px;" height="30">
						<th>准考证号</th>
						<th>姓名</th>
						<th>性别</th>
						<th>考生类别</th>
						<th>政治面貌</th>
						<th>民族</th>
						<th>毕业学校</th>
						<th>户口所在地</th>
						<th>家庭地址</th>
						<th>联系电话</th>
						<th>注册性质</th>
						<th>身份证号</th>
						<th>学籍号</th>
						<th>个人照片</th>
						<th width="60px">操作</th>
					</tr> 
<?php
for($i = 0; $i < count ( $fenyePage->res_array ); $i ++) {
	$row = $fenyePage->res_array [$i];
	$row ['nation'] = $nationService->GetNation ( $row ['nation'] )->getNationName ();
	echo "<td id=zkzh_{$row['zkzh']}>{$row['zkzh']}</td>";
	echo "<td id=name_{$row['zkzh']}>{$row['name']}</td>";
	echo "<td id=sex_{$row['zkzh']}>{$row['sex']}</td>";
	echo "<td id=kslb_{$row['zkzh']}>{$row['kslb']}</td>";
	echo "<td id=zzmm_{$row['zkzh']}>{$row['zzmm']}</td>";
	echo "<td id=nation_{$row['zkzh']}>{$row['nation']}</td>";
	echo "<td id=byxx_{$row['zkzh']}>{$row['byxx']}</td>";
	echo "<td id=hkszd_{$row['zkzh']}>{$row['hkszd']}</td>";
	echo "<td id=address_{$row['zkzh']}>{$row['address']}</td>";
	echo "<td id=telephone_{$row['zkzh']}>{$row['telephone']}</td>";
	echo "<td id=zcxx_{$row['zkzh']}>{$row['zcxx']}</td>";
	echo "<td id=cardNumber_{$row['zkzh']}>{$row['cardNumber']}</td>";
	echo "<td id=xjh_{$row['zkzh']}>{$row['xjh']}</td>";
	echo "<td align='center' id=photo_{$row['zkzh']}><img width='50px' height='50px' src=\"{$row['photo']}\" /></td>";
	echo "<td><div align='left'><a href='#' onclick=\"OpenViewStudentInfo('{$row['zkzh']}', '查看学生信息','{$row['zkzh']}');\">查看详情</a>&nbsp;&nbsp;</div> </td>";
	echo "</tr>";
}
echo "<input type=button id='Ajax_Btn' style='display:none;' onclick='Ajax_GetStudentInfo();' />";
echo "</table>";
// 显示上一页和下一页
echo $fenyePage->navigate;
?>
&nbsp;跳转到： <input name="pageValue" type="text" size="4" style="height: 20px; width: 30px; border: 1px solid #999999;" />页
<img src="../images/go.gif" style="cursor: hand;" onclick="changepage(<?php echo $fenyePage->pageCount ?>);" width="37" height="15" />
				<!--endprint-->
			</form>
		</div>
	</div>
</body>
</html>
