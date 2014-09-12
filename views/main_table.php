<?php

/* 
 * Displays all customer table
 */
$data = $data["customers"];

// actual display table
echo "<table id='main_table'>
         <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Country</td>
            <td>Transactions</td>
        </tr>" . PHP_EOL;

foreach($data as $val){
        
        echo "<tr>
                 <td class='c_id'>".$val["customer_id"]."</td>
                 <td><span class='c_name'>"
                      .$val["customer_name"].
                     "</span><br>
                     <div class='actions'>
                         <a href='javascript:;' class='transactions'>View</a>&nbsp;
                         <a href='javascript:;' class='edit'>Edit</a>&nbsp;
                         <a class='delete' href='javascript:;'>Delete</a>
                     </div>
                 </td>
                 <td class='c_email'>".$val["customer_email"]."</td>
                 <td><input type='hidden' class='c_country' value='".$val["customer_country"]."'>".country::get_country($val["customer_country"])."</td>
                 <td>
                    <p style='padding-top:12px;'><b>Total</b> : ".number_format($val["total"], 2, '.', ',')."</p>
                 </td>
             </tr>";       

}

echo  "</table>";

if(count($data) == 0){
    echo "<h3 style='float:left; margin:50px auto;'>0 RECORD FOUND.</h3>";
}


?>






