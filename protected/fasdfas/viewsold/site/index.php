<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/extjs4/resources/css/ext-all.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/extjs4/ext-all.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/SalesItems/model.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/SalesItems/main.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/SalesItems/_form.js"></script>


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
    <div class="content-pos-grid">
        <div class="inputtab">
            <form id="sales-hb" action="<?php echo $this->createUrl('SalesHb/save') ?>">
                <?php //echo CHtml::textField('table'); ?>
                <?php echo CHtml::dropDownList('e1', '1', Items::model()->data_items()); ?>
                <label>Jumlah
                    <?php echo CHtml::textField('qty', '1', array('class' => 'myinput', 'onkeypress' => 'return runScript(event,"discount")')); ?></label>
                <label>Diskon
                    <?php echo CHtml::dropDownList('discount', '0', array('0'=>'0','10'=>'10','20'=>'20'),array('class' => 'myinput', 'onkeypress' => 'return runScript(event,"add_item")')); ?> % </label>
                    <?php //echo CHtml::textField('discount', '0', array('class' => 'myinput', 'onkeypress' => 'return runScript(event,"add_item")')); ?>
                <input  type="button" value="Tambah" onClick="add_item()" class="mybutton">
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
				
                if (num < 10000)
                {
                    num = 10000;
                    return num;
                }
                else if (num<= 20000)
                {
                    return 20000;
                }
                else if (num <= 100000)
                {
                    return 100000;
                }
                else if (num <= 150000)
                {
                    return 150000;
                }
                else if (num <= 200000)
                {
                    return 200000;
                }
                else if (num <= 250000)
                {
                    return 250000;
                }
                else if (num <= 300000)
                {
                    return 300000;
                }
                else
                {
                    return num;
                }
				
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
        <?php echo CHtml::button('Meja', array('id' => 'tombol_meja', 'onclick' => '$("#dialog_meja").dialog("open");', 'class' => 'big-button mybutton')); ?>
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
                    <td class="left">Tax (10%):</td>
                    <td class="right"><div id="sum_sale_tax">0</td>
                </tr>

            </table>
            <table class="tb_kanan kanan-footer">
                <tr>
                    <td class="left"><b>Total:</b></td>
                    <td class="right"><b><div id="sum_sale_total">0</div></b></td>
                </tr>
            </table>
        </div>
    </div>
</div>
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
		
		$("#pembayaran").on("keyup",function(){
			var bayar = $("#pembayaran").val();
			$("#pembayaran").val(bayar.replace(/[^\d,]+/g, ''));
			bayar = $("#pembayaran").val();
			// bayar = bayar.replace(/[^\d,]+/g, '');
			var sum_sale_total = $("#sum_sale_total").html();
			var kembalian = bayar-sum_sale_total;
			$("#kembalian").val(kembalian);
			// alert('asdasd');
		});
        
    });
</script>
<script>
	$('#sum_sale_discount2').change(function(){
		var disc = $('#sum_sale_discount2').val();
		alert(disc);
	});

    function test(){
       var service=$('#sum_sale_service').html();
       alert('service : '+service);
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
        if (event.keyCode>0){
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
        var subtotal = 0;
        liveSearchPanel_SalesItems.store.each(function (rec) { 
            subtotal += rec.get('item_price')*rec.get('quantity_purchased'); 
            sum += rec.get('item_total_cost'); 
            discount += rec.get('item_discount') * (rec.get('item_price')*rec.get('quantity_purchased')) /100 ; 
            
			tax += rec.get('item_tax'); 
        });

		// tax = (subtotal-discount)/10;
		
        $('#sum_sub_total').html(Math.round(subtotal));
        $('#sum_sale_discount').html(Math.round(discount));
        $('#sum_sale_tax').html(Math.round(tax));
         service  = 	var_service * (subtotal-discount)/ 100;
        //service  = 0;
        

        $('#sum_sale_service').html(Math.round(service));
        $('#sum_sale_total').html(Math.ceil(subtotal-discount+service+tax));
        $('#total_bayar').html(Math.ceil(subtotal-discount+tax+service));
        
    }

	
    function list_action(act)
    {   
		var sum_sale_total = $("#sum_sale_total").html();
		var kembalian = estimate($("#total_bayar").html())-sum_sale_total;
        switch(act)
        {        
            case 112 : $("#e1").select2("close"); $("#pembayaran").val(estimate($("#total_bayar").html()));
						$("#dialog_bayar").dialog("open");$("#pembayaran").focus(); 
						$("#kembalian").val(kembalian);
						break;
            case 113 :  $("#e1").select2("close"); $("#e1").select2("open"); break;
            case 114 : $("#e1").select2("close"); $("#dialog_meja").dialog("open"); break;
            case 115 :  $("#e1").select2("close"); $("#e1").select2("close"); liveSearchPanel_SalesItems.getView().focus(); liveSearchPanel_SalesItems.getView().focus(); liveSearchPanel_SalesItems.getSelectionModel().select(0);
                break;
            case 116 : baru(); kalkulasi1(); break;
            case 118 : cetakbill(); break;
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
    'id' => 'dialog_bayar',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Bayar',
        'autoOpen' => false,
        'modal' => true
    ),
));

$this->renderPartial('payment');

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

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
//echo "ramdnai";

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

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

<!--<input type=button onClick="cetakbill()" value="Cetak" class="mybutton">-->
<input type=button onClick="editdiskongrid()" value="Edit Diskon" class="mybutton">
<input type=button onClick="window.location.reload()" value="Baru" class="mybutton">
<!--input type=button onClick="cekisigrid()" value="cek isi grid" class="mybutton"-->
<!--input type=button onClick="test()" value="Cetak" class="mybutton"-->
<applet name="jzebra" code="jzebra.PrintApplet.class" archive="jZebra/jzebra/jzebra.jar" width="0" height="0">
    <param name="printer" value="zebra">
</applet>

<!--div id="msg-keypress">here press</div-->
