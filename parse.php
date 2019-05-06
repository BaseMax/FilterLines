<?php
/**
*
* @Name : FilterLines/parse.php
* @Version : 1.0
* @Programmer : Max
* @Date : 2019-05-06
* @Released under : https://github.com/BaseMax/FilterLines/blob/master/LICENSE
* @Repository : https://github.com/BaseMax/FilterLines
*
**/
function mexplode($delimiters=null, $input="") {
	if($delimiters === null || count($delimiters) == 0) {
		$delimiters=array(" ");
	}
	$input = str_replace($delimiters, $delimiters[0], $input);
	return explode($delimiters[0], $input);
	// $items = explode($delimiters[0], $ready);
	// return $items;
}

function startsWith($haystack,$needle,$case=true) {
	if($case)
		return strpos($haystack, $needle, 0) === 0;
	return stripos($haystack, $needle, 0) === 0;
}

function endsWith($haystack,$needle,$case=true) {
	$expectedPosition = strlen($haystack) - strlen($needle);
	if($case)
		return strrpos($haystack, $needle, 0) === $expectedPosition;
	return strripos($haystack, $needle, 0) === $expectedPosition;
}

if(isset($_POST['srt'])) {
	header("Content-Type: text/plain");
	$srt=$_POST['srt'];
	$keep=$_POST['keep'];
	$lines=explode("\n", $srt);
	$output="";
	// file_put_contents("execute-".rand(1000,9999).".txt",$srt);
	foreach($lines as $line) {
		if($keep == "none") {
			// Keep
		}
		else if($keep == "number") {
			if(is_numeric($line[0])) {
				// Keep
			}
			else {
				continue;
			}
		}
		else if($keep == "space") {
			if(startsWith($line, " ") || startsWith($line, "\t")) {
				// Keep
			}
			else {
				continue;
			}
		}
		$output.=$line."\n";
		// $line=trim($line);
	}
	print $output;
}
else {
?>
<form action="" method="POST">
	<textarea cols="13" rows="20" name="srt"></textarea><br>
	<select name="keep">
		<option value="none">All</option>
		<option value="number">Number</option>
		<option value="space">Space</option>
	</select><br>
	<button>Check</button>
</form>
<?php
}
