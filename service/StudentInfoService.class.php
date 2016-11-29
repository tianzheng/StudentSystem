<?php
require_once '../database/SqlHelper.class.php';
require_once '../phpbean/StudentInfo.class.php';

/*学生信息管理业务层类*/
class StudentInfoService {
	/*添加学生信息*/
	function AddStudentInfo(StudentInfo $studentInfo) {
		$studentInfo_zkzh = $studentInfo->getZkzh();
		$studentInfo_name = $studentInfo->getName();
		$studentInfo_sex = $studentInfo->getSex();
		$studentInfo_kslb = $studentInfo->getKslb();
		$studentInfo_zzmm = $studentInfo->getZzmm();
		$studentInfo_nation = $studentInfo->getNation();
		$studentInfo_byxx = $studentInfo->getByxx();
		$studentInfo_hkszd = $studentInfo->getHkszd();
		$studentInfo_address = $studentInfo->getAddress();
		$studentInfo_telephone = $studentInfo->getTelephone();
		$studentInfo_zcxx = $studentInfo->getZcxx();
		$studentInfo_cardNumber = $studentInfo->getCardNumber();
		$studentInfo_xjh = $studentInfo->getXjh();
		$studentInfo_gysznj = $studentInfo->getGysznj();
		$studentInfo_gesznj = $studentInfo->getGesznj();
		$studentInfo_gssznj = $studentInfo->getGssznj();
		$studentInfo_memo = $studentInfo->getMemo();
		$studentInfo_photo = $studentInfo->getPhoto();

		// 构建sql语句
		$sql = "insert into t_StudentInfo(zkzh,name,sex,kslb,zzmm,nation,byxx,hkszd,address,telephone,zcxx,cardNumber,xjh,gysznj,gesznj,gssznj,memo,photo) values ('$studentInfo_zkzh','$studentInfo_name','$studentInfo_sex','$studentInfo_kslb','$studentInfo_zzmm',$studentInfo_nation,'$studentInfo_byxx','$studentInfo_hkszd','$studentInfo_address','$studentInfo_telephone','$studentInfo_zcxx','$studentInfo_cardNumber','$studentInfo_xjh','$studentInfo_gysznj','$studentInfo_gesznj','$studentInfo_gssznj','$studentInfo_memo','$studentInfo_photo')";
		//调用数据层执行添加
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}

	/*更新学生信息信息*/
	function UpdateStudentInfo(StudentInfo $studentInfo) {
		$studentInfo_zkzh = $studentInfo->getZkzh();
		$studentInfo_name = $studentInfo->getName();
		$studentInfo_sex = $studentInfo->getSex();
		$studentInfo_kslb = $studentInfo->getKslb();
		$studentInfo_zzmm = $studentInfo->getZzmm();
		$studentInfo_nation = $studentInfo->getNation();
		$studentInfo_byxx = $studentInfo->getByxx();
		$studentInfo_hkszd = $studentInfo->getHkszd();
		$studentInfo_address = $studentInfo->getAddress();
		$studentInfo_telephone = $studentInfo->getTelephone();
		$studentInfo_zcxx = $studentInfo->getZcxx();
		$studentInfo_cardNumber = $studentInfo->getCardNumber();
		$studentInfo_xjh = $studentInfo->getXjh();
		$studentInfo_gysznj = $studentInfo->getGysznj();
		$studentInfo_gesznj = $studentInfo->getGesznj();
		$studentInfo_gssznj = $studentInfo->getGssznj();
		$studentInfo_memo = $studentInfo->getMemo();
		$studentInfo_photo = $studentInfo->getPhoto();
		$sql = "update t_StudentInfo set ";
		$sql = $sql."name='$studentInfo_name'";
		$sql = $sql.",sex='$studentInfo_sex'";
		$sql = $sql.",kslb='$studentInfo_kslb'";
		$sql = $sql.",zzmm='$studentInfo_zzmm'";
		$sql = $sql.",nation=$studentInfo_nation";
		$sql = $sql.",byxx='$studentInfo_byxx'";
		$sql = $sql.",hkszd='$studentInfo_hkszd'";
		$sql = $sql.",address='$studentInfo_address'";
		$sql = $sql.",telephone='$studentInfo_telephone'";
		$sql = $sql.",zcxx='$studentInfo_zcxx'";
		$sql = $sql.",cardNumber='$studentInfo_cardNumber'";
		$sql = $sql.",xjh='$studentInfo_xjh'";
		$sql = $sql.",gysznj='$studentInfo_gysznj'";
		$sql = $sql.",gesznj='$studentInfo_gesznj'";
		$sql = $sql.",gssznj='$studentInfo_gssznj'";
		$sql = $sql.",memo='$studentInfo_memo'";
		$sql = $sql.",photo='$studentInfo_photo'";
		$sql = $sql." where zkzh='$studentInfo_zkzh'";
		//调用数据层执行更新操作
		$sqlHelper = new SqlHelper (); 
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}

