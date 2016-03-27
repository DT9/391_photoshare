sqlplus -s /nolog <<EOF
connect dtruong1/hunter23
@setup.sql
commit;
quit
EOF
sqlplus -s /nolog <<EOF
connect dtruong1/hunter23
@ins.sql
commit;
quit
EOF

sqlldr control=lob.ctl userid=dtruong1/hunter23

sqlplus -s /nolog <<EOF
connect jianle/drag0ngamer
@setup.sql
commit;
quit
EOF

sqlplus -s /nolog <<EOF
connect jianle/drag0ngamer
@ins.sql
commit;
quit
EOF

sqlldr control=lob.ctl userid=jianle/drag0ngamer

sqlplus -s /nolog <<EOF
connect chengyao/chengyao00308900
@setup.sql
commit;
quit
EOF

sqlplus -s /nolog <<EOF
connect chengyao/chengyao00308900
@ins.sql
commit;
quit
EOF

sqlldr control=lob.ctl userid=chengyao/chengyao00308900
