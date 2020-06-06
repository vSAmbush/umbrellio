drop schema if exists test cascade;
create schema test;
set search_path to test;

create table users (
	id bigserial,
	id_group bigint
);

insert into users (id_group) values (1), (1), (1), (2), (1), (3);

-- with cte as (select  row_number() over (order by id) as rn, * from users),
-- 	 res_group as (select  u.*, 
-- 						(select  max(ID) from cte as ct where
-- 					 		not exists (select * from cte where rn = ct.rn - 1 and id_group = ct.id_group)
--                      		and ct.id <= u.id) as sort_id
--         		   from  users as u)
-- select sort_id as min_id, id_group, count(sort_id) from res_group group by id_group, sort_id order by sort_id;

-- working only with serial (auto_increment) id
with cte as (
	select *, 
		row_number() over(partition by group_id order by id) as group_rn, -- put all equal group_ids together and count them like (1, 1, 1, 2 => 1, 2, 3, 1)
		id - row_number() OVER (PARTITION BY group_id ORDER BY id) AS clue -- this is a solution - where countinuos group clue will be equal (1, 1, 2, 2, => 3, 3, 4, 4)
	from users
)
select 
	min(id) as min_id,
	group_id,
	count(*)
from cte
group by group_id, clue
order by min_id;

