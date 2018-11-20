<?php if (Yii::app()->user->getLevel()==7){
$this->redirect(array("site/waiter"));

} ?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/extjs4/resources/css/ext-all.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/extjs4/ext-all.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/SalesItems/model.js"></script>

<?php 
    // $url = Yii::getPathOfAlias('webroot');
    // include("'$url/js/app/SalesItems/main.php'");
    $this->renderPartial('main');
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/SalesItems/_form.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/include/dist/plugins/jqplot.barRenderer.min.js"></script>


<link href="<?php echo Yii::app()->request->baseUrl; ?>/select2/select2.css" rel="stylesheet"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/select2/select2.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid-pos.css" />

<script>

    function print() {
        document.jzebra.append("A37,503,0,1,2,3,N,PRINTED USING JZEBRA\n");
        // ZPLII
        // document.jzebra.append("^XA^FO50,50^ADN,36,20^FDPRINTED USING JZEBRA^FS^XZ");  
        document.jzebra.print();
    }
</script>
<div class="content-pos">
<div>

<script>
$(document).ready(function(){
	//$("#cetaksaja").click(function(){
    //    var a = confirm("Jangan Lupa Reload !!!");
    //    if (a==true){
    //        location.reload();
    //    }
    //});
    $("#cowork").click(function(){
        // var subtotal = $("#sum_sub_total").html();
        var service = $("#sum_sale_service").html();
        var tax = $("#sum_sale_tax").html();
        // var voucher = $("#sum_sale_voucher").html();
        var total = $("#sum_sale_total").html();
        var jumlaha = total - service - tax;
        $("#sum_sale_service").html(0);
        $("#sum_sale_tax").html(0);
        $("#sum_sale_total").html(jumlaha);
        // alert(service);
        // alert(tax);
        // alert(total);
    });
    $("#ditditvoc").click(function(){
        var subtotal = $("#sum_sub_total").html();
        var total = $("#sum_sale_total").html();
        //editan tax dan service sesudah discount
        
        var vouchernominal = $("#vouchernominal").val();
        if (vouchernominal == ""){
            vouchernominal = 0;
        }
        var setelahvouchernominal = subtotal - vouchernominal;
        var nilai_tax = "<?php echo Parameter::model()->findByPk('1')->pajak ?>";
        var nilai_service = "<?php echo Parameter::model()->findByPk('1')->service ?>";
        var real_tax = nilai_tax / 100;
        var real_service = nilai_service / 100;
        var vtax = setelahvouchernominal * real_tax;
        var vservice = setelahvouchernominal * real_service;
        var tampil = setelahvouchernominal + vtax + vservice;
        //editan tax dan service sesudah discount

        $("#sum_sale_voucher").html(vouchernominal);
        $("#sum_sale_total").html(tampil);
        kalkulasi1();
    });
    $("#ditditvoc").click(function(){
        var nilai_tax = "<?php echo Parameter::model()->findByPk('1')->pajak ?>";
        var nilai_service = "<?php echo Parameter::model()->findByPk('1')->service ?>";
        var real_tax = nilai_tax / 100;
        var real_service = nilai_service / 100;
        var subtotal = $("#sum_sub_total").html();
        var discount = $("#sum_sale_discount").html();
        var setelahdiscount = subtotal - discount;
        var taxsd = setelahdiscount * real_tax;
        var servicesd = setelahdiscount * real_service;
        var total = setelahdiscount + taxsd + servicesd;
        $("#sum_sale_tax").html(taxsd);
        $("#sum_sale_service").html(servicesd);
        $("#sum_sale_total").html(total);
    });

});

