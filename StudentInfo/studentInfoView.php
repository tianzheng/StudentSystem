 <?php
    require_once '../service/StudentInfoService.class.php';
    require_once '../phpbean/StudentInfo.class.php';
    $zkzh = $_GET['zkzh'];
    $studentInfoService = new StudentInfoService();
    $studentInfo = $studentInfoService->GetStudentInfo($zkzh);
 ?>
<html>
<head>
<title>查看学生信息</title>
<link href="/css/add_modify.css" rel="stylesheet" type="text/css" />
<script src="/js/util.js" type="text/javascript"></script>
<script src="../js/calendar.js"></script>
<script type="text/javascript">
        function CheckForm() {
            var re = /^[0-9]+.?[0-9]*$/;
            var resc=/^[1-9]+[0-9]*]*$/ ;
            var name = document.getElementById("name").value;
            if (name == "") {
                alert("请输入姓名...");
                document.getElementById("name").focus();
                return false;
            }

            var sex = document.getElementById("sex").value;
            if (sex == "") {
                alert("请输入性别...");
                document.getElementById("sex").focus();
                return false;
            }

            var kslb = document.getElementById("kslb").value;
            if (kslb == "") {
                alert("请输入考生类别...");
                document.getElementById("kslb").focus();
                return false;
            }

            var zzmm = document.getElementById("zzmm").value;
            if (zzmm == "") {
                alert("请输入政治面貌...");
                document.getElementById("zzmm").focus();
                return false;
            }

            var hkszd = document.getElementById("hkszd").value;
            if (hkszd == "") {
                alert("请输入户口所在地...");
                document.getElementById("hkszd").focus();
                return false;
            }

            document.forms[0].submit();
       } 
    </script>
</head>
<body>
	<div id="container">
		<div id="title">
			<table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
				<tr>
					<td height="21"><img src="../images/ico/ico29.gif" width="32" height="32" hspace="2" vspace="2" align="absmiddle">
					    <strong> 学生信息修改 </strong>
					</td>
				</tr>
			</table>
		</div>

		<div id="content">
			<form id="form1" method="post" action="/controller/StudentInfoAction.php?action=update" enctype="multipart/form-data">
				<p>
					准考证号: &nbsp;
					<input id="zkzh" class="text" type="text" readOnly style="width: 300px" value="<?php echo $studentInfo->getZKZH()?>" name="studentInfo[zkzh]" />
					<font color=red>*</font>
				</p>
				<p>
					姓名: &nbsp;
					<input id="name" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getName()?>" name="studentInfo[name]" />
					<font color=red>*</font>
				</p>
				<p>
					性别: &nbsp;
					<input id="sex" class="text" type="text" style="width: 20px" value="<?php echo $studentInfo->getSex()?>" name="studentInfo[sex]" />
					<font color=red>*</font>
				</p>
				<p>
					考生类别: &nbsp;
					<input id="kslb" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getKslb()?>" name="studentInfo[kslb]" />
					<font color=red>*</font>
				</p>
				<p>
					政治面貌: &nbsp;
					<input id="zzmm" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getZzmm()?>" name="studentInfo[zzmm]" />
					<font color=red>*</font>
				</p>
				<p>
					民族:&nbsp;
					<select name="studentInfo[nation]">
					<?php
						require_once '../service/NationService.class.php';
						$nationService = new NationService ();
						$nation_res = $nationService->QueryAllNation ();
						for($i = 0; $i < count ( $nation_res ); $i ++) {
						  $row = $nation_res [$i];
						  if($row['nationId'] == $studentInfo->getNation())
						    echo "<option selected value={$row['nationId']}>{$row['nationName']}</option>";
						  else
						    echo "<option value={$row['nationId']}>{$row['nationName']}</option>";
						}
					?>
					</select>
				</p>

				<p>
					毕业学校: &nbsp;
					<input id="byxx" class="text" type="text" style="width: 300px" value="<?php echo $studentInfo->getByxx()?>" name="studentInfo[byxx]" />
				</p>
				<p>
					户口所在地: &nbsp;
					<input id="hkszd" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getHkszd()?>" name="studentInfo[hkszd]" />
					<font color=red>*</font>
				</p>
				<p>
					家庭地址: &nbsp;
					<input id="address" class="text" type="text" style="width: 800px" value="<?php echo $studentInfo->getAddress()?>" name="studentInfo[address]" />
				</p>
				<p>
					联系电话: &nbsp;
					<input id="telephone" class="text" type="text" style="width: 300px" value="<?php echo $studentInfo->getTelephone()?>" name="studentInfo[telephone]" />
				</p>
				<p>
					注册性质: &nbsp;
					<input id="zcxx" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getZcxx()?>" name="studentInfo[zcxx]" />
				</p>
				<p>
					身份证号: &nbsp;
					<input id="cardNumber" class="text" type="text" style="width: 300px" value="<?php echo $studentInfo->getCardNumber()?>" name="studentInfo[cardNumber]" />
				</p>
				<p>
					学籍号: &nbsp;
					<input id="xjh" class="text" type="text" style="width: 300px" value="<?php echo $studentInfo->getXjh()?>" name="studentInfo[xjh]" />
				</p>
				<p>
					高一所在年级: &nbsp;
					<input id="gysznj" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getGysznj()?>" name="studentInfo[gysznj]" />
				</p>
				<p>
					高二所在年级: &nbsp;
					<input id="gesznj" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getGesznj()?>" name="studentInfo[gesznj]" />
				</p>
				<p>
					高三所在年级: &nbsp;
					<input id="gssznj" class="text" type="text" style="width: 200px" value="<?php echo $studentInfo->getGssznj()?>" name="studentInfo[gssznj]" />
				</p>
				<p>
					备注信息: &nbsp;
					<textarea name="studentInfo[memo]" id="memo" cols="60" rows="8"><?php echo $studentInfo->getMemo()?></textarea>
				</p>
				<p>
					个人照片:&nbsp; <img src="<?php echo $studentInfo->getPhoto()?>" width="200px" border="0px" /><br/>
				</p>
			</form>
		</div>
	</div>
</body>
</html>
