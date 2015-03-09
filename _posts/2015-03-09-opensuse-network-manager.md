---
title: "OPENSUSE 13.1 네트워크 매니저 활성화"
layout: "post"
category: "etc"
tags: 
    - linux
---

자리를 옮기면서 무선랜을 사용해야 하게 됐는데 이게 당췌 무선랜 잡는 인터페이스가 나오질 않는 거다.

한참 헤매다가 찾았다.

    systemctl start NetworkManager

늘 활성화하려면 **yast > System > Services Manager > NetworkManager**를 찾아서 좌측 하단에 있는 enable/disable 버튼을 누른다. 그래서 NetworkManager가 enable로 변하면 완료.