function hutang(){
	var id = prompt("Silahkan Masukan No. Faktur", "");
	if (id!=""){
	   $.ajax({
				type: 'GET',
				url: '<?php echo Yii::app()->createAbsoluteUrl("sales/hutang"); ?>',
				data:'id='+id,
				success:function(data){
				if (data=='kosong')
					alert('tidak ada ID faktur '+id);
					// alert('id telah sukses dibayar');
				else if (data =='already') 
					alert(id+' tersebut sudah dibayar!!');
				else{
					// alert(data);
				    var sales = jQuery.parseJSON(data);
					print_bayar(sales);
					}
				},
				dataType:'html'
			});
	}else{
		alert('ID faktur kosong');
	}
}

</script>
<style type="text/css">
    .namapel{
        margin-top: 20px;
        height: 30px;
        width: 150px;
        border-radius: 8px;
    }
</style>

<?php
// $connection=new CDbConnection('mysql:host=localhost;dbname=postech','root','');
// 		$connection->active=true; // open connection

// 		$que="select i.id,o.status, i.item_name from outlet o , items i where o.kode_outlet = i.kode_outlet ";
// 		$command=$connection->createCommand($que);
// 		$reader=$command->query();
		
// 		$model=Items::model()->with('outlet')->findAll(
// 		array('select'=>'kode_outlet,item_name',));
		
//                 // $data = array();
//                 // foreach ($model as $item)
//                 // {
//                     // $temp = array();
//                     // $data[$item->id] = $item->outlet->status." ".$item->item_name;
//                 // }
				
// 				$data = array();
//                 foreach ($reader as $item)
//                 {
//                     $temp = array();
//                     // $data[$item->id] = $item->outlet->status." ".$item->item_name;
//                     $data[$item['id']] = $item['status']." ".$item['item_name'];
					
