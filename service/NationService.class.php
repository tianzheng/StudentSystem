<?php
require_once '../database/SqlHelper.class.php';
require_once '../phpbean/Nation.class.php';

/*民族信息管理业务层类*/
class NationService {
	/*添加民族信息*/
	function AddNation(Nation $nation) {
		$nation_nationName = $nation->getNationName();

		// 构建sql语句
		$sql = "insert into t_Nation(nationName) values ('$nation_nationName')";
		//调用数据层执行添加
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}

	/*更新民族信息信息*/
	function UpdateNation(Nation $nation) {
		$nation_nationId = $nation->getNationId();
		$nation_nationName = $nation->getNationName();
		$sql = "update t_Nation set ";
		$sql = $sql."nationName='$nation_nationName'";
		$sql = $sql." where nationId=$nation_nationId";
		//调用数据层执行更新操作
		$sqlHelper = new SqlHelper (); 
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}

	// 根据民族编号获取民族信息
	function GetNation($nationId) {
		$sql = "select * from t_Nation where nationId=$nationId";
		$sqlHelper = new SqlHelper ();
		$arr = $sqlHelper->execute_dql2 ( $sql );
		$sqlHelper->close_connect ();
		// 二次封装,$arr=>Nation对象实例
		$nation = new Nation();
		if(count($arr)>0) {
			$nation->setNationId($arr [0] ['nationId']);
			$nation->setNationName($arr [0] ['nationName']);
		}
		return $nation;
	}

	function QueryPrintNationInfo() {
		// 创建一个SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		$sql = "select * from t_Nation where 1=1";
		$condition = "";
		$sql = $sql.$condition;
		$nationArray = $sqlHelper->execute_dql2($sql);
		$sqlHelper->close_connect();
		return $nationArray;
	}

	/*用封装的方式完成分页查询*/
	function getFenyePage($fenyePage) {
		// 创建一个SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		//根据查询条件构造sql语句
		$sql1 = "select * from t_Nation where 1=1";
		$sql2 = "select count(nationId) from t_Nation where 1=1";
		$condition = "";
		$sql1 = $sql1.$condition." limit ". ($fenyePage->pageNow - 1) * $fenyePage->pageSize . "," . $fenyePage->pageSize;
		$sql2 = $sql2.$condition;
		//调用数据层执行查询操作
		$sqlHelper->execute_dql_fenye ( $sql1, $sql2, $fenyePage );
		$sqlHelper->close_connect ();
	}

	// 根据民族编号删除某个民族信息
	function DeleteNation($nationId) {
		$sql = "delete from t_Nation where nationId=$nationId";
		// 创建SqlHelper对象实例执行删除
		$sqlHelper = new SqlHelper ();
		return $sqlHelper->execute_dml ( $sql );
	}

	/*查询所有的民族信息*/
	function QueryAllNation() {
		$sql = "select nationId,nationName from t_Nation";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
}

?>
