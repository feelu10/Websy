<?php
include "link/inc_control_structure_links.php";
if (isset($_GET['section'])){
	switch ($_GET['section']){
		case 'ForLoop':
			include('loops/Chinese_Zodiac_for_loop.php');
			break;
		case 'WhileLoop':
			include('loops/Chinese_Zodiac_while_loop.php');
			break;
		case 'forEachLoop':
			include('loops/Chinese_Zodiac_foreach_loop.php');
			break;
		case 'doWhileLoop':
			include('loops/Chinese_Zodiac_dowhile_loop.php');
			break;
		case 'nestedLoop':
			include('loops/Chinese_Zodiac_nested_loop.php');
			break;
	}
}
?>	