select owner_name, subject, timing
from images
where 
group by cube(owner_name,subject,timing);

select owner_name, subject, timing
from images 
where timing in ('20-MAR-01','20-MAR-99')
group by rollup(owner_name,subject,timing);

select owner_name, subject, timing
from images
group by cube(owner_name,subject,timing);

GROUPING(channel_desc) AS Ch,
   GROUPING(calendar_month_desc) AS Mo, GROUPING(country_iso_code) AS Co


   HAVING (GROUPING(channel_desc)=1 AND GROUPING(calendar_month_desc)= 1 
  AND GROUPING(country_iso_code)=1) OR (GROUPING(channel_desc)=1 
  AND GROUPING (calendar_month_desc)= 1) OR (GROUPING(country_iso_code)=1
  AND GROUPING(calendar_month_desc)= 1);

