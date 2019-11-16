CPPVMENU.writer_1 = new Ext.data.JsonWriter({
      encode: true,
      writeAllFields: true // иначе все поля зашлет на сервер
    });

CPPMENU.MainStoreCfg={ 
 baseParams:{action: 'getlist'},
 root: 'results',
 totalProperty: 'total',
 idProperty: 'id',
 remoteSort: true,  
 writer: CPPVMENU.writer_1,	
 fields: [
            'id', 
            'name',
            {name: 'description', type: 'text'},
            'parent',            
            'ves',,            
            'price',            
            'is_catalog'}            
        ],
 proxy: new Ext.data.HttpProxy({
            url: '/assets/components/menu35/mng/connector.php'
        })
        
};