//                 }
                // return $data;
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
?>
</div>

    <div class="content-pos-grid">
        <div class="inputtab" >
            <form id="sales-hb" action="<?php echo $this->createUrl('SalesHb/save') ?>">
                <?php //echo CHtml::textField('table'); ?>
                <div style="display:none">
                <?php echo CHtml::dropDownList('e1', '1', Items::model()->data_items()); ?>
                </div>
                <label style="display:none">Jumlah
                    <?php echo CHtml::textField('qty', '1', array('class' => 'myinput', 'onkeypress' => 'return runScript(event,"discount")')); ?></label>
                <label>Diskon
                    <?php echo CHtml::dropDownList('discount', '0', Chtml::listdata(Diskon::model()->findAll(),'diskon','diskon'),array('class' => 'myinput', 'onkeypress' => 'return runScript(event,"add_item")')); ?> % </label>
                    <?php //echo CHtml::textField('discount', '0', array('class' => 'myinput', 'onkeypress' => 'return runScript(event,"add_item")')); ?>
                    <input class="namapel" type="text" id="namapel" placeholder="   Atas Nama">
                    <input class="namapel" type="text" id="vouchernominal" placeholder="   Voucher Nominal">
                <input style="display:none"  type="button" value="Tambah" onClick="add_item()" class="mybutton">
            </form>
        </div>
        <script>
            function runScript(e,obj) {
                if (e.keyCode == 13) {
                    //                    alert('endter');
                    $('#'+obj).focus();
                    if (obj=="add_item")
                    {
                        add_item();
                    }
                }
            }
            function send()
            {
 
                var data=$("#sales-hb").serialize();
 
 
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->createAbsoluteUrl("SalesHb/save"); ?>',
                    data:data,
                    success:function(data){
                        alert(data);
                    },
          
                    dataType:'html'
                });
 
            }
		
            function estimate(num)
            {
                return 0 ;
				
                // if (num < 10000)
                // {
                //     num = 10000;
                //     return num;
                // }
                // else if (num<= 20000)
                // {
                //     return 20000;
                // }
                // else if (num <= 100000)
                // {
                //     return 100000;
                // }
                // else if (num <= 150000)
                // {
                //     return 150000;
                // }
                // else if (num <= 200000)
                // {
                //     return 200000;
                // }
                // else if (num <= 250000)
                // {
                //     return 250000;
                // }
                // else if (num <= 300000)
                // {
                //     return 300000;
                // }
                // else
                // {
                //     return num;
                // }
				
            }
            function runScript(e,obj) {
                if (e.keyCode == 13) {
                    //                    alert('endter');
                    $('#'+obj).focus();
                    if (obj=="add_item")
                    {
                        add_item();
                    }
                }
            }
            function send()
            {
 
                var data=$("#sales-hb").serialize();
 
 
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->createAbsoluteUrl("SalesHb/save"); ?>',
                    data:data,
                    success:function(data){
                        alert(data);
                    },
          
                    dataType:'html'
                });
 
            }
			
			function custype(){
				var customer_type = $('#custype').val();
				// alert(customer_type);
				
				// var chk = $("#chkService").val();
				//ambil data dari summary kanan
				var subtotal = $('#sum_sub_total').html();
				var discount =$('#sum_sale_discount').html();
				var tax =$('#sum_sale_tax').html();
				var service=0;
				var total_cost=$('#sum_sale_total').html();
				
				//travel tidak pake service
				if(customer_type==2){
					// alert('checked');
					// $('#sum_sub_total').html(0);
					// $('#sum_sale_discount').html(0);
					$('#sum_sale_service').html(0);
					// $('#sum_sale_tax').html(0);
					$('#sum_sale_total').html(total_cost-service);
				}else{
					// alert('unchecked');
					service  = 	var_service * (subtotal-discount)/ 100;
					$('#sum_sale_service').html(service);
					// $('#sum_sale_tax').html(0);
					$('#sum_sale_total').html(parseInt(total_cost)+parseInt(service));
			}
			
			// alert(chk);
			}
        </script>
        <div id="sales_items"></div>
    </div>
    <div class="content-pos-kanan">
        <!-- tombol -->
        <script type="text/javascript">
        function klikmeja(){
            $('#dialog_meja').load('index.php?r=site/table');
            $("#dialog_meja").dialog("open");

        }
        </script>
        <?php echo CHtml::button('Meja', array('id' => 'tombol_meja', 'onclick' => 'klikmeja()', 'class' => 'big-button mybutton')); ?>
		<?php $list = CHtml::listData(CustomerType::model()->findAll(), 'id', 'customer_type');?>
		<div style="margin-left:20px;">
		<?php //echo "Jenis Customer : ".CHtml::dropDownList('custype', '0', $list, array('class' => 'myinput', 'onchange' => 'custype()', 'style'=>'margin-bottom:5px;width:100px;')); ?>
		</div>
		
		
        <!-- untuk div tax, subtotal, total -->
        <div class="pos-kanan-content">
            <table class="tb_kanan">
                <tr>
                    <td class="left">Sub Total:</td>
                    <td class="right"><div id="sum_sub_total">0</div></td>
                </tr>
                <tr>
                    <td class="left">Discount :</td>
                    <td class="right"><div id="sum_sale_discount">0<?php //echo CHtml::dropDownList('sum_sale_discount2', '5', array('5'=>'5%','10'=>'10%')); ?></div></td>
                </tr>
                <tr>
                    <td class="left">Service (<script>document.write(var_service);</script>)% :</td>
                    <td class="right"><div id="sum_sale_service">0</div></td>
                </tr>
                <tr>
                    <td class="left">Tax (<?php echo Parameter::model()->findByPk(1)->pajak ?>)%:</td>
                    <td class="right"><div id="sum_sale_tax">0</td>
                </tr>
                <tr>
                    <td class="left">Voucher :</td>
                    <td class="right"><div id="sum_sale_voucher">0</td>
                </tr>

            </table>
            <table class="tb_kanan kanan-footer">
                <tr>
                    <td class="left"><b>Total:</b></td>
                    <td class="right"><b><div id="sum_sale_total">0</div></b></td>
                </tr>
            </table>
        </div>
		<!-- <input type="button" id="travel()" value="No Tax And Service" class="mybutton"> -->
		<div style="text-align:left;">
		<input type=button onClick="travel()" value="Travel" class="mybutton">
		<input type=button onClick="owner()" value="Tax" class="mybutton">
        <input type=button onClick="serv()" value="Serv" class="mybutton">
		</div>
    </div>
