---
title: '[링크]javascript Object 값 출력'
author: 안형우
layout: post
permalink: /archives/390
aktt_notify_twitter:
  - yes
daumview_id:
  - 37011395
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<a target="_blank" href="http://bluebreeze.co.kr/398">http://bluebreeze.co.kr/398</a>  
소스다. 링크 붙여 놓고&#8230; 어디선가 퍼 오신 거라 했으니 소스 퍼와도 양해해 주실 거라 생각한다.  
<a target="_blank" href="http://bluebreeze.co.kr/398"> </a>

<div>
  <pre class="brush:js">
dump: function(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0; j &lt; level+1; j++) level_padding += "    ";
	
	if(typeof(arr) == &#039;object&#039;) { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == &#039;object&#039;) { //If it is an array,
				dumped_text += level_padding + "&#039;" + item + "&#039; ...\n";
				dumped_text += this.dump(value,level+1);
			} else {
				dumped_text += level_padding + "&#039;" + item + "&#039; =&gt; \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===&gt;"+arr+"&lt;===("+typeof(arr)+")";
	}
	return dumped_text;
}
</pre>
  
  <p>
    </div>