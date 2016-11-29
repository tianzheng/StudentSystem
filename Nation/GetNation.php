<?php
require_once '../service/NationService.class.php';
require_once '../phpbean/Nation.class.php';
$nationId = $_GET['nationId'];
$nationService = new NationService();
$nation = $nationService->GetNation($nationId);

/*使用 JSON数据格式返回*/
header('Content-type: text/json;charset=utf-8');
echo "{nationId:".$nation->getNationId();
echo ",nationName:\"".$nation->getNationName()."\"";
echo "}"; 
?>
