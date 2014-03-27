<?
	$subject="abc [001] ,def [002] ,good [003] ";
    $patterns[0] = "/\[001\]/";
    $patterns[1] = "/\[002\]/";
    $patterns[2] = "/\[003\]/";    
    $replacements[0] = "<001>";
    $replacements[1] = "<002>";
    $replacements[2] = "<003>";
    ksort($patterns);
    ksort($replacements);
	print preg_replace($patterns, $replacements, $subject);
<html>
	<img alt="替换文本" src="图片路径"/>;
</html>
?>