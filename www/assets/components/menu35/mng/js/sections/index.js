
CPPVMENU.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'menu35-panel-home'
            ,renderTo: 'menu35-panel-home-div'
        }]
    });
    CPPVMENU.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(CPPVMENU.page.Home,MODx.Component);
Ext.reg('menu35-page-home',CPPVKOEFS.page.Home);

Ext.onReady(function() {
    MODx.load({ xtype: 'menu35-page-home'});
});
