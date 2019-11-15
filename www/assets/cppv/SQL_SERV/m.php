<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru-RU" xml:lang="ru-RU">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
    <title>SQL SERVICE</title>
    <script type="text/javascript" src="js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js.js"></script>
    <script src="js/wait1.js" type="text/javascript"></script>
    <script src="win_2012/win.js" type="text/javascript"></script>
    <link rel="STYLESHEET" type="text/css" href="win_2012/win.css">

    <script type="text/javascript" src="wysiwyg/jquery.wysiwyg.js"></script>
    <link rel="stylesheet" href="wysiwyg/jquery.wysiwyg.css" type="text/css"/>


    <script type="text/javascript" src="wysiwyg/wysiwyg.fileManager.js"></script>
    <link rel="stylesheet" href="wysiwyg/wysiwyg.fileManager.css">

    <link rel="STYLESHEET" type="text/css" href="css/bt_green.css">
    <link rel="STYLESHEET" type="text/css" href="css/t_2012.css">
</head>
<body>
<div style="background-color: #bac5cc; text-align: center; padding: 10px; margin-bottom: 3px;">
<h3>SQL_SERVICE</h3>
</div>
 <div style="height: 100%; width: 30%; background-color: #b3b3ff; float: left; padding: 5px; margin-right: 10px;">

     <fieldset id="base" style="text-align: right;">
             <legend>БАЗА(mySQL):</legend>
             server: <input type="text" name="server" style="width: auto;"/><br>
             user: <input type="text" name="user" style="width: auto;"/><br>
             passw: <input type="text" name="passw" style="width: auto;"/><br>
             db_name:  <input type="text" name="db_name" style="width: auto;"/><br>
         </fieldset>
     <fieldset id="tables" style="text-align: right;">
         <legend>ТАБЛИЦЫ:</legend>
         <select name="table_name" id="table_list">
             <option value="-1">Пустой список</option>
         </select>
         <div class='b_gr'><ul><li id="TABLE_LOAD">ЗАПРОСИТЬ</li></ul></div>
     </fieldset>
     <fieldset id="sql_qewry" style="text-align: right;">
        <legend>SQL_ЗАПРОС</legend>
       <select id="sql_type"  onchange="sql_type_chenge.call(this);">
           <option value="show tables">SHOW TABLES</option>
           <option value="describe">DESCRIBE</option>
           <option value="select">SELECT</option>
           <option value="update">UPDATE</option>
           <option value="alter">ALTER</option>
           <option value="insert">INSERT</option>
           <option value="create">CREATE</option>
       </select>


       <textarea name="sql_text" style="width: 100%; height: 150px;">
       </textarea>
         <div class='b_gr'><ul><li id="START">СТАРТ</li></ul></div>
     </fieldset>
     <fieldset id="mata_table">
         <legend>Таблица. Метаданные.</legend>
         <select name="t_oper_name" id="table_oper_list">
             <option value="meta_create">Сгенерить "CREATE TABLE..."</option>
             <option value="meta_out">Выгрузить данные</option>
             <option value="meta_in">Загрузить данные</option>
             <option value="meta_csv">Выгрузить выборку в CSV</option>
         </select>
         <div class='b_gr'><ul><li id="meta_START">START</li></ul></div>
     </fieldset>
 </div>
<div id="cont_" style="width: auto; background-color: #edf47e; padding: 5px;">
    &nbsp;
</div>
<div style="margin-top: 3px; clear: both; background-color: #0b77b7; color: #fff5ee; width:auto; margin-top: 3px; text-align: right; padding: 5px;" >
   <strong> aset. 2012.</strong>
</div>
</body>
</html>
