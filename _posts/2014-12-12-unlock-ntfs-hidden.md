---
title: "윈도우에서 파일이 다 사라지는 악성코드 치료후 파일 보이게 하기"
layout: "post"
category: "etc"
---

사무실에서 돌았던 바이러스다. 딱히 치명적인 건 아닌데 파일이 다 숨김처리가 돼 사람들이 당황한다. 치료를 다 했다면 윈도우 cmd에서 usb 드라이브로 전환한 뒤 `attrib` 명령어로 파일을 보이게 만든다.

usb 드라이브는 `f:` 라고 가정한다. `window + R` 버튼을 눌러 실행기를 띄우고 `cmd`라고 입력한 뒤 엔터쳐서 윈도우 커맨드라인을 띄운다. 그리고 아래처럼 입력해서 파일을 보이게 만든다.

    f:
    attrib -s -h -r /s /d

각 옵션에 대한 설명은 [Attrib 문서](https://www.microsoft.com/resources/documentation/windows/xp/all/proddocs/en-us/attrib.mspx?mfr=true) 참고

사실 이 악성코드는 NTFS 포맷에 대해 걸리는 놈인 것 같고, 그래서 리눅스나 맥에서 해당 USB를 살펴 보면 파일이 다 보인다.

이상.