</div>
<script>
	function travel(){
				var customer_type = $('#custype').val();
				// alert(customer_type);
				
				// var chk = $("#chkService").val();
				//ambil data dari summary kanan
				var subtotal = $('#sum_sub_total').html();
				var discount =$('#sum_sale_discount').html();
				var tax =$('#sum_sale_tax').html();
				var service=$('#sum_sale_service').html();
				var total_cost=$('#sum_sale_total').html();
				
				$('#sum_sale_service').html(0);
				$('#sum_sale_tax').html(0);
				$('#sum_sale_total').html(parseInt(subtotal)-parseInt(discount));
			
				//mulai
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
				"permintaan":rec.get('permintaan'),
                "item_total_cost":rec.get('item_total_cost')
        };
        inc=inc+1;
		console.log(data_detail);
		});
		//remove isi grid
		liveSearchPanel_SalesItems.store.removeAll();
			
			for (i = 0; i < data_detail.length; i++) {
			// alert(data_detail[i].name);
			// var hargatotal = data_detail[i].quantity_purchased * data_detail[i].item_price;
			// var potongan = (hargatotal*ediskon)/100;
			// var itcost = hargatotal-potongan+data_detail[i].item_tax;
			
			var r = Ext.create('SalesItems', {
                item_id:  data_detail[i].item_id,
                quantity_purchased:data_detail[i].quantity_purchased,
                item_tax: 0,
                item_name: data_detail[i].item_name,
                item_price:data_detail[i].item_price,
                // item_discount: val.item_discount,
                item_discount: data_detail[i].item_discount,
                item_total_cost: data_detail[i].item_price * data_detail[i].quantity_purchased
			});
			// alert(i);
			liveSearchPanel_SalesItems.store.insert(0, r);
           kalkulasi1();
		}

        // $("#vouchernominal").trigger("change");
}
//Koding Triana##buka
    function owner(){
		var customer_type = $('#custype').val();
        var subtotal = $('#sum_sub_total').html();
        var discount =$('#sum_sale_discount').html();
        var tax =$('#sum_sale_tax').html();
        var service=$('#sum_sale_service').html();
        var total_cost=$('#sum_sale_total').html();
        $('#sum_sale_tax').html(0);
        $('#sum_sale_total').html(parseInt(subtotal)+parseInt(service));
        // kalkulasi1();

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
                "item_service":rec.get('item_service'),
                "item_price":rec.get('item_price'),
                "permintaan":rec.get('permintaan'),
                "item_total_cost":rec.get('item_total_cost')
        };
        inc=inc+1;
        console.log(data_detail);
        });
        //remove isi grid
        liveSearchPanel_SalesItems.store.removeAll();
            
            for (i = 0; i < data_detail.length; i++) {
            // alert(data_detail[i].name);
            // var hargatotal = data_detail[i].quantity_purchased * data_detail[i].item_price;
            // var potongan = (hargatotal*ediskon)/100;
            // var itcost = hargatotal-potongan+data_detail[i].item_tax;
            
            var r = Ext.create('SalesItems', {
                item_id:  data_detail[i].item_id,
                quantity_purchased:data_detail[i].quantity_purchased,
                item_tax: 0,
                item_name: data_detail[i].item_name,
                item_price:data_detail[i].item_price,
                item_service: data_detail[i].item_service,
                item_discount: data_detail[i].item_discount,
                item_total_cost: data_detail[i].item_price * data_detail[i].quantity_purchased + data_detail[i].item_service
            });
            // alert(i);
            liveSearchPanel_SalesItems.store.insert(0, r);
           // kalkulasi1();
            // $("#vouchernominal").trigger("keyup");
        }
        var nilai_tax = "<?php echo Parameter::model()->findByPk('1')->pajak ?>";
        var nilai_service = "<?php echo Parameter::model()->findByPk('1')->service ?>";
        keyupvoucher(nilai_service,0);

    }
	
	function serv(){
        var customer_type = $('#custype').val();
        var subtotal = $('#sum_sub_total').html();
        var discount =$('#sum_sale_discount').html();
        var tax =$('#sum_sale_tax').html();
        var service=$('#sum_sale_service').html();
        var total_cost=$('#sum_sale_total').html();
        $('#sum_sale_service').html(0);
        $('#sum_sale_total').html(parseInt(subtotal)+parseInt(tax));
        // kalkulasi1();

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
                "item_service":rec.get('item_service'),
                "item_price":rec.get('item_price'),
                "permintaan":rec.get('permintaan'),
                "item_total_cost":rec.get('item_total_cost')
        };
        inc=inc+1;
        console.log(data_detail);
        });
        //remove isi grid
        liveSearchPanel_SalesItems.store.removeAll();
            
            for (i = 0; i < data_detail.length; i++) {
            // alert(data_detail[i].name);
            // var hargatotal = data_detail[i].quantity_purchased * data_detail[i].item_price;
            // var potongan = (hargatotal*ediskon)/100;
            // var itcost = hargatotal-potongan+data_detail[i].item_tax;
            
            var r = Ext.create('SalesItems', {
                item_id:  data_detail[i].item_id,
                quantity_purchased:data_detail[i].quantity_purchased,
                item_tax: data_detail[i].item_tax,
                item_name: data_detail[i].item_name,
                item_price:data_detail[i].item_price,
                item_service: 0,
                item_discount: data_detail[i].item_discount,
                item_total_cost: data_detail[i].item_price * data_detail[i].quantity_purchased + data_detail[i].item_tax
            });
            // alert(i);
            liveSearchPanel_SalesItems.store.insert(0, r);
            // $("#vouchernominal").trigger("keyup");
            // alert("masuk");
           // kalkulasi1();
        }
          var nilai_tax = "<?php echo Parameter::model()->findByPk('1')->pajak ?>";
        var nilai_service = "<?php echo Parameter::model()->findByPk('1')->service ?>";
        keyupvoucher(0,nilai_tax);

    }

     $("#vouchernominal").keyup(function(){
        var nilai_tax = "<?php echo Parameter::model()->findByPk('1')->pajak ?>";
        var nilai_service = "<?php echo Parameter::model()->findByPk('1')->service ?>";
        keyupvoucher(nilai_service,nilai_tax);

    });
    function keyupvoucher(nilai_service,nilai_tax){
        //  alert(nilai_tax);
        // alert(nilai_service);
        var subtotal = $("#sum_sub_total").html();
        var total = $("#sum_sale_total").html();
        var vouchernominal = $("#vouchernominal").val();
        if (vouchernominal == ""){
            vouchernominal = 0;
        }
        var setelahvouchernominal = subtotal - vouchernominal;
        
       
        var real_tax = nilai_tax / 100;
        var real_service = nilai_service / 100;
        var vtax = setelahvouchernominal * real_tax;
        var vservice = setelahvouchernominal * real_service;
        var tampil = setelahvouchernominal + vtax + vservice;
        $("#sum_sale_tax").html(vtax);
        $("#sum_sale_service").html(vservice);
        $("#sum_sale_voucher").html(vouchernominal);
        $("#sum_sale_total").html(tampil);
    }
    //##tutup
 </script>
