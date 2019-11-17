    //alert('Conters.panel.Home  start');
Ext.onReady(function(){
CPPVMENU.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>Menu</h2>'
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
            ,id: 'cppvmenu_home_tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,stateful: true
            ,stateId: 'cppvmenu-home-tabpanel'
            
            ,stateEvents: ['tabchange']
            ,getState:function() {
                return {activeTab:this.items.indexOf(this.getActiveTab())};
            }
            ,items:[
                { title:"Меню",defaults: { autoHeight: true }, 
                  items:[
	                   {  html: '<div id="menu35-main-grid"></div>'
   	                  ,border: false
      	               ,bodyCssClass: 'panel-desc'
                      },
                      {
                        // xtype: 'cppvkoefs-grid-koefs'
                      } 
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
    CPPVMENU.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(CPPVMENU.panel.Home,MODx.Panel);
Ext.reg('menu35-panel-home',CPPVMENU.panel.Home);

});