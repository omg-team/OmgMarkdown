<?php

include '../AbstractMdElement.php';
include '../MdList.php';
include '../MdParagraph.php';
include '../MdTitle.php';
include '../MdParser.php';

use OmgMarkdown\MdParser;

$text = file_get_contents('test.md');

$parser = MdParser::create($text);
$parser->parse();
echo $parser->render();