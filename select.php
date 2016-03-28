  <?php

         $con = mysql_connect("10.192.11.199:3306","root","");
         if (!$con)
           {
             die('Could not connect: ' . mysql_error());
           }

           mysql_select_db("ex1", $con);
           $v1=$_REQUEST['f1'];
          if($v1==NULL)
            {


                $r["re"]="Enter the number!!!";
                 print(json_encode($r));
                die('Could not connect: ' . mysql_error());
          }

          else

            {


                $i=mysql_query("select * from t1 where f1=$v1",$con);
               $check='';
               while($row = mysql_fetch_array($i))
                {
  
                  $r[]=$row;
                  $check=$row['f1'];
                 }
                  if($check==NULL)
                   {            
                      $r["re"]="Record is not available";
                      print(json_encode($r));
                 
                     }
                   else
                     {
                         $r["re"]="success";
                            print(json_encode($r));
                              
                       } 



}

 mysql_close($con);
               
    ?> 