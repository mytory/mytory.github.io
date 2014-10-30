<?php 
include_once 'functions-postcode.php';
header('Content-Type:text/html;charset=utf-8');
 
if(!empty($_GET['query'])){
	$result = get_post_code_xml_by_api($_GET['query']);	
	
	if ($result['error'] == false){
	    $xml = new SimpleXMLElement($result['content']);
	    if(count($xml->itemlist->item) == 0){
	    	echo '결과가 없습니다';
	    }else{
			print_postcode_table($xml);
	    }
	}
	else {
	    echo '에러 발생: ' . $result['content'];
	}
}else{
	echo '검색어를 입력하세요.';
}
?>

