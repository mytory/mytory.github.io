---
title: '[번역] 구글 아날리틱스로 웹 성능 이상 탐지하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/8880
daumview_id:
  - 37928287
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
원문은 [&#8216;Web Performance Anomaly Detection with Google Analytics&#8217;][1]이다. 번역 시작이다.

&#8212;&#8212;

<img class="left alignleft" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/GA-detect-anomaly/ga-alert.png" width="208" height="129" />

첫째, 모든 것을 모니터링하라. 둘째, 데이터 분석, 통찰 얻기, **반복적으로** 측정치를 모니터링하고 최적화하는 데에 분석 시간과 자원의 90%를 집중하라. 그러나 한 가지 작은 문제가 있다. **기계가 생산해내는 대량의 데이터가 우리의 분석 능력, 모니터링 능력, 수치를 연관지어 해석하는 능력을 앞지르는 경우이다.**

바로 이 지점이 [이상 탐지 알고리즘][2]이 설 자리다. <a class="simple-footnote" title="anomaly detection algorithm &#8211; 찾아 보니까 이상 탐지, 비정상 탐지 등으로 번역돼 있더라. 공인된 번역어가 있는 것 같진 않았다." id="return-note-8880-1" href="#note-8880-1"><sup>1</sup></a> 이 알고리즘은 아주 유용한 데이터에 접근하는 훌륭한 통계 엔진으로 뒷받침된다. 이 엔진은 완벽할 필요는 없지만 일반적이지 않은 상황이 감지됐을 때 우리에게 알려줄 수 있어야 한다. 이미 들어온 알림이나, 메일함에 있는 알림을 바탕으로 우리는 조사가 필요한지 판단할 수 있다.

<div class="video-container">
  <div class="video-container__inner">
  </div>
</div>

## 구글 아날리틱스의 지능형 이벤트

좋은 소식이 있다. 당신이 구글 아날리틱스를 사용하고 있다면, 강력한 이상 탐지 엔진이 이미 있는 것이다. 바로 [지능형 이벤트][3]다. 무엇보다도, 이것은 기존 데이터, 설정된 세그먼트, 그리고 다른 커스터마이징한 것들을 모두 커버한다. 그리고 가격이 아주 딱이다. 공짜다.

> 아날리틱스는 의미있는 통계적 수치들을 감지하기 위해 웹사이트 트래픽을 모니터링한다. 그리고 신경써야 할 수치를 감지하면 자동으로 알림이나 지능형 이벤트를 생성한다. 이상 수치를 철저히 관찰함으로써, 그러지 않았다면 놓쳤을 만한 통찰을 얻을 수 있다. 예를 들면, 특정 도시나 사이트에서 갑자기 유입이 많아진다거나 한 경우 말이다.

사실, 조금 수고를 들이고 커스터마이징을 하면, **지능형 이벤트를 이용해 손쉽게 사이트 성능을 모니터링할 수 있다!** 인도에서 온 방문자의 페이지 로딩 시간이 이상하다? 문제를 감지할 수 있는 자동화된 툴이 있는 거다.

<p style="text-align: center;">
  <img class="center aligncenter" style="max-width: 691px; width: 100%;" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/GA-detect-anomaly/wplt-alert.png.pagespeed.ic.png" width="691" height="184" />
</p>

금상첨화로, 예시로 든 보고서를 보면 알겠지만, 알림이 왜 생성됐는지, 인도 첸나이에서 온 방문자와 연관지어 설명하고 있다는 점이다. 인도 첸나이에서 온 방문자들이 페이지 로딩 시간이 상당히 길었던 것으로 확인됐다. 이렇게 정보를 손에 쥠으로써, 우리는 근본 원인을 밝혀낼 수 있다.

## 웹 성능 이상 탐지

구글 아날리틱스는 [W3C 내비게이션 타이밍][4] API를 지원하는 브라우저의 경우 [페이지 로딩 시간 성능 데이터를 측정][5]한다. 이 API는 다음을 측정한다 : 리디렉트와 DNS 시간, TCP 확립, 서버 응답 시간, onload 시간 같은 DOM 레벨 측정치. 다양한 측정치가 있다. 각각의 측정치는 사용자가 실제로 사이트에 접속하는 데 걸린 시간을 기록한다. 다시 말해, 이것은 실사용자 측정(Real User Measurement (RUM))이다. 인공 데이터가 아니다.

[사이트 속도 보고서][6]에 익숙치 않으면, 배우기 좋은 곳이 있다. 상세히 알고 싶으면 [이 GDL 에피소드][7]를 봐라. <a class="simple-footnote" title="GDL &#8211; Google Developers Live" id="return-note-8880-2" href="#note-8880-2"><sup>2</sup></a> 근데, 우리는 한 단계 더 나갈 거다. **각각의 내이게이션 타이밍 측정치를 지능형 이벤트로 모니터링할 수 있다!** 맞춤 알림을 만들고, 이벤트를 발생시킬 기준점 정도만 설정해 주면 된다.

<img class="center" style="max-width: 638px; width: 100%;" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/GA-detect-anomaly/walert-segment.png.pagespeed.ic.png" width="638" height="275" />

우리 사이트 성능 알림을 위한 아이디어 :

*   전 세계 혹은 특정 지역의** DNS 해석 시간 추적**
*   모든 방문자, 혹은 각각 다른 버전의 사이트로 커스터마이징한 **서버 응답 시간 추적**
*   오작동하는 CSS, 스크립트나 다른 자원을 감지하는 **onload 시간 추적.**

## 파워팁 : 고급 세그먼트를 사용하라!

사이트 전체에 대해 특정 수치에 대한 알림을 설정하는 것은 좋은 시작이다. 그러나, 구글 아날리틱스에서 [고급 세그먼트][8]를 사용해 본 적이 없다면, 수박 겉핥기만 한 것이다. 아시아 모바일 방문자 혹은 특히 도쿄의 페이지 로딩 시간이나 DNS 시간을 모니터링할 필요가 있다면? 문제 없다. 새로운 고급 세그먼트를 만들기만 하면 된다.

<img class="center" style="max-width: 684px; width: 100%;" alt="" src="https://dl.dropbox.com/u/15546257/blog/mytory/GA-detect-anomaly/wmobile-asia-segment.png.pagespeed.ic.png" width="684" height="460" />

고급 세그먼트는, 한 번 만들기만 하면, 구글 아날리틱스의 어떤 보고서에든 적용할 수 있다. 지능형 알림에서도 사용하도록 설정할 수 있다! 특정 시장, 특정 사용자 유형, 특정 트래픽 같은 걸 관찰해야 한다고 해 보자. 맞춤 세그먼트를 만들면 알림을 그렇게 맞출 수 있다.

## 측정, 최적화, 반복

이상 탐지 엔진은 도구다. 그리고 강력한 도구다. **그러나 설정하는 건 우리들 자신의 책임이다. 자신의 사이트에 맞게 반복적으로 세그먼트와 알림 기준점을 개선해야 한다.** 쓸모 없는 알림도 많이 받게 될 거다. 그러나 데이터 모니터링의 급류 속에서는 절대 발견하지 못했을 문제도 건지게 될 것이다.

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>
  
  <ol>
    <li id="note-8880-1">
      anomaly detection algorithm &#8211; 찾아 보니까 이상 탐지, 비정상 탐지 등으로 번역돼 있더라. 공인된 번역어가 있는 것 같진 않았다. <a href="#return-note-8880-1">&#8617;</a>
    </li>
    <li id="note-8880-2">
      <a href="https://developers.google.com/live/">GDL &#8211; Google Developers Live</a> <a href="#return-note-8880-2">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://www.igvita.com/2012/11/30/web-performance-anomaly-detection-with-google-analytics/
 [2]: http://en.wikipedia.org/wiki/Anomaly_detection
 [3]: http://support.google.com/analytics/bin/answer.py?hl=ko&answer=1320491&topic=1032994&ctx=topic
 [4]: http://w3c-test.org/webperf/specs/NavigationTiming/
 [5]: http://www.igvita.com/2012/04/04/measuring-site-speed-with-navigation-timing/
 [6]: http://support.google.com/analytics/bin/answer.py?hl=ko&answer=1205784
 [7]: http://www.youtube.com/watch?v=NCFVEuKQgBM&list=PL1B4F4863AEE2B122&index=1
 [8]: http://support.google.com/analytics/bin/answer.py?hl=ko&answer=1033017