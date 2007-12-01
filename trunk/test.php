<?php
// format MySQL DateTime (YYYY-MM-DD hh:mm:ss) using date()
function datetime($datetime) {
    $year = substr($datetime,0,4);
    $month = substr($datetime,5,2);
    $day = substr($datetime,8,2);
    
    return date("M j Y",mktime(0,0,0,$month,$day,$year));
}

print datetime('2000-01-01');
?>