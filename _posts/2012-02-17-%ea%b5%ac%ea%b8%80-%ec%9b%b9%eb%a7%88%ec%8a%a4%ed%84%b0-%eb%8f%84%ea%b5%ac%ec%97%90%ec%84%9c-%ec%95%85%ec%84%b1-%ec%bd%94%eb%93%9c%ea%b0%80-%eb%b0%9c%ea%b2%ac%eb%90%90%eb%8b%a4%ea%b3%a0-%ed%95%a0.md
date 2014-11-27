---
title: 구글 웹마스터 도구에서 악성 코드가 발견됐다고 할 때 대처법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2273
aktt_notify_twitter:
  - yes
daumview_id:
  - 36623867
categories:
  - 기타
tags:
  - TIP
---
**요약 : 자기 사이트의 어떤 페이지에 악성 코드가 유포되고 있는지 확인하고 싶은 사람들은 아래 폼에 사이트 주소를 입력해 보면 되겠다.**

## 내 이야기 &#8211; 구글 웹마스터 도구가 내 웹사이트에 악성 코드가 있다고 우긴다

얼마 전부터 구글 웹마스터 도구에 들어가면 내 블로그에서 악성 코드가 감지됐다고 나온다. 나는 사이트를 사용하는 데 아무 문제가 없었기 때문에 의아했다.

<img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/google_webmaster_badware_alert.jpg" alt="" width="553" height="284" />

검토 요청을 두 번이나 했는데 해제되지 않았다. 코드를 모두 다운받아 백신으로 검사를 해 보기도 했다. 악성코드는 발견되지 않았고, 크롬과 구글 검색에서도 사이트를 이용하는 데 아무 문제가 없었다.

그래도 메세지가 자꾸 나오는 건 찜찜하기 때문에 안내문에 있는대로 [StopBadware.org][1]에 방문해 봤다.

홈 화면에 있는 내용은 악성 코드에는 어떤 게 있는지에 대한 설명이었다. 자바스크립트, .htaccess 파일 변경, 그리고 iframe 방식의 악성 코드가 있다고 설명하고 있었다.

## 어떤 페이지가 악성 코드에 감염됐는지 확인하는 방법

그리고 어떤 페이지가 악성 코드에 감염됐는지를 알려면 아래처럼 URL을 써서 들어가 보라고 했다.

<pre>&lt;a href="http://www.google.com/safebrowsing/diagnostic?site=mytory.net"&gt;http://www.google.com/safebrowsing/diagnostic?site=mytory.net&lt;/a&gt;</pre>

나이스! 저렇게 쳐 봤더니 아무 문제가 없다고 나왔다.

<div id="header">
  <blockquote>
    <h2>
      세이프 브라우징
    </h2>
    
    <h3>
      mytory.net에 대한 <em>진단 페이지</em>
    </h3>
  </blockquote>
</div>

> **mytory.net의 현재 상태는 어떤가요?? 의심스러운 사이트로 등록되어 있나요?**
> 
> 현재 이 사이트는 의심스러운 사이트로 등록되지 않았습니다.
> 
> 최근 90일 동안 이 사이트의 일부에서 의심스러운 활동이 9회 발생한 것으로 기록되었습니다.
> 
> **Google이 이 사이트를 방문했을 때 어떤 현상이 발생했나요?**
> 
> 최근 90일 동안 해당 사이트의 173개 페이지를 테스트한 결과 0개 페이지에서 악성 소프트웨어가 사용자의 동의 없이 다운로드 및 설치되는 것으로 나타났습니다. Google이 이 사이트를 마지막으로 방문한 것은 2012-02-10이고, 최근 90일 동안에는 이 사이트에서 의심스러운 콘텐츠가 전혀 발견되지 않았습니다.이 사이트는 [AS4766 (Korea Telecom)][2]을(를) 포함한 1개의 네트워크에서 호스팅되었습니다.
> 
> **이 사이트가 멀웨어를 확산시키는 중개 역할을 한 적이 있나요?**
> 
> mytory.net은(는) 최근 90일 동안 웹사이트를 감염시키는 중개 역할을 하지 않은 것으로 보입니다.
> 
> **이 사이트가 멀웨어를 호스팅한 적이 있나요?**
> 
> 아니요, 이 사이트는 최근 90일 동안 악성 소프트웨어를 호스팅하지 않았습니다.
> 
> **다음 단계:**
> 
> *   [이전 페이지로 돌아가기][3]
> *   이 웹사이트의 소유자는 Google [웹마스터 도구][4]를 이용해 사이트 점검을 요청할 수 있습니다. 점검 절차에 대해 자세히 알아보려면 Google의 [웹마스터 도움말 센터][5]를 참조하세요.

아니, 의심스러운 거 안 했다면서 왜 자꾸 웹마스터 센터에선 나한테 그러는 거냐고! 여튼간에 그래서 다시 검토 요청을 했다.

 [1]: http://www.stopbadware.org/
 [2]: http://www.google.com/safebrowsing/diagnostic?site=AS:4766
 [3]: http://www.google.com/safebrowsing/diagnostic?site=mytory.net#
 [4]: http://www.google.com/webmasters/tools/
 [5]: http://www.google.com/support/webmasters/bin/answer.py?answer=45432