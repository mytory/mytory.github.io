~~~
Jan 10 21:43:57 servername kernel: [928270.384097] nginx invoked oom-killer: gfp_mask=0x24201ca, order=0, oom_score_adj=0
Jan 10 21:43:57 servername kernel: [928270.384106] nginx cpuset=/ mems_allowed=0
Jan 10 21:43:57 servername kernel: [928270.384134] CPU: 1 PID: 21390 Comm: nginx Not tainted 4.4.0-104-generic #127-Ubuntu
Jan 10 21:43:57 servername kernel: [928270.384135] Hardware name: servername, BIOS 20151212 10/11/2015
Jan 10 21:43:57 servername kernel: [928270.384139]  0000000000000286 8e8c0ce32f5bf862 ffff8800513339d8 ffffffff813fb523
Jan 10 21:43:57 servername kernel: [928270.384145]  ffff880051333b90 ffff880036072a00 ffff880051333a48 ffffffff8120cb7e
Jan 10 21:43:57 servername kernel: [928270.384147]  ffffffff81cd7a2f 0000000000000000 ffffffff81e67920 0000000000000206
Jan 10 21:43:57 servername kernel: [928270.384150] Call Trace:
Jan 10 21:43:57 servername kernel: [928270.384196]  [<ffffffff813fb523>] dump_stack+0x63/0x90
Jan 10 21:43:57 servername kernel: [928270.384214]  [<ffffffff8120cb7e>] dump_header+0x5a/0x1c5
Jan 10 21:43:57 servername kernel: [928270.384224]  [<ffffffff81193562>] oom_kill_process+0x202/0x3c0
Jan 10 21:43:57 servername kernel: [928270.384226]  [<ffffffff81193989>] out_of_memory+0x219/0x460
Jan 10 21:43:57 servername kernel: [928270.384235]  [<ffffffff81199995>] __alloc_pages_slowpath.constprop.88+0x965/0xb00
Jan 10 21:43:57 servername kernel: [928270.384237]  [<ffffffff81199db6>] __alloc_pages_nodemask+0x286/0x2a0
Jan 10 21:43:57 servername kernel: [928270.384246]  [<ffffffff811e38bc>] alloc_pages_current+0x8c/0x110
Jan 10 21:43:57 servername kernel: [928270.384248]  [<ffffffff8118fb2b>] __page_cache_alloc+0xab/0xc0
Jan 10 21:43:57 servername kernel: [928270.384250]  [<ffffffff8119203a>] filemap_fault+0x14a/0x3f0
Jan 10 21:43:57 servername kernel: [928270.384263]  [<ffffffff812a5046>] ext4_filemap_fault+0x36/0x50
Jan 10 21:43:57 servername kernel: [928270.384268]  [<ffffffff811befd0>] __do_fault+0x50/0xe0
Jan 10 21:43:57 servername kernel: [928270.384271]  [<ffffffff811c2af2>] handle_mm_fault+0xfa2/0x1820
Jan 10 21:43:57 servername kernel: [928270.384279]  [<ffffffff81259f77>] ? ep_scan_ready_list+0x1e7/0x1f0
Jan 10 21:43:57 servername kernel: [928270.384282]  [<ffffffff8125a1ca>] ? ep_poll+0x21a/0x3d0
Jan 10 21:43:57 servername kernel: [928270.384295]  [<ffffffff8106b577>] __do_page_fault+0x197/0x400
Jan 10 21:43:57 servername kernel: [928270.384310]  [<ffffffff810f65fb>] ? __getnstimeofday64+0x3b/0xd0
Jan 10 21:43:57 servername kernel: [928270.384312]  [<ffffffff8106b847>] trace_do_page_fault+0x37/0xe0
Jan 10 21:43:57 servername kernel: [928270.384317]  [<ffffffff81063f29>] do_async_page_fault+0x19/0x70
Jan 10 21:43:57 servername kernel: [928270.384332]  [<ffffffff81846a28>] async_page_fault+0x28/0x30
Jan 10 21:43:57 servername kernel: [928270.384334] Mem-Info:
Jan 10 21:43:57 servername kernel: [928270.384348] active_anon:453506 inactive_anon:21374 isolated_anon:2
Jan 10 21:43:57 servername kernel: [928270.384348]  active_file:82 inactive_file:51 isolated_file:1
Jan 10 21:43:57 servername kernel: [928270.384348]  unevictable:915 dirty:14 writeback:0 unstable:0
Jan 10 21:43:57 servername kernel: [928270.384348]  slab_reclaimable:5088 slab_unreclaimable:6545
Jan 10 21:43:57 servername kernel: [928270.384348]  mapped:17207 shmem:21742 pagetables:5979 bounce:0
Jan 10 21:43:57 servername kernel: [928270.384348]  free:13665 free_pcp:76 free_cma:0
Jan 10 21:43:57 servername kernel: [928270.384354] Node 0 DMA free:8208kB min:352kB low:440kB high:528kB active_anon:6272kB inactive_anon:652kB active_file:60kB inactive_file:32kB unevictable:0kB isolated(anon):0kB isolated(file):0kB present:15992kB managed:15908kB mlocked:0kB dirty:0kB writeback:0kB mapped:696kB shmem:652kB slab_reclaimable:152kB slab_unreclaimable:108kB kernel_stack:16kB pagetables:416kB unstable:0kB bounce:0kB free_pcp:0kB local_pcp:0kB free_cma:0kB writeback_tmp:0kB pages_scanned:340 all_unreclaimable? no
Jan 10 21:43:57 servername kernel: [928270.384364] lowmem_reserve[]: 0 1966 1966 1966 1966
Jan 10 21:43:57 servername kernel: [928270.384369] Node 0 DMA32 free:46452kB min:44700kB low:55872kB high:67048kB active_anon:1807752kB inactive_anon:84844kB active_file:268kB inactive_file:172kB unevictable:3660kB isolated(anon):8kB isolated(file):4kB present:2080748kB managed:2032276kB mlocked:3660kB dirty:56kB writeback:0kB mapped:68132kB shmem:86316kB slab_reclaimable:20200kB slab_unreclaimable:26072kB kernel_stack:3296kB pagetables:23500kB unstable:0kB bounce:0kB free_pcp:304kB local_pcp:184kB free_cma:0kB writeback_tmp:0kB pages_scanned:7700 all_unreclaimable? yes
Jan 10 21:43:57 servername kernel: [928270.384374] lowmem_reserve[]: 0 0 0 0 0
Jan 10 21:43:57 servername kernel: [928270.384377] Node 0 DMA: 20*4kB (ME) 6*8kB (ME) 8*16kB (UME) 4*32kB (ME) 3*64kB (UME) 4*128kB (UME) 4*256kB (UM) 4*512kB (UME) 2*1024kB (ME) 1*2048kB (M) 0*4096kB = 8256kB
Jan 10 21:43:57 servername kernel: [928270.384393] Node 0 DMA32: 423*4kB (UE) 575*8kB (UME) 514*16kB (UME) 290*32kB (UMEH) 145*64kB (UME) 66*128kB (UME) 13*256kB (MEH) 1*512kB (H) 1*1024kB (H) 0*2048kB 0*4096kB = 46388kB
Jan 10 21:43:57 servername kernel: [928270.384409] Node 0 hugepages_total=0 hugepages_free=0 hugepages_surp=0 hugepages_size=1048576kB
Jan 10 21:43:57 servername kernel: [928270.384412] Node 0 hugepages_total=0 hugepages_free=0 hugepages_surp=0 hugepages_size=2048kB
Jan 10 21:43:57 servername kernel: [928270.384413] 22465 total pagecache pages
Jan 10 21:43:57 servername kernel: [928270.384421] 0 pages in swap cache
Jan 10 21:43:57 servername kernel: [928270.384424] Swap cache stats: add 0, delete 0, find 0/0
Jan 10 21:43:57 servername kernel: [928270.384425] Free swap  = 0kB
Jan 10 21:43:57 servername kernel: [928270.384426] Total swap = 0kB
Jan 10 21:43:57 servername kernel: [928270.384427] 524185 pages RAM
Jan 10 21:43:57 servername kernel: [928270.384428] 0 pages HighMem/MovableOnly
Jan 10 21:43:57 servername kernel: [928270.384429] 12139 pages reserved
Jan 10 21:43:57 servername kernel: [928270.384429] 0 pages cma reserved
Jan 10 21:43:57 servername kernel: [928270.384430] 0 pages hwpoisoned
Jan 10 21:43:57 servername kernel: [928270.384431] [ pid ]   uid  tgid total_vm      rss nr_ptes nr_pmds swapents oom_score_adj name
Jan 10 21:43:57 servername kernel: [928270.384437] [  633]     0   633     9563     1530      22       3        0             0 systemd-journal
Jan 10 21:43:57 servername kernel: [928270.384440] [  667]     0   667    25742       47      17       3        0             0 lvmetad
Jan 10 21:43:57 servername kernel: [928270.384442] [  701]     0   701    10628      647      22       3        0         -1000 systemd-udevd
Jan 10 21:43:57 servername kernel: [928270.384444] [  788]   100   788    25081      188      19       3        0             0 systemd-timesyn
Jan 10 21:43:57 servername kernel: [928270.384446] [ 1276]     0  1276     1306       30       8       3        0             0 iscsid
Jan 10 21:43:57 servername kernel: [928270.384448] [ 1277]     0  1277     1431      882       8       3        0           -17 iscsid
Jan 10 21:43:57 servername kernel: [928270.384450] [ 1281]     0  1281     7137      515      19       3        0             0 systemd-logind
Jan 10 21:43:57 servername kernel: [928270.384452] [ 1284]     0  1284     6511      400      16       3        0             0 atd
Jan 10 21:43:57 servername kernel: [928270.384453] [ 1292]     0  1292     7324      475      20       3        0             0 cron
Jan 10 21:43:57 servername kernel: [928270.384455] [ 1298]     0  1298   206327     2505      35       4        0             0 lxcfs
Jan 10 21:43:57 servername kernel: [928270.384457] [ 1299]     0  1299    15253     3636      34       3        0             0 supervisord
Jan 10 21:43:57 servername kernel: [928270.384459] [ 1307] 65534  1307    52236     2185      24       5        0          -900 do-agent
Jan 10 21:43:57 servername kernel: [928270.384461] [ 1311]     0  1311    69044      749      39       4        0             0 accounts-daemon
Jan 10 21:43:57 servername kernel: [928270.384466] [ 1318]     0  1318    16380      618      35       3        0         -1000 sshd
Jan 10 21:43:57 servername kernel: [928270.384468] [ 1321]   107  1321    10724      326      26       4        0          -900 dbus-daemon
Jan 10 21:43:57 servername kernel: [928270.384477] [ 1342]   104  1342    64099      401      28       3        0             0 rsyslogd
Jan 10 21:43:57 servername kernel: [928270.384480] [ 1344]     0  1344     1100      319       7       3        0             0 acpid
Jan 10 21:43:57 servername kernel: [928270.384482] [ 1370]     0  1370     3344      233      11       3        0             0 mdadm
Jan 10 21:43:57 servername kernel: [928270.384484] [ 1376]     0  1376    32342     1109      50       3        0             0 nginx
Jan 10 21:43:57 servername kernel: [928270.384485] [ 1383]     0  1383    69295      187      38       4        0             0 polkitd
Jan 10 21:43:57 servername kernel: [928270.384487] [ 1451]     0  1451     4868      117      14       3        0             0 irqbalance
Jan 10 21:43:57 servername kernel: [928270.384489] [ 1462]     0  1462     4057      350      12       3        0             0 agetty
Jan 10 21:43:57 servername kernel: [928270.384491] [ 1464]     0  1464     4011      405      14       3        0             0 agetty
Jan 10 21:43:57 servername kernel: [928270.384493] [ 2764]     0  2764    56094     2631      35       5        0          -900 snapd
Jan 10 21:43:57 servername kernel: [928270.384495] [ 8397]     0  8397    97983     3932     148       3        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384497] [ 8400]    33  8400   159499    31243     211       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384499] [ 8401]    33  8401   162043    27529     207       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384500] [ 8402]    33  8402   144669    28797     209       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384502] [ 8403]    33  8403   166330    32321     216       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384504] [ 8404]    33  8404   156499    25810     207       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384505] [ 8405]    33  8405   139289    24523     203       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384507] [ 8406]    33  8406   124958    20627     192       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384509] [ 8407]    33  8407   139900    24182     201       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384511] [ 8408]    33  8408   142118    30833     214       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384513] [ 8409]    33  8409   133884    29882     210       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384514] [ 8410]    33  8410   158135    29556     213       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384516] [ 8411]    33  8411   124764    20774     193       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384518] [ 8412]    33  8412   174858    23839     201       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384520] [ 8413]    33  8413   129322    25441     201       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384521] [ 8414]    33  8414   150119    31804     217       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384523] [ 8415]    33  8415   152064    25379     207       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384525] [ 8416]    33  8416   125034    20731     193       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384527] [ 8417]    33  8417   124807    20563     192       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384528] [ 8418]    33  8418   144294    27782     205       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384530] [ 8419]    33  8419   143027    28259     207       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384532] [ 8420]    33  8420   139423    20935     199       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384534] [ 8421]    33  8421   127063    22988     197       4        0             0 php-fpm7.0
Jan 10 21:43:57 servername kernel: [928270.384536] [ 4375]     0  4375     5365      516      15       3        0             0 mysqld_safe
Jan 10 21:43:57 servername kernel: [928270.384538] [ 4528]   112  4528   228659   142999     337       4        0             0 mysqld
Jan 10 21:43:57 servername kernel: [928270.384539] [ 4529]     0  4529     6595       59      18       3        0             0 logger
Jan 10 21:43:57 servername kernel: [928270.384541] [ 6444]    33  6444   102811     8008     151       4        0             0 php
Jan 10 21:43:57 servername kernel: [928270.384543] [ 6451]    33  6451   102808     8199     151       4        0             0 php
Jan 10 21:43:57 servername kernel: [928270.384545] [21389]    33 21389    32348     1839      49       3        0             0 nginx
Jan 10 21:43:57 servername kernel: [928270.384547] [21390]    33 21390    32553     1874      49       3        0             0 nginx
Jan 10 21:43:57 servername kernel: [928270.384548] Out of memory: Kill process 4528 (mysqld) score 279 or sacrifice child
Jan 10 21:43:57 servername kernel: [928270.389532] Killed process 4528 (mysqld) total-vm:914636kB, anon-rss:571744kB, file-rss:252kB
~~~