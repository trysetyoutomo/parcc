var liveSearchPanel_SalesItems; 
var empGroupStore_SalesItems; 
var id_inc=0;
//Ext.Loader.setConfig({enabled: true});

Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.toolbar.Paging',
    'Ext.ux.PreviewPlugin',
    'Ext.ModelManager',
    'Ext.tip.QuickTipManager'
    ]);

function void_bayar(status, table,sale_id)
{
    //    alert(table);
    var subtotal = $('#sum_sub_total').html();
    var discount =$('#sum_sale_discount').html();
    var tax =$('#sum_sale_tax').html();
    var service=0;
    var total_cost=$('#sum_sale_total').html();
    var payment=$('#pembayaran').val();
    var paidwith=$('#payment').val();
    data = {
        sale_id : sale_id,
        subtotal : subtotal,
        discount : discount,
        tax : tax,
        service : service,
        total_cost : total_cost,
        payment : payment,
        paidwith : paidwith,
        status : status,
        table : table
    };
    var data_detail = [];
    var inc = 0;
    liveSearchPanel_SalesItems.store.each(function (rec) { 
        //        var temp = new Array(10,10);
        //        temp['item_price'].push(rec.get('item_total_cost'));
        //        data_detail[0]['quantity_purchased']=rec.get('quantity_purchased');
        data_detail[inc] = {
            "item_id":rec.get('item_id'),
            "quantity_purchased":rec.get('quantity_purchased'),
            "item_tax":rec.get('item_tax'),
            "item_discount":rec.get('item_discount'),
            "item_price":rec.get('item_price'),
            "item_total_cost":rec.get('item_total_cost')
        };
        inc=inc+1;
    });
    //    console.log(data_detail);

    $.ajax({
        url : '/postech/index.php?r=sales/void',
        data : {
            data:data,
            data_detail:data_detail
        },
        success : function(data)
        {
            //var obj = jQuery.parseJSON(data);
             
            if (data=="success")
            {
                $("#dialog_bayar").dialog("close");
                liveSearchPanel_SalesItems.store.removeAll();
                $('#sum_sub_total').html(0);
                $('#sum_sale_discount').html(0);
                $('#sum_sale_tax').html(0);
                
                $('#sum_sale_total').html(0);
                $('#pembayaran').val(0);
                $('#payment').val(0);
                $("#e1").select2("close");
                $('#dialog_meja').load('index.php?r=site/table');
      
               
                show_meja('Meja');
            }
        },
        error : function(data)
        {
            //alert(data);
            $('#dialog_meja').load('index.php?r=site/table');
        }
    });
}

function useDefaultPrinter() {
    var applet = document.jzebra;
    if (applet != null) {
        // Searches for default printer
        applet.findPrinter();
    }
         
    monitorFinding();
}
function monitorFinding() {
    var applet = document.jzebra;
    if (applet != null) {
        if (!applet.isDoneFinding()) {
            window.setTimeout('monitorFinding()', 100);
        } else {
            var printer = applet.getPrinter();
            alert(printer == null ? "Printer not found" : "Printer \"" + printer + "\" found");
        }
    } else {
        alert("Applet not loaded!");
    }
}

function print_bayar(data) {
    useDefaultPrinter();
    var applet = document.jzebra;
    if (applet != null) {
        // Send characters/raw commands to applet using "append"
        // Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
        applet.append(data.logo);
        applet.append("\n");
        // applet.append(data.sale_id);
        applet.append(data.alamat);
        applet.append("\n");
        applet.append(data.no_telp);
        applet.append("\n");
        applet.append(data.no_nota);
        applet.append("\n");
        applet.append(data.trx_tgl);
        applet.append("\n\n");
        applet.append(data.no_meja);
        applet.append("\n");
        applet.append(data.pembatas);
        applet.append("\n");
        // var sales = jQuery.parseJSON(data);
        $.each(data.detail, function(i,cetak) {
            applet.append(cetak.quantity);
            applet.append("\n");
            applet.append(cetak.nama_item);
            applet.append("\n");
        });
        applet.append(data.pembatas);
        applet.append("\n");
        applet.append(data.subtotal);
        applet.append(data.discount);
        applet.append(data.service);
        applet.append(data.ppn);
        applet.append(data.pembatas);
        applet.append("\n");
        applet.append(data.total);
        applet.append(data.bayar);
        applet.append(data.kembali);
        applet.append(data.line_bawah);
        applet.append(data.slogan);
        applet.append(data.pcm);
        // applet.append("A590,1570,2,3,1,1,N,\"Testing the print() function\"\n");
        // applet.append("Ramdani memang kasep \n");
			
        applet.append("\n");
        applet.append("\n");
        applet.append("\n");
        applet.append("\n");
        applet.append("\x1Bm"); 
       // alert(data);
            
        // Send characters/raw commands to printer
        applet.print();
    }

}

