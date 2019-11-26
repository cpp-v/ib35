CPPVMENU.writer_1 = new Ext.data.JsonWriter({
      encode: true,
      writeAllFields: true // иначе все поля зашлет на сервер
    });

CPPVMENU.MainStoreCfg={ 
 baseParams:{action: 'main/getlist'},
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
            'ves',          
            'price',            
            'is_catalog',
            'restint_2'           
        ],
 proxy: new Ext.data.HttpProxy({
            url: '/mdx/assets/components/menu35/mng/connector.php'
        })        
        
};