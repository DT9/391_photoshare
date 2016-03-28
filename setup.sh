#!/bin/bash
chmod 755 -R .

if [ -n "$1" -a -n "$2" ]
then
  sqlplus $1/$2 @setup.sql
  #sqlplus $1/$2 @ins.sql
  #sqlldr control=lob.ctl userid=$1/$2
  sed -i 7s/.*/"$$"conn = oci_connect(\"$1\",\"$2\");/ connection_database.php; \
  sed -i '7s/"$$"/$$/' connection_database.php; \

fi

sqlplus dtruong1/hunter23 @setup.sql
sqlplus dtruong1/hunter23 @setup.sql
sqlldr control=lob.ctl userid=dtruong1/hunter23

sqlplus jianle/drag0ngamer @setup.sql
sqlplus jianle/drag0ngamer @ins.sql
sqlldr control=lob.ctl userid=jianle/drag0ngamer

sqlplus chengyao/chengyao00308900 @setup.sql
sqlplus chengyao/chengyao00308900 @ins.sql
sqlldr control=lob.ctl userid=chengyao/chengyao00308900
