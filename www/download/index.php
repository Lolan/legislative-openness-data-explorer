<?php
/**
* Download page
*/

$page = 'download';

require("../../inc/common.php");

//read download.md
include('../../inc/Parsedown.php');
$mdurl = TEXT_URL . lang($page) . "/download/download.md";
$contents = file_get_contents($mdurl);
$Parsedown = new Parsedown();
$smarty->assign('mid_text',$Parsedown->text($contents));

$smarty->display($page . '.tpl');

?>
