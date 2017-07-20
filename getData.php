<?php
   $dbhost = 'localhost';
   $dbuser = 'moniter';
   $dbpass = 'password';
   
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   
   $sql1 = 'SELECT * FROM tempTable ORDER BY timestamp DESC LIMIT 1';
   $sql2 = 'SELECT * FROM phTable ORDER BY timestamp DESC LIMIT 1';
   $sql3 = 'SELECT * FROM weightTable ORDER BY timestamp DESC LIMIT 1';
   $sql4 = 'SELECT * FROM gasTable ORDER BY timestamp DESC LIMIT 1';
   $sql5 = 'SELECT * FROM humidityTable ORDER BY timestamp DESC LIMIT 1';

   mysql_select_db('lostbytes');

   $retval1 = mysql_query( $sql1, $conn );
   $retval2= mysql_query( $sql2, $conn );
   $retval3 = mysql_query( $sql3, $conn );
   $retval4 = mysql_query( $sql4, $conn );
   $retval5 = mysql_query( $sql5, $conn );
     
   if(! $retval1 ) {
      die('Could not get data: ' . mysql_error());
   }
   if(! $retval2 ) {
      die('Could not get data: ' . mysql_error());
   }
   if(! $retval3 ) {
      die('Could not get data: ' . mysql_error());
   }
   if(! $retval4 ) {
      die('Could not get data: ' . mysql_error());
   }
   if(! $retval5 ) {
      die('Could not get data: ' . mysql_error());
   }
   
   $row1 = mysql_fetch_array($retval1); 
   $row2 = mysql_fetch_array($retval2);
   $row3 = mysql_fetch_array($retval3);
   $row4 = mysql_fetch_array($retval4);
   $row5 = mysql_fetch_array($retval5);

   $temp = $row1['temp'];
   $ph = $row2['ph'];
   $weight = $row3['weight'];
   $gas = $row4['gas'];
   $humidity = $row5['humidity'];
   
   echo $temp . '|';
   echo $ph . '|';
   echo $weight . '|';
   echo $gas . '|';
   echo $humidity . '|';
   
   mysql_close($conn);
?>