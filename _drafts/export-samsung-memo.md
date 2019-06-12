
db를 얻은 다음...

SELECT datetime(createdAt/1000,'unixepoch') as created, datetime(lastModifiedAt/1000,'unixepoch') as modified, title, strippedContent FROM memo ORDER BY created


csv 추출한 뒤 


~~~ php
$rows = [];
if (($handle = fopen('samsung-memo.csv', 'r')) !== false) {
    while (($row = fgetcsv($handle, 0, ',')) !== false) {
        $rows[] = $row;
    }
    fclose($handle);
}

$header = array_shift($rows);
foreach ($rows as $i => $row) {
    $rows[$i] = array_combine($header, $row);
}

foreach ($rows as $row) {
    $title = trim(preg_replace('/[^ 0-9A-Za-z가-힣-_]/u', '', mb_substr((explode("\n", $row['title'])[0] ?? ''), 0, 20)));
    $date = date('Y-m-d', strtotime($row['created']));
    if ($title) {
        $filename = "{$date} {$title}";
    } else {
        $filename = $date;
    }

    $filemode = "x+";
    if (is_file("memos/{$filename}.txt")) {
        // 삼성 메모는 메모가 길면 나누어 저장한다.
        $filemode = "a";
    }
    $handle = fopen("memos/{$filename}.txt", $filemode);
    fwrite($handle, $row['strippedContent']);
    fclose($handle);
}
~~~