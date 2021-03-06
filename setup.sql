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

--Create sequences for auto-incr ids
create sequence test_seq start with 1 increment by 1 nomaxvalue;

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
   user_name varchar(24),
   photo_id int,
   PRIMARY KEY(user_name,photo_id)
);

--MAKE DUH DATA CUBE
create view data_cube as
   select owner_name, subject, extract(year from timing) as tYear, extract(month from timing)
   as tMonth, to_number(to_char(timing,'WW')) as tWeek, count(owner_name) as image_count
   from images
   group by cube (owner_name, subject, timing, extract(year from timing),
      extract(month from timing), to_number(to_char(timing,'WW')));

--INDEXES MAN
create index subject_index on images(subject) indextype is ctxsys.context;
create index desc_index on images(description) indextype is ctxsys.context;
create index place_index on images(place) indextype is ctxsys.context;

--indexes update on interval
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

commit;

