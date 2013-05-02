<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            textarea {
                width:100%;
                height:800px}
        </style>
        <script type="text/javascript">
            function selectAll() {
                document.getElementById("inputArea").focus();
                document.getElementById("inputArea").select();
            }
        </script>

    </head>

    <body onLoad="selectAll();">
        <textarea id="inputArea" name="inputText" ><?php
$inputTextArray = textToArray($_POST['inputText']);
$prevLine = '';
$last = '';

foreach ($inputTextArray as $line) {
    $line = trim($line);

    if ($line == '')
        continue;
    elseif (strstr($line, '接受') && strstr($line, '拒绝'))
        continue;
    elseif (strstr($line, '你们拥有'))
        continue;
    elseif (strstr($line, '我是') && strstr($line, '想加') && strstr($line, '为好友'))
        continue;

    if (strstr($line, ' (') && strstr($line, ')')) {
        if ($prevLine != '') {
            echo $prevLine . "\n";
        }
        $prevLine = $line;
    } else {
        $line = $prevLine . ' “' . $line . "”";
        echo $line . "\n";
        $prevLine = '';
    }

    $last = $line;
}
echo $last;

function textToArray($inputText) {
    #$inputTextReplace = preg_replace('/\r\n|\n\r/', '*nl*',$inputText); // Alternative method
    #$inputTextArray = explode('*nl*', $inputTextReplace); // Alternative method
    $inputTextReplaced = str_replace(chr(13) . chr(10), chr(10), $inputText);
    $inputTextReplaced = str_replace(chr(13), chr(10), $inputText);
    $inputTextArray = explode(chr(10), $inputTextReplaced);
    return $inputTextArray;
}
?></textarea>
    </body>
</html>