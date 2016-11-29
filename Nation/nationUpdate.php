 <?php
    require_once '../controller/CheckLoginState.php'; 
    require_once '../service/NationService.class.php';
    require_once '../phpbean/Nation.class.php';
    $nationId = $_GET['nationId'];
    $nationService = new NationService();
    $nation = $nationService->GetNation($nationId);
 ?>
<html>
<head>
<title>修改民族信息</title>
<link href="/css/add_modify.css" rel="stylesheet" type="text/css" />
<script src="/js/util.js" type="text/javascript"></script>
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
			<table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
				<tr>
					<td height="21"><img src="../images/ico/ico29.gif" width="32" height="32" hspace="2" vspace="2" align="absmiddle">
					    <strong> 民族信息修改 </strong>
					</td>
				</tr>
			</table>
		</div>

		<div id="content">
			<form id="form1" method="post" action="/controller/NationAction.php?action=update" enctype="multipart/form-data">
				<p>
					民族编号: &nbsp;
					<input id="nationId" class="text" type="text" readOnly style="width: 60px" value="<?php echo $nation->getNATIONID()?>" name="nation[nationId]" />
					<font color=red>*</font>
				</p>
				<p>
					民族名称: &nbsp;
					<input id="nationName" class="text" type="text" style="width: 300px" value="<?php echo $nation->getNationName()?>" name="nation[nationName]" />
					<font color=red>*</font>
				</p>
				<p>
					<input type="button" style="cursor: hand;" class="btn" value="修改" onClick="CheckForm();" />
				</p>
			</form>
		</div>
	</div>
</body>
</html>
