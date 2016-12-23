---
title: '[PHP] RSS 긁어오기 라이브러리 &#8211; lastRSS'
author: 안형우
layout: post
permalink: /archives/237
aktt_notify_twitter:
  - no
daumview_id:
  - 37118484
mytory_md_path:
  - 
categories:
  - 서버단
tags:
  - PHP
---
[2012-07-16 알림 : 지금 RSS 라이브러리에서 대세는 [SimplePie][1]라고 한다. 나도 앞으론 [SimplePie][1]를 사용할 생각이다.]

제휴사라든지 다른 정보 같은 것을 자신의 홈페이지에 보여 주기 위해서 RSS를 사용할 수 있다. 예컨대, 언론사 RSS를 바탕으로, 자신의 웹사이트에 해당 언론의 최신 기사를 노출할 수 있다. 자동으로.

이 라이브러리는 &#8216;PHP RSS 리더&#8217;라는 글에서 발견했고, 사용법 간단해서 좋다. lastRSS라는 라이브러리에 한글 설명을 단 게 아래 소스다. 한글 설명은 저 글의 필자가 단 것이다.

lastRSS 원본 사이트에서 직접 원본 파일과 예제 등을 볼 수 있다. [2012-07-16 지금 원본 사이트가 일시적으로 맛이 간 듯하다.]

## 소스

원본 사이트가 날아가서 소스도 언제 날아갈지 모르니까, 퍼왔다. GPL 라이센스니까 괜찮다.

<pre class="brush: php; gutter: true; first-line: 1; highlight: []; html-script: false">/* 
 ====================================================================== 
 lastRSS 0.9.1 

 Simple yet powerfull PHP class to parse RSS files. 

 by Vojtech Semecky, webmaster @ oslab . net 

 Latest version, features, manual and examples: 

http://lastrss.oslab.net/

 ---------------------------------------------------------------------- 
 LICENSE 

 This program is free software; you can redistribute it and/or 
 modify it under the terms of the GNU General Public License (GPL) 
 as published by the Free Software Foundation; either version 2 
 of the License, or (at your option) any later version. 

 This program is distributed in the hope that it will be useful, 
 but WITHOUT ANY WARRANTY; without even the implied warranty of 
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
 GNU General Public License for more details. 

 To read the license please visit http://www.gnu.org/copyleft/gpl.html 
 ====================================================================== 
*/ 

/** 
* lastRSS 
* Simple yet powerfull PHP class to parse RSS files. 
*/ 
class lastRSS { 
    // ------------------------------------------------------------------- 
    // Public properties 
    // ------------------------------------------------------------------- 
    var $default_cp = 'UTF-8'; 
    var $CDATA = 'nochange'; 
    var $cp = ''; 
    var $items_limit = 0; 
    var $stripHTML = False; 
    var $date_format = ''; 

    // ------------------------------------------------------------------- 
    // Private variables 
    // ------------------------------------------------------------------- 
    var $channeltags = array ('title', 'link', 'description', 'language', 'copyright', 'managingEditor', 'webMaster', 'lastBuildDate', 'rating', 'docs'); 
    var $itemtags = array('title', 'link', 'description', 'author', 'category', 'comments', 'enclosure', 'guid', 'pubDate', 'source'); 
    var $imagetags = array('title', 'url', 'link', 'width', 'height'); 
    var $textinputtags = array('title', 'description', 'name', 'link'); 

