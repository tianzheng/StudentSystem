<?php
	require_once '../controller/CheckLoginState.php';
?>
<html>
<head>
<title>学生信息登记</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/add_modify.css" rel="stylesheet" type="text/css" />
<script src="../js/util.js" language="JavaScript"></script>
<script src="../js/calendar.js"></script>
<script type="text/javascript">
        function CheckForm() {
            var re = /^[0-9]+.?[0-9]*$/;
            var resc=/^[1-9]+[0-9]*]*$/ ;
            var zkzh = document.getElementById("zkzh").value;
            if (zkzh == "") {
                alert("请输入准考证号...");
                document.getElementById("zkzh").focus();
                return false;
            }

            var name = document.getElementById("name").value;
            if (name == "") {
                alert("请输入姓名...");
                document.getElementById("name").focus();
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
			<img src="../images/ADD.gif" />学生信息录入 (带*号的为必填项)
		</div>
		<div id="content">
			<form method="post" name="studentInfoAddForm"
				action="/controller/StudentInfoAction.php?action=add"
				enctype="multipart/form-data">
				<br />
				<p>
					准考证号: &nbsp;
					<input id="zkzh" class="text" type="text" style="width: 300px" value="" name="studentInfo[zkzh]" />
					<font color=red>*</font>
				</p>
				<p>
					姓名: &nbsp;
					<input id="name" class="text" type="text" style="width: 200px" value="" name="studentInfo[name]" />
					<font color=red>*</font>
				</p>
				<p>
					性别: &nbsp;
					<select name="studentInfo[sex]">
						<option value="男">男</option>
						<option value="女">女</option>
					</select> 
					 
				</p>
				<p>
					考生类别: &nbsp;
					<input id="kslb" class="text" type="text" style="width: 200px" value="" name="studentInfo[kslb]" />
					<font color=red>*</font>
				</p>
				<p>
					政治面貌: &nbsp;
					<input id="zzmm" class="text" type="text" style="width: 200px" value="" name="studentInfo[zzmm]" />
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
						  echo "<option value={$row['nationId']}>{$row['nationName']}</option>";
						}
					?>
					</select>
				</p>

				<p>
					毕业学校: &nbsp;
					<input id="byxx" class="text" type="text" style="width: 300px" value="" name="studentInfo[byxx]" />
				</p>
				<p>
					户口所在地: &nbsp;
					<input id="hkszd" class="text" type="text" style="width: 200px" value="" name="studentInfo[hkszd]" />
					<font color=red>*</font>
				</p>
				<p>
					家庭地址: &nbsp;
					<input id="address" class="text" type="text" style="width: 800px" value="" name="studentInfo[address]" />
				</p>
				<p>
					联系电话: &nbsp;
					<input id="telephone" class="text" type="text" style="width: 300px" value="" name="studentInfo[telephone]" />
				</p>
				<p>
					注册性质: &nbsp;
					<input id="zcxx" class="text" type="text" style="width: 200px" value="" name="studentInfo[zcxx]" />
				</p>
				<p>
					身份证号: &nbsp;
					<input id="cardNumber" class="text" type="text" style="width: 300px" value="" name="studentInfo[cardNumber]" />
				</p>
				<p>
					学籍号: &nbsp;
					<input id="xjh" class="text" type="text" style="width: 300px" value="" name="studentInfo[xjh]" />
				</p>
				<p>
					高一所在年级: &nbsp;
					<input id="gysznj" class="text" type="text" style="width: 200px" value="" name="studentInfo[gysznj]" />
				</p>
				<p>
					高二所在年级: &nbsp;
					<input id="gesznj" class="text" type="text" style="width: 200px" value="" name="studentInfo[gesznj]" />
				</p>
				<p>
					高三所在年级: &nbsp;
					<input id="gssznj" class="text" type="text" style="width: 200px" value="" name="studentInfo[gssznj]" />
				</p>
				<p>
					备注信息: &nbsp;
					<textarea name="studentInfo[memo]" id="memo" cols="80" rows="8"></textarea>
				</p>
				<p>
					个人照片:&nbsp; <input class="text" type="file" style="width: 200px" value="" name="photo" />
				</p>
				<p>
					<input type="button" style="cursor: hand;" class="btn" value="添加" onClick="CheckForm();" />
				</p>

			</form>
		</div>
	</div>
</body>
</html>