	// 根据准考证号获取学生信息
	function GetStudentInfo($zkzh) {
		$sql = "select * from t_StudentInfo where zkzh='$zkzh'";
		$sqlHelper = new SqlHelper ();
		$arr = $sqlHelper->execute_dql2 ( $sql );
		$sqlHelper->close_connect ();
		// 二次封装,$arr=>StudentInfo对象实例
		$studentInfo = new StudentInfo();
		if(count($arr)>0) {
			$studentInfo->setZkzh($arr [0] ['zkzh']);
			$studentInfo->setName($arr [0] ['name']);
			$studentInfo->setSex($arr [0] ['sex']);
			$studentInfo->setKslb($arr [0] ['kslb']);
			$studentInfo->setZzmm($arr [0] ['zzmm']);
			$studentInfo->setNation($arr [0] ['nation']);
			$studentInfo->setByxx($arr [0] ['byxx']);
			$studentInfo->setHkszd($arr [0] ['hkszd']);
			$studentInfo->setAddress($arr [0] ['address']);
			$studentInfo->setTelephone($arr [0] ['telephone']);
			$studentInfo->setZcxx($arr [0] ['zcxx']);
			$studentInfo->setCardNumber($arr [0] ['cardNumber']);
			$studentInfo->setXjh($arr [0] ['xjh']);
			$studentInfo->setGysznj($arr [0] ['gysznj']);
			$studentInfo->setGesznj($arr [0] ['gesznj']);
			$studentInfo->setGssznj($arr [0] ['gssznj']);
			$studentInfo->setMemo($arr [0] ['memo']);
			$studentInfo->setPhoto($arr [0] ['photo']);
		}
		return $studentInfo;
	}

	function QueryPrintStudentInfoInfo($zkzh,$name,$kslb,$nation,$byxx,$hkszd,$address,$telephone,$cardNumber,$xjh) {
		// 创建一个SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		$sql = "select * from t_StudentInfo where 1=1";
		$condition = "";
		if($zkzh != "") $condition = $condition." and zkzh like '%$zkzh%'";
		if($name != "") $condition = $condition." and name like '%$name%'";
		if($kslb != "") $condition = $condition." and kslb like '%$kslb%'";
		if($nation != "") $condition = $condition." and nation=$nation";
		if($byxx != "") $condition = $condition." and byxx like '%$byxx%'";
		if($hkszd != "") $condition = $condition." and hkszd like '%$hkszd%'";
		if($address != "") $condition = $condition." and address like '%$address%'";
		if($telephone != "") $condition = $condition." and telephone like '%$telephone%'";
		if($cardNumber != "") $condition = $condition." and cardNumber like '%$cardNumber%'";
		if($xjh != "") $condition = $condition." and xjh like '%$xjh%'";
		$sql = $sql.$condition;
		$studentInfoArray = $sqlHelper->execute_dql2($sql);
		$sqlHelper->close_connect();
		return $studentInfoArray;
	}

	/*用封装的方式完成分页查询*/
	function getFenyePage($fenyePage,$zkzh,$name,$kslb,$nation,$byxx,$hkszd,$address,$telephone,$cardNumber,$xjh) {
		// 创建一个SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		//根据查询条件构造sql语句
		$sql1 = "select * from t_StudentInfo where 1=1";
		$sql2 = "select count(zkzh) from t_StudentInfo where 1=1";
		$condition = "";
		if($zkzh != "") $condition = $condition." and zkzh like '%$zkzh%'";
		if($name != "") $condition = $condition." and name like '%$name%'";
		if($kslb != "") $condition = $condition." and kslb like '%$kslb%'";
		if($nation != "") $condition = $condition." and nation=$nation";
		if($byxx != "") $condition = $condition." and byxx like '%$byxx%'";
		if($hkszd != "") $condition = $condition." and hkszd like '%$hkszd%'";
		if($address != "") $condition = $condition." and address like '%$address%'";
		if($telephone != "") $condition = $condition." and telephone like '%$telephone%'";
		if($cardNumber != "") $condition = $condition." and cardNumber like '%$cardNumber%'";
		if($xjh != "") $condition = $condition." and xjh like '%$xjh%'";
		$sql1 = $sql1.$condition." limit ". ($fenyePage->pageNow - 1) * $fenyePage->pageSize . "," . $fenyePage->pageSize;
		$sql2 = $sql2.$condition;
		//调用数据层执行查询操作
		$sqlHelper->execute_dql_fenye ( $sql1, $sql2, $fenyePage );
		$sqlHelper->close_connect ();
	}

	// 根据准考证号删除某个学生信息
	function DeleteStudentInfo($zkzh) {
		$sql = "delete from t_StudentInfo where zkzh='$zkzh'";
		// 创建SqlHelper对象实例执行删除
		$sqlHelper = new SqlHelper ();
		return $sqlHelper->execute_dml ( $sql );
	}

	/*查询所有的学生信息*/
	function QueryAllStudentInfo() {
		$sql = "select zkzh,name from t_StudentInfo";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
}

?>
