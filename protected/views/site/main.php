<script type="text/javascript">
var liveSearchPanel_SalesItems; 
var empGroupStore_SalesItems; 
var id_inc=0;
var Ext;
var jumlah_baris;
var meja_cetak = 0;
var meja_tipe_cetak;

// Ext.Loader.setConfig({enabled: true});

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
    
	var bayar=$('#bayar').val();

    var cash=$('#cash').val();
    var edcbca=$('#edcbca').val();
    var edcniaga=$('#edcniaga').val();
    var voucher = $('#voucher').val();
    var compliment=$('#compliment').val();
    var dll=$('#dll').val();
	
	
	payment = {
		cash : cash,
		edcbca : edcbca,
		edcniaga : edcniaga,
		voucher : voucher,
		compliment : compliment,
		dll : dll
	}
	
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
       console.log(payment);

    $.ajax({
        url : 'index.php?r=sales/void',
        data : {
            data:data,
            data_detail:data_detail,
			data_payment : payment
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
                $("#dialog_bayar").dialog("close");
                $("#dialog_bayar2").dialog("close");
      
               
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
            // alert(printer == null ? "Printer not found" );
            // alert(printer == null ? "Printer not found" : "Printer \"" + printer + "\" found");
            // alert(printer == null ? "Printer not found":none);
        }
    } else {
        alert("Applet not loaded!");
    }
}
function chr(i){	
	return String.fromCharCode(i);
}

function jarak(){
		useDefaultPrinter();
		var applet = document.jzebra;
		if (applet != null) {
				applet.append("\n");
				applet.append("\x1Bm");
				applet.print();
		}
}

function print_bayar(data,fake) {
try{
	var ulang;
	if (fake==1)
		data = JSON.parse(data);
	
	// alert(data.is_fake);
	// alert(data.is_fake);
	// if (data.is_fake)
	// alert(data.alamat);
	// if (data.cd==1)
		// ulang = 2;
	// else
		// ulang = 1;

	// console.log(data);
	// for(a=1;a<=ulang;a++){
	useDefaultPrinter();
	var applet = document.jzebra;
	if (applet != null && data!= null) {

		// Send characters/raw commands to applet using "append"
		// Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
		applet.append(chr(27)+chr(69)+"\r");//perintah untuk bold
		// applet.append(chr(27)+"\x61"+"\x31"); //perintah untuk center
		applet.append(chr(27) + "\x61" + "\x31"); // center justify
		// applet.append(chr(27) + chr(33) + chr(128));//underliner
		applet.append(data.logo+"\r\n");
		applet.append(chr(27) + chr(64));//cancel character sets			
		applet.append(chr(27) + "\x61" + "\x31"); // center justify
		applet.append(data.alamat+"\r\n");
		applet.append(data.no_telp+"\r\n");
		applet.append(data.trx_tgl+"\r\n");
		applet.append(data.no_nota+"\r\n");
		applet.append(chr(27) + chr(64));//cancel character sets
		applet.append("\n");

		//applet.print();
		// alert(data.mejavalue);
		if(data.mejavalue!=null){
			applet.append(data.no_meja+data.mejavalue);
			applet.append("\n");
		}

		if(data.kasir!=null){
			applet.append(data.kasir);
		}
		applet.append("\n");

		if(data.namapelanggan!=null){
			applet.append(data.namapelanggan);
			applet.append("\n");
		}else{
			applet.append("-");
			applet.append("\n");
		}
		// applet.append("\n");


		applet.append("\n");
		applet.append(data.pembatas);
		applet.append("\n");
		// alert(JSON.stringify(data.detail));
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
		if (data.cd==1){
			applet.append(data.voucher);
		}
		applet.append(data.bayar);
		applet.append(data.kembali);
		applet.append(data.line_bawah);
		applet.append(data.slogan);
		applet.append(data.pcm);


		//alert('berhasil');
		// applet.append("A590,1570,2,3,1,1,N,\"Testing the print() function\"\n");
		// applet.append("27,112,0,55,27\"Testing the print() function\"\n");

		// applet.append("Ramdani memang kasep \n");

		// applet.append(data.cinta);
		applet.append("\n");
		applet.append("\n");
		applet.append("\n");
		applet.append("\n");
		applet.append("\n");
		applet.append("\n");
		applet.append("\n");
		applet.append("\x1Bm");
		// var multiple = applet.getAllowMultipleInstances();
		// applet.allowMultipleInstances(true);	
		// applet.setEndOfDocument("P1,1\r\n");
		// applet.setEndOfDocument("^XZ");
		// applet.setDocumentsPerSpool("2");
		// // applet.setDocumentsPerSpool(3);
		// applet.clear();	
		// applet.clear();				
		// applet.print();		
		// Send characters/raw commands to printer
		if (data.cd!=0){
		applet.append(chr(27)+"\x70"+"\x30"+chr(25)+chr(25)+"\r");
		// bayar_lagi(data);
		}
		applet.print();
		//	applet.clearException();

		// var clearPrinter = "\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b\x1b"; 
		// applet.append(clearPrinter + "This is a text" +longFF); 

		// }
	}	

	}
	catch(err) {
		alert("error :" +err);
		alert("silahkan refresh halaman ini");
	}
}