<script>
    $(document).ready(function() { 
    
        $("#e1").select2({
            closeOnSelect : true   
        }); 
        
        $('#e1').on("change",function(){
            //            alert('test');
            $("#e1").select2('close',function(){
                $("#qty").focus();
            }); 
        });
		
		// $("#cash").on("keyup",function(){
			// var bayar = $("#cash").val();
			// $("#cash").val(bayar.replace(/[^\d,]+/g, ''));
			// bayar = $("#cash").val()+$("#edc").val()+$("#voucher").val()+$("#compliment").val()+$("#dll").val();
			// // bayar = bayar.replace(/[^\d,]+/g, '');
			// var sum_sale_total = $("#sum_sale_total").html();
			// var kembalian = bayar-sum_sale_total;
			// $("#kembalian").val(kembalian);
			// // alert('asdasd');
		// });
		
    });
		function changebayar(){
            // var my = $('.myinput').val(); 
            // if (my.length==''){
            //     $('.myinput').val(0);
            // }
            // alert(my);
			var bayar = $("#cash").val();
			$("#cash").val(bayar.replace(/[^\d,]+/g, ''));
			bayar = parseInt($("#cash").val())+parseInt($("#edcbca").val())+parseInt($("#edcniaga").val())+parseInt($("#creditbca").val())+parseInt($("#creditmandiri").val())+parseInt($("#voucher").val())+parseInt($("#compliment").val())+parseInt($("#dll").val());
			// bayar = bayar.replace(/[^\d,]+/g, '');
			var sum_sale_total = $("#sum_sale_total").html();
			var kembalian = bayar-sum_sale_total;
			$("#kembalian").val(kembalian);
			$("#cash").val(parseInt($("#sum_sale_total").html())-parseInt($("#edcbca").val())-parseInt($("#edcniaga").val())-parseInt($("#creditbca").val())-parseInt($("#creditmandiri").val())-parseInt($("#voucher").val())-parseInt($("#compliment").val())-parseInt($("#dll").val()));
			// $("#voucher").val("haha");
			
			
			// alert('asdasd');
		};
        
