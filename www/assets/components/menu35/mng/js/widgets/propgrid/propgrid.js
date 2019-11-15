Ext.onReady(function(){    
    CPPVKOEFS.grid.prop = new Ext.grid.PropertyGrid({
        //renderTo: 'prop-grid',
        width: 300,
        autoHeight: true,
        propertyNames: {
            sezon: 'Сезонный k',
            test: 'Тестовое для строкм',
            d:'Тестовое для даты'
        },
        source: {
           // sezon: 1,
           // test:'строка',
           // d:new Date()   
        },
        viewConfig : {
            forceFit: true,
            scrollOffset: 2 // the grid will never have scrollbars
        }
    });

   CPPVKOEFS.grid.prop.on('afteredit', afterEdit, this );
 
  function afterEdit(e) {
    // execute an XHR to send/commit data to the server, in callback do (if successful):
    console.log('afterEdit');
    console.log(e);
    var obj={};
    //var parObj={}; parObj.name= ;parObj.value=
    
    obj.data=JSON.stringify(e.record.data);
   Ext.Ajax.request({
   url: '/assets/components/cppvkoefs/mng/js/widgets/propgrid/prop.php',
   params:obj,
   success: function(response, opts) {
      var obj = Ext.decode(response.responseText);
      console.dir(obj);
      e.record.commit();    
   },
   failure: function(response, opts) {
      console.log('server-side failure with status code ' + response.status);
   }
  });    
    
         
  };

  //загрузим с сервера
   Ext.Ajax.request({
   url: '/assets/components/cppvkoefs/mng/js/widgets/propgrid/params.json',
   success: function(response, opts) {
      console.dir(response);  
      var obj = Ext.decode(response.responseText);
      console.dir(obj);  CPPVKOEFS.grid.prop.setSource(obj);
   },
   failure: function(response, opts) {
      console.log('server-side failure with status code ' + response.status);
   }
  });    



});