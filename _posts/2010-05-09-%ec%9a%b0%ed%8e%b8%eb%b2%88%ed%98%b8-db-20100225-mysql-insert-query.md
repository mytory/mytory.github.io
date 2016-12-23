---
title: 우편번호 DB 20130530 mysql insert query
author: 안형우
layout: post
permalink: /archives/579
aktt_notify_twitter:
  - yes
daumview_id:
  - 36943537
categories:
  - 서버단
tags:
  - MySQL
---
[2013년 5월 30일자 우편번호 mysql export 파일 다운로드][1]

[우체국에서 제공하는 오픈 API][2]가 있지만, 까다롭고, 활용하기 힘든 부분도 있다.

그런데 <a href="http://www.zipfinder.co.kr/zipcode/index.html" target="_blank">우편번호 DB를 제공하는 데</a>서 다운을 받으면, 이번엔 난생 처음 보는 dbf 파일로 돼 있다. 물론 이 파일은 엑셀에서 잘 열린다. 그럼 이놈을 어떻게 mysql에 넣을까&#8230;

처음에는 엑셀에서 다른 이름으로 저장을 선택한 후 cvs로 바꾼 다음,(그러면 텍스트 파일이 된다.) 에디트 플러스로 열어서 일일이 찾기 바꾸기를 했다. 열라 귀찮았고, 결국 다 했는데 오류가 났다. 썅.

이번에는 phpmyadmin의 import 메뉴를 잘 살펴봤다. Format of imported file 항목이 있었고, CVS 형식이 있었다. 엑셀에서 CVS로 저장한 다음 여기 집어넣었다. 대성공!

물론, 설정은 필요했다. 아래처럼 말이다. (아마 클릭하면 확대될 거다.)

<img class="aligncenter" alt="" src="/uploads/legacy/old-images/1/cfile30.uf.1249464E4D4BC8F9262EF9.jpg" width="580" height="189" />

흠. 일단 필드 구분자를 쉼표로 바꿨고, 필드 감싸기를 지웠다. 줄 구분자는 그냥 오토로 했다.

그랬더니 성공적으로 들어갔다. 나이스!(물론, DB와 필드는 미리 생성해 뒀다.)

그리고 또 활용해 먹으려고 내보내기를 했다. 내가 사용한 놈은 필드 여섯 개짜리 놈이다. 필요한 분들은 다운받아 사용해라. 나도 계속 만들기 귀찮아서 필요하면 다운받아 쓰려고 한다.

[2011년 3월 11일자 우편번호 mysql export 파일 다운로드  
][3]

[2013년 5월 30일자 우편번호 mysql export 파일 다운로드][1]

 [1]: /uploads/legacy/zipcode.sql.gz
 [2]: http://mytory.net/archives/1284 "우체국의 우편번호 API를 이용해 우편번호 검색 서비스를 만들어 보자 (1) 서버단"
 [3]: https://docs.google.com/leaf?id=0B1y-xjZYE3AqMzFhNzEzYWUtMWY1OC00MGIyLWI5NGYtZmQ1YzY5YWZmZDVi&hl=ko