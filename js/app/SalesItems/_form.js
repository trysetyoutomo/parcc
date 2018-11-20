
var form_add_SalesItems;
var form_add_window_SalesItems;

form_add_SalesItems = Ext.create('Ext.form.Panel', {
    width: 500,
    height: 300,
    layout: 'form',
    frame: true,
    bodyPadding: 5,
    defaultType: 'textfield',
    url:'index.php?r=salesitems/create',
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
                        form_add_window_SalesItems.close();
                        liveSearchPanel_SalesItems.getStore().load();
                    },
                    failure: function(form, action) {
                        Ext.Msg.alert('Failed', action.result.msg);
                        form_add_window_SalesItems.close();
                    }
                });
            }
        }
    }
    ],
    items: [	
				{
					fieldLabel: 'id',
					name: 'id',
					allowBlank:false
				},
				{
					fieldLabel: 'sale_id',
					name: 'sale_id',
					allowBlank:false
				},
				{
					fieldLabel: 'item_id',
					name: 'item_id',
					allowBlank:false
				},
				{
					fieldLabel: 'quantity_purchased',
					name: 'quantity_purchased',
					allowBlank:false
				},
				{
					fieldLabel: 'item_tax',
					name: 'item_tax',
					allowBlank:false
				},
				{
					fieldLabel: 'item_price',
					name: 'item_price',
					allowBlank:false
				},
				{
					fieldLabel: 'item_discount',
					name: 'item_discount',
					allowBlank:false
				},
				{
					fieldLabel: 'item_total_cost',
					name: 'item_total_cost',
					allowBlank:false
				},	
    ]
});

form_add_window_SalesItems =  Ext.create('Ext.window.Window', {
    title: 'Add Data SalesItems',
    height: 200,
    width: 400,
    layout: 'fit',
    items: form_add_SalesItems,
    closeAction:'hide'
});
