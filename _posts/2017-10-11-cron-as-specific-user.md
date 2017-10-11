---
title: '특정 사용자로 cron 실행하기'
layout: post
author: 안형우
tags: 
  - linux
  - tip
description: 'cron으로 파일을 만드는 일을 해야 한다면, 특정 사용자로 접근해야 하는 경우가 있다. 사용자를 지정하는 /etc/crontab을 이용한다.'
image: /uploads/2017/cron-as-specific-user.jpg
---

cron으로 돌리고 있는 명령어가 www-data 소유 폴더에 리사이즈 이미지를 만들어야 했다. cron은 일반 사용자가 돌리고, 폴더 권한은 755(소유자만 쓰기 가능)였기 때문에 파일 만들기에 실패했다.

이 문제를 해결하기 위해 root로 cron을 돌릴 수도 있다. 하지만 그러면 생성된 파일의 소유자가 root가 되기 때문에 www-data 권한만 있는 웹서버가 해당 리사이즈 이미지를 지우거나 고칠 수 없다는 문제가 생긴다. 

`/etc/crontab`을 이용하면 사용자를 지정해 cron을 돌릴 수 있다. `/etc/crontab`은 시스템이 수준의(system-wide) cron 명령어를 저장하는 파일인데, 이 파일에는 user를 지정하는 항목이 있다. 아래처럼 적는다.

    # m h dom mon dow user	command
    * *     * * *   www-data php /var/www/artisan schedule:run >> /dev/null 2>&1


