<?php
require_once 'header.php';
?>

<div id="container">
    
    <div id="filter">
        
        <div class="filter_inner">
            <h1>
                Number of Records
            </h1>
            <p>
                <select id="show_rec">
                    <option value="all">All</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </select>
            </p>  
        </div>
        
        <div class="filter_inner">
            <h1>
                <input id="search_btn" type="button" value="Search Name">
            </h1>
            <p>
                <input type="text" id="search" class="input" placeholder='Use (*) to reload all'>
            </p>    
        </div>

        <div class="filter_inner">
            <h1>
                Sort By:
            </h1>
            <p>
                <select id="sort_by">
                    <option value="customer_id">ID</option>
                    <option value="customer_name">Name</option>
                    <option value="customer_email">Email</option>
                    <option value="customer_country">Country</option>
                </select>
            </p>  
        </div> 
        <div class="filter_inner">
            <h1>
                <input id="add_btn" type="button" value="Add New Customer">
            </h1>
            <p>
            </p>  
        </div> 
    </div>
    
    <div id="process_data">
        <div id="data_table">
            <h1></h1>
            <table>
                <tr>
                    <td>Customer Name:<input type="hidden" id="cust_id" value=""></td>
                    <td><input type="text" class="cust_in" value="" id="cust_name"></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><input type="text"  class="cust_in" value="" id="cust_email"></td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td>
                        <select id="cust_country">
                            <option value=""> -- Select -- </option>
                            <?php 
                                $country = country::get_country();
                                foreach($country as $key => $val){
                                    echo "<option value='$key'>$val</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><div id="remarks"></div>
                        <input type="button" value="Cancel" id="cancel_btn">
                        <input type="button" value="Save" id="save_btn" class='btn1'>
                        <input type="button" value="Save" id="update_btn" class='btn1'></td>
                </tr>

            </table>
        </div>
        <div id="transactions">
            <h1>Customer Information</h1>
            <table id="data_table">
                <tr>
                    <td style='text-align:right; font-weight:bold;'>Customer Name:</td>
                    <td id="cust_name_t" style='text-align:left; padding-left:12px;'></td>
                </tr>
                <tr>
                    <td style='text-align:right; font-weight:bold;'>Customer Email:</td>
                    <td id="cust_email_t" style='text-align:left; padding-left:12px;'></td>
                </tr>
                <tr>
                    <td style='text-align:right; font-weight:bold;'>Country:</td>
                    <td id="cust_country_t" style='text-align:left; padding-left:12px;'>
                    </td>
                </tr>
            </table>    
            <h1 id='tle'>Customer Information</h1>
            <div id="transactions_t"></div>
        </div>
    </div>
    
<div id="main_content">

<?php require_once 'main_table.php' ?>    

</div><!-- main content -->

</div><!-- container -->
    
<?php
require_once 'footer.php';
?>




