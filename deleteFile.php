<?php
$title = $_POST['name'];

$xml = simplexml_load_file('textFiles.xml');

foreach($xml->file as $file){
    if($file['id']==$title){
        $node = dom_import_simplexml($file);
        $node->parentNode->removeChild($node);
    }
}
$xml->asXml('textFiles.xml');
?>