//alert("streets.grid.js  start");
//Ext.onReady(function(){
	    
CPPVMENU.grid.mainColModel = new Ext.grid.ColumnModel([
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
            //,editor: { xtype: 'textfield' }
        }
        
        ,
        {
            header: 'Состав'
            ,dataIndex: 'description'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'textfield' }
        },
        {
            header: 'Порция(вес)'
            ,dataIndex: 'ves'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },
        {
            header: 'Каталог'
            ,dataIndex: 'is_catalog'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'numberfield' }
        },{
            header: 'ID'
            ,dataIndex: 'id'
            ,sortable: true
            ,width: 5
        },{
            header: 'Родитель'
            ,dataIndex: 'parent'
            ,sortable: true
            ,width: 5
        }
                

]);



CPPVMENU.grid.main_CFG = {
	/*
        id: 'menu35-grid-main'
        ,url: '/assets/components/cppvkoefs/mng/connector.php'
        ,baseParams: { action: 't1/getlist' }
        ,fields: ['id','name','dist','count','classauto','k_sezon','k_auto','k_pass','k_dist','price','restint_1','restint_2']
   */      
        //store: CPPVMENU.MainStoreCfg
        title:'Заголовок'       
        ,paging: true
        ,width: 800
        ,height:600
        ,pageSize: 50
        ,remoteSort: false
        ,anchor: '97%'
        //,autoExpandColumn: 'name'
        ,save_action: 't1/updateFromGrid' 
        ,autosave: true
        ,cm: CPPVMENU.grid.mainColModel
        ,tbar:[
            {
     style:{marginBottom: '10px', marginRight: '20px'}       	
    ,xtype: 'textfield'
    ,id: 'menu35-mg-search-filter'
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
            action: 'main/create'
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
            action: 'main/remove'
            ,id: this.menu.record.id 
        }
        ,listeners: {
            'success': {fn:this.refresh,scope:this}
        }
    });
   }
   ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
                        //alert('tf='+s.baseParams.query);
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
	style: {
   	padding: '10px 20px'
	}
};

CPPVMENU.grid.main_start=function () {
console.log('CPPVMENU.grid.main_start');

CPPVMENU.mainStore = new Ext.data.JsonStore(CPPVMENU.MainStoreCfg);

CPPVMENU.grid.main=new Ext.grid.EditorGridPanel(CPPVMENU.grid.main_CFG); 
//CPPVMENU.grid.main=new MODx.grid.Grid(CPPVMENU.grid.main_CFG); 
CPPVMENU.grid.main.store=CPPVMENU.mainStore;

CPPVMENU.grid.main.render('menu35-main-grid');

	CPPVMENU.mainStore.load();


}



                                                                //alert("Counters.grid.Citys end");
//});//Ext.onReady


