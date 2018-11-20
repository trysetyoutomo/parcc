var liveSearchPanel_SalesItems; 
var empGroupStore_SalesItems; 
var id_inc=0;
var Ext;
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
                $('#sum_sale_service').html(0);
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
function chr(i){	
	return String.fromCharCode(i);
}


function print_bayar(data) {
    useDefaultPrinter();
    var applet = document.jzebra;
    if (applet != null) {
	
        // Send characters/raw commands to applet using "append"
        // Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
       // applet.append(chr(27)+chr(69)+"\r");//perintah untuk bold
       // applet.append(chr(27)+"\x61"+"\x31"); //perintah untuk center
        // applet.append(data.sale_id);
		var ulangi;
		if (data.cd==0)
			ulangi = 1;
		else
			ulangi = 2;
			
		for(a=1;a<=ulangi;a++){
		applet.append(data.logo);
        applet.append("\n");
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
		applet.append(data.kasir);
		
		
        applet.append("\n");
        applet.append(data.pembatas);
        applet.append("\n");
		
 //       applet.print();
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
		
		
		//alert('berhasil');
        // applet.append("A590,1570,2,3,1,1,N,\"Testing the print() function\"\n");
        // applet.append("27,112,0,55,27\"Testing the print() function\"\n");
        
        // applet.append("Ramdani memang kasep \n");
			
        applet.append("\n");
        applet.append("\n");
        applet.append("\n");
        applet.append("\n");
        applet.append("\x1Bm"); 
		
	    
		// applet.print();
		// alert('lewat');
		// console.log(data);
		
		
         applet.print(); 
		}
		   
		
		
        // Send characters/raw commands to printer
		if (data.cd!=0){
			applet.append(chr(27)+"\x70"+"\x30"+chr(25)+chr(25)+"\r");
       }
		
		//console.log(data);
//		window.reload();
		// window.location.href + "/../sample.pdf";
    }

}

//---------------------------
function print_rekap(data) {
    useDefaultPrinter();
    // var applet = document.jzebra;
    var applet = document.jzebra;
    if (applet != null) {
        // Send characters/raw commands to applet using "append"
        applet.append(data.logo);
        applet.append("\n");
        // applet.append(data.sale_id);
        applet.append(data.alamat);
        applet.append("\n");
        applet.append(data.no_telp);
        applet.append("\n");
        // applet.append(data.no_nota);
        // applet.append("\n");
        applet.append(data.trx_tgl);
        applet.append("\n\n");
        // applet.append(data.no_meja);
        // applet.append("\n");
		
        applet.append(data.kasir);
        applet.append("\n");
        applet.append(data.pembatas);
        applet.append("\n");
		applet.append(data.detail.gross);
		applet.append(data.detail.grossvalue);
        applet.append("\n");
		applet.append(data.detail.net);
		applet.append(data.detail.netvalue);
        applet.append("\n");
		applet.append(data.detail.disc);
		applet.append(data.detail.discvalue);
        applet.append("\n");
		applet.append(data.detail.svc);
		applet.append(data.detail.svcvalue);
        applet.append("\n");
		applet.append(data.detail.tax);
		applet.append(data.detail.taxvalue);
        applet.append("\n");

		applet.append(data.pembatas);
		applet.append("\n");
		//keuangan
		applet.append(data.detail.comp);
		applet.append(data.detail.compvalue);
        applet.append("\n");
		applet.append(data.detail.netcash);
		applet.append(data.detail.netcashvalue);
     
        applet.append("\n");
		applet.append(data.detail.bca);
		applet.append(data.detail.bcavalue);
        applet.append("\n");
		applet.append(data.detail.mandiri);
		applet.append(data.detail.mandirivalue);
        applet.append("\n");
		applet.append(data.detail.niaga);
		applet.append(data.detail.niagavalue);
        applet.append("\n");
		applet.append(data.pembatas);
		applet.append("\n");
		
		
		$.each(data.detail2, function(i,cetak){
			applet.append(cetak.dept);
			applet.append("\n");
			applet.append(cetak.pembatas);
			applet.append("\n");
			applet.append(cetak.table);
			applet.append("\n");
		});
		
		// jQuery.each(data.detail, function(){
			// jQuery.each(this, function () {
                // // applet.append(this.gross);
				// // applet.append("\n");
            // });
		// });
		
        // $.each(data.detail2, function() {
			// $.each(this, function(i,cetak){
				// // applet.append(cetak.dept);
				// // applet.append("\n");
				// // applet.append(cetak.pembatas);
				// // applet.append("\n");
				// // applet.append(cetak.table);
				// // applet.append("\n");
			// });
        // });
			
        applet.append(data.total);
        applet.append("\n");
        applet.append(data.footer);
        // applet.append("\n");
        applet.append(data.footer2);
        applet.append("\n");
        applet.append("\n");
        applet.append("\n");
        applet.append("\n");
        applet.append("\x1Bm"); 
       // alert(data);
            
		// console.log(data);
        // Send characters/raw commands to printer
      
		applet.print();
		// window.location.href + "/../sample.pdf";
    }
}
//---------------------------

