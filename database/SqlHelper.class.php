<?php
 
	//这是一个工具类，作用是完成对数据库的操作
	class SqlHelper {
		
		public $conn;
		public $dbname="studentdb";
		public $username="root";
		public $password="123456";
		public $host="localhost";

		public function __construct() {
			$this->conn = mysqli_connect($this->host,$this->username,$this->password);
			if(!$this->conn) {
				die("链接失败!".mysqli_error());
			}
			//设置数据库的编码
			mysqli_query($this->conn,"set names utf8") or die (mysqli_errno());
			//选择数据库
			mysqli_select_db($this->conn,$this->dbname);
		}

		//执行dql语句
		public function execute_dql($sql) {
			$res = mysqli_query($this->conn,$sql) or die(mysqli_error());
			return $res;

		}

		//执行dql语句 返回的是一个数组
		public function execute_dql2($sql) {
			$arr = array();
			$res = mysqli_query($this->conn,$sql) or die(mysqli_error());
			///$i=0;
			//把$res=>$arr(结果集内容转移到数组中)
			while($row=mysqli_fetch_assoc($res)) {
				//$arr[$i++] = $row;
				$arr[] = $row;
			}
			//这里就可以马上把$res关闭
			mysqli_free_result($res);
			return $arr;
		}

		//考虑分页情况的查询,这是一个通用的并体现oop编程思想的
		//$sql1 = "select * from 表名 limit 0,6";
		//$sql2 = "select count(id) from 表名"
		public function execute_dql_fenye($sql1,$sql2,$fenyePage) {
			//这里我们查询了要分页显示的数据
			$res = mysqli_query($this->conn,$sql1) or die(mysqli_error());
			//$res => arrary()
			$arr = array();
			//把$res转移到$arr
			while($row = mysqli_fetch_assoc($res)) {
				$arr[] = $row;
			}

			mysqli_free_result($res);

			$res2 = mysqli_query($this->conn,$sql2) or die(mysqli_error());

			if($row = mysqli_fetch_row($res2)) {
				$fenyePage->pageCount = ceil($row[0]/$fenyePage->pageSize);
				$fenyePage->rowCount = $row[0];
			}
			mysqli_free_result($res2);

			//把导航信息也封装到fenyePage对象中

			$navigate = "";
			if($fenyePage->pageNow>1){
				$prePage=$fenyePage->pageNow-1;
				$navigate = "<a href='{$fenyePage->gotoUrl}?action=query&pageNow=$prePage'>上一页</a>&nbsp";
			}
			if($fenyePage->pageNow<$fenyePage->pageCount){
				$nextPage=$fenyePage->pageNow+1;
				$navigate.="<a href='{$fenyePage->gotoUrl}?action=query&pageNow=$nextPage'>下一页</a>&nbsp";
			}



			$start=floor(($fenyePage->pageNow-1)/$fenyePage->pageStep)*$fenyePage->pageStep+1;
			$index = $start;
			//整体每$fenyePage->pageStep页翻向前翻动
			//如果当前pageNow在1-$fenyePage->pageStep页数，就没有向前翻动的超链接
			if($fenyePage->pageNow>$fenyePage->pageStep)
				//$navigate.="&nbsp;<a href='{$fenyePage->gotoUrl}?action=query&pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
				$navigate.="&nbsp;<a href='#' onclick='GoToPage($start-1)'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
			//定start  1---->10  floor(pageNow-1)/10 + 1 = 1  11--->20 floor(pageNow-1)/10 * 10 + 1 =11;
			for(;$start<$index+$fenyePage->pageStep;$start++) {
				if($start > $fenyePage->pageCount ) break;
				//$navigate.="<a href='{$fenyePage->gotoUrl}?action=query&pageNow=$start'>[$start]</a>";
				$navigate.="<a href='#' onclick='GoToPage($start)'>[$start]</a>";
			}


			if($fenyePage->pageCount > $fenyePage->pageStep) {
				//整体每10页翻向后翻动
				//$navigate.="&nbsp;<a href='{$fenyePage->gotoUrl}?action=query&pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
				$navigate.="&nbsp;<a href='#' onclick='GoToPage($start)'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
			}
			//显示当前多少页
			$navigate.="当前{$fenyePage->pageNow}页/共{$fenyePage->pageCount}页";

			//把$arr赋给$fenyePage
			$fenyePage-> res_array = $arr;
			$fenyePage->navigate = $navigate;

		}
		//执行dml语句
		public function execute_dml($sql) {
			$b = mysqli_query($this->conn,$sql) or die(mysqli_error());
			if(!$b) {
				return 0;
			} else {
				if(mysqli_affected_rows($this->conn)>0) {
					return 1;  //表示执行ok
				} else {
					return 2;  //表示没有行收到影响
				}
			}
		}


		//关闭链接
		public function close_connect() {
			if(!empty($this->conn)) {
				mysqli_close($this->conn);
			}
		}
		
		
	}

?>