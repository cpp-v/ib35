//----------------------------------------------------------------------------------------
function WIN_LOGIN(call_b)
{
 var win_login=new WIN_PROTO();  
 win_login.height="auto"; 
 win_login.div_m="<br><span><b>Логин:</b></span><input type=text name='login'  value='' size=30>&nbsp;&nbsp;<span><b>Пароль:</b></span><input type=text name='autor'  value='' size=30><br>";
 win_login.show(); 
 ADD_SHADOW.call($("#win").get(0));
 $("#win #b ul li").bind("click",function(){
  if($(this).text()=="ОК")
  {   
   var passw=$("#win>#m>:input").eq(1).val();       
   var login=$("#win>#m>:input").eq(0).val();    
   $("#win").fadeTo(2000,0,function(){$("#win").remove();$("#wr").remove();});
   call_b({login:login,passw:passw});   
  }
 }); 
}
//----------------------------------------------------------------------------------------
function WIN_MESSAGE()
{
 this.body=""; 
 this.div_menu="<div id='t'><ul><li>Х</li></ul></div>";
 this.show_=function()
 {
  this.show();
  $("#win").css({"font-size":"18px","text-align":"left"}  );
  $("#win #t ul li").bind("click",function()
  {
   if($(this).text()=="Х")
   {
    $("#win").fadeTo(600,0,function(){$("#win").remove();$("#wr").remove();});
   }   
  }
  )
 }
}
//----------------------------------------------------------------------------------------
function WIN_MESSAGE_FULL(html)
{ 
 var w_proto=new WIN_PROTO();  w_proto.height="auto"; 
 WIN_MESSAGE.prototype=w_proto;
 var win_h=new WIN_MESSAGE();
 win_h.div_m=html;
 win_h.show_(); 
 $("#win").find("#b").find("li").eq(0).remove();
 ADD_SHADOW.call($("#win").get(0));
}
//----------------------------------------------------------------------------------------
function ADD_SHADOW()
{
var offset = $(this).offset();
var offset_wr = $("#wr").offset();
 
var h=$(this).height(); var w=$(this).width();
var l=parseInt($(this).css("left"))+5; t=parseInt($(this).css("top"))+5; 
var div_="<div style='opacity:1;border-radius:8px; background-color:black; position:absolute;width:"+w+"px; height:"+h+"px; left:"+(offset.left-offset_wr.left+5)+"px; top:"+(offset.top-offset_wr.top+5)+"px;'>&nbsp;</div>"; 
$("#wr").append(div_);
 
}
//----------------------------------------------------------------------------------------
function MY_ALERT(str_,delay_mms)
{
  $("#my_alert").remove();
 
  h_=$(window).height()/2;
  w_=$(window).width()/2-200;  
  var s_top_=$(window).scrollTop();
  var s_left_=$(window).scrollLeft();
 
 $("body").append("<div id='my_alert' style='position:absolute;width:100%;height:100%;z-index:400;font-size:30px; color:red;top:"+s_top_+"px; left:"+s_left_+"px; text-align:center; padding-top:30%;'>"+str_+"</div>");
 if(!delay_mms) delay_mms=3000;
 $("#my_alert").fadeTo(delay_mms,0,function(){$("#my_alert").each(function(i){$(this).remove();})});
}
//----------------------------------------------------------------------------------------
function WIN_PROTO()
{
  this.width="600px";
  this.height="400px";
  this.div_menu="<div id='t'><ul><li>Х</li></ul></div>";
  this.div_menu_b="<div id='b'><ul><li>ОК</li><li>ОТМЕНА</li></ul></div>";
  this.div_m="";
  this.show=function(){
  var h_=$(window).height();
  var w_=$(window).width();  
  var s_top_=$(window).scrollTop();
  var s_left_=$(window).scrollLeft();
  $("body").append("<div id='wr'>&nbsp;</div>");
  $("#wr").css({"top":s_top_+"px","left":s_left_+"px"});  
  $("body").append("<div id='win'></div>");
  var el_win=$("#win");
  el_win.css({"width":this.width, "height":this.height});
  el_win.css({"top":s_top_+h_/2-el_win.height()/2+"px","left":s_left_+w_/2-el_win.width()/2+"px"});
  el_win.prepend(this.div_menu);
  el_win.append("<div id='m'>"+this.div_m+"</div>");
  if(this.div_menu.length>5){el_win.append(this.div_menu_b);} 
  $("#win #t ul li").bind("click",function(){if($(this).text()=="Х"){$("#win").fadeTo(600,0,function(){$("#win").remove(); $("#wr").remove();});}})
  if(this.div_menu_b.length>5) 
  {   
  $("#win #b ul li").bind("click",function()
  {
   if($(this).text()=="ОТМЕНА")
   {
    $("#win").fadeTo(600,0,function(){$("#win").remove();$("#wr").remove();});
   }
  }
  )
 }
  } 
}
//----------------------------------------------------------------------------------------
function WIN_PR(class_wr,class_win,z_wr,z_win)
{
  this.width="600px";
  this.height="auto";
  this.div_menu="<div id='t'><ul><li>Х</li></ul></div>";
  this.div_m="";
  var test_=123;
  this.show=function()
  {
   if($("."+class_win).length>0) return;
   var h_=$(window).height();
   var w_=$(window).width();  
   
   var s_top_=$(window).scrollTop();
   var s_left_=$(window).scrollLeft(); 
   
   $("body").append("<div class='"+class_wr+"' id='wr'>&nbsp;</div>");  
   $("."+class_wr).css({"top":s_top_+"px","left":s_left_+"px","z-index":z_wr});  
   $("body").append("<div class='"+class_win+"' id='win'></div>");

  var el_win=$("."+class_win);
  var top_=s_top_+h_/2-el_win.height()/2;
  if(this.height=="auto") top_=s_top_+50; 
  //if(top_<s_top_) top_=s_top_;
  el_win.css({"width":this.width, "height":this.height,"z-index":z_win});
  el_win.append("<div id='m'>"+this.div_m+"</div>");
  el_win.css({"top":top_+"px","left":s_left_+w_/2-el_win.width()/2+"px"});
  el_win.prepend(this.div_menu);
      $("."+class_win+" #t ul li").bind("click",function(){if($(this).text()=="Х"){$("."+class_win).fadeTo(600,0,function(){$("."+class_win).remove();$("."+class_wr).remove();});}});
      $("."+class_win+" #t").bind("mousedown",function(e)
      {
         // $("."+class_win+" #mode").text(test_);
         $(this).attr("move_ready","1");
         var X= e.clientX;
         var Y= e.clientY;
         $(this).attr("X",X);
         $(this).attr("Y",Y);
         var X_=$(this).parent().eq(0).css("left");
         var Y_=$(this).parent().eq(0).css("top");
          $(this).attr("X_",X_);
          $(this).attr("Y_",Y_);

          $("body").bind("mousemove",function(e) {
           //   test_++;
              var el_menu=$("."+class_win+" #t");
              if (el_menu.attr("move_ready") == "0") return;
              var el_ = $("." + class_win);
              var X_new = e.clientX;
              var Y_new = e.clientY;
              var X_start_mouse = parseInt(el_menu.attr("X"));
              var Y_start_mouse = parseInt(el_menu.attr("Y"));
              var X_start_win = parseInt(el_menu.attr("X_"));
              var Y_start_win = parseInt(el_menu.attr("Y_"));
              var X_new_win;
              X_new_win = X_start_win + X_new - X_start_mouse;
              var Y_new_win;
              Y_new_win = Y_start_win + Y_new - Y_start_mouse;
              el_.css({"top":Y_new_win + "px", "left":X_new_win + "px"});
          });


          $("body").bind("mouseup",function(){ //$("."+class_win+" #mode").text(test_);
              var el_menu=$("."+class_win+" #t");
              el_menu.attr("move_ready","0");
             $("body").unbind("mousemove");



          });
      });

      el_win.css("opacity",0.1);
  el_win.animate({opacity:1}, 500);
  }

  this.hide=function(){$("."+class_win).fadeTo(600,0,function(){$("."+class_win).remove();$("."+class_wr).remove();});}
}
//----------------------------------------------------------------------------------------





