/*
CPPVKOEFS.grid.comboAuto=function (config) {
    config = config || {};
	 Ext.applyIf(config,{
	   id: 'cppvkoefs-combo-auto'
	   ,url:"/assets/components/cppvkoefs/mng/connector.php"
      //,url: CPPVKOEFS.config.connectorUrl
      ,baseParams: { action: 't2/getlist' }
      ,fields:['class','restint_1']
      ,displayField: 'class'
      ,valueField: 'restint_1'
      ,mode:'remote'

	 });
	 CPPVKOEFS.grid.comboAuto.superclass.constructor.call(this,config);
};	
Ext.extend(CPPVKOEFS.grid.comboAuto,MODx.combo.ComboBox);
Ext.reg('cppvkoefs-combo-auto',CPPVKOEFS.grid.comboAuto);
*/
Ext.onReady(function(){    

CPPVKOEFS.grid.storecombo = new Ext.data.JsonStore({    
    autoDestroy: true,
    url: '/assets/components/cppvkoefs/mng/connector.php', // backend, отвечающий за загрузку данных
    baseParams: { action: 't2/getlist' },    
    storeId: 'storeCombo',    
    fields:['class','restint_1'],
    root:'results'
});


Ext.util.Format.comboRenderer = function(combo){
    return function(value){
        var record = combo.findRecord(combo.valueField, value);
        return record ? record.get(combo.displayField) : combo.valueNotFoundText;
    }
}

CPPVKOEFS.grid.comboAuto=new Ext.form.ComboBox({
	   id: 'cppvkoefs-combo-auto',
      typeAhead: true,
      triggerAction: 'all',  
       store: CPPVKOEFS.grid.storecombo,      
       fields:['class','restint_1'],
       displayField: 'class',
       valueField: 'restint_1',
     // mode:'remote'
       lazyRender: true
	 });

CPPVKOEFS.grid.storecombo.load();
});

