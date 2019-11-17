<!doctype html>
<html lang=ru>
  <head>
      <meta charset=utf-8>
      <title>AS TEST</title>
 </head>
 <body>
 		<style type="text/css">
         body{
           width:1000px;
           margin:10px auto;         
         }      
    		footer{
           height:20px;
           text-align: right;   		
    		
    		}
		</style>
      <section id="content">
        <pre>
           <?php
             readfile(__DIR__.'/debug.txt');
           ?>
        </pre>   
      </section>
 
      <footer>aset 2018</footer>
   </body>
</html>