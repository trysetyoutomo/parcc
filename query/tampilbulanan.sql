select 

date(s.date),
sum(si.item_total_cost) as total,
sum(if(i.kode_outlet=1,si.item_total_cost,0)) as pcm,
sum(if(i.kode_outlet=2,si.item_total_cost,0)) as paradays,
sum(if(i.kode_outlet=3,si.item_total_cost,0)) as ampera

from 
sales s,
items i,
sales_items si

where 
i.id=si.item_id
and
s.id=si.sale_id
and
month(s.date)=02 and year(s.date)=2014
group by day(s.date)