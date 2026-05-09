<?php
// Script to fix double move_uploaded_file issues in cthpgv.php
$file = file_get_contents('cthpgv.php');

// Pattern 1: Remove the first move_uploaded_file for plain text/octet-stream
// Find and replace the pattern where $a=$_FILES['f']['tmp_name']; $b='file/'... move_uploaded_file($a,$b);
// followed by $filePath = 'file/'...
// This should become: $filePath = $_FILES['f']['tmp_name'];

$pattern1 = '/elseif\(\$t=\'application\/octet-stream\'\|\|\$t=\'text\/plain\'\)\{[\s\S]*?\$a=\$_FILES\[\'f\'\]\[\'tmp_name\'\];[\s\S]*?\$b=\'file\/\'\.\$_FILES\[\'f\'\]\[\'name\'\];[\s\S]*?move_uploaded_file\(\$a,\$b\);[\s\S]*?\$filePath = \'file\/\'\.\$_FILES\[\'f\'\]\[\'name\'\];/';

// This is too complex for regex. Let's do string replacement instead.

// Find the problematic sections and replace them
$fixes = array(
    // For octet-stream section - remove the initial move and change filePath to tmp
    'elseif($t=\'application/octet-stream\'||$t=\'text/plain\'){
	$a=$_FILES[\'f\'][\'tmp_name\'];
	$b=\'file/\'.$_FILES[\'f\'][\'name\'];
	move_uploaded_file($a,$b);
	$filePath = \'file/\'.$_FILES[\'f\'][\'name\'];' => 'elseif($t==\'application/octet-stream\'||$t==\'text/plain\'){
	$filePath = $_FILES[\'f\'][\'tmp_name\'];',
);

foreach ($fixes as $search => $replace) {
    if (strpos($file, $search) !== false) {
        $file = str_replace($search, $replace, $file);
        echo "Fixed: " . substr($search, 0, 50) . "...\n";
    }
}

// Also fix the comparison operators from = to ==
$file = str_replace('elseif($t=\'application/octet-stream\'', 'elseif($t==\'application/octet-stream\'', $file);
$file = str_replace('elseif($t=\'text/plain\'', 'elseif($t==\'text/plain\'', $file);

file_put_contents('cthpgv.php', $file);
echo "File fixed successfully!\n";
?>