<?php
header("content-type: image/svg+xml");
$svg_xml = file_get_contents('has-viewbox.svg');
$svg_xml = str_replace('viewBox="0 0 84 84"', '', $svg_xml);
echo $svg_xml;