<?php
/**
* Front page
*/

$relative_path = "";
require($relative_path . 'settings.php');

include ($relative_path . "cache.php");

$page = 'front-page';


require($relative_path . "common.php");

//get countries
$parliaments = json_decode(file_get_contents(APP_PATH . "inc/parliaments.json"));
$selected_countries = selected_countries($parliaments);
//get categories
$categories = json_decode(file_get_contents(APP_PATH . "inc/categories.json"));
$categories_sorted = sort_categories($categories);

//read jumbo.md
include('Parsedown.php');
$mdurl = TEXT_URL . lang($page) . "/front-page/jumbo.md";
$contents = file_get_contents($mdurl);
$Parsedown = new Parsedown();

$smarty->assign('countries',json_encode($selected_countries));
$smarty->assign('categories',$categories_sorted);
$smarty->assign('jumbo_text',ltrim($Parsedown->text($contents),'<p>'));

$smarty->display($page . '.tpl');




function sort_categories($categories) {
    $out = [];
    foreach ($categories as $c) 
        $out[] = $c;
    usort($out, 'compare_weights');
    return $out;
}


?>