function add_item()
{
//alert(var_service);
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
			// var taxdisc = tax*10/100 ;
			// var totaltax = tax - taxdisc;
            // var total_cost = total-discount+totaltax;
            var total_cost = total-discount+tax;
            id_inc = id_inc + 1;    
            var r = Ext.create('SalesItems', {
                id : id_inc,
                item_id:  $("#e1").val(),
                quantity_purchased: $("#qty").val(),
                // item_tax: obj.tax_percent*$("#qty").val(),
                item_tax: tax,
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

			// tax = (subtotal-discount)/10;
			
            $('#sum_sub_total').html(subtotal);
            $('#sum_sale_discount').html(Math.round(discount));
            $('#sum_sale_tax').html(Math.round(tax));
            
			 
             service  = 	var_service * (subtotal-discount)/ 100;
            //service  = 	0;
            
            $('#sum_sale_service').html(Math.round(service));
            $('#sum_sale_total').html(Math.round(subtotal-discount+service+tax));

            $('#total_bayar').html(Math.round(subtotal-discount+service+tax));

            $("#qty").val(1);
            //$("#discount").val(0);
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
                // console.log(data);return false;
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

// function cetakReport(){
	// // alert('cek');
	// $.ajax({
        // url : '/postech/index.php?r=sales/cetakReport',
        // // data : {
            // // submit:true,
            // // // data_detail:data_detail
        // // },
        // success : function(result)
        // {
			// // alert('cek');
            // var sales = jQuery.parseJSON(result);
            // if (sales.sale_id!="")
            // {
				// print_bayar(sales);
            // }
        // },
        // error : function(result)
        // {
            // alert('error');
            // // $('#dialog_meja').load('index.php?r=site/table');
        // }
    // });
// }

function bayar(status,table,sale_id)
{
//    alert(sale_id); 
    var subtotal = $('#sum_sub_total').html();
    var discount =$('#sum_sale_discount').html();
    var tax =$('#sum_sale_tax').html();
    //var service=0;
    var total_cost=$('#sum_sale_total').html();
    var payment=$('#pembayaran').val();
    var payment2=$('#pembayaran2').val();
    var paidwith2=$('#payment2').val();
    var paidwith=$('#payment').val();
    var custype=$('#custype').val();
  
  
	data = {
        sale_id : sale_id,
        subtotal : subtotal,
        discount : discount,
        tax : tax,
        service : service,
        total_cost : total_cost,
        payment : payment,
        payment2 : payment2,
        paidwith2 : paidwith2,
        paidwith : paidwith,
        status : status,
        table : table,
        custype : custype
    };
    
					console.log(data);
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
	
	//alert();
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
               
                $("#dialog_bayar").dialog("close");
                liveSearchPanel_SalesItems.store.removeAll();
                $('#sum_sub_total').html(0);
                $('#sum_sale_discount').html(0);
                $('#sum_sale_service').html(0);
                $('#sum_sale_tax').html(0);
                $('#sum_sale_total').html(0);
                $('#pembayaran').val(0);
                $('#pembayaran2').val(0);
                $('#payment').val(0);
                $('#payment2').val(0);
                $("#e1").select2("close");
                $('#dialog_meja').load('index.php?r=site/table');
				$('select option[value="1"]').attr("selected",true);
               
                show_meja('Meja');
				
                if (sales.status == 1)
                {
                    print_bayar(sales);
                  //S  print_bayar(sales);
				//	window.location.reload();
                }
            }
			
			
        },
        error : function(data)
        {
            alert(data);
            $('#dialog_meja').load('index.php?r=site/table');
        }
    });
}

function editdiskongrid(){
	//ambil data dari grid
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
            "item_name":rec.get('item_name'),
            "item_discount":rec.get('item_discount'),
            "item_price":rec.get('item_price'),
            "item_total_cost":rec.get('item_total_cost')
        };
        inc=inc+1;
		console.log(data_detail);
		});
		//remove isi grid
		liveSearchPanel_SalesItems.store.removeAll();

		var ediskon = $('#discount').val();
		
		for (i = 0; i < data_detail.length; i++) {
			// alert(data_detail[i].name);
			var hargatotal = data_detail[i].quantity_purchased * data_detail[i].item_price;
			var potongan = (hargatotal*ediskon)/100;
			var itcost = hargatotal-potongan+data_detail[i].item_tax;
			
			var r = Ext.create('SalesItems', {
                item_id:  data_detail[i].item_id,
                quantity_purchased:data_detail[i].quantity_purchased,
                item_tax: data_detail[i].item_tax,
                item_name: data_detail[i].item_name,
                item_price:data_detail[i].item_price,
                // item_discount: val.item_discount,
                item_discount: ediskon,
                item_total_cost: itcost
			});
			// alert(i);
			liveSearchPanel_SalesItems.store.insert(0, r);
            kalkulasi1();
		}
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
    });
    //    console.log(data_detail);

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
/*
function cetakbill()
{
    //    alert(sale_id);
    var number_meja= $("#tombol_meja").attr('value');
    number_meja =  number_meja.replace(/[^0-9]+/g, '');
    var table = number_meja;
    
    var subtotal = $('#sum_sub_total').html();
    var discount =$('#sum_sale_discount').html();
    var tax =$('#sum_sale_tax').html();
    var service=0;
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
    });
    //    console.log(data_detail);

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
            //alert(data);
            alert("silahkan isikan menu terlebih dahulu");
            $('#dialog_meja').load('index.php?r=site/table');
        }
    });
}
*/
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

		// tax = (subtotal-discount)/10;
		
        $('#sum_sub_total').html(subtotal);
        $('#sum_sale_discount').html(Math.round(discount));
        $('#sum_sale_tax').html(Math.round(tax));
        service  = 	var_service * (subtotal-discount)/ 100;
        //service  = 	0;
            
        $('#sum_sale_service').html(Math.round(service));
        $('#sum_sale_total').html(Math.round(subtotal-discount+service+tax));
        $('#total_bayar').html(Math.round(subtotal-discount+tax+service));
    }

});

