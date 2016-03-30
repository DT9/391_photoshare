LOAD DATA 
INFILE 'lob.txt'
   INTO TABLE images
   FIELDS TERMINATED BY ','   
   (photo_id CHAR(10),
   owner_name  char(24),
   permitted   CHAR(10),
   subject     CHAR(128),
   place       CHAR(128),
   timing      date,
   description CHAR(2048),
   t_filename     FILLER CHAR(100),
   r_filename     FILLER CHAR(100),
   thumbnail   LOBFILE(t_filename) TERMINATED BY EOF,
   photo       LOBFILE(r_filename) TERMINATED BY EOF)