function add_item()
{
    $.ajax({
        url : '/postech?r=items/check',
        data : 'id='+$("#e1").val(),
        success : function(data)
        {
            //            alert(data);
            var obj = jQuery.parseJSON(data);
            var total = obj.unit_price * $("#qty").val()
            var discount = total * $("#discount").val() / 100;
                
            var tax = $("#qty").val()*obj.tax_percent;
            var total_cost = total-discount+tax;
            id_inc = id_inc + 1;    
            var r = Ext.create('SalesItems', {
                id : id_inc,
                item_id:  $("#e1").val(),
                quantity_purchased: $("#qty").val(),
                item_tax: obj.tax_percent*$("#qty").val(),
                item_name: obj.item_name,
                item_price:obj.unit_price,
                item_discount: $("#discount").val(),
                item_total_cost:total_cost
            
            });
            liveSearchPanel_SalesItems.store.insert(0, r);
            var sum = 0;
            discount = 0;
            tax = 0;
            var subtotal = 0;
            liveSearchPanel_SalesItems.store.each(function (rec) { 
                subtotal += rec.get('item_price')*rec.get('quantity_purchased'); 
                sum += rec.get('item_total_cost'); 
                discount += rec.get('item_discount') * (rec.get('item_price')*rec.get('quantity_purchased')) /100 ; 
                tax += rec.get('item_tax'); 
            });

            $('#sum_sub_total').html(subtotal);
            $('#sum_sale_discount').html(discount);
            $('#sum_sale_tax').html(tax);
            
            service  = 	var_service * (subtotal-discount)/ 100;
            
            $('#sum_sale_service').html(service);
            $('#sum_sale_total').html(subtotal-discount+service+tax);

            $('#total_bayar').html(subtotal-discount+service+tax);

            $("#qty").val(1);
            $("#discount").val(0);
            $("#e1").select2("open");
                
        },
        error : function(data)
        {
        //alert(data);
                
        }
    });
}


function update_bill()
{

}

function load_bill(meja,data)
{
    //    alert("meja");
    liveSearchPanel_SalesItems.store.removeAll();
    $.getJSON('/postech/index.php?r=sales/load&id='+data, function(data) {
        //         alert(jd.sales.id);
        $.each(data.si, function(key, val) {
            //            alert(val.item_price
            var r = Ext.create('SalesItems', {
                item_id:  val.item_id,
                quantity_purchased:val.quantity_purchased,
                item_tax: val.item_tax,
                item_name: val.item_name,
                item_price:val.item_price,
                item_discount: val.item_discount,
                item_total_cost:val.item_total_cost
            });
            liveSearchPanel_SalesItems.store.insert(0, r);
            kalkulasi1();

        });
    //             $('#stage').html('<p> Name: ' + jd.name + '</p>');
    //             $('#stage').append('<p>Age : ' + jd.age+ '</p>');
    //             $('#stage').append('<p> Sex: ' + jd.sex+ '</p>');
    });
          
//    $.ajax({
//        url : '/postech?r=sales/load',
//        data : 'id='+data,
//        success : function(data)
//        {
//            var obj = jQuery.parseJSON(data);
//            //            alert(obj.si.item_id);
//            var data = obj.si;
//            $.each(data, function(i, item) {
//                alert(item.item_price);
//            });​
//        //            $.each(data, function(i, item) {
//        //              //  alert(data[i].item_price);
//        //            });​
//        //            var r = Ext.create('SalesItems', {
//        //                item_id:  obj.si.item_id,
//        //                quantity_purchased:obj.si.quantity_purchased,
//        //                item_tax: obj.si.item_tax,
//        //                item_name: obj.si.item_name,
//        //                item_price:obj.si.item_price,
//        //                item_discount: obj.si.item_discount,
//        //                item_total_cost:obj.si.item_total_cost
//        //            });
//        //            liveSearchPanel_SalesItems.store.insert(0, r);
//        }
//    });
}