function print_items(lokasi,lokindex) {

	<?php 
	date_default_timezone_set("Asia/Jakarta"); 
	?>
	var d = new Date();
	var h = d.getHours();
	var m = d.getMinutes();
	
	// alert(lokasi);
	try { 
	var applet = document.jzebra;
	applet.findPrinter(lokasi);

	if (lokasi == "POS-80C"){
		lokasi = "BAR";
	}else{
		lokasi = "KITCHEN";
	}
 	var data_detail = [];
    var inc = 0;
	var namapel = $('#namapel').val();
	//alert(namapel);
	$(".baris").each(function() {
			var idb = $(this).find('.pk').html();
			var nama = $(this).find('.nama_menu').html();
			var lokasi = $(this).find('.pk').attr("lokasi");
			var jml = $(this).find('.jumlah').find('.input-jumlah').val();
			var permintaan = $(this).find('.permintaan').find('.area-permintaan').val();
			var belum_print = $(this).find('.pk[cetak=0]').length;
			if (belum_print!=0){
				if (lokasi==lokindex){
				     data_detail.push({
				        "item_id":idb,
				        "item_name":nama,
						"namapel":namapel,
				        "quantity_purchased":jml,
				        "permintaan":permintaan,
				        "lokasi":lokasi
				    });
				 }
			 }
	
	    inc=inc+1;

	});	
				if (data_detail.length>0){
				applet.append(chr(27) + chr(33) + chr(128));//underliner
				applet.append("\n PERMINTAAN KEPADA : "+lokasi+"\r\n");
				applet.append("\n MEJA : "+meja_cetak+"\r\n");
				applet.append(chr(27) + chr(64));//cancel character sets			
				applet.append(chr(27) + chr(64));//cancel character sets
				applet.append("\n");
				applet.append("  Tanggal : ");
				
				applet.append("<?php echo date('d M Y') ?>");
				applet.append("\n");
				//applet.append("  Jam     : ");
				//applet.append("<?php echo date('H:i:s') ?>");
				//applet.append("\n");
				applet.append("  Jam     : "+h+":"+m);
				//applet.append("<?php echo date('H:i:s');?>");
				applet.append("  Asli ");
				applet.append("\n");
				applet.append("  Waiter  : ");
				applet.append("<?php echo Yii::app()->user->name; ?>");
				applet.append("\n");
				applet.append("  Nama    : "+namapel+"\n");
				
			
				applet.append("  Tipe    : "+meja_tipe_cetak+"\n");
				applet.append("\n");
				
				
				applet.append("\n");
				applet.append("--------------------------------------");
				applet.append("\n");
				applet.append("\n");
				//applet.append("<table width = '500'>");
				//applet.append("<tr>");
				//applet.append("<th>Nama</th>");
				//applet.append("<th>Jumlah</th>");
				//applet.append("</tr>");
				//applet.append("</table>");
	        	$.each(data_detail,function(i,cetak) {
				
					if (cetak.permintaan==''){
						applet.append("  "+cetak.item_name+" x "+cetak.quantity_purchased);
						applet.append("\n");
					}else{
	        		// if (cetak.lokasi==lokindex){	
						applet.append("  "+cetak.item_name+" x "+cetak.quantity_purchased+" / '" +cetak.permintaan + "' ");
						applet.append("\n");
	        		// }
					// applet.append(cetak.nama_item);
					// applet.append("\n");
					// alert('repeat');
					}
				});
				
				 applet.append("\n");
				 applet.append("\n");
				 applet.append("\n");
				 applet.append("\n");
				 applet.append("\n");
				 applet.append("\n");
				 applet.append("\n");
				 applet.append("\x1Bm"); 
				// applet.append("______________________")
				applet.print();
				}
				return true;
			}
		catch(err) {
	        alert(err);
	        alert("tidak bisa print , halaman ini akan reload, dan silahkan ulangi kembali penginputan menu ! ");
	        window.location.reload();
	        exit;
	        return false;
	    }
}