</script>
<script>
	$('#sum_sale_discount2').change(function(){
		var disc = $('#sum_sale_discount2').val();
		alert(disc);
	});

    function test(){
       var service=$('#sum_sale_service').html();
       // alert('service : '+service);
    }
    //script buat disable tombol
    function disable(event) { 
        switch (event.which){
            //116 itu key code nya F5
            case 112: event.preventDefault(); break;
            case 113: event.preventDefault(); break;
            case 114: event.preventDefault(); break;
            case 115: event.preventDefault(); break;
            case 116: event.preventDefault(); break;
            case 117: event.preventDefault(); break;
            case 118: event.preventDefault(); break;
            case 119: event.preventDefault(); break;
            case 120: event.preventDefault(); break;
            case 121: event.preventDefault(); break;
        }
    };
    // disable F5
    $(document).bind("keydown", disable);
    $('body').keypress(function(event){
        //message gan, buat info kode2 tombol doank
        var message = '<BR>ada tombol yg di pencet gan!, keyCode = ' + event.keyCode + ' which = ' + event.which;
			
        //cek kalo keycodenya > 0 berarti ada tombol f1 - f12 + enter (kode 13) yg agan pencet
        if (event.keyCode>=0 || event.charCode>=0 || event.which>=0 ){
            message = message + '<BR>F1 - F12 / enter pressed';
            list_action(event.keyCode);
        }else{
            list_action_other(event.which);
            message = message + '<BR>key other than F1 - F12 pressed';
        }
			
        //print pesan
        $('#msg-keypress').html(message)
		
    });
    
	
    function kalkulasi1()
    {
        var sum = 0;
        var discount = 0;
        var tax = 0;
        var svc = 0;
        var subtotal = 0;
		var voucher = 0;
		voucher = $("#vouchernominal").val();
        liveSearchPanel_SalesItems.store.each(function (rec) { 
            sum += rec.get('item_total_cost'); 
            discount += rec.get('item_discount') * (rec.get('item_price')*rec.get('quantity_purchased')) /100 ; 
   
            // tax += rec.get('item_tax')*rec.get('quantity_purchased'); 
            tax += rec.get('item_tax'); 
            svc += rec.get('item_service'); 
            subtotal += (rec.get('item_price')*rec.get('quantity_purchased')); 
        });
        // alert(svc);

		// tax = (subtotal-discount)/10;
		
        $('#sum_sub_total').html(Math.round(subtotal));
        $('#sum_sale_discount').html(Math.round(discount));
        $('#sum_sale_tax').html(Math.round(tax));
        service = svc;
         // service  = 	var_service * (subtotal-discount)/ 100;
        //service  = 0;
        

        $('#sum_sale_service').html(Math.round(service));
        $('#sum_sale_total').html(Math.ceil(subtotal-discount-voucher+service+tax));
        $('#total_bayar').html(Math.ceil(subtotal-discount-voucher+tax+service));
      
        
    }
  
	
    function list_action(act)
    {   
		var sum_sale_total = $("#sum_sale_total").html();
		var kembalian = estimate($("#total_bayar").html())-sum_sale_total;
        switch(act)
        {        
            case 112 : 
                        // alert($('#sum_sale_total').html());
                        if ( parseInt($('#sum_sale_total').html()) !=0 ){
                        // alert(JSON.stringify(data_detail));
                        $("#e1").select2("close"); $("#pembayaran").val(estimate($("#total_bayar").html()));
						$("#dialog_bayar").dialog("open");$("#pembayaran").focus(); 
						$("#kembalian").val(kembalian);
						$('#cash').val(sum_sale_total);
                        $('#edcbca').val(0);
                        $('#edcniaga').val(0);
                        $('#creditbca').val(0);
						$('#creditmandiri').val(0);
						$('#compliment').val(0);
						$('#voucher').val(0);
						$('#dll').val(0);
						changebayar();
						$('#total_bayar').html($('#sum_sale_total').html());
						}
                        else{
                            alert('Silahkan isi menu .. ');
                        }

                        break;

            case 113 :  $("#e1").select2("close"); $("#e1").select2("open"); break;
            case 114 : $("#e1").select2("close"); $("#dialog_meja").dialog("open"); break;
            case 115 :  $("#e1").select2("close"); $("#e1").select2("close"); liveSearchPanel_SalesItems.getView().focus(); liveSearchPanel_SalesItems.getView().focus(); liveSearchPanel_SalesItems.getSelectionModel().select(0);
                break;
            case 116 : baru(); kalkulasi1(); break;
            case 118 : 
                       if ( parseInt($('#sum_sale_total').html()) !=0 ){ 
                        cetakbill();
                        }else{
                           alert('Silahkan isi menu .. ');  
                        }
                        break;
            case 119 : hutang(); break;
			case 120 :
				var number_meja= $("#tombol_meja").attr('value');
				number_meja =  number_meja.replace(/[^0-9]+/g, '');
				if (number_meja!=''){
				alert("Update tidak berfungsi ");
					// alert(number_meja);
					// alert('<?php echo $_SESSION['temp_sale_id']; ?>');
					// var id = '<?php echo $_SESSION['temp_sale_id']; ?>';
					// if (id!=''){
						// bayar(0,number_meja,'<?php echo $_SESSION['temp_sale_id']; ?>');
						// alert('mode update holdbill'+'<?php echo $_SESSION['temp_sale_id']; ?>');
					// }else{
						// alert('beluma ada session');
					// }
						// $.ajax({
							// url:'<?php echo $this->createUrl('sales/getsaleid2')?>',
							// // data:'id='+data,
							// success:function(data){
								// // alert('success :'+data);
								// bayar(0,number_meja,data);
								// alert('mode update holdbill');
							// },
							// error: function(){
								// // alert('gagal'+data);
							// }
							
						// });
				}
				else
					alert('belum membuka meja ..');
				// // alert(number_meja);
				
			 break;
        }

    }
    
