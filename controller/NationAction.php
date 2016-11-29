<?php
require_once '../phpbean/Nation.class.php';
require_once '../service/NationService.class.php';

//创建了NationService实例
$nationService = new NationService();

//根据action参数决定用户要执行什么样的操作
if(!empty($_REQUEST['action'])) {
	//接收action值
	$action = $_REQUEST['action'];
	if($action == "add") {
		//说明用户希望执行添加民族信息信息
		$nation = new Nation();
		$array_nation = $_POST["nation"];
		$nation->setNationId($array_nation['nationId']);
		$nation->setNationName($array_nation['nationName']);
		//完成添加->数据库
		$res = $nationService->AddNation($nation);
		if($res==1) {
			header("Location: /ok.php");
			exit();
		} else {
			//失败
			header("Location: /error.php");
			exit();
		}
	} else if($action == "query") {
		//查询民族信息信息
		require_once '../service/NationService.class.php';
		require_once '../service/FenyePage.class.php';
		//获取查询参数
		//创建NationService实例
		$nationService = new NationService();

		//创建一个FenyePage对象实例
		$fenyePage = new FenyePage();
		//给fenyePage指定必须的参数
		$fenyePage->pageNow = 1;
		$fenyePage->pageSize = 5;
		$fenyePage->gotoUrl = "NationAction.php";

		//在此我们需要根据用户的点击来修改pageNow的值，不要判断是否有这个pageNow发送
		if(!empty($_REQUEST['pageNow'])){
			$fenyePage->pageNow=$_REQUEST['pageNow'];
		}

		//调用getFenyePage，该方法可以把fenyePage完成
		$nationService->getFenyePage($fenyePage);
		include '../Nation/nationManage.php';
	} else if($action == "frontQuery") {
		//查询民族信息信息
		require_once '../service/NationService.class.php';
		require_once '../service/FenyePage.class.php';
		//获取查询参数
		//创建NationService实例
		$nationService = new NationService();

		//创建一个FenyePage对象实例
		$fenyePage = new FenyePage();
		//给fenyePage指定必须的参数
		$fenyePage->pageNow = 1;
		$fenyePage->pageSize = 5;
		$fenyePage->gotoUrl = "NationAction.php";

		//在此我们需要根据用户的点击来修改pageNow的值，不要判断是否有这个pageNow发送
		if(!empty($_REQUEST['pageNow'])){
			$fenyePage->pageNow=$_REQUEST['pageNow'];
		}

		//调用getFenyePage，该方法可以把fenyePage完成
		$nationService->getFenyePage($fenyePage);
		include '../Nation/nationFrontQuery.php';
  } else if($action == "OutToExcel") {
		require_once './PHPExcel/PHPExcel.php';
		require_once './PHPExcel/phpExcel/IOFactory.php';
		require_once '../service/NationService.class.php';
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
		$objPayable = $objRichText->createTextRun('民族信息信息记录');
		$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
		$objPayable->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->getStartColor()->setARGB('00FFFF00');			// 底纹
		$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
		$objPHPExcel->getActiveSheet()->getCell('A1')->setValue($objRichText);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);		// 加粗
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);			// 字体大小
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);	// 文本颜色

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', '民族编号');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
		$objPHPExcel->getActiveSheet()->setCellValue('B2', '民族名称');
		for($i = 'A'; $i <= 'B'; $i++)
		{
			$objPHPExcel->getActiveSheet()->getStyle($i . '2')->getFont()->setBold(true);		// 加粗
		}

		//获取查询参数
		//创建NationService实例
		$nationService = new NationService();

		$nationArray = $nationService->QueryPrintNationInfo();
		for($i=0;$i<count($nationArray);$i++) {
			$objPHPExcel->getActiveSheet()->getRowDimension($i+3)->setRowHeight(20);
			$nation = $nationArray[$i];
			$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+3), $nation['nationId']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($i+3), $nation['nationName']);
		}
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('民族信息信息记录');

		//保存到服务器
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//$FileName=iconv('utf-8','gbk','PHP导出Excel.xls');
		//$objWriter->save($FileName); 

		//选中保存路径
		$outputFileName = iconv('UTF-8','gb2312','民族信息记录.xls');
		ob_end_clean();//清除缓冲区,避免乱码 
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename='.$outputFileName); 
		header('Cache-Control: max-age=0'); 

		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
		$objWriter->save('php://output'); 
	} else if($action == "update") {
		//说明用户希望执行更新民族信息信息
		$array_nation = $_POST["nation"];
		$nation = $nationService->GetNation($array_nation['nationId']);
		$nation->setNationId($array_nation['nationId']);
		$nation->setNationName($array_nation['nationName']);
		//完成修改->数据库
		$res = $nationService->UpdateNation($nation);
		if($res != 0) {
			header("Location: /ok.php");
			exit();
		} else {
			//失败
			header("Location: /error.php");
			exit();
		}
	} else if($action == "del") {
		//这时我们知道要删除民族信息信息
		$nationId = $_GET['nationId'];
		if($nationService->DeleteNation($nationId) == 1) {
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
