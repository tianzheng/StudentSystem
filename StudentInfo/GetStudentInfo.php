<?php
require_once '../service/StudentInfoService.class.php';
require_once '../phpbean/StudentInfo.class.php';
require_once '../service/NationService.class.php';
$nationService = new NationService();
$zkzh = $_GET['zkzh'];
$studentInfoService = new StudentInfoService();
$studentInfo = $studentInfoService->GetStudentInfo($zkzh);

/*使用 JSON数据格式返回*/
header('Content-type: text/json;charset=utf-8');
echo "{zkzh:\"".$studentInfo->getZkzh()."\"";
echo ",name:\"".$studentInfo->getName()."\"";
echo ",sex:\"".$studentInfo->getSex()."\"";
echo ",kslb:\"".$studentInfo->getKslb()."\"";
echo ",zzmm:\"".$studentInfo->getZzmm()."\"";
echo ",nation:\"".$nationService->GetNation($studentInfo->getNation())->getNationName()."\"";
echo ",byxx:\"".$studentInfo->getByxx()."\"";
echo ",hkszd:\"".$studentInfo->getHkszd()."\"";
echo ",address:\"".$studentInfo->getAddress()."\"";
echo ",telephone:\"".$studentInfo->getTelephone()."\"";
echo ",zcxx:\"".$studentInfo->getZcxx()."\"";
echo ",cardNumber:\"".$studentInfo->getCardNumber()."\"";
echo ",xjh:\"".$studentInfo->getXjh()."\"";
echo ",gysznj:\"".$studentInfo->getGysznj()."\"";
echo ",gesznj:\"".$studentInfo->getGesznj()."\"";
echo ",gssznj:\"".$studentInfo->getGssznj()."\"";
echo ",memo:\"".$studentInfo->getMemo()."\"";
echo ",photo:\"".$studentInfo->getPhoto()."\"";
echo "}"; 
?>
