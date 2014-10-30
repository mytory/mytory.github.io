---
title: 자바 FileReader는 인코딩 설정을 할 수 없다
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/307
aktt_notify_twitter:
  - yes
daumview_id:
  - 37062914
categories:
  - 서버단
tags:
  - JAVA
---
웹에 텍스트 파일을 업로드하는 로직을 만들었는데, 리눅스에서는 제대로 올라가는데 윈도우에서는 제대로 올라가질 않았다.

FileReader가 운영체제의 기본 한글 인코딩을 기본으로 인식하기 때문이었다.(대략 말하면 그렇고, 구체적인 원리 설명은 &#8216;[JAVA도 인코딩때문에 꼬인다][1]&#8216;에서 볼 수 있다.)  
그래서 인코딩 설정을 할 수 있는 FileInputStream을 사용해야 한다.

나머지 내용은 아래 인용을 참고하라.

> xml파일을 읽어들여 데이터를 파싱하는 테스트코드에 문제가 있는 것을 발견했다. 한글 글자가 다 깨져서 저장이 되는 것이다.리눅스에서 쓸 때는 잘 되던게 맥오에스로 넘어오니 에러가 난다. 근 하루간의 삽질끝에 원인을 발견했다.
> 
> 문제가 된 xml파일을 읽을때 시스템의 인코딩으로 간주해서 읽었던 것이다. 파일 읽는 코드는 아래처럼 구현했었는데,
> 
> <pre class="brush:java">BufferedReader reader = new BufferedReader(new FileReader(filepath));</pre>
> 
> FIleReader클래스는 읽어들이는 파일의 인코딩을 무조건 file.encoding 으로 간주해 읽으려 했기 때문이었다. 아 쓰기 귀찮다.
> 
> 어쨌든 인터넷을 뒤져 아래와 같은 코드로 바꾸었다. 파일을 무조건 UTF-8문서로 간주해 읽기다.
> 
> <pre class="brush:java">BufferedReader reader = new BufferedReader(new InputStreamReader(new FileInputStream(filepath),"UTF8"));</pre>

 [1]: http://psg9.egloos.com/1131327