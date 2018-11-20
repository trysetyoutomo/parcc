<script type="text/javascript" src="/postech/assets/4e98bbc2/jquery.js"></script>
<script type="text/javascript" src="/postech/assets/d9b05a5e/jquery-barcode.min.js"></script>
<h1>INI ADALAH BARCODE</h1>
<style type="text/css">
	.kotak{
		display: inline-block;
	}
</style>
<?php
echo '<div id="showBarcode"><div>'; //the same id should be given to the extension item id 

$optionsArray = array(
'elementId'=> 'showBarcode', /*id of div or canvas*/
'value'=> '4797001018719', /* value for EAN 13 be careful to set right values for each barcode type */
'type'=>'ean13',/*supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix*/

);
$this->widget('ext.barcode.Barcode', $optionsArray);