    // ------------------------------------------------------------------- 
    // Parse RSS file and returns associative array. 
    // ------------------------------------------------------------------- 
    function Get ($rss_url) { 
        // If CACHE ENABLED 
        if ($this-&gt;cache_dir != '') { 
            $cache_file = $this-&gt;cache_dir . '/rsscache_' . md5($rss_url); 
            $timedif = @(time() - filemtime($cache_file)); 
            if ($timedif &lt; $this-&gt;cache_time) { 
                // cached file is fresh enough, return cached array 
                $result = unserialize(join('', file($cache_file))); 
                // set 'cached' to 1 only if cached file is correct 
                if ($result) $result['cached'] = 1; 
            } else { 
                // cached file is too old, create new 
                $result = $this-&gt;Parse($rss_url); 
                $serialized = serialize($result); 
                if ($f = @fopen($cache_file, 'w')) { 
                    fwrite ($f, $serialized, strlen($serialized)); 
                    fclose($f); 
                } 
                if ($result) $result['cached'] = 0; 
            } 
        } 
        // If CACHE DISABLED &gt;&gt; load and parse the file directly 
        else { 
            $result = $this-&gt;Parse($rss_url); 
            if ($result) $result['cached'] = 0; 
        } 
        // return result 
        return $result; 
    } 

    // ------------------------------------------------------------------- 
    // Modification of preg_match(); return trimed field with index 1 
    // from 'classic' preg_match() array output 
    // ------------------------------------------------------------------- 
    function my_preg_match ($pattern, $subject) { 
        // start regullar expression 
        preg_match($pattern, $subject, $out); 

        // if there is some result... process it and return it 
        if(isset($out[1])) { 
            // Process CDATA (if present) 
            if ($this-&gt;CDATA == 'content') { // Get CDATA content (without CDATA tag) 
                $out[1] = strtr($out[1], array('&lt;![CDATA['=&gt;'', ']]&gt;'=&gt;'')); 
            } elseif ($this-&gt;CDATA == 'strip') { // Strip CDATA 
                $out[1] = strtr($out[1], array('&lt;![CDATA['=&gt;'', ']]&gt;'=&gt;'')); 
            } 

            // If code page is set convert character encoding to required 
            if ($this-&gt;cp != '') 
                //$out[1] = $this-&gt;MyConvertEncoding($this-&gt;rsscp, $this-&gt;cp, $out[1]); 
                $out[1] = iconv($this-&gt;rsscp, $this-&gt;cp.'//TRANSLIT', $out[1]); 
            // Return result 
            return trim($out[1]); 
        } else { 
        // if there is NO result, return empty string 
            return ''; 
        } 
    } 

    // ------------------------------------------------------------------- 
    // Replace HTML entities &something; by real characters 
    // ------------------------------------------------------------------- 
    function unhtmlentities ($string) { 
        // Get HTML entities table 
        $trans_tbl = get_html_translation_table (HTML_ENTITIES, ENT_QUOTES); 
        // Flip keys&lt;==&gt;values 
        $trans_tbl = array_flip ($trans_tbl); 
        // Add support for &apos; entity (missing in HTML_ENTITIES) 
        $trans_tbl += array('&apos;' =&gt; "'"); 
        // Replace entities by values 
        return strtr ($string, $trans_tbl); 
    } 

