---
title: 우편번호 오픈API _ IE에서만 돌아간다? 아니다
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/420
aktt_notify_twitter:
  - yes
daumview_id:
  - 36998480
mytory_md_path:
  - 
categories:
  - 기타
tags:
  - 생각해 보기
---
[이 글을 쓰고 4년 가량 지났다. 지금은 우체국에서 IE뿐 아니라 다른 브라우저에서도 테스트할 수 있는 URL을 제공하고 있다. 그리고 공공데이터포털이라는 사이트도 문을 열었다. 우체국 API는 구주소만 지원하므로 도로명주소를 검색하려면 공공데이터포털의 우편번호 검색 서비스를 이용해야 한다. [내가 쓴 글][1]이 있으니 참고하라. - 2014-01-10 추가.]

진행중인 프로젝트에서 야심차게 <a href="http://biz.epost.go.kr/customCenter/custom/custom_9.jsp?subGubun=sub_3&subGubun_1=cum_17&gubun=m07" target="_blank">우편번호 오픈 API</a>를 붙여 보려고 했다.

그러나&#8230; 얼마간의 삽질을 하다가 깨달았다. IE에서만 돌아가는 것 같다. OTL;; ([꼭 그렇지는 않은 듯하다][2] &#8211; 2011-05-24 추가)

[이건 내가 초보시절에 착각한 거다. URL 입력으로 결과값을 확인해 보는 건 IE에서마 되는 게 맞았었다. 지금은 그렇지도 않지만. 여튼간에 URL을 직접 입력해서 값을 받을 리가 없었으니 초보인 내가 착각을 했던 거다. 서버단 프로그램으로 http 요청을 해서 결과값을 받는 데는 예전에도 문제가 없었고 지금도 문제가 없다. 잘 모르고 생사람 잡았던 것. PHP쪽 구현은 ["우체국의 우편번호 API를 이용해 우편번호 검색 서비스를 만들어 보자 – 서버단"][3]에서 설명을 했었다. 그런데 이제는 공공데이터포털에서도 API를 제공하므로 그걸 보면 된다. 어찌 보면 그쪽이 더 간편하다. - 2014-01-12 추가.]

<pre>http://biz.epost.go.kr/KpostPortal/openapi?regkey=test&target=post&query=구의1동</pre>

위 형태의 주소표시줄은 우편번호 API가 받는다.

<pre>http://biz.epost.go.kr/KpostPortal/openapi?regkey=test&target=post&query=%B1%B8%C0%C71%B5%BF</pre>

위 형태처럼, 파이어폭스는 한글을 자동으로 URL인코딩으로 변환하는데, 이러면 인식을 못 한다.

어이가 없으심 OTL;;

보통은 IE가 한글로 URL을 날리면 인식을 못 하고, 파폭 등은 알아서 인코딩을 풀어서 인식하므로 IE 때문에 짜증나는 일이 많았다.

그러나 IE에 최적화된 우체국 오픈 API는 어떻게 해 볼 방법이 없는 것 같다. ㅠ.ㅠ

결국 우편번호를 DB에 넣어야 orz&#8230;

[▶우편번호 mysql DB 파일이 필요한 사람은 여기를 참고하면 된다.][4]

 [1]: http://mytory.local/archives/12185 "공공데이터포털 우편번호 신청 절차와 API 정리"
 [2]: http://mytory.local/archives/1284 "우체국의 우편번호 API를 이용해 우편번호 검색 서비스를 만들어 보자 (1) 서버단"
 [3]: http://mytory.local/archives/1284 "우체국의 우편번호 API를 이용해 우편번호 검색 서비스를 만들어 보자 – 서버단"
 [4]: http://mytory.local/archives/579