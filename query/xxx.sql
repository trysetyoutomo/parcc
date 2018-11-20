select 

s.date,
s.date,i.kode_outlet,o.nama_outlet,
sum(si.item_total_cost)


from 
sales s,
items i,
sales_items si,
outlet o
where 
i.id=si.item_id
and
s.id=si.sale_id
and
i.kode_outlet=o.kode_outlet
and 
date(s.date)="2014-02-23"

group by s.date