function list_action_other(act)
{   
	switch(act)
	{        
		case 109 : $('#payment option[value="2"]').attr("selected",true); break;
		case 99 : $('#payment option[value="1"]').attr("selected",true); break;
		//            case 113 : alert('f1'); break;
		//            case 114 : alert('f1'); break;
		//            case 115 : alert('f1'); break;
	}
}

function editdiskon(){
	//ambil nilai dari combo diskon
   if ( parseInt($('#sum_sale_total').html()) !=0 ){ 

	var diskon = $('#discount').val();
	
	var subtotal = $('#sum_sub_total').html();
    var discount = (subtotal/10);
    var tax = $('#sum_sale_tax').html();
    var service = 0;
    var total_cost = parseInt(subtotal) - parseInt(discount) + parseInt(tax) + parseInt(service);
	
	$('#sum_sub_total').html(subtotal);
	$('#sum_sale_discount').html(discount);
	$('#sum_sale_service').html(service);
	$('#sum_sale_tax').html(tax);
	$('#sum_sale_total').html(total_cost);
    }else{
        alert('Silahkan isi menu');
    }
}
	
function hanyacetak(status,table,sale_id)
{
//alert(sale_id);
// return;
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
        //$.each(sales.detail, function(i,dani) {
        // alert(dani.quantity + " " + dani.nama_item);
        // var total_cetak = dani.logo + dani.alamat; 
        //});


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
        //print_bayar(data);
        // show_meja('Meja');
    }
				
				
},
error : function(data)
{
    alert(data);
    $('#dialog_meja').load('index.php?r=site/table');
}
});
}
    
