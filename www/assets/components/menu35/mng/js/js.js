alert("cppvkoefs js.js START!"); 
var CPPVMENU = function(config) {
    config = config || {};
    CPPVMENU.superclass.constructor.call(this,config);
};
Ext.extend(CPPVMENU,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('cppvmenu',CPPVMENU);
CPPVMENU = new CPPVMENU();


alert("cppvkoefs js.js end");
