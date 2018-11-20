<?php

echo "
var form_add;
var form_add_window;

form_add = Ext.create('Ext.form.Panel', {
    width: 500,
    height: 300,
    layout: 'form',
    frame: true,
    bodyPadding: 5,
    defaultType: 'textfield',
    url:'index.php?r=".strtolower($this->modelClass)."/create',
    buttons : [
    {
        'xtype':'button',
        'text':'Save',
        'handler':function()
        {
            
            var form = this.up('form').getForm();
            if (form.isValid()) {
                form.submit({
                    success: function(form, action) {
                        form_add_window.close();
                        liveSearchPanel.getView().refresh();
                    },
                    failure: function(form, action) {
                        Ext.Msg.alert('Failed', action.result.msg);
                        form_add_window.close();
                    }
                });
            }
        }
    }
    ],
    items: [";
	?>
	<?php foreach($this->tableSchema->columns as $column): 
			echo "
				{
					fieldLabel: '".$column->name."',
					name: '".$column->name."',
					allowBlank:false
				},";
			endforeach; ?>
	<?php echo "
    ]
});

form_add_window =  Ext.create('Ext.window.Window', {
    title: 'Add Data ".$this->modelClass."',
    height: 200,
    width: 400,
    layout: 'fit',
    items: form_add,
    closeAction:'hide'
});
";
?>