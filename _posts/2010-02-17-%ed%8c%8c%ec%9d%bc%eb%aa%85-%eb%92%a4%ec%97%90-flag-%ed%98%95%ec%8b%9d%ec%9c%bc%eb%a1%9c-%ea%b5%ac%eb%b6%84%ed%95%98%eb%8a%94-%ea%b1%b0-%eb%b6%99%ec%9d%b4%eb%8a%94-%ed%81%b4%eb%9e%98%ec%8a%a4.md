---
title: '[java]파일명 뒤에 -flag 형식으로 구분하는 거 붙이는 클래스'
author: 안형우
layout: post
permalink: /archives/284
aktt_notify_twitter:
  - yes
daumview_id:
  - 37078588
categories:
  - 서버단
tags:
  - JAVA
---
그림파일을 만들다 보면 fileName.jpg를 fileName-large.jpg, fileName-small.jpg 식으로 파일명을 수정해야 할 때가 있다.

금세 코드를 짤 수 있겠지만, 클래스를 보관해 두면 더 편할 것.

내가 만든 메서드 코드는 아래와 같다.

<pre class="brush:java">public String addFlagToFileName(String fileName, String flag) {
	String[] fileNameArray = fileName.split("\\.");
	// fileNameArray[fileNameArray.length-1] : 확장자
	// fileName.replace("."+fileNameArray[fileNameArray.length-1], "") :
	// 확장자를 제거한 파일명
	String modifiedFileName = fileName.replace("."
			+ fileNameArray[fileNameArray.length - 1], "")
			+ "-" + flag + "." + fileNameArray[fileNameArray.length - 1];
	return modifiedFileName;
}</pre>

실행 예시는 이렇다.

<pre class="brush:java">className.addFlagToFileName("myImage.jpg", "large");
//결과는 myImage-large.jpg</pre>