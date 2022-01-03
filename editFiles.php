<?php
$title = $_POST['name'];
$text = $_POST['content'];
$xml = simplexml_load_file('textFiles.xml');
$create = true;
foreach($xml->file as $file){
    if($file['id']==$title){
        $file = $text;
        $create = false;
        break;
    }
}
if($create){
    $temp = $xml->addChild('file', $text);
    $temp->addAttribute('id', $title);
}
$xml->asXml('textFiles.xml');
?>