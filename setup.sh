sqlplus -s /nolog <<EOF
connect dtruong1/hunter23
@ins.sql
commit;
quit
EOF

sqlldr control=lob.ctl userid=dtruong1/hunter23