function bayar(status,table,sale_id)
{
    //    alert(sale_id); 
    var subtotal = $('#sum_sub_total').html();
    var discount =$('#sum_sale_discount').html();
    var tax =$('#sum_sale_tax').html();
    var service=$('#sum_sale_service').html();
    var total_cost=$('#sum_sale_total').html();
    var payment=$('#pembayaran').val();
    var paidwith=$('#payment').val();
    data = {
        sale_id : sale_id,
        subtotal : subtotal,
        discount : discount,
        tax : tax,
        service : service,
        total_cost : total_cost,
        payment : payment,
        paidwith : paidwith,
        status : status,
        table : table
    };
    var data_detail = [];
    var inc = 0;
    liveSearchPanel_SalesItems.store.each(function (rec) { 
        //        var temp = new Array(10,10);
        //        temp['item_price'].push(rec.get('item_total_cost'));
        //        data_detail[0]['quantity_purchased']=rec.get('quantity_purchased');
        data_detail[inc] = {
            "item_id":rec.get('item_id'),
            "quantity_purchased":rec.get('quantity_purchased'),
            "item_tax":rec.get('item_tax'),
            "item_discount":rec.get('item_discount'),
            "item_price":rec.get('item_price'),
            "item_total_cost":rec.get('item_total_cost')
        };
        inc=inc+1;
    });
    //    console.log(data_detail);

    $.ajax({
        url : '/postech/index.php?r=sales/bayar',
        data : {
            data:data,
            data_detail:data_detail
        },
        success : function(data)
        {
            var sales = jQuery.parseJSON(data);
            if (sales.sale_id!="")
            {
                if (sales.status == 1)
                {
                    print_bayar(sales);
                }
               
                $("#dialog_bayar").dialog("close");
                liveSearchPanel_SalesItems.store.removeAll();
                $('#sum_sub_total').html(0);
                $('#sum_sale_discount').html(0);
                $('#sum_sale_service').html(0);
                $('#sum_sale_tax').html(0);
                $('#sum_sale_total').html(0);
                $('#pembayaran').val(0);
                $('#payment').val(0);
                $("#e1").select2("close");
                $('#dialog_meja').load('index.php?r=site/table');
               
                show_meja('Meja');
				
            }
			
			
        },
        error : function(data)
        {
            alert(data);
            $('#dialog_meja').load('index.php?r=site/table');
        }
    });
}

function cetakbill()
{
    //    alert(sale_id);
    var number_meja= $("#tombol_meja").attr('value');
    number_meja =  number_meja.replace(/[^0-9]+/g, '');
    var table = number_meja;
    
    var subtotal = $('#sum_sub_total').html();
    var discount =$('#sum_sale_discount').html();
    var tax =$('#sum_sale_tax').html();
    var service=$('#sum_sale_service').html();
    var total_cost=$('#sum_sale_total').html();
    var payment=$('#pembayaran').val();
    var paidwith=$('#payment').val();
    data = {
        sale_id : 0,
        subtotal : subtotal,
        discount : discount,
        tax : tax,
        service : service,
        total_cost : total_cost,
        payment : payment,
        paidwith : paidwith,
        status : 0,
        table : table
    };
    var data_detail = [];
    var inc = 0;
    liveSearchPanel_SalesItems.store.each(function (rec) { 
        //        var temp = new Array(10,10);
        //        temp['item_price'].push(rec.get('item_total_cost'));
        //        data_detail[0]['quantity_purchased']=rec.get('quantity_purchased');
        data_detail[inc] = {
            "item_id":rec.get('item_id'),
            "quantity_purchased":rec.get('quantity_purchased'),
            "item_tax":rec.get('item_tax'),
            "item_discount":rec.get('item_discount'),
            "item_price":rec.get('item_price'),
            "item_total_cost":rec.get('item_total_cost')
        };
        inc=inc+1;
		// alert(inc);
    });
    
	//console.log(data_detail);

    $.ajax({
        url : '/postech/index.php?r=sales/hanyacetak',
        data : {
            data:data,
            data_detail:data_detail
        },
        success : function(data)
        {
            var sales = jQuery.parseJSON(data);
            if (sales.sale_id!="")
            {
                print_bayar(sales);
                // $.each(sales.detail, function(i,dani) {
                // // alert(dani.quantity + " " + dani.nama_item);
                // // var total_cetak = dani.logo + dani.alamat; 
                // });


                //$("#dialog_bayar").dialog("close");
             
            }
			
			
        },
        error : function(data)
        {
            alert(data);
            $('#dialog_meja').load('index.php?r=site/table');
        }
    });
}