</script>
<!--div id="msg-keypress"></div-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialog_bayar2',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Pembayaran',
        'autoOpen' => false,
        'modal' => true,
		'width' => 400,
    ),
));

$this->renderPartial('payment_next');

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialog_bayar',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Pengisian cara pembayaran',
        'autoOpen' => false,
        'modal' => true,
		'width' => 450,
		
    ),
));

$this->renderPartial('payment');

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php if (Yii::app()->user->getLevel()==2){ ?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialog_meja',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Meja (Space = hapus  |  Enter = simpan/update/pindah meja)',
        'autoOpen' => false,
        'modal' => true,
        'width' => 665
    ),
));
$this->renderPartial('table');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php } else{ ?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialog_meja',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Meja',
        'autoOpen' => false,
        'modal' => true,
        'width' => 665
    ),
));
$this->renderPartial('table');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php } ?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialog_menu',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Menu',
        'autoOpen' => false,
        'modal' => true,
        'width' => 1000,
        'height' => 400,
    ),
));
?>
<div><?php $this->renderPartial('menu'); ?> </div>
<?php
//echo "ramdnai";

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<input id="pay" type="button" value="Bayar" onclick='list_action(112);' class="mybutton">

<input type=button onClick="cetakbill()" value="Cetak" class="mybutton"><!-- id="cetaksaja" -->
<!-- <input type=button onClick="print_bayar()" value="Cetak2" class="mybutton"> -->
<input style="display:none" type=button id="cetakdapur" onClick="cetakdapur()" value="Cetak Dapur" class="mybutton">
<input style="display:none" type=button id="cetakbar" onClick="cetakbar()" value="Cetak Bar" class="mybutton">
<!-- <input type=button  onClick="cetakbardapur()" value="Cetak Bar & Dapur" class="mybutton"> -->
<input type=button onClick="editdiskongrid()" value="Edit Diskon" class="mybutton" id="ditditvoc">
<input style="display:none" type=but    ton onClick="window.location.reload()" value="Baru" class="mybutton">
<!--<input type=button onClick="opencash()" value="Buka Drawer" class="mybutton">-->
<!--input type=button onClick="cekisigrid()" value="cek isi grid" class="mybutton"-->
<applet name="jzebra" code="jzebra.PrintApplet.class" archive="jZebra/jzebra/jzebra.jar" width="0" height="0">
    <param name="printer" value="zebra">
</applet>
<system.webServer>
    <staticContent>
      <mimeMap fileExtension=".jnlp" mimeType="application/x-java-jnlp-file" />
    </staticContent>
</system.webServer>

<!--div id="msg-keypress">here press</div-->
