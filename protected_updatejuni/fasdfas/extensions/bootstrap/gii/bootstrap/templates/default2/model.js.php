<?php
echo
"Ext.define('".$this->modelClass."',{
    extend:'Ext.data.Model',
    autoLoad:true,
    fields:[";	
     ?>
		<?php foreach($this->tableSchema->columns as $column): 
			echo 
			 "{
				name:'".$column->name."',
				type:'".$column->type."'
			},\n";
		endforeach; ?>
<?php
echo    "]
});";
?>