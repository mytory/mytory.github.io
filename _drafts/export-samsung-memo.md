
db를 얻은 다음...

SELECT datetime(createdAt/1000,'unixepoch') as created, datetime(lastModifiedAt/1000,'unixepoch') as modified, title, content FROM memo ORDER BY created