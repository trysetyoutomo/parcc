select 
s.id ,
distinct(s.date),
if(i.kode_outlet=2,si.item_total_cost,0) as pcm,
if(i.kode_outlet=1,si.item_total_cost,0) as paradaya

from  
sales s,
items i,
sales_items si

where 
i.id=si.item_id
and
s.id=si.sale_id

group by date(s.date)
