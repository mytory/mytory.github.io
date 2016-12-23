---
title: '[우분투] 버추얼박스에서 USB 장치 인식시키기'
author: 안형우
layout: post
permalink: /archives/1672
aktt_notify_twitter:
  - yes
daumview_id:
  - 36684422
categories:
  - 기타
tags:
  - Ubuntu Family
---
버추얼박스 웹사이트에서 직접 다운로드를 받아야 USB를 인식할 수 있다는 이야기를 들은 적이 있다. 우분투 소프트웨어 센터에서 까는 거 말고 말이다.

그래서 난 버추얼박스 웹사이트에서 바로 다운받아 썼다. 소프트웨어 센터에서 다운받은 걸로 USB 장치 인식시키기 시도를 해 본 적은 없다는 말이다.

여튼, 나는 아이폰을 인식시키는 데 성공했다.

사실 그냥 USB 메모리 같은 건 굳이 이렇게 할 필요가 없다. 그냥 /media 를 공유 폴더로 해 두면 USB를 마운트했을 때 버추얼박스에서도 인식이 된다.

## 사용자 권한 메세지 대응하기

버추얼박스에서 설정에 들어갈 때 이런 메세지가 뜬다. (번역한 메시지다)

> USB 하위 시스템에 접근할 수 없습니다.
> 
> VirtualBox에서 USB 장치에 접근할 수 없습니다. 현재 사용자를 &#8216;vboxusers&#8217; 그룹에 추가하십시오. 더 자세한 설명은 사용자 설명서를 참고하십시오.

한마디로 &#8220;vboxgroups 라는 사용자 그룹에 네가 포함돼 있어야 한단다&#8221; 하는 얘기다.

그럼 사용자 그룹에 나를 추가하러 가 보자.

영어 메뉴명으로는 **Administration > Users ans Groups** 다. (참고로 난 [루분투][1] 11.04를 사용하고 있다. 그래서 아래 이미지들은 모두 루분투를 캡쳐한 것이다.)

자 이런 그림이 나오면 **Manage Groups** 항목을 누르자.

아래쪽으로 스크롤을 해서 **vboxusers** 를 선택해 준다.

그리고 **Properties** 버튼을 누른다. (한글로는 속성 뭐 이런 거겠지?)

그러면 아래 같은 창이 뜬다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/virtualbox/group-member.png" alt="" width="420" height="300" />
</p>

여기서 자신의 이름에 체크를 해 주자. 나는 사용자 이름이 mytory 니까 당연히 mytory에 체크했다.

이렇게 하고 **로그아웃했다가 다시 들어오면 아까 같은 오류 메세지가 뜨지 않고 제대로 된다.**

로그아웃한다는 게 뭔 말인지 모르겠다면 **그냥 재부팅**한다.

## 인식하게 할 USB 장치 선택

여기서 끝이 아니다. 사용할 USB 장치를 선택해 줘야 한다.

USB 선택에서 + 표시가 돼 있는 버튼을 누른다. 아래 그림을 참고하라.

그리고 원하는 기기를 선택해 주면 된다. 키보드 마우스 같은 건 선택할 필요가 없다.

그러면 USB를 인식한다.

## 추가적인 것 &#8211; USB 2.0? (필수인지 선택인지는 잘 모르겠지만)

버추얼박스의 설정에 들어가서 USB쪽을 보면 USB 2.0을 사용하라는 것처럼 보이는 체크박스가 있다.

USB 2.0 은 속도가 더 빠른 놈일 텐데… 나는 사용하기로 결심했다.

그래서 체크를 해 줬는데, 이번에도 뭔 extension 을 설치해야 한다면서 체크가 안 됐다.

그래서 [버추얼박스 다운로드 페이지][2]에 가 봤다. 다운로드 링크가 있었다. 단번에 찾기가 힘드니까 아래 이미지를 참고하라. 이 이미지는 2011년 8월 12일에 캡쳐한 거다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/virtualbox/extention-pack.png" alt="" width="467" height="211" />
</p>

다운로드 페이지에서 Ctrl+F 를 누르고 extension 을 검색해 보라. 그러면 찾을 수 있을 거다.

다운받으면 **Oracle\_VM\_VirtualBox\_Extension\_Pack-4.1.0-73009.vbox-extpack** 라는 파일이 다운로드되는데, 그냥 더블클릭해서 실행하면 된다.

설치가 완료되면 USB 2.0 에 체크가 가능하다.

 [1]: http://lubuntu.net/
 [2]: http://www.virtualbox.org/wiki/Downloads