//alert("streets.grid.js  start");
Ext.onReady(function(){
	    
CPPVKOEFS.grid.koefsColModel = new Ext.grid.ColumnModel([
    new Ext.grid.RowNumberer(),
        {
            header: 'н сортировки'
            ,dataIndex: 'restint_2'
            ,sortable: true
            ,width: 50
            ,editor: { xtype: 'numberfield' }
        }
        ,
                
        {
            header: 'Наименование (необяз.)'
            ,dataIndex: 'name'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'textfield' }
        },
        {
            header: '1 Расстояние'
            ,dataIndex: 'restint_1'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: '2 Расстояние'
            ,dataIndex: 'dist'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: 'Кол-во людей'
            ,dataIndex: 'count'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        
        {
            header: 'Класс автомобиля'
            ,dataIndex: 'classauto'
            ,sortable: true
            ,width: 100
            //,editor: { xtype: 'cppvkoefs-combo-auto', renderer: true }
            ,renderer: Ext.util.Format.comboRenderer(CPPVKOEFS.grid.comboAuto) 
            ,editor: CPPVKOEFS.grid.comboAuto
            
        },
        
        {
            header: 'k сезон'
            ,dataIndex: 'k_sezon'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: 'k авто'
            ,dataIndex: 'k_auto'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: 'k пассажиров'
            ,dataIndex: 'k_pass'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: 'k растояния'
            ,dataIndex: 'k_dist'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: 'Цена'
            ,dataIndex: 'price'
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



CPPVKOEFS.grid.koefs = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'cppvkoefs-grid-koefs'
        ,url: '/assets/components/cppvkoefs/mng/connector.php'
        ,baseParams: { action: 't1/getlist' }
        ,fields: ['id','name','dist','count','classauto','k_sezon','k_auto','k_pass','k_dist','price','restint_1','restint_2']
        ,paging: true
        ,pageSize: 50
        ,remoteSort: false
        ,anchor: '97%'
        ,autoExpandColumn: 'name'
        ,save_action: 't1/updateFromGrid' 
        ,autosave: true
        ,cm: CPPVKOEFS.grid.koefsColModel
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
            action: 't1/create'
            //,id: this.menu.record.id 
        }
        ,listeners: {
            'success': {fn:this.refresh,scope:this}
        }
    }); 
 
 
        }
    },
    {
        text: 'Дублировать строку'
        ,handler: function(){
        MODx.msg.confirm({
        title: "Дубль записи "
        ,text: "Сделать копию строки?"
        ,url: this.config.url
        ,params: {
            action: 't1/dubl'
            ,id: this.menu.record.id 
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
            action: 't1/remove'
            ,id: this.menu.record.id 
        }
        ,listeners: {
            'success': {fn:this.refresh,scope:this}
        }
    });
   }
})



    
CPPVKOEFS.grid.koefs.superclass.constructor.call(this,config);
      //  alert("Counters.grid.Counters end");
				
};						//alert("Counters.grid.Citys 1");


        // - - - - -
Ext.extend(CPPVKOEFS.grid.koefs,MODx.grid.Grid,{
    
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
Ext.reg('cppvkoefs-grid-koefs',CPPVKOEFS.grid.koefs);



                                                                //alert("Counters.grid.Citys end");
});


