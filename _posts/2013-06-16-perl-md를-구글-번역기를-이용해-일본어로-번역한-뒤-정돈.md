---
title: '[perl] md를 구글 번역기를 이용해 일본어로 번역한 뒤 정돈하는 스크립트'
author: 안형우
layout: post
permalink: /archives/10373
daumview_id:
  - 46190829
categories:
  - 기타
tags:
  - 분류대기중
---
이건 아주 특수한 경우에 사용하는 거다.

블로그 글을 쓸 때 최근에 일단은 마크다운으로 작성하기 시작했다. 그리고 html로 변환해서 올린다. 그리고 구글 일본어 번역기로 가서 마크다운 텍스트를 넣고 바로 번역시킨다. 번역된 결과를 복사한다. 그리고 이것저것 정돈을 한다. 그 뒤 찾기 바꾸기로 파일을 정리한 다음 올리곤 했는데, 그냥 펄 스크립트로 만들었다. 앞으론 구글 번역기로 돌린 다음 그냥 이 펄 스크립트에 집어 넣어서 나온 결과물을 일본어 블로그에 바로 올리면 된다. 참고할 사람은 참고하시길.

파일명은 `arrange-translate.pl`이다. 실행권한을 줘야 한다는 걸 잊지 말고. 터미널에서 돌리는 놈이라는 것도 잊지 말길.

    #!/usr/bin/perl
    use strict;
    use warnings;
    use feature 'say';
    use Data::Dumper;
    use File::Basename;
    use File::Spec;
    
    our @content;
    our $name;
    our $path;
    our $suffix;
    our $new_filepath;
    
    if( ! $ARGV[0]){
        say "Write filepath. for example, arrange-translate.pl /my/path/my/filename";
        exit;
    }
    
    open (MYFILE, $ARGV[0]);
    @content = ();
    
    our $index = 0;
    while (<MYFILE>) {
        chomp;
        if($_ eq '' and $index == 0){
            $index++;
            next;
        }
        $index++;
    
        $_ =~ s/\<\/ /\<\//g;
        $_ =~ s/\< \/ /\<\//g;
        $_ =~ s/\[\/ /\[\//g;
        $_ =~ s/（/(/g;
        $_ =~ s/）/)/g;
        $_ =~ s/！/!/g;
        $_ =~ s/@ /@/g;
        $_ =~ s/＃/#/g;
        $_ =~ s/ \^ \= /\^\=/g;
        $_ =~ s/ / /g;
        $_ =~ s/：/: /g;
        $_ =~ s/:  /: /g;
        $_ =~ s/ __/__/g;
        $_ =~ s/^\*/\* /g;
        $_ =~ s/】/\]/g;
        $_ =~ s/http :\/ \/ /http:\/\//g;
        $_ =~ s/`([a-zA-Z\-\_ \:\@]*)'/`$1`/g;
        $_ =~ s/'([a-zA-Z\-\_ \:\@]*)`/`$1`/g;
    
        # pre 안의 코드
        if( index($_, '    ') == 0 ||  index($_, '/\t/') == 0 ){
            $_ =~ s/、/, /g;
            $_ =~ s/。/./g;
            $_ =~ s/([a-z]) \[/$1\[/g;
        }
    
        push (@content, $_);
    }
    close (MYFILE);
    
    # 새 파일 이름을 만들기 위해 
    ($name,$path,$suffix) = fileparse($ARGV[0], qr/\.[^.]*/);
    
    $new_filepath = $path . $name . '-arranged' . $suffix;
    
    say "Arranged file is ", $new_filepath;
    
    open (FILE_TO_WRITE, '>' . $new_filepath);
    for (@content) {
        say FILE_TO_WRITE $_;
    }
    close (FILE_TO_WRITE);