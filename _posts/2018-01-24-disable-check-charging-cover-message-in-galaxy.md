---
title: "갤럭시S5 충전 커버 확인 메시지 삭제(루팅)" 
layout: post
tags: 
  - tip
---

갤럭시S5에서는 뭐만 하면 "충전 커버 확인" 메시지가 뜬다. 루팅을 했다면 이걸 비활성화할 수 있다.

**PopupuiReceiver**를 비활성화하면 된다. Titanium을 이용해서 비활성화하거나 삭제해도 되고, `/system/app/PopupuiReceiver_M.apk`를 다른 곳으로 옮기거나 삭제해도 될 것이다. 


## 앱을 사용해서 비활성화

해외에서도 이건 짜증나는 일인가 보다. [Disable Those Annoying "Water Damage" Popup Reminders on Your Galaxy S5](https://gs5.gadgethacks.com/how-to/disable-those-annoying-water-damage-popup-reminders-your-galaxy-s5-0155689/)라는 글을 발견했다. 여기서는 앱을 설치해서 비활성화하는 방법을 설명한다. 역시 루팅은 한 상태여야 한다.


## 기타

[메시지가 뜨는 기준](https://www.samsungsvc.co.kr/online/faqView.do?domainId=NODE0000033866&node_Id=NODE0000145891&faqId=KNOW0000030236)은 아래와 같다.

###  배터리 커버 확인 팝업 발생 조건

1. 플립 커버 분리 또는 장착할 때 발생
2. 단말 최초 부팅할 때 발생


### 충전 커버 확인 팝업 발생 조건

1. 충전기 및 USB 케이블 연결 후 분리할 때 발생

