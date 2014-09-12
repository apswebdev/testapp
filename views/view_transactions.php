<?php

/* 
 * Displays all customer table
 */
$data = $data["transactions"];

// actual display table
// if the there are records
if(count($data) > 0){
    
    echo "<table id='tr_table'>
             <tr>
                <td>ID</td>
                <td>Item Name</td>
                <td>Item Price</td>
                <td>Date Purchased</td>
            </tr>" . PHP_EOL;

    $total = 0;

    foreach($data as $val){

            $total += $val["transactions_amount"];
            echo "<tr>
                     <td>".$val["transactions_id"]."</td>
                     <td>".$val["transactions_item"]."</td>
                     <td>".$val["transactions_amount"]."</td>
                     <td>".date("M jS\, Y",  strtotime($val["transactions_date"]))."</td>
                 </tr>";       

    }

    echo "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td style='color:green; font-size:18px; margin:12px 0px; padding-top:5px; border-top:1px dashed #333'>Total: ".number_format($total, 2, '.', ',')."</td>
        </tr>
        <tr style='margin:10px 0px;'>
            <td class='c_id' style='position:relative'><input style='position:absolute; width:200px; left:30px; top:0px;' type='button' id='send_email' value='Send data to customer email'></td>
            <td class='c_id'></td>
            <td class='c_id'></td>
            <td class='c_id' style='text-align:right'><a href='javascript:;' id='close'></a></td>
         </tr>
      </table>
      <h1 style='font-size:14px; text-decoration:none;' id='remarks_email'></h1>"; 

}else{

    echo "<h3 style='margin:50px auto; color:red'>0 TRANSACTION FOUND FOR THIS CUSTOMER.</h3>";

    
}
?>