Ext.onReady(function() {
    var id = 0
    $('#add_item').click(function () {
        
        
        
        
    
        });
       
    
    
    empGroupStore_SalesItems = Ext.create('Ext.data.Store', {
        model:'SalesItems',
        pageSize:20,
        proxy:{
            type:'ajax',
            url:'index.php?r=salesitemshb/list',
            reader:{
                type:'json',
                root:'data',
                totalProperty:'totalCount'
            }
        },
        autoLoad:{
            start: 0, 
            limit: 25
        }
    });

    liveSearchPanel_SalesItems=Ext.create('Ext.grid.Panel',{
        id : 'ext_sales_items',
        searchUrl:'index.php?r=salesitems/list',
        title: 'SalesItems',
        listeners: {
            keyup: {
                element: 'el',
                fn: function (eventObject, htmlElement, object, options) {
                 
                    //                    alert(eventObject.keyCode);]\
                    
                    if (eventObject.keyCode===46)
                    {
                        var pGrid = Ext.ComponentMgr.get('ext_sales_items');
                        //                        alert(pGrid.id);
                        id = pGrid.selModel.getCurrentPosition().row;
                        record=pGrid.getStore().getAt(id);
                        pGrid.store.remove(record);
                        pGrid.getView().focus(); 
                        pGrid.getSelectionModel().select(0);
                        kalkulasi();
                    }
                }
            }
        },
        //    store: empGroupStore_SalesItems,
        plugins: [
        Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToEdit: 7,
            listeners: {
                edit: function(editor,e){
                    Ext.Ajax.request({
                        url: 'index.php?r=salesitems/update&id=' + e.record.get('id'),
                        params: e.record.data,
                        success: function(){ 
                            e.record.commit();
                            empGroupStore_SalesItems.load();
                        }
                    })
                }
            }
        })
        ], 
       
        columns: [		{
            text:'id',
            flex:1,
            sortable:false,
            dataIndex:'id',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            },
            hidden : true
        },
        {
            text:'sale_id',
            flex:1,
            sortable:false,
            dataIndex:'sale_id',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            },
            hidden:true
        },
        {
            text:'Nama Item',
            flex:1,
            sortable:false,
            dataIndex:'item_id',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            },
            hidden:true
        },
        {
            text:'Nama Item',
            flex:1,
            sortable:false,
            dataIndex:'item_name',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            }
        },
        {
            text:'Jumlah',
            flex:1,
            sortable:false,
            dataIndex:'quantity_purchased',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            }
        },
     
        {
            text:'Harga',
            flex:1,
            sortable:false,
            dataIndex:'item_price',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            }
        },
        {
            text:'Discount(%)',
            flex:1,
            sortable:false,
            dataIndex:'item_discount',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            }
        },
        {
            text:'Pajak',
            flex:1,
            sortable:false,
            dataIndex:'item_tax',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            }
        },
        {
            text:'Total',
            flex:1,
            sortable:false,
            dataIndex:'item_total_cost',
            editor   : {
                xtype:'textfield',
                allowBlank:false
            }
        },
		
        {
            text:'Action',
            flex:1,
            xtype:'actioncolumn',
            items:[
            {
                icon:'icon/delete.gif',
                handler:function(grid,rowIndex,colIndex,item,e){
                    id=grid.getStore().getAt(rowIndex,colIndex);
                    grid.store.remove(id);
                    kalkulasi();
                }
            }
            ]
        }
        ],
        height: 200,
        viewConfig: {
            stripeRows: true
        },
        renderTo : 'sales_items'

    }); 
	
    function kalkulasi()
    {
        //alert('kalkulasi');
        var sum = 0;
        var discount = 0;
        var tax = 0;
        var subtotal = 0;
        //alert('test');
        liveSearchPanel_SalesItems.store.each(function (rec) { 
            subtotal += rec.get('item_price')*rec.get('quantity_purchased'); 
            sum += rec.get('item_total_cost'); 
            discount += rec.get('item_discount') * (rec.get('item_price')*rec.get('quantity_purchased')) /100 ; 
            tax += rec.get('item_tax'); 
        });

        $('#sum_sub_total').html(subtotal);
        $('#sum_sale_discount').html(discount);
        $('#sum_sale_tax').html(tax);
        service  = 	var_service * (subtotal-discount)/ 100;
            
        $('#sum_sale_service').html(service);
        $('#sum_sale_total').html(subtotal-discount+service+tax);
        $('#total_bayar').html(subtotal-discount+tax+service);
    }

});