function opencash(){
useDefaultPrinter();
 var applet = document.jzebra;
  applet.append(chr(27)+"\x70"+"\x30"+chr(25)+chr(25)+"\r");
  applet.print();
}


//---------------------------
function print_rekap(data) {
// alert("123");
    useDefaultPrinter();
    // var applet = document.jzebra;
	
    var applet = document.jzebra;
    if (applet != null) {
        // Send characters/raw commands to applet using "append"
        applet.append(chr(27) + "\x61" + "\x31"); // center justify
		applet.append(chr(27) + chr(33) + chr(128));//underliner
		applet.append(data.logo+"\r\n");
		applet.append(chr(27) + chr(64));//cancel character sets			
        applet.append(chr(27) + "\x61" + "\x31"); // center justify
		applet.append(data.alamat+"\r\n");
        applet.append(data.no_telp+"\r\n");
        applet.append(data.trx_tgl+"\r\n");
		applet.append(chr(27) + chr(64));//cancel character sets
        applet.append("\n");
        // applet.append(data.no_meja);
        // applet.append("\n");
		
        applet.append(data.kasir);
        applet.append("\n");
        applet.append(data.tgl_cetak);
        applet.append("\n");
        applet.append(data.pembatas);
        applet.append("\n");
		
		applet.append(chr(27) + chr(33) + chr(32));//double weidth
        applet.append(chr(27) + "\x61" + "\x31"); // center justify
        applet.append("PENJUALAN\r\n"); // center justify
		applet.append(chr(27) + chr(64));//cancel character sets			
		applet.append(data.pembatas);
        applet.append("\n");
		
		applet.append(data.detail.gross);
		applet.append(data.detail.grossvalue);
		applet.append(data.detail.disc);
		applet.append(data.detail.discvalue);
		applet.append(data.detail.svc);
		applet.append(data.detail.svcvalue);
		applet.append(data.detail.tax);
		applet.append(data.detail.taxvalue);
		applet.append(data.detail.net);
		applet.append(data.detail.netvalue);
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");

		applet.append(data.pembatas);
		applet.append("\n");
		
		applet.append(chr(27) + chr(33) + chr(32));//double weidth
        applet.append(chr(27) + "\x61" + "\x31"); // center justify
        applet.append("CARA PEMBAYARAN  \r\n"); // center justify
		applet.append(chr(27) + chr(64));//cancel character sets			
		applet.append(data.pembatas);
        applet.append("\n");
		
		applet.append(data.detailpay.total);
		applet.append(data.detailpay.totalvalue);
		applet.append(data.detailpay.comp);
		applet.append(data.detailpay.compvalue);
		applet.append(data.detailpay.netcash);
		applet.append(data.detailpay.netcashvalue);
		applet.append(data.detailpay.bca);
		applet.append(data.detailpay.bcavalue);
		applet.append(data.detailpay.mandiri);
		applet.append(data.detailpay.mandirivalue);
		applet.append(data.detailpay.c_bca);
		applet.append(data.detailpay.c_bcavalue);
		applet.append(data.detailpay.c_mandiri);
		applet.append(data.detailpay.c_mandirivalue);
		
		//ceta
		// applet.append("123");
		
		
		applet.append(data.detailpay.niaga);
		applet.append(data.detailpay.niagavalue);
		applet.append(data.detailpay.dll);
		applet.append(data.detailpay.dllvalue);
		
		//kredit 
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
        // applet.append("\n");
		
		applet.append(data.pembatas);
		applet.append("\n");
			applet.append(chr(27) + chr(33) + chr(32));//double weidth
        applet.append(chr(27) + "\x61" + "\x31"); // center justify
		// alert(data.h)
        if (data.hutang != null){
			applet.append("PEMBAYARAN PIUTANG  \r\n"); // center justify
			applet.append(chr(27) + chr(64));//cancel character sets			
			applet.append(data.pembatas);
			applet.append("\n");
			//isi untuk hutang
			var totalhutang;
			$.each(data.hutang, function(i,cetak){
				applet.append(cetak.faktur+ ", ");
				applet.append(cetak.bayar+ " \n" );
				 totalhutang = parseFloat(totalhutang) +  parseFloat(cetak.bayar);
			});
				applet.append(" \n");
				// applet.append("Total  : "+totalhutang);
			
			//akhir untuk hutang
			applet.append("\n");
			applet.append(data.pembatas);
			applet.append("\n");
		}
		
		applet.append(chr(27) + chr(33) + chr(32));//double weidth
        applet.append(chr(27) + "\x61" + "\x31"); // center justify
        applet.append("RINCIAN PENJUALAN\r\n"); // center justify
		applet.append(chr(27) + chr(64));//cancel character sets			
		// applet.append(data.pembatas);
        // applet.append("\n");
		$.each(data.detail2, function(i,cetak){
			applet.append(cetak.pembatas);
			applet.append("\n");
			if (cetak.dept!="") {
			applet.append(cetak.dept);
			applet.append("\n");
			applet.append(cetak.pembatas);
				 applet.append("\n");
			}
			// else
			// {
			// applet.append(cetak.pembatas);
			// applet.append("\n");
			// }
			// applet.append(chr(27) + chr(69) + " TOTAL     : \t 5000\r\n" + chr(27) + chr(70)); 
			// applet.append(cetak.table+"\n");
			// applet.append(chr(27) + chr(97) + chr(2));//right alignment 
			applet.append(chr(27) + chr(69) +cetak.table+cetak.harga+"\r\n"+chr(27) + chr(97)+chr(2));
			applet.append(chr(27) + chr(64));//cancel character sets		
			// applet.append("\n");
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
		applet.append("\n");
        applet.append(data.pembatas);
			
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
            
        // Send characters/raw commands to printer
      
		applet.print();
		// window.location.href + "/../sample.pdf";
    }
}
//---------------------------

function add_item()
{
	// alert('masuk');
//alert(var_service);
    $.ajax({
        url : 'index.php?r=items/check',
        data : 'id='+$("#e1").val(),
        success : function(data)
        {
            // alert(data);
            var obj = jQuery.parseJSON(data);
            var total = obj.unit_price * $("#qty").val();
            var discount = total * $("#discount").val() / 100;
                
            // var tax = $("#qty").val()*obj.tax_percent;
            var persen = parseFloat($("#parameter-pajak").val())/100;
            var tax = $("#qty").val()*obj.unit_price*persen;


			// var taxdisc = tax*10/100 ;
			// var totaltax = tax - taxdisc;
            // var total_cost = total-discount+totaltax;
            var total_cost = total-discount+tax;
            id_inc = id_inc + 1;    
			
			liveSearchPanel_SalesItems.store.each(function (rec) {
				if (rec.get('item_name')==obj.item_name){
						var grid = liveSearchPanel_SalesItems;
						var row = grid.store.indexOf(rec);
						var models = grid.getStore().getRange();
						models[row].set("quantity_purchased",(models[row].get("quantity_purchased")+parseInt($("#qty").val())));
						models[row].set("item_tax",(models[row].get("item_price")*persen)*models[row].get("quantity_purchased"));
						models[row].set("item_total_cost",models[row].get("item_tax")+(models[row].get("item_price")*models[row].get("quantity_purchased")));kalkulasi1();
						exit();
				}
				// alert(models);

			});
			// alert(liveSearchPanel_SalesItems.getStore().getRange());

            var r = Ext.create('SalesItems', {
                id : id_inc,
                item_id:  $("#e1").val(),
                quantity_purchased: $("#qty").val(),
                // item_tax: obj.tax_percent*$("#qty").val(),
                item_tax: tax,
                lokasi: obj.lokasi,
                item_name: obj.item_name,
                item_price:obj.unit_price,
                item_discount: $("#discount").val(),
                item_total_cost:total_cost
            
            });

            // alert(JSON.stringify(r));
            liveSearchPanel_SalesItems.store.insert(0, r);
            var sum = 0;
            discount = 0;
            tax = 0;
            var subtotal = 0;
			kalkulasi1();

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
    // alert(data);
    $.getJSON('index.php?r=sales/load&id='+data, function(data) {
    	// alert(JSON.stringify(data));
                // console.log(data);return false;
        $.each(data.si, function(key, val) {
		// alert(val.nama);
	    	$('#namapel').val(val.nama);
			//$('#namapeg').val(val.nilaiwaiter);
                       // alert(val.item_service);
            var r = Ext.create('SalesItems', {
                item_id:  val.item_id,
                quantity_purchased:val.quantity_purchased,
                item_tax: val.item_tax,
                item_service: val.item_service,
                item_name: val.item_name,
                item_price:val.item_price,
                item_discount: val.item_discount,
                lokasi: val.lokasi,
                permintaan: val.permintaan,
                item_total_cost:val.item_total_cost
            });
            liveSearchPanel_SalesItems.store.insert(0, r);
            kalkulasi1();

        });
        // alert('masuj');
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
    //alert(sale_id); 
    var subtotal = $('#sum_sub_total').html();
    var discount =$('#sum_sale_discount').html();
    var tax =$('#sum_sale_tax').html();
    var service=$('#sum_sale_service').html();
    var total_cost=parseInt($('#sum_sub_total').html())-parseInt($('#sum_sale_discount').html())+parseInt($('#sum_sale_tax').html())+parseInt($('#sum_sale_service').html());
    // var total_cost=$('#sum_sale_total').html();
    var payment=$('#pembayaran').val();
    // var paidwith=$('#payment').val();
    var paidwith=1;
    var custype=$('#custype').val();
	var id_voucher = $('#id_v').val();
    var bayar=$('#bayar').val();

    var cash=$('#cash').val();
    var edcbca=$('#edcbca').val();
    var edcniaga=$('#edcniaga').val();
    var creditbca=$('#creditbca').val();
    var creditmandiri=$('#creditmandiri').val();
    var voucher=$('#sum_sale_voucher').html();
    // var voucher=$('#voucher').val();
    var compliment=$('#compliment').val();
    var dll=$('#dll').val();
	
	var data2 ;
	
	payment = {
		cash : cash,
		edcbca : edcbca,
		edcniaga : edcniaga,
		creditbca : creditbca,
		creditmandiri : creditmandiri,
		voucher : voucher,
		compliment : compliment,
		dll : dll
	}
	// console.log(payment);
	
	
	data = {
        id_voucher : id_voucher,
        sale_id : sale_id,
        subtotal : subtotal,
        discount : discount,
        tax : tax,
        service : service,
        total_cost : total_cost,
        payment : payment,
        paidwith : paidwith,
        status : status,
        table : table,
        custype : custype,
        bayar: bayar
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
            "item_service":rec.get('item_service'),
            "item_discount":rec.get('item_discount'),
            "item_price":rec.get('item_price'),
            "item_total_cost":rec.get('item_total_cost'),
            "permintaan":rec.get('permintaan')
        };
        inc=inc+1;
    });
    //console.log(data_detail);
	//alert();
    $.ajax({
        url : 'index.php?r=sales/bayar',
		type : 'POST',
        data : {
            data:data,
            data_detail:data_detail,
			data_payment : payment
        },
        success : function(data)
        {
        	// alert(data);
            var sales = jQuery.parseJSON(data);
            data2 = sales;
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
                $('#payment').val(0);
                $('#namapel').val("");
                $('#vouchernominal').val("");
                $('#sum_sale_voucher').html(0);
                $("#e1").select2("close");
                $('#dialog_meja').load('index.php?r=site/table');
				$('select option[value="1"]').attr("selected",true);
               
                show_meja('Meja');
				
                if (sales.status == 1)
                {
                	// var applet;
     //             	var counter = 0;
     //             	// while (counter<printers.length){
					// applet.findPrinter(printers[0]);
					// print_items(sales,applet,1);

     //             	var printers = Array('BAR','DAPUR');
     //                var applet = document.jzebra;
     //                applet.findPrinter(printers[0]);
					// print_items(sales,applet,1);
	
						// alert(counter+1);
						// counter++;
						// applet.clear();
						// exit();
						// applet.isDonePrinting();	
						// alert(counter);
                 	//}
                 	// doneFinding();
                 	// donePrinting();	
     //                // print_bayar(sales);
     //                print_dapur(sales,applet);
     //                applet.isDonePrinting();
            
     //                // var applet = document.jzebra;
					// applet.findPrinter("BAR");
     //                print_bar(sales,applet);
                     // applet.setEndOfDocument("P1\n");
					// if (window.confirm("cetak lagi ? ")==true)
						// print_bayar(sales);
					// window.location.reload();
                    // bayar_lagi(sales);
                    print_bayar(sales,0);
					alert("Tekan OK untuk mendapatkan rekap ke 2.");
                    print_bayar(sales,0);
					$("#vouchernominal").val(0);
                }
            }
			
			
        },
        error : function(data)
        {
            alert(data);
            $('#dialog_meja').load('index.php?r=site/table');
        }
    });
		// var applet2 = document.jzebra;
		// applet2.findPrinter(printers[1]);
		// print_items(data2,applet2,2);

	//
	}
var commands = Array("hahahaha","jhihihihihi");
var counter = 0;
function doPrint(){
	document.jzebra.findPrinter(printers[counter])
}
function doneFinding(){
	var e = document.jzebra.getException();
	if (e != null){
		document.jzebra.print(commands[counter]);
	}else{
		alert("error");
	}
}
function donePrinting(){
	counter++;
	if (counter<printers.length){
		doPrint()
	}else{
		alert('completed');
	}
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
            "item_service":rec.get('item_service'),
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
                item_service: data_detail[i].item_service,
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
    var nama = $('#namapel').html();
    var subtotal = $('#sum_sub_total').html();
    var discount =$('#sum_sale_discount').html();
    var tax =$('#sum_sale_tax').html();
    var service=$('#sum_sale_service').html();
    var total_cost=$('#sum_sale_total').html();
    var payment=$('#pembayaran').val();
    var paidwith=$('#payment').val();
	var namapelanggan=$('#namapel').val();
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
        table : table,
        namapelanggan : namapelanggan
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
        url : 'index.php?r=sales/hanyacetak',
        type : 'POST',
		data : {
            data:data,
            data_detail:data_detail
        },
        success : function(data)
        {
        	// alert(JSON.stringify(data));
            var sales = jQuery.parseJSON(data);
            // alert(sales);
            if (sales.sale_id!="")
            {
                print_bayar(sales,0);
                // $.each(sales.detail, function(i,dani) {
                // // alert(dani.quantity + " " + dani.nama_item);
                // // var total_cetak = dani.logo + dani.alamat; 
                // });


                //$("#dialog_bayar").dialog("close");
             
            }
			
			
        },
        error : function(data)
        {	
        	alert("error");
            alert(data);
            $('#dialog_meja').load('index.php?r=site/table');
        }
    });
}

// function cetakdapur()
// {
//    print_items("DAPUR",2);
//    alert('PERMINTAAN TELAH TERKIRIM KE DAPUR')	
// }
// function cetakbar()
// {
//    print_items("BAR",1);	
//    alert('PERMINTAAN TELAH TERKIRIM KE BAR')	
// }
function cetakbardapur(meja,meja_tipe){
	// alert(meja);
	// alert(meja_tipe);
	meja_cetak = meja;
	meja_tipe_cetak = meja_tipe;
	if (confirm('Aplikasi akan mengirimkan permintaan ke bar dan dapur ?')){
		
		// alert(meja_tipe_cetak);
		// alert(meja_tipe);
		
		var bar = false;
		var dapur = false;
		var jsonObj = [];

		$(".baris").each(function() {
			var idb = $(this).find('.pk').html();
			var nama = $(this).find('.nama_menu').html();
			var lokasi = $(this).find('.pk').attr("lokasi");
			var jml = $(this).find('.jumlah').find('.input-jumlah').val();
			var permintaan = $(this).find('.permintaan').find('.area-permintaan').val();
			var belum_print = $(this).find('.pk[cetak=0]').length;

			item = {}
			item["idb"] = idb;
			item["nama"] = nama;
			item["jml"] = jml;
			item["permintaan"] = permintaan;
			item["lokasi"] = lokasi;
			// jsonObj.push(item);

			if (belum_print!=0){
				if (lokasi=="1"){
		     		bar = true;
		     	}
		     	if (lokasi=="2"){
		     		dapur = true;
		     	}
	     	}

		});
	    if (dapur==true){		
			 if (print_items("POS-80C dapur",2)){
				 alert('PERMINTAAN TELAH TERKIRIM KE DAPUR');				// alert('dapur true');
				 // return true;
			 }
		}

	    if (bar==true){		
			if (print_items("POS-80C",1)){
			    alert('PERMINTAAN TELAH TERKIRIM KE BAR');
			    // return true;
			}
	    }

	    return true;
    }else{
    	return false;
    }
	    


	// alert('lewat');
	 // alert('PERMINTAAN TELAH TERKIRIM KE DAPUR & BAR')	
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
                'edit': function(editor,e){
						var grid = liveSearchPanel_SalesItems;
						var selectedRecord = grid.getSelectionModel().getSelection()[0];
						var row = grid.store.indexOf(selectedRecord);
						// alert(row);
						
						var models = grid.getStore().getRange();
						var subtotal_value = (models[row].get("item_price") * models[row].get("quantity_purchased"));
						var diskon_value = (subtotal_value) * (models[row].get("item_discount")/100);
						var tax_value = (subtotal_value - diskon_value)*(10/100);
						var service_value = (subtotal_value - diskon_value)*(5/100);
						var total_value = (subtotal_value - diskon_value) + tax_value + service_value;
						// alert(subtotal_value);
						// alert(diskon_value);
						// alert(tax_value);
						// alert(service_value);
						// models[row].set("item_tax",(models[row].get("item_price")*0.1)*models[row].get("quantity_purchased"));
						// models[row].set("item_total_cost",models[row].get("item_tax")+(models[row].get("item_price")*models[row].get("quantity_purchased")));
						models[row].set("item_tax",tax_value);
						models[row].set("item_service",service_value);
						models[row].set("item_total_cost",total_value);
						kalkulasi1();
						 // store.user_store.load(function(){
							// alert(this.getAt(0).get('item_price'));
						// });​
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
            text:'lokasi',
            flex:1,
            sortable:false,
            dataIndex:'lokasi',
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
            sortable:true,
            dataIndex:'item_name',
            // editor   : {
                // xtype:'textfield',
                // allowBlank:false
            // }
        },
        {
            text:'Jumlah',
            flex:1,
            sortable:false,
            dataIndex:'quantity_purchased',
            // editor   : {
            //     xtype:'textfield',
            //     allowBlank:false
            // }
        },
     
        {
            text:'Harga',
            flex:1,
            sortable:false,
            dataIndex:'item_price',
            // editor   : {
                // xtype:'textfield',
                // allowBlank:false
            // }
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
            // editor   : {
                // xtype:'textfield',
                // allowBlank:false
            // }
        },
          {
            text:'service',
            flex:1,
            sortable:false,
            dataIndex:'item_service',
            // editor   : {
                // xtype:'textfield',
                // allowBlank:false
            // }
        },
        {
            text:'Total',
            flex:1,
            sortable:false,
            dataIndex:'item_total_cost',
            // editor   : {
                // xtype:'textfield',
                // allowBlank:false
            // }
        },
         {
            text:'Permintaan',
            flex:1,
            sortable:false,
            dataIndex:'permintaan',
            // editor   : {
            //     xtype:'textarea',
            //     allowBlank:true
            // }
        },
		
        {
            text:'Action',
            flex:1,
            hidden:true,
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
        height: 180,
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
            // tax += rec.get('item_tax') *  rec.get('quantity_purchased'); 
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

</script>