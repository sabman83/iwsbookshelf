<?php

$link = mysql_connect('weblab.cs.uml.edu/~skolman', 'skolman', 'sk26994');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);

?>