    <?php

         $con = mysql_connect("10.192.11.199:3306","root","");
         if (!$con)
           {
             die('Could not connect: ' . mysql_error());
           }

           mysql_select_db("ex1", $con);


             $v1=$_REQUEST['f1'];
             $v2=$_REQUEST['f2'];
             $v3=$_REQUEST['f3']; 
   
              if($v1==NULL || $v2==NULL || $v3==NULL)
              {
                 $r["re"]="Fill the all fields!!!";
                 print(json_encode($r));
                die('Could not connect: ' . mysql_error());
               }
             else
                   {

                       $i=mysql_query("select * from t1 where f1=$v1",$con);
                        $check='';
                      while($row = mysql_fetch_array($i))
                       {
  
                             $check=$row['f1'];

                        }

           
                        if($check!=NULL)
                       {

                           $q="update t1 set f2='$v2',f3='$v3' where f1='$v1'";
                           $s= mysql_query($q,$con); 
                          if(!$s)
                           {
                                 $r["re"]="updating problem in batabase";
                  
                                 print(json_encode($r));
                              } 
                            else
                            {
                               $r["re"]="Record updated successfully";
                     
                                   print(json_encode($r));
                              }
                          }
                        else
                          {
                           $r["re"]="Record is not available.. Enter valid number!!";
                              print(json_encode($r));
                          }

           }
 mysql_close($con);
               
    ?> 
 