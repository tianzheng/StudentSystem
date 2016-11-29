<?php
require_once '../phpbean/StudentInfo.class.php';
require_once '../service/StudentInfoService.class.php';

//创建了StudentInfoService实例
$studentInfoService = new StudentInfoService();

//根据action参数决定用户要执行什么样的操作
if(!empty($_REQUEST['action'])) {
	//接收action值
	$action = $_REQUEST['action'];
	if($action == "add") {
		//说明用户希望执行添加学生信息信息
		$studentInfo = new StudentInfo();
		$array_studentInfo = $_POST["studentInfo"];
		/*处理图片上传*/
		require_once("../util/upload.class.php");
		require_once("../util/util.php");

		$studentInfo->setZkzh($array_studentInfo['zkzh']);
		$studentInfo->setName($array_studentInfo['name']);
		$studentInfo->setSex($array_studentInfo['sex']);
		$studentInfo->setKslb($array_studentInfo['kslb']);
		$studentInfo->setZzmm($array_studentInfo['zzmm']);
		$studentInfo->setNation($array_studentInfo['nation']);
		$studentInfo->setByxx($array_studentInfo['byxx']);
		$studentInfo->setHkszd($array_studentInfo['hkszd']);
		$studentInfo->setAddress($array_studentInfo['address']);
		$studentInfo->setTelephone($array_studentInfo['telephone']);
		$studentInfo->setZcxx($array_studentInfo['zcxx']);
		$studentInfo->setCardNumber($array_studentInfo['cardNumber']);
		$studentInfo->setXjh($array_studentInfo['xjh']);
		$studentInfo->setGysznj($array_studentInfo['gysznj']);
		$studentInfo->setGesznj($array_studentInfo['gesznj']);
		$studentInfo->setGssznj($array_studentInfo['gssznj']);
		$studentInfo->setMemo($array_studentInfo['memo']);
		$photo = "/upload/NoImage.jpg";
		if ($_FILES['photo']['name'] != ''){
			/*--  实例化上传类  --*/
			$file = $_FILES['photo'];
			$upload_path = '../upload';
			$allow_type = array('jpg','bmp','png','gif','jpeg');
			$max_size=2048000;
			$upload = new upFiles($file, $upload_path, $max_size, $allow_type);
			$upload->upload();
			$pic = $upload->getSaveFileInfo();
			$photo = substr($pic['path'], 2)."/".$pic['savename'];
		}
		$studentInfo->setPhoto($photo);


		//完成添加->数据库
		$res = $studentInfoService->AddStudentInfo($studentInfo);
		if($res==1) {
			header("Location: /ok.php");
			exit();
		} else {
			//失败
			header("Location: /error.php");
			exit();
		}
	} else if($action == "query") {
		//查询学生信息信息
		require_once '../service/StudentInfoService.class.php';
		require_once '../service/FenyePage.class.php';
		//获取查询参数
		$zkzh = !empty($_POST['zkzh']) ? $_POST['zkzh'] : "";
		$name = !empty($_POST['name']) ? $_POST['name'] : "";
		$kslb = !empty($_POST['kslb']) ? $_POST['kslb'] : "";
		$nation = !empty($_POST['nation'])?$_POST['nation']:0;
		$byxx = !empty($_POST['byxx']) ? $_POST['byxx'] : "";
		$hkszd = !empty($_POST['hkszd']) ? $_POST['hkszd'] : "";
		$address = !empty($_POST['address']) ? $_POST['address'] : "";
		$telephone = !empty($_POST['telephone']) ? $_POST['telephone'] : "";
		$cardNumber = !empty($_POST['cardNumber']) ? $_POST['cardNumber'] : "";
		$xjh = !empty($_POST['xjh']) ? $_POST['xjh'] : "";
		//创建StudentInfoService实例
		$studentInfoService = new StudentInfoService();

		//创建一个FenyePage对象实例
		$fenyePage = new FenyePage();
		//给fenyePage指定必须的参数
		$fenyePage->pageNow = 1;
		$fenyePage->pageSize = 5;
		$fenyePage->gotoUrl = "StudentInfoAction.php";

		//在此我们需要根据用户的点击来修改pageNow的值，不要判断是否有这个pageNow发送
		if(!empty($_REQUEST['pageNow'])){
			$fenyePage->pageNow=$_REQUEST['pageNow'];
		}

		//调用getFenyePage，该方法可以把fenyePage完成
		$studentInfoService->getFenyePage($fenyePage,$zkzh,$name,$kslb,$nation,$byxx,$hkszd,$address,$telephone,$cardNumber,$xjh);
		require_once '../service/NationService.class.php';
		$nationService = new NationService();
		$nation_res = $nationService->QueryAllNation();

		include '../StudentInfo/studentInfoManage.php';
	} else if($action == "frontQuery") {
		//查询学生信息信息
		require_once '../service/StudentInfoService.class.php';
		require_once '../service/FenyePage.class.php';
		//获取查询参数
		$zkzh = !empty($_POST['zkzh']) ? $_POST['zkzh'] : "";
		$name = !empty($_POST['name']) ? $_POST['name'] : "";
		$kslb = !empty($_POST['kslb']) ? $_POST['kslb'] : "";
		$nation = !empty($_POST['nation'])?$_POST['nation']:0;
		$byxx = !empty($_POST['byxx']) ? $_POST['byxx'] : "";
		$hkszd = !empty($_POST['hkszd']) ? $_POST['hkszd'] : "";
		$address = !empty($_POST['address']) ? $_POST['address'] : "";
		$telephone = !empty($_POST['telephone']) ? $_POST['telephone'] : "";
		$cardNumber = !empty($_POST['cardNumber']) ? $_POST['cardNumber'] : "";
		$xjh = !empty($_POST['xjh']) ? $_POST['xjh'] : "";
		//创建StudentInfoService实例
		$studentInfoService = new StudentInfoService();

		//创建一个FenyePage对象实例
		$fenyePage = new FenyePage();
		//给fenyePage指定必须的参数
		$fenyePage->pageNow = 1;
		$fenyePage->pageSize = 5;
		$fenyePage->gotoUrl = "StudentInfoAction.php";

		//在此我们需要根据用户的点击来修改pageNow的值，不要判断是否有这个pageNow发送
		if(!empty($_REQUEST['pageNow'])){
			$fenyePage->pageNow=$_REQUEST['pageNow'];
		}

		//调用getFenyePage，该方法可以把fenyePage完成
		$studentInfoService->getFenyePage($fenyePage,$zkzh,$name,$kslb,$nation,$byxx,$hkszd,$address,$telephone,$cardNumber,$xjh);
		require_once '../service/NationService.class.php';
		$nationService = new NationService();
		$nation_res = $nationService->QueryAllNation();

		include '../StudentInfo/studentInfoFrontQuery.php';
  } else if($action == "OutToExcel") {
		require_once './PHPExcel/PHPExcel.php';
		require_once './PHPExcel/phpExcel/IOFactory.php';
		require_once '../service/StudentInfoService.class.php';
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
									 ->setLastModifiedBy("Maarten Balliauw")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");
		$objPHPExcel->setActiveSheetIndex(0);
		$objRichText = new PHPExcel_RichText();
		$objRichText->createText('');
		$objPayable = $objRichText->createTextRun('学生信息信息记录');
		$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
		$objPayable->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->getStartColor()->setARGB('00FFFF00');			// 底纹
		$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
		$objPHPExcel->getActiveSheet()->getCell('A1')->setValue($objRichText);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);		// 加粗
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);			// 字体大小
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);	// 文本颜色

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', '准考证号');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('B2', '姓名');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('C2', '性别');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('D2', '考生类别');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('E2', '政治面貌');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('F2', '民族');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('G2', '毕业学校');
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('H2', '户口所在地');
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('I2', '家庭地址');
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('J2', '联系电话');
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('K2', '注册性质');
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('L2', '身份证号');
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('M2', '学籍号');
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12);
		$objPHPExcel->getActiveSheet()->setCellValue('N2', '个人照片');
		for($i = 'A'; $i <= 'N'; $i++)
		{
			$objPHPExcel->getActiveSheet()->getStyle($i . '2')->getFont()->setBold(true);		// 加粗
		}

		//获取查询参数
		$zkzh = !empty($_POST['zkzh']) ? $_POST['zkzh'] : "";
		$name = !empty($_POST['name']) ? $_POST['name'] : "";
		$kslb = !empty($_POST['kslb']) ? $_POST['kslb'] : "";
		$nation = !empty($_POST['nation'])?$_POST['nation']:0;
		$byxx = !empty($_POST['byxx']) ? $_POST['byxx'] : "";
		$hkszd = !empty($_POST['hkszd']) ? $_POST['hkszd'] : "";
		$address = !empty($_POST['address']) ? $_POST['address'] : "";
		$telephone = !empty($_POST['telephone']) ? $_POST['telephone'] : "";
		$cardNumber = !empty($_POST['cardNumber']) ? $_POST['cardNumber'] : "";
		$xjh = !empty($_POST['xjh']) ? $_POST['xjh'] : "";
		//创建StudentInfoService实例
		$studentInfoService = new StudentInfoService();

		$studentInfoArray = $studentInfoService->QueryPrintStudentInfoInfo($zkzh,$name,$kslb,$nation,$byxx,$hkszd,$address,$telephone,$cardNumber,$xjh);
		for($i=0;$i<count($studentInfoArray);$i++) {
			$objPHPExcel->getActiveSheet()->getRowDimension($i+3)->setRowHeight(50);
			$studentInfo = $studentInfoArray[$i];
			$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+3), $studentInfo['zkzh']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($i+3), $studentInfo['name']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.($i+3), $studentInfo['sex']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.($i+3), $studentInfo['kslb']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.($i+3), $studentInfo['zzmm']);
			require_once '../service/NationService.class.php';
			$nationService = new NationService();  
			$objPHPExcel->getActiveSheet()->setCellValue('F'.($i+3), $nationService->GetNation($studentInfo['nation'])->getnationName());
			$objPHPExcel->getActiveSheet()->setCellValue('G'.($i+3), $studentInfo['byxx']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.($i+3), $studentInfo['hkszd']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.($i+3), $studentInfo['address']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.($i+3), $studentInfo['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.($i+3), $studentInfo['zcxx']);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('L'.($i+3), $studentInfo['cardNumber'], PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.($i+3), $studentInfo['xjh']);
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('photo');
			$objDrawing->setDescription('photo');
			$objDrawing->setPath('..'.$studentInfo['photo']);
			$objDrawing->setResizeProportional(false);  //取消按原图像缩放
			$objDrawing->setHeight(68);
			$objDrawing->setWidth(85);
			$objDrawing->setCoordinates('N'.($i+3));
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('学生信息信息记录');

		//保存到服务器
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//$FileName=iconv('utf-8','gbk','PHP导出Excel.xls');
		//$objWriter->save($FileName); 

		//选中保存路径
		$outputFileName = iconv('UTF-8','gb2312','学生信息记录.xls');
		ob_end_clean();//清除缓冲区,避免乱码 
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename='.$outputFileName); 
		header('Cache-Control: max-age=0'); 

		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
		$objWriter->save('php://output'); 
	} else if($action == "update") {
		//说明用户希望执行更新学生信息信息
		$array_studentInfo = $_POST["studentInfo"];
		$studentInfo = $studentInfoService->GetStudentInfo($array_studentInfo['zkzh']);
		/*处理图片上传*/
		require_once("../util/upload.class.php");
		require_once("../util/util.php");

		$studentInfo->setZkzh($array_studentInfo['zkzh']);
		$studentInfo->setName($array_studentInfo['name']);
		$studentInfo->setSex($array_studentInfo['sex']);
		$studentInfo->setKslb($array_studentInfo['kslb']);
		$studentInfo->setZzmm($array_studentInfo['zzmm']);
		$studentInfo->setNation($array_studentInfo['nation']);
		$studentInfo->setByxx($array_studentInfo['byxx']);
		$studentInfo->setHkszd($array_studentInfo['hkszd']);
		$studentInfo->setAddress($array_studentInfo['address']);
		$studentInfo->setTelephone($array_studentInfo['telephone']);
		$studentInfo->setZcxx($array_studentInfo['zcxx']);
		$studentInfo->setCardNumber($array_studentInfo['cardNumber']);
		$studentInfo->setXjh($array_studentInfo['xjh']);
		$studentInfo->setGysznj($array_studentInfo['gysznj']);
		$studentInfo->setGesznj($array_studentInfo['gesznj']);
		$studentInfo->setGssznj($array_studentInfo['gssznj']);
		$studentInfo->setMemo($array_studentInfo['memo']);
		if ($_FILES['photo']['name'] != ''){
			/*--  实例化上传类  --*/
			$file = $_FILES['photo'];
			$upload_path = '../upload';
			$allow_type = array('jpg','bmp','png','gif','jpeg');
			$max_size=2048000;
			$upload = new upFiles($file, $upload_path, $max_size, $allow_type);
			$upload->upload();
			$pic = $upload->getSaveFileInfo();
			$photo = substr($pic['path'], 2)."/".$pic['savename'];
		  $studentInfo->setPhoto($photo);
		}

		//完成修改->数据库
		$res = $studentInfoService->UpdateStudentInfo($studentInfo);
		if($res != 0) {
			header("Location: /ok.php");
			exit();
		} else {
			//失败
			header("Location: /error.php");
			exit();
		}
	} else if($action == "del") {
		//这时我们知道要删除学生信息信息
		$zkzh = $_GET['zkzh'];
		if($studentInfoService->DeleteStudentInfo($zkzh) == 1) {
			//成功
			header("Location: /ok.php");
			exit();
		} else {
			//失败
			header("Location: /error.php");
			exit();
		}
	}
}
?>
