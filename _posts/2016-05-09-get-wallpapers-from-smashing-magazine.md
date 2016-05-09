---
title: '스매싱 매거진 월간 바탕화면을 다운받는 PHP 스크립트'
layout: post
tags:
  - PHP
  - Tip
---

딱히 바탕화면 취향이 있지 않은 나는 스매싱 매거진의 월간 바탕화면을 사용한다. 해상도에 맞는 것을 전부 다운 받아서 5분 마다 돌게 해 놨다. 그런데 매달 이걸 다운받는 게 꽤 귀찮은 일이다. 그래서 다운받는 스크립트를 하나 PHP로 만들었다. 

코드의 원리는 그리 어렵지 않다. Tidy로 HTML을 정리한 다음, 정규식을 사용해서 설정한 해상도에 맞는 이미지 파일의 URL을 추출한 뒤, 다운로드한다.

해당 글의 URL이나, 해당 글의 HTML 파일을 옵션으로 넘기고, 다운받을 폴더를 옵션으로 설정하고, 받고 싶은 해상도를 옵션으로 설정하고, 달력을 포함할 것인지 포함하지 않을 것인지 옵션으로 설정한 뒤 실행하면 된다. 사실 그냥 실행해 보면 설명이 나온다.

아래가 코드다.

## 알아 둘 것

- Tidy 확장이 설치돼 있어야 한다. 
- `file_get_contents()`가 웹 페이지를 긁어 올 수 있게 설정돼 있어야 하고, 그렇지 않다면 스매싱 매거진의 해당 웹페이지 코드를 긁어서 파일을 하나 만들고 해당 파일의 경로를 URL 대신 넘겨 준다.
- 해상도 설정은 알파벳 x를 사용해서 한다(1920x1200). 
- 달력 포함이면 `cal`, 포함하지 않으려면 `nocal`을 인자값으로 넘기면 된다.


	<?php
	/**
	* Author: An, Hyeong-woo
	* Email: mytory@gmail.com
	* Blog: http://mytory.net
	* Description: See detail on help message. You can see by running this script without args.
	* Dependencies: Tidy extension.
	*/
	function cmd_echo($str){
		echo $str . PHP_EOL;
	}
	if($argc != 5){
		cmd_echo("SYNOPSIS:");
		cmd_echo("\tphp $argv[0] [url or filepath] [downlaod_folder] [resolution] [cal or nocal]");
		cmd_echo("EXAMPLE:");
		cmd_echo("\tphp $argv[0] https://www.smashingmagazine.com/2016/04/desktop-wallpaper-calendars-may-2016/ ~/Downloads/wallpaer/ 1920x1200 cal");
		cmd_echo("\t(You must use alphabet 'x' for resolution.)");
		cmd_echo("\tphp $argv[0] https://www.smashingmagazine.com/2016/04/desktop-wallpaper-calendars-may-2016/ ~/Downloads/wallpaer/ 1920x1200 nocal");
		cmd_echo("\t(If you specify nocal, download wallpaper without calender.)");
		exit(1);
	}
	$url = $argv[1];
	$download_folder = $argv[2];
	$resolution = str_replace('x', '×', $argv[3]);
	$cal_or_nocal = $argv[4];
	if(is_file('./smashing_test_html.html')){
		cmd_echo('Using test file ./smashing_test_html.html.');
		$html = file_get_contents('./smashing_test_html.html');
	} else {
		$html = file_get_contents($url);
	}
	if(!$html){
		cmd_echo("Is URL corrupted? Cannot open URL.");
		exit(1);
	}
	$tidy_config = array(
	'wrap' => 0,
	);
	// Tidy
	$tidy = new tidy;
	$tidy->parseString($html, $tidy_config, 'utf8');
	$tidy->cleanRepair();
	$html = (string) $tidy;
	$pattern = "/<a.* href=\"(?P<url>[^\"]+)\".*>(?P<resolution>{$resolution})<\/a>/";
	cmd_echo('regex pattern: ' . $pattern);
	preg_match_all($pattern, $html, $matches);
	$urls = $matches['url'];
	$resolutions = $matches['resolution'];
	// validate resolution
	foreach($resolutions as $i => $export_resolution){
		if($export_resolution != $resolution){
			cmd_echo("Item $i is not targeted resolution($export_resolution). So removed.");
			unset($resolutions[$i]);
			unset($urls[$i]);
		}
	}
	// cal or nocal
	foreach($urls as $i => $url){
		if(!strstr($url, "-{$cal_or_nocal}-")){
			unset($urls[$i]);
		}
	}
	// make download folder
	if(!is_dir($download_folder)){
		if(!mkdir($download_folder, 0777, true)){
			cmd_echo('Fail to make download folder. Check permission: ' . $download_folder);
			exit(1);
		}
	}
	// download wallpaper
	foreach($urls as $url){
		$filename = pathinfo($url, PATHINFO_BASENAME);
		$target_dir = realpath($download_folder);
		$filepath = $target_dir . DIRECTORY_SEPARATOR . $filename;
		$binary = file_get_contents($url);
		if($binary === false){
			cmd_echo($url . ' has not downloaded bacause error. Check url or network status.');
			continue;
		}
		if(false === file_put_contents($filepath, $binary)){
			cmd_echo($url . ' has not created bacause error. Check directory permission.');
			continue;
		}else{
			cmd_echo("$url downloaded.");
		}
	}
	cmd_echo('Finish.');


[gist에서 보기](https://gist.github.com/mytory/96ce1431faf54a2f60a1cd71e51a972f)