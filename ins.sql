
//drops all tables
BEGIN
   FOR cur_rec IN (SELECT object_name, object_type
                     FROM user_objects
                    WHERE object_type IN
                             ('TABLE',
                              'VIEW',
                              'PACKAGE',
                              'PROCEDURE',
                              'FUNCTION',
                              'SEQUENCE'
                             ))
   LOOP
      BEGIN
         IF cur_rec.object_type = 'TABLE'
         THEN
            EXECUTE IMMEDIATE    'DROP '
                              || cur_rec.object_type
                              || ' "'
                              || cur_rec.object_name
                              || '" CASCADE CONSTRAINTS';
         ELSE
            EXECUTE IMMEDIATE    'DROP '
                              || cur_rec.object_type
                              || ' "'
                              || cur_rec.object_name
                              || '"';
         END IF;
      EXCEPTION
         WHEN OTHERS
         THEN
            DBMS_OUTPUT.put_line (   'FAILED: DROP '
                                  || cur_rec.object_type
                                  || ' "'
                                  || cur_rec.object_name
                                  || '"'
                                 );
      END;
   END LOOP;
END;
/

drop sequence test_seq;
drop sequence pic_id_sequences;
--Create sequences for auto-incr ids
create sequence test_seq start with 1 increment by 1 nomaxvalue; 
create sequence picsbro start with 4 increment by 1 nomaxvalue; 

//creates tables
CREATE TABLE users (
   user_name varchar(24),
   password  varchar(24),
   date_registered date,
   primary key(user_name)
);

CREATE TABLE persons (
   user_name  varchar(24),
   first_name varchar(24),
   last_name  varchar(24),
   address    varchar(128),
   email      varchar(128),
   phone      char(10),
   PRIMARY KEY(user_name),
   UNIQUE (email),
   FOREIGN KEY (user_name) REFERENCES users
);


CREATE TABLE groups (
   group_id   int,
   user_name  varchar(24),
   group_name varchar(24),
   date_created date,
   PRIMARY KEY (group_id),
   UNIQUE (user_name, group_name),
   FOREIGN KEY(user_name) REFERENCES users
);

CREATE TABLE group_lists (
   group_id    int,
   friend_id   varchar(24),
   date_added  date,
   notice      varchar(1024),
   PRIMARY KEY(group_id, friend_id),
   FOREIGN KEY(group_id) REFERENCES groups,
   FOREIGN KEY(friend_id) REFERENCES users
);

CREATE TABLE images (
   photo_id    int,
   owner_name  varchar(24),
   permitted   int,
   subject     varchar(128),
   place       varchar(128),
   timing      date,
   description varchar(2048),
   thumbnail   blob,
   photo       blob,
   PRIMARY KEY(photo_id),
   FOREIGN KEY(owner_name) REFERENCES users,
   FOREIGN KEY(permitted) REFERENCES groups
);
CREATE TABLE photo_count (
   photo_id int,
   count int,
   place_count int,
   description int,
   PRIMARY KEY(photo_id),
   FOREIGN KEY(photo_id) REFERENCES images
);


INSERT INTO users VALUES ('john', 'john123', TO_DATE('31/1/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('donald', 'donald123', TO_DATE('2/11/2013 2:19:32', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('donald2', 'donald123',  TO_DATE('24/12/2013 19:17:2', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('marilyn', 'marilyn123',  TO_DATE('12/5/2013 20:12:51', 'DD/MM/YYYY hh24:mi:ss'));
INSERT INTO users VALUES ('nathaniel', 'nathaniel123', TO_DATE('31/1/2015 13:11:32', 'DD/MM/YYYY hh24:mi:ss'));

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
INSERT INTO group_lists VALUES (2, 'donald2', TO_DATE('21/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai2');
INSERT INTO group_lists VALUES (4, 'marilyn', TO_DATE('11/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai3');
INSERT INTO group_lists VALUES (4, 'donald', TO_DATE('12/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai4');
INSERT INTO group_lists VALUES (5, 'nathaniel', TO_DATE('01/01/2011 12:12:12', 'DD/MM/YYYY hh24:mi:ss'),'notice me senpai5');

--MAKE DUH DATA CUBE
create view data_cube as 
   select owner_name, subject, extract(year from timing) as tYear, extract(month from timing) 
   as tMonth, to_number(to_char(timing,'WW')) as tWeek, count(*) as image_count 
   from images 
   group by cube (owner_name, subject, timing, extract(year from timing), 
      extract(month from timing), to_number(to_char(timing,'WW')));

--INDEXES MAN
create index name_index on images(owner_name) indextype is ctxsys.context;
create index subject_index on images(subject) indextype is ctxsys.context;
create index date_index on images(timing);
create index desc_index on images(description) indextype is ctxsys.context;
create index place_index on images(place) indextype is ctxsys.context;

--make dem indexes update bro
define interval = "3"
set serveroutput on
declare
   type array_t is table of varchar2(20);
   array array_t := array_t('name_index', 'subject_index', 'date_index','desc_index','place_index');
   job number;   
begin
   for i in 1..array.count loop
      dbms_job.submit(job, 'ctx_ddl.sync_index(''array(i)'');',
      interval=>'SYSDATE+&interval/1440');
      commit;
      dbms_output.put_line('job '||job||' has been submitted.');
   end loop;
end;


COMMIT;