    // ------------------------------------------------------------------- 
    // Parse() is private method used by Get() to load and parse RSS file. 
    // Don't use Parse() in your scripts - use Get($rss_file) instead. 
    // ------------------------------------------------------------------- 
    function Parse ($rss_url) { 
        // Open and load RSS file 
        if ($f = @fopen($rss_url, 'r')) { 
            $rss_content = ''; 
            while (!feof($f)) { 
                $rss_content .= fgets($f, 4096); 
            } 
            fclose($f); 

            // Parse document encoding 
            $result['encoding'] = $this-&gt;my_preg_match("'encoding=[\'\"](.*?)[\'\"]'si", $rss_content); 
            // if document codepage is specified, use it 
            if ($result['encoding'] != '') 
                { $this-&gt;rsscp = $result['encoding']; } // This is used in my_preg_match() 
            // otherwise use the default codepage 
            else 
                { $this-&gt;rsscp = $this-&gt;default_cp; } // This is used in my_preg_match() 

            // Parse CHANNEL info 
            preg_match("'&lt;channel.*?&gt;(.*?)&lt;/channel&gt;'si", $rss_content, $out_channel); 
            foreach($this-&gt;channeltags as $channeltag) 
            { 
                $temp = $this-&gt;my_preg_match("'&lt;$channeltag.*?&gt;(.*?)&lt;/$channeltag&gt;'si", $out_channel[1]); 
                if ($temp != '') $result[$channeltag] = $temp; // Set only if not empty 
            } 
            // If date_format is specified and lastBuildDate is valid 
            if ($this-&gt;date_format != '' && ($timestamp = strtotime($result['lastBuildDate'])) !==-1) { 
                        // convert lastBuildDate to specified date format 
                        $result['lastBuildDate'] = date($this-&gt;date_format, $timestamp); 
            } 

            // Parse TEXTINPUT info 
            preg_match("'&lt;textinput(|[^&gt;]*[^/])&gt;(.*?)&lt;/textinput&gt;'si", $rss_content, $out_textinfo); 
                // This a little strange regexp means: 
                // Look for tag &lt;textinput&gt; with or without any attributes, but skip truncated version &lt;textinput /&gt; (it's not beggining tag) 
            if (isset($out_textinfo[2])) { 
                foreach($this-&gt;textinputtags as $textinputtag) { 
                    $temp = $this-&gt;my_preg_match("'&lt;$textinputtag.*?&gt;(.*?)&lt;/$textinputtag&gt;'si", $out_textinfo[2]); 
                    if ($temp != '') $result['textinput_'.$textinputtag] = $temp; // Set only if not empty 
                } 
            } 
            // Parse IMAGE info 
            preg_match("'&lt;image.*?&gt;(.*?)&lt;/image&gt;'si", $rss_content, $out_imageinfo); 
            if (isset($out_imageinfo[1])) { 
                foreach($this-&gt;imagetags as $imagetag) { 
                    $temp = $this-&gt;my_preg_match("'&lt;$imagetag.*?&gt;(.*?)&lt;/$imagetag&gt;'si", $out_imageinfo[1]); 
                    if ($temp != '') $result['image_'.$imagetag] = $temp; // Set only if not empty 
                } 
            } 
            // Parse ITEMS 
            preg_match_all("'&lt;item(| .*?)&gt;(.*?)&lt;/item&gt;'si", $rss_content, $items); 
            $rss_items = $items[2]; 
            $i = 0; 
            $result['items'] = array(); // create array even if there are no items 
            foreach($rss_items as $rss_item) { 
                // If number of items is lower then limit: Parse one item 
                if ($i &lt; $this-&gt;items_limit || $this-&gt;items_limit == 0) { 
                    foreach($this-&gt;itemtags as $itemtag) { 
                        $temp = $this-&gt;my_preg_match("'&lt;$itemtag.*?&gt;(.*?)&lt;/$itemtag&gt;'si", $rss_item); 
                        if ($temp != '') $result['items'][$i][$itemtag] = $temp; // Set only if not empty 
                    } 
                    // Strip HTML tags and other bullshit from DESCRIPTION 
                    if ($this-&gt;stripHTML && $result['items'][$i]['description']) 
                        $result['items'][$i]['description'] = strip_tags($this-&gt;unhtmlentities(strip_tags($result['items'][$i]['description']))); 
                    // Strip HTML tags and other bullshit from TITLE 
                    if ($this-&gt;stripHTML && $result['items'][$i]['title']) 
                        $result['items'][$i]['title'] = strip_tags($this-&gt;unhtmlentities(strip_tags($result['items'][$i]['title']))); 
                    // If date_format is specified and pubDate is valid 
                    if ($this-&gt;date_format != '' && ($timestamp = strtotime($result['items'][$i]['pubDate'])) !==-1) { 
                        // convert pubDate to specified date format 
                        $result['items'][$i]['pubDate'] = date($this-&gt;date_format, $timestamp); 
                    } 
                    // Item counter 
                    $i++; 
                } 
            } 

            $result['items_count'] = $i; 
            return $result; 
        } 
        else // Error in opening return False 
        { 
            return False; 
        } 
    } 
}</pre>

 [1]: http://www.simplepie.org/