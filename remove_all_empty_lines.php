<?php 

// COPY THIS FILE INTO THE DATABASE FOLDER, THEN:
// CALL ME: for f in *.txt ; do php remove_all_empty_lines.php "$f" ; done

$file = $argv[1];
$str = file_get_contents("$file");
$str = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $str);
file_put_contents("$file", "$str");

?>
