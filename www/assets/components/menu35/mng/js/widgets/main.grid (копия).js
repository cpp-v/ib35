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

	
 function onAdd (btn, ev) {
        var u = new CPPVMENU.mainStore.recordType({
           name : 'Новое название',
           description : '',
        });
        CPPVMENU.rowEditor.stopEditing();
        CPPVMENU.mainStore.insert(0, u);
        CPPVMENU.rowEditor.startEditing(0);
 }
    /**
     * onDelete
     */
   function onDelete () {
        var rec = CPPVMENU.grid.main.getSelectionModel().getSelected();
        if (!rec) {
            return false;
        }
        CPPVMENU.grid.main.store.remove(rec);
  }
	


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
        //,save_action: 'main/updateFromGrid' 
        ,autosave: true
        ,eitor:CPPVMENU.rowEditor
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
             
		,{
            text: 'Add',
            iconCls: 'silk-add',
            handler: onAdd
        }, '-', {
            text: 'Delete',
            iconCls: 'silk-delete',
            handler: CPPVMENU.onDelete
        }, '-'             
             
     ]

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

CPPVMENU.rowEditor = new Ext.ux.grid.RowEditor({
       saveText: 'Update' 
    });
    
    
CPPVMENU.mainStore = new Ext.data.JsonStore(CPPVMENU.MainStoreCfg);

CPPVMENU.grid.main=new Ext.grid.GridPanel(CPPVMENU.grid.main_CFG);

CPPVMENU.rowEditor.grid=CPPVMENU.grid.main; 
 
//CPPVMENU.grid.main=new Ext.grid.EditorGridPanel(CPPVMENU.grid.main_CFG);

//CPPVMENU.grid.main=new MODx.grid.Grid(CPPVMENU.grid.main_CFG);
 
CPPVMENU.grid.main.store=CPPVMENU.mainStore;

CPPVMENU.grid.main.render('menu35-main-grid');

	CPPVMENU.mainStore.load();

    /**
     * onAdd
     */


}



                                                                //alert("Counters.grid.Citys end");
//});//Ext.onReady


