//alert("section/index.js start");

CPPVKOEFS.page.Home = function(config) {
    //alert("Counters.page.Home start");
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'cppvkoefs-panel-home'
            ,renderTo: 'cppvkoefs-panel-home-div'
        }]
    });
    CPPVKOEFS.page.Home.superclass.constructor.call(this,config);
    //alert("Counters.page.Home end");

};
Ext.extend(CPPVKOEFS.page.Home,MODx.Component);
Ext.reg('cppvkoefs-page-home',CPPVKOEFS.page.Home);

//alert("section/index.js end");

Ext.onReady(function() {
    MODx.load({ xtype: 'cppvkoefs-page-home'});
});
