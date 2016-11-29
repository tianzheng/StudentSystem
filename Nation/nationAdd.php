<?php
	require_once '../controller/CheckLoginState.php';
?>
<html>
<head>
<title>民族信息登记</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/add_modify.css" rel="stylesheet" type="text/css" />
<script src="../js/util.js" language="JavaScript"></script>
<script src="../js/calendar.js"></script>
<script type="text/javascript">
        function CheckForm() {
            var re = /^[0-9]+.?[0-9]*$/;
            var resc=/^[1-9]+[0-9]*]*$/ ;
            var nationName = document.getElementById("nationName").value;
            if (nationName == "") {
                alert("请输入民族名称...");
                document.getElementById("nationName").focus();
                return false;
            }

            document.forms[0].submit();
       } 
    </script>
</head>
<body>
	<div id="container">
		<div id="title">
			<img src="../images/ADD.gif" />民族信息录入 (带*号的为必填项)
		</div>
		<div id="content">
			<form method="post" name="nationAddForm"
				action="/controller/NationAction.php?action=add"
				enctype="multipart/form-data">
				<br />
				<p>
					民族名称: &nbsp;
					<input id="nationName" class="text" type="text" style="width: 300px" value="" name="nation[nationName]" />
					<font color=red>*</font>
				</p>
				<p>
					<input type="button" style="cursor: hand;" class="btn" value="添加" onClick="CheckForm();" />
				</p>

			</form>
		</div>
	</div>
</body>
</html>
