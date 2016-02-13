---
title: '오픈수세 13.2 크롬 에러 해결(Check failed: NamespaceUtils::WriteToIdMapFile("/proc/self/gid_map", gid_))'
layout: post
categories:
  - linux
tags:
  - opensuse
---

오픈수세 업데이트를 하고 나니 갑자기 크롬이 실행되지 않는다. 커맨드 라인에서 `google-chrome`을 쳐 실행해 보니 다음과 같은 에러 메시지가 나왔다.

    Check failed: NamespaceUtils::WriteToIdMapFile("/proc/self/gid_map", gid_)

뭔가 네임스페이스에서 문제가 났다는 것 같은데...

아래처럼 크롬을 실행하면 일단 실행이 된다. 네임스페이스 기능을 끄는 것인가 보다.

    google-chrome %U --disable-namespace-sandbox

이상.

