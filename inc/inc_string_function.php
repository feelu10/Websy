<?php
include "link/inc_string_function_links.php";
if (isset($_GET['section'])){
    switch ($_GET['section']){
        case 'EmbeddedWords':
            include('EmbeddedWords.php');
            break;
        case 'SimilarNames':
            include('SimilarNames.php');
            break;
    }
}
?>
