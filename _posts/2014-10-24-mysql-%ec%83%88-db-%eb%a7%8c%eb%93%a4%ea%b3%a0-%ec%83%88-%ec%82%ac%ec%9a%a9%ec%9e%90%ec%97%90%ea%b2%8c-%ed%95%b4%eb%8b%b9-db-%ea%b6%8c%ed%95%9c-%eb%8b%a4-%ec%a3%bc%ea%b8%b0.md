---
title: mysql 새 db 만들고 새 사용자에게 해당 db 권한 다 주기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/13336
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13336-mysql-new-db-and-user.md
categories:
  - 서버단
tags:
  - MySQL
  - 코드 조각
---
외울려고 보관.

    create database newdbname character set utf8mb4;
    create user 'new_user_name'@'localhost' identified by 'new_user_password';
    grant all privileges on newdbname.* to 'new_user_name'@'localhost';
    flush privileges;