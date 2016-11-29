<?php
/*映射民族信息数据库表:t_Nation*/
class Nation {
	/*民族编号*/
	private $nationId;
	public function setNationId($nationId) {
		$this->nationId = $nationId;
	}
	public function getnationId() {
		return $this->nationId;
	}
	/*民族名称*/
	private $nationName;
	public function setNationName($nationName) {
		$this->nationName = $nationName;
	}
	public function getnationName() {
		return $this->nationName;
	}
}
?>
