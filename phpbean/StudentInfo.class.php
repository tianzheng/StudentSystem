<?php
/*映射学生信息数据库表:t_StudentInfo*/
class StudentInfo {
	/*准考证号*/
	private $zkzh;
	public function setZkzh($zkzh) {
		$this->zkzh = $zkzh;
	}
	public function getzkzh() {
		return $this->zkzh;
	}
	/*姓名*/
	private $name;
	public function setName($name) {
		$this->name = $name;
	}
	public function getname() {
		return $this->name;
	}
	/*性别*/
	private $sex;
	public function setSex($sex) {
		$this->sex = $sex;
	}
	public function getsex() {
		return $this->sex;
	}
	/*考生类别*/
	private $kslb;
	public function setKslb($kslb) {
		$this->kslb = $kslb;
	}
	public function getkslb() {
		return $this->kslb;
	}
	/*政治面貌*/
	private $zzmm;
	public function setZzmm($zzmm) {
		$this->zzmm = $zzmm;
	}
	public function getzzmm() {
		return $this->zzmm;
	}
	/*民族*/
	private $nation;
	public function setNation($nation) {
		$this->nation = $nation;
	}
	public function getnation() {
		return $this->nation;
	}
	/*毕业学校*/
	private $byxx;
	public function setByxx($byxx) {
		$this->byxx = $byxx;
	}
	public function getbyxx() {
		return $this->byxx;
	}
	/*户口所在地*/
	private $hkszd;
	public function setHkszd($hkszd) {
		$this->hkszd = $hkszd;
	}
	public function gethkszd() {
		return $this->hkszd;
	}
	/*家庭地址*/
	private $address;
	public function setAddress($address) {
		$this->address = $address;
	}
	public function getaddress() {
		return $this->address;
	}
	/*联系电话*/
	private $telephone;
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}
	public function gettelephone() {
		return $this->telephone;
	}
	/*注册性质*/
	private $zcxx;
	public function setZcxx($zcxx) {
		$this->zcxx = $zcxx;
	}
	public function getzcxx() {
		return $this->zcxx;
	}
	/*身份证号*/
	private $cardNumber;
	public function setCardNumber($cardNumber) {
		$this->cardNumber = $cardNumber;
	}
	public function getcardNumber() {
		return $this->cardNumber;
	}
	/*学籍号*/
	private $xjh;
	public function setXjh($xjh) {
		$this->xjh = $xjh;
	}
	public function getxjh() {
		return $this->xjh;
	}
	/*高一所在年级*/
	private $gysznj;
	public function setGysznj($gysznj) {
		$this->gysznj = $gysznj;
	}
	public function getgysznj() {
		return $this->gysznj;
	}
	/*高二所在年级*/
	private $gesznj;
	public function setGesznj($gesznj) {
		$this->gesznj = $gesznj;
	}
	public function getgesznj() {
		return $this->gesznj;
	}
	/*高三所在年级*/
	private $gssznj;
	public function setGssznj($gssznj) {
		$this->gssznj = $gssznj;
	}
	public function getgssznj() {
		return $this->gssznj;
	}
	/*备注信息*/
	private $memo;
	public function setMemo($memo) {
		$this->memo = $memo;
	}
	public function getmemo() {
		return $this->memo;
	}
	/*个人照片*/
	private $photo;
	public function setPhoto($photo) {
		$this->photo = $photo;
	}
	public function getphoto() {
		return $this->photo;
	}
}
?>
