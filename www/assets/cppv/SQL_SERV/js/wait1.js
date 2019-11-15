$(document).ready(function()
{
    wait=(function()
    {
     var p_={}, int_ID, shift,shift_img;
     p_.img_="/src/wait/sh.png";
     p_.img_wr_="/src/wait/wr.png";
     im_btn_l1=new Image(); im_btn_l1.src=p_.img_;     
     im_btn_l2=new Image(); im_btn_l1.src=p_.img_wr_;     
     var delay=50;
     var delta=4;
          
     p_.show=function(selector_){
     if($("#wait").length>0) return;
     
     shift=0;   
     $("<div id='wait' style='width:100px; height:100px; overflow:hidden; background-image:url(/src/wait/wr.png); background-repeat:no-repeat;'><img src='"+p_.img_+"'></div>").appendTo(selector_);
     $("#wait>img").css("position","relative");
     $("#wait>img").css("display","none");
     int_ID=setInterval(shift_img,delay);   //alert("delta="+delta+"    delay="+delay+"  shift="+shift);
     var el_w=$("#wait");
     var el_sel_=$(selector_);
     var offset=el_sel_.offset();
     var top_=offset.top+parseInt(el_sel_.height()/2);
     var left_=offset.left+parseInt(el_sel_.width()/2);         
     el_w.css({'position':'absolute','top':top_,'left':left_}); 
     };
     p_.hide=function(){if($("#wait").length==0) return;clearInterval(int_ID); $("#wait").remove();};     
     shift_img=function (){
     $("#wait>img").css("display","block");
     var r_=$("#wait").width()/3;
     shift+=delta;
     var x_=r_*Math.cos(shift/30); 
     var y_=r_*Math.sin(shift/30); 
     $("#wait>img").css("top",y_+r_);   
     $("#wait>img").css("left",x_+r_);   
     };       
     return p_;
    })(); 
}
);