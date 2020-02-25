<?php

/*
Plugin Name: REAL NORSE MYTHOLOGY SPELLINGS
Description: A plugin to help our foreign friends to spell the norse mythology words like the gods themselves intended.
Version: 1.0
Author: Dagny
Author URL:
Text Domain:
*/

//SECURITY
defined( 'ABSPATH' ) or die( 'Get outta my houseeee' );

add_filter('the_content', array('filterhook_fix_wordpress', 'fix_spelling'));
class filterhook_fix_wordpress {

function fix_spelling($content)
{
//DATABASE CONNECTION
    $conn = mysqli_connect('localhost', 'root', '123456', 'dbwordpressplugin');

//NOW THIS IS FOR CHECKING IF THE CONNECTION IS WORKING IF NOT RETURN ERROR
    if(!$conn) 
    {
        echo 'CONNECTION ERROR:' . mysqli_connect_error();
    }

//SELECT WHAT DATA YOU WANT AND SEND A QUERY
    $sql = 'SELECT english, icelandic FROM words';
    $result = mysqli_query($conn, $sql);

//THIS IS FOR GOING THROUGH THE DATABASE
    while($row =$result ->fetch_assoc())
    {
        $search[] = $row['english'];
        $replace[] = $row['icelandic'];
    }

//THE RETURN

    return str_replace($search, $replace, $content);
}
}



