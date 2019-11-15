//alert("streets.grid.js  start");
Ext.onReady(function(){    
CPPVKOEFS.grid.autoColModel = new Ext.grid.ColumnModel([
    new Ext.grid.RowNumberer()
        ,{
            header: 'Класс (наименование)'
            ,dataIndex: 'class'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'textfield' }
        },
        {
            header: 'Номер (уникальный)'
            ,dataIndex: 'restint_1'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: 'ID'
            ,dataIndex: 'id'
            ,sortable: true
            ,width: 5
        }        

]);

CPPVKOEFS.grid.auto = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'cppvkoefs-grid-auto'
        ,url: '/assets/components/cppvkoefs/mng/connector.php'
        ,baseParams: { action: 't2/getlist' }
        ,fields: ['id','class','restint_1']
        ,paging: true
        ,pageSize: 50
        ,remoteSort: true
        ,anchor: '97%'
        ,autoExpandColumn: 'name'
        ,save_action: 't2/updateFromGrid' 
        ,autosave: true
        ,cm: CPPVKOEFS.grid.autoColModel
        ,tbar:[
            {
     style:{marginBottom: '10px', marginRight: '20px'}       	
    ,xtype: 'textfield'
    ,id: 'cppvkoefs_koefs-search-filter'
    ,emptyText: 'Поиск...'
    ,listeners: {
        'change': {fn:this.search,scope:this}
        ,'render': {fn: function(cmp) {
            new Ext.KeyMap(cmp.getEl(), {
                key: Ext.EventObject.ENTER
                ,fn: function() {
                    this.fireEvent('change',this);
                    this.blur();
                    return true;
                }
                ,scope: cmp
                                       });
                  },scope:this}
                }
    
             }
     ]
,getMenu: function() {
    return [{
        text: 'Удалить'
        ,handler: this.remove
    }
   ,{
        text: 'Добавить строку'
        ,handler: function(){
        MODx.msg.confirm({
        title: "Добавить запись "
        ,text: "Добавить строку?"
        ,url: this.config.url
        ,params: {
            action: 't2/create'
        }
        ,listeners: {
            'success': {fn:this.refresh,scope:this}
        }
    }); 
 
 
        }
    }

];
}
   ,remove: function() {
      MODx.msg.confirm({
        title: "Удаление записи"
        ,text: "Удалить запись?"
        ,url: this.config.url
        ,params: {
            action: 't2/remove'
            ,id: this.menu.record.id 
        }
        ,listeners: {
            'success': {fn:this.refresh,scope:this}
        }
    });
   }
})



    
CPPVKOEFS.grid.auto.superclass.constructor.call(this,config);
      //  alert("Counters.grid.Counters end");
				
};						//alert("Counters.grid.Citys 1");


        // - - - - -
Ext.extend(CPPVKOEFS.grid.auto,MODx.grid.Grid,{
    
    search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
                        //alert('tf='+s.baseParams.query);
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
	style: {
   	padding: '10px 20px'
	}
});
Ext.reg('cppvkoefs-grid-auto',CPPVKOEFS.grid.auto);

                                                                //alert("Counters.grid.Citys end");
});


