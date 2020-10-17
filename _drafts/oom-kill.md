~~~
Oct 16 08:16:34 [  pid  ]   uid  tgid total_vm      rss pgtables_bytes swapents oom_score_adj name
Oct 16 08:16:34 [    110]     0   110      267        1     28672        0             0 none
Oct 16 08:16:34 [    403]     0   403    37469      885    294912        0          -250 systemd-journal
Oct 16 08:16:34 [    431]     0   431     5359      751     61440        0         -1000 systemd-udevd
Oct 16 08:16:34 [    559]     0   559    70031     4482     94208        0         -1000 multipathd
Oct 16 08:16:34 [    635]   112   635     1774      698     57344        0             0 rpcbind
Oct 16 08:16:34 [    636]   102   636    22542      621     77824        0             0 systemd-timesyn
Oct 16 08:16:34 [    696]   100   696     6687      846     77824        0             0 systemd-network
Oct 16 08:16:34 [    698]   101   698     6013     1468     86016        0             0 systemd-resolve
Oct 16 08:16:34 [    755]     0   755    60255      745     94208        0             0 accounts-daemon
Oct 16 08:16:34 [    756]   103   756     1898      647     61440        0          -900 dbus-daemon
Oct 16 08:16:34 [    767]     0   767    20455      650     57344        0             0 irqbalance
Oct 16 08:16:34 [    769]     0   769     7303     2777     94208        0             0 networkd-dispat
Oct 16 08:16:34 [    770]   104   770    56083      506     90112        0             0 rsyslogd
Oct 16 08:16:34 [    773] 584788   773    2168       14     69632        0             0 updater
Oct 16 08:16:34 [    774] 584788   774   28646     1562     98304        0             0 agent
Oct 16 08:16:34 [    789]     0   789     4182      794     73728        0             0 systemd-logind
Oct 16 08:16:34 [    791]     0   791   210051     3216    180224        0             0 f2b/server
Oct 16 08:16:34 [    792]     0   792     1277       57     45056        0             0 iscsid
Oct 16 08:16:34 [    793]     0   793     1403     1353     53248        0           -17 iscsid
Oct 16 08:16:34 [    796]     0   796     3042      533     57344        0         -1000 sshd
Oct 16 08:16:34 [    835]     0   835     2134      502     57344        0             0 cron
Oct 16 08:16:34 [    839]     0   839      948      529     45056        0             0 atd
Oct 16 08:16:34 [    849]     0   849     1838      458     49152        0             0 agetty
Oct 16 08:16:34 [    856]     0   856     1457      371     45056        0             0 agetty
Oct 16 08:16:34 [    866]     0   866    27009     2787    110592        0             0 unattended-upgr
Oct 16 08:16:34 [    871]     0   871    55674     2890    184320        0             0 apache2
Oct 16 08:16:34 [    881]     0   881    59102      888     90112        0             0 polkitd
Oct 16 08:16:34 [    952] 584788   952   195178    24444   536576        0             0 updater
Oct 16 08:16:34 [   1049] 584788  1049     2168       14    69632        0             0 monitoring
Oct 16 08:16:34 [   1053] 584788  1053   342488    29590   700416        0             0 monitoring
Oct 16 08:16:34 [ 202296]    33 202296    75681     7631   237568        0             0 apache2
Oct 16 08:16:34 [ 206693]    33 206693    75724     8274   237568        0             0 apache2
Oct 16 08:16:34 [ 208576]    33 208576    75729     8459   237568        0             0 apache2
Oct 16 08:16:34 [ 239227]    33 239227    75574     7469   229376        0             0 apache2
Oct 16 08:16:34 [ 241101]    33 241101    75087     7301   225280        0             0 apache2
Oct 16 08:16:34 [ 246277]     0 246277      652      118    45056        0             0 apt.systemd.dai
Oct 16 08:16:34 [ 246281]     0 246281      652      389    40960        0             0 apt.systemd.dai
Oct 16 08:16:34 [ 246312]     0 246312    63805     9856   274432        0             0 unattended-upgr
Oct 16 08:16:34 [ 246327]     0 246327    63805     9426   270336        0             0 unattended-upgr
Oct 16 08:16:34 [ 247750]     0 247750   231182     4358   241664        0          -900 snapd
Oct 16 08:16:34 [ 247758]     0 247758     3222     1208    65536        0             0 dpkg
Oct 16 08:16:34 [ 247944]   114 247944   440219    86176  1081344        0             0 mysqld
Oct 16 08:16:34 [ 247965]     0 247965      652      124    45056        0             0 linux-modules-e
Oct 16 08:16:34 [ 247966]     0 247966    16907    15923   172032        0             0 depmod
Oct 16 08:16:34 oom-kill:constraint=CONSTRAINT_NONE,nodemask=(null),cpuset=/,mems_allowed=0,global_oom,task_m
emcg=/system.slice/mysql.service,task=mysqld,pid=247944,uid=114
Oct 16 08:16:34 Out of memory: Killed process 247944 (mysqld) total-vm:1760876kB, anon-rss:344704kB, file-rss
:0kB, shmem-rss:0kB, UID:114 pgtables:1056kB oom_score_adj:0
~~~


~~~
	    rss	KB	MB
 mysqld	86176	344704	336.6
 monitoring	29590	118360	115.6
 updater	24444	97776	95.5
 depmod	15923	63692	62.2
 unattended-upgr	9856	39424	38.5
 unattended-upgr	9426	37704	36.8
 apache2	8459	33836	33.0
 apache2	8274	33096	32.3
 apache2	7631	30524	29.8
 apache2	7469	29876	29.2
 apache2	7301	29204	28.5
multipathd	4482	17928	17.5
 snapd	4358	17432	17.0
f2b/server	3216	12864	12.6
apache2	2890	11560	11.3
unattended-upgr	2787	11148	10.9
networkd-dispat	2777	11108	10.8
agent	1562	6248	6.1
systemd-resolve	1468	5872	5.7
iscsid	1353	5412	5.3
 dpkg	1208	4832	4.7
polkitd	888	3552	3.5
systemd-journal	885	3540	3.5
systemd-network	846	3384	3.3
systemd-logind	794	3176	3.1
systemd-udevd	751	3004	2.9
accounts-daemon	745	2980	2.9
rpcbind	698	2792	2.7
irqbalance	650	2600	2.5
dbus-daemon	647	2588	2.5
systemd-timesyn	621	2484	2.4
sshd	533	2132	2.1
atd	529	2116	2.1
rsyslogd	506	2024	2.0
cron	502	2008	2.0
agetty	458	1832	1.8
 apt.systemd.dai	389	1556	1.5
agetty	371	1484	1.4
 linux-modules-e	124	496	0.5
 apt.systemd.dai	118	472	0.5
iscsid	57	228	0.2
updater	14	56	0.1
 monitoring	14	56	0.1
none	1	4	0.0
~~~