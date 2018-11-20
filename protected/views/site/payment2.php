<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    $(document).ready( function(){
        $(".cb-enable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-disable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', true);
        });
        $(".cb-disable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-enable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', false);
        });
    });
</script>

<?php
// echo CHtml::textField('pembayaran', '0', array('onkeypress' => 'return runScript(event,"id_bayar")'));
// echo CHtml::dropDownList('payment', '0', Sales::model()->payment());
?>

<div class="konten-bayar">
    <div class="line" style="font-size:14px;font-weight:bold">Total Bayar : <label id="total_bayar">zz</label></div>
    <div class="line"><label><input type="text" class="myinput" placeholder="Kembalian" style="width:200px" id="kembalian"></input></label></div>
    <div class="line">
       <?php echo CHtml::dropDownList('payment', '0', Sales::model()->payment(), array('style'=>'width:200px')); ?>
    </div>
    <!--div style="clear:both"></div-->
    <div class="line"><label><input id="pembayaran" type="text" placeholder="Bayar" class="myinput" style="width:200px"></input></label></div>
    <input  type="button" value="Bayar" onClick="bayar(1,2,sale_id)" class="mybutton">
    <input  type="button" value="Void" onClick="void_bayar()" class="mybutton" style="margin-left:10px;">
</div>
<script>
    function collect_data()
    {
        $(function(){
            alert($("#sum_sub_total").html());            
        });
    }
    
    function kalkulasi()
    {
        $("#kembalian").val
    }
	
	
</script>
<!--input id="id_bayar" type="button" onclick='bayar(1,2,sale_id)' value="Bayar"-->