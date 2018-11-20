Ext.onReady(function () {
    Ext.tip.QuickTipManager.init();

    // create some portlet tools using built in Ext tool ids
    var tools = [{
        type: 'gear',
        handler: function () {
            Ext.Msg.alert('Message', 'The Settings tool was clicked.');
        }
    }, {
        type: 'close',
        handler: function (e, target, panel) {
            panel.ownerCt.remove(panel, true);
        }
    }];

    Ext.create('Ext.Viewport', {
        layout: 'fit',
        items: [{
            xtype: 'grouptabpanel',
            activeGroup: 0,
            listeners: {
                click: {
                    element: 'body', //bind to the underlying el property on the panel
                    fn: function(){
                        alert('click el');
                    }
                }
            },
            items: [{
                mainItem: 1,
                items: [
                {
                    title: 'Bahan Baku',
                    iconCls: 'x-icon-subscriptions',
                    tabTip: 'Subscriptions tabtip',
                    style: 'padding: 10px;',
                    border: false,
                    layout: 'fit',
                    items: liveSearchPanel_Customers
                    
                },
                {
                    title: 'Data Dashboard',
                    iconCls: 'x-icon-subscriptions',
                    tabTip: 'Subscriptions tabtip',
                    style: 'padding: 10px;',
                    border: false,
                    layout: 'fit'
                    
                },
                {
                    title: 'Users',
                    iconCls: 'x-icon-users',
                    tabTip: 'Users tabtip',
                    style: 'padding: 10px;',
                    items:liveSearchPanel_Users
                },
                {
                    title: 'Kategori',
                    iconCls: 'x-icon-users',
                    tabTip: 'Users tabtip',
                    style: 'padding: 10px;'
                },{
                    title: 'Supplier',
                    iconCls: 'x-icon-users',
                    tabTip: 'Users tabtip',
                    style: 'padding: 10px;',
                    html: 'leuwih pinter'
                },{
                    title: 'Unit',
                    iconCls: 'x-icon-users',
                    tabTip: 'Users tabtip',
                    style: 'padding: 10px;',
                    html: 'leuwih pinter'
                },{
                    title: 'Bank',
                    iconCls: 'x-icon-users',
                    tabTip: 'Users tabtip',
                    style: 'padding: 10px;',
                    html: 'leuwih pinter'
                },
                {
                    title: 'Branch',
                    iconCls: 'x-icon-users',
                    tabTip: 'Users tabtip',
                    style: 'padding: 10px;',
                    html: 'leuwih pinter'
                },{
                    title: 'Payment Type',
                    iconCls: 'x-icon-users',
                    tabTip: 'Users tabtip',
                    style: 'padding: 10px;',
                    html: 'leuwih pinter'
                },
				
				
                ]
            }, {
                expanded: true,
                items: [{
                    title: 'Configuration',
                    iconCls: 'x-icon-configuration',
                    tabTip: 'Configuration tabtip',
                    style: 'padding: 10px;',
                    html: 'doll'
                }, {
                    title: 'Email Templates',
                    iconCls: 'x-icon-templates',
                    tabTip: 'Templates tabtip',
                    style: 'padding: 10px;',
                    border: false,
                    items: {
                        xtype: 'form',
                        // since we are not using the default 'panel' xtype, we must specify it
                        id: 'form-panel',
                        labelWidth: 75,
                        title: 'Form Layout',
                        bodyStyle: 'padding:15px',
                        labelPad: 20,
                        defaults: {
                            width: 230,
                            labelSeparator: '',
                            msgTarget: 'side'
                        },
                        defaultType: 'textfield',
                        items: [{
                            fieldLabel: 'First Name',
                            name: 'first',
                            allowBlank: false
                        }, {
                            fieldLabel: 'Last Name',
                            name: 'last'
                        }, {
                            fieldLabel: 'Company',
                            name: 'company'
                        }, {
                            fieldLabel: 'Email',
                            name: 'email',
                            vtype: 'email'
                        }],
                        buttons: [{
                            text: 'Save'
                        }, {
                            text: 'Cancel'
                        }]
                    }
                }]
            }, {
                expanded: false,
                items: {
                    itemId : 'coba',
                    title: 'Single item in third',
                    bodyPadding: 10,
                    html: '<h1>The third tab group only has a single entry.<br>This is to test the tab being tagged with both "first" and "last" classes to ensure rounded corners are applied top and bottom</h1>',
                    border: false
                }
            }]
        }]
    });
});