
INSERT INTO users VALUES ('john', 'john123', TO_DATE('31/1/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('donald', 'donald123', TO_DATE('2/11/2013 2:19:32', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('donald2', 'donald123',  TO_DATE('24/12/2013 19:17:2', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('marilyn', 'marilyn123',  TO_DATE('12/5/2013 20:12:51', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('nathaniel', 'nathaniel123', TO_DATE('31/1/2015 13:11:32', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('admin', 'admin', TO_DATE('31/1/2015 13:11:32', 'DD/MM/YYYY hh24:mi:ss'));

INSERT INTO persons VALUES ('john', 'John', 'Doe', '1248 Blane Street', 'johndoe@yahoo.com', '3145542033');
INSERT INTO persons VALUES ('donald', 'Donald', 'Stein', '2734 Veltri Drive', 'dstein@yahoo.com', '3335552233');
INSERT INTO persons VALUES ('donald2', 'Bridget', 'McManus', '113 Hedge Street', 'mmbridget@yahoo.com', '6475133212');
INSERT INTO persons VALUES ('marilyn', 'Marilyn', 'Austin', '742 Dennison Street', 'maustin@yahoo.com', '5144321234');
INSERT INTO persons VALUES ('nathaniel', 'Nathaniel', 'Torres', '122 Carriage Court', 'ntorres@yahoo.com', '6477122233');

INSERT INTO groups values (1,null,'public', sysdate);
INSERT INTO groups values (2,null,'private',sysdate);
INSERT INTO groups VALUES (3, 'john', 'john', TO_DATE('31/1/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO groups VALUES (4, 'john', 'johnboy', TO_DATE('2/11/2013 2:19:32', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO groups VALUES (5, 'donald', 'donald', TO_DATE('2/11/2013 2:19:32', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO groups VALUES (6, 'donald2', 'donald2', TO_DATE('24/12/2013 19:17:2', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO groups VALUES (7, 'marilyn', 'marilyn', TO_DATE('12/5/2013 20:12:51', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO groups VALUES (8, 'nathaniel', 'nathaniel', TO_DATE('31/1/2015 13:11:32', 'DD/MM/YYYY hh24:mi:ss'));

INSERT INTO group_lists VALUES (1, 'john', TO_DATE('30/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai1');
INSERT INTO group_lists VALUES (3, 'john', TO_DATE('30/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai1');
INSERT INTO group_lists VALUES (2, 'donald2', TO_DATE('21/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai2');
INSERT INTO group_lists VALUES (4, 'marilyn', TO_DATE('11/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai3');
INSERT INTO group_lists VALUES (4, 'donald', TO_DATE('12/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai4');
INSERT INTO group_lists VALUES (5, 'nathaniel', TO_DATE('01/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai5');


COMMIT;
quit;