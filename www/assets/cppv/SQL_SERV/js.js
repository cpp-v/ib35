/**
 * Created with JetBrains PhpStorm.
 * User: 1
 * Date: 07.08.12
 * Time: 16:20
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
    cfg_l={};
    CFG={};
    cfg_fm={};
    cfg_fm.passw="jwysiwyg";
    cfg_fm.dir_up="";
    $.wysiwyg.fileManager.setAjaxHandler("/src/jwysiwyg/plugins/fileManager/handlers/PHP/file-manager.php");
    $("#START").click(function(){
        $("#cont_").html("");
        /*
        var server= $(":input[name='server']").val();
        var user= $(":input[name='user']").val();
        var passw= $(":input[name='passw']").val();
        var db_name= $(":input[name='db_name']").val();
        var sql_text=$(":input[name='sql_text']").val();

        $.post("./aj.php",{task:"sql_start",server:server,user:user,passw:passw,db_name:db_name,sql_text:sql_text},function(data){
         $("#cont_").html(data);
        },"html");
       */
        CFG_load_db_param();
        CFG["task"]="sql_start";
        $.post("./aj.php",CFG,function(data){
            $("#cont_").html(data);
        },"html");

    }
);

    $("#TABLE_LOAD").click(function(){
    $("#cont_").html("");
            CFG_load_db_param();
            CFG["task"]="table_list_load";
            $.post("./aj.php",CFG,function(data){
                $("select#table_list").html(data);
                //$("#cont_").html(data);
            },"html");

            //$.post("./aj.php",{task:"table_list_load",server:server,user:user,passw:passw,db_name:db_name},function(data){
            /*$("select#table_list").html(data);*/
  //          $("#cont_").html(data);
  //      },"html");*/


 }
);
    $("#meta_START").click(function(){
        $("#cont_").html("");
        CFG_load_db_param();
    CFG["task"]="meta_start";
    CFG["meta"]=$(":input[name='t_oper_name']").val();
    //alert(CFG["meta"]);
    if(CFG["meta"]=="meta_in") { win_meta_file_in_load(); return; }

        $.post("./aj.php",CFG,function(data){
            $("#cont_").html(data);
        },"html");
    });

});
//=====================================================
function win_meta_file_in_load()
{
 data="<div id='win_add' style='text-align:left; font:bold 10px/10px;'>\
 <div id='mode'></div>\
 <br>Файл: <input type='text' name='file_' style='width:95% ;'/><div class='wysiwyg-fileManager' title='Загрузка файла'>&nbsp;</div>\
 <br>\
 <br>\
 <br>\
 <div class='b_gr'><ul><li id='START'>СТАРТ</li></ul></div>\
</div>";
    var win_=new WIN_PR("my_wr_1","my_win_1",100,101);
    cfg_l["win_1"]=win_;
    win_.height="auto";
    win_.width="300px";
    win_.div_m=data;

    win_.show();
    $(".my_win_1").get(0).style.height="auto";
    $("div.wysiwyg-fileManager").eq(0).bind("click", function ()
    {
       cfg_fm.dir_up="";//$(el_).find("input[name='dir_']").val();
       $.wysiwyg.fileManager.init(function (selected) {
           // alert(selected);
            var el_=$(".my_win_1");
            var inp_=$(el_).find("input[name='file_']");
            var f_=selected.replace(/\\/,"\/");
            inp_.val(f_);
       });});

    $("#START",".my_win_1").click(function(){
      $f_name_=$(":input[name='file_']",".my_win_1").eq(0).val();
      CFG["file_"]=$f_name_;
      $.post("./aj.php",CFG,function(data){$("#cont_").html(data);},"html");
      cfg_l["win_1"].hide();
    });

}
//=====================================================

function CFG_load_db_param()
{
  CFG["server"]= $(":input[name='server']").val();
  CFG["user"]= $(":input[name='user']").val();
  CFG["passw"]= $(":input[name='passw']").val();
  CFG["db_name"]= $(":input[name='db_name']").val();
  CFG["table_name"]= $(":input[name='table_name']").val();
  CFG["sql_text"]=$(":input[name='sql_text']").val();
}
//=====================================================
function sql_type_chenge()
{
 var sql_type=this.value;
 var arr_sql=[];
    arr_sql["show tables"]="show tables";
    arr_sql["describe"]="describe #t#";
    arr_sql["select"]="select * from #t# where 1=1 limit 10";
    arr_sql["update"]="update #t# set #fielde#=#value#";
    arr_sql["alter"]="alter TABLE #t# add `#fielde#` varchar(50) null";
    arr_sql["insert"]="insert into #t# VALUES (values,…)";
    arr_sql["create"]="show create table #t#";
    var t_name=$("select#table_list").val();
    var txt_=arr_sql[sql_type].replace(/#t#/g,t_name);
    $(":input[name='sql_text']").val(txt_);
}
//=====================================================

