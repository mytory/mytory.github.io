---
title: '[java] 디렉토리 있는지 확인하고 없으면 만드는 메서드'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/286
aktt_notify_twitter:
  - yes
daumview_id:
  - 37074939
categories:
  - 서버단
tags:
  - JAVA
---
간단한 거지만&#8230;

<pre class="brush:java">//log4j 사용한다고 가정함.
public void directoryConfirmAndMake(targetDir){
        File d = new File(targetDir);
        if (log.isDebugEnabled()) log.debug("디렉토리가 있는지 : " + d.isDirectory());

        if(!d.isDirectory()){
        	if (log.isDebugEnabled()) log.info("디렉토리가 없어서 만듭니다.");
        	if(!d.mkdirs()){
        		if (log.isDebugEnabled()) log.error("디렉토리 생성 실패. 퍼미션을 확인해야 할 거 같은데...");
        	}
        }
}
</pre>

메서드로 만들어 놓고 사용하면 편할 것.