    //alert('Conters.panel.Home  start');
Ext.onReady(function(){     
    
CPPVKOEFS.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>Параметры калькулятора</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        }
        ,
        {
         tbar:[]    
        }
        ,
         {
            xtype: 'modx-tabs'
            ,id: 'cppvkoefs_home_tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,stateful: true
            ,stateId: 'cppvkoefs-home-tabpanel'
            
            ,stateEvents: ['tabchange']
            ,getState:function() {
                return {activeTab:this.items.indexOf(this.getActiveTab())};
            }
            ,items:[
                { title:"Таблица параметров",defaults: { autoHeight: true }, 
                  items:[
	                   {  html: '<p>Установка коэфициентов и прочих параметров.</p>'
   	                  ,border: false
      	               ,bodyCssClass: 'panel-desc'
                      },
                      {
                         xtype: 'cppvkoefs-grid-koefs'
                      } 
                   ]  
                },     
                { title:"Классы машин",defaults: { autoHeight: true }, 
                  items:[
	                   {  html: '<p>Заполнение таблицы классов машин</p>'
   	                  ,border: false
      	               ,bodyCssClass: 'panel-desc'
                      },
                      {
                          xtype: 'cppvkoefs-grid-auto'
                      } 
                   ]  
                },     
                { title:"Прочие параметры",defaults: { autoHeight: true }, 
                  items:[
	                   {  html: '<p>Прочие одиночные параметры</p>'
   	                  ,border: false
      	               ,bodyCssClass: 'panel-desc'
                      },
                      
                      CPPVKOEFS.grid.prop
                       
                   ]  
                }    
            ]     
          
/*          
                    xtype: 'mrph35-grid-mrph35'
                    ,cls: 'main-wrapper'
                    ,preventRender: true
*/                    
          }
        
        ]
    });
    CPPVKOEFS.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(CPPVKOEFS.panel.Home,MODx.Panel);
Ext.reg('cppvkoefs-panel-home',CPPVKOEFS.panel.Home);

});