---
Title: .htaccess를 이용해 url에서 단계 하나를 없애기
Tags:
  - apache
  - .htaccess
---

~~~
RewriteEngine on
# RewriteCond $1 !^(index\.php|assets|images|robots\.txt|js-lib|js|css)
RewriteCond $1 !^(korean)
RewriteRule ^(.*)$ /korean/$1 [L]
~~~
