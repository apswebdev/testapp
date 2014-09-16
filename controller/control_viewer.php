<?php

/** 
 * this is the redirect page process
 * this will manipulate query strings and redirect them 
 *  to proper page processes. 
 */

class display_screen{
    
    
    /**
     * Setup Url
     * 
     * @param none
     * @return none 
     */
    protected static $clean_url = array( "add_customer",
                                         "delete_customer",
                                         "update_customer",
                                         "paginate",
                                         "search_customer",
                                         "view_transactions",
                                         "sort_by",
                                         "send_email",
                                         "check_email");
    
    /**
     * Determines process or screen
     * 
     * @param none
     * @return none 
     */
    public static function start(){
        
        // before moving forward, 
        // check url if right and if
        // wrong, just redirect to homepage.
        if($type = self::check_url()){
            
            // call function
            self::$type();     
            
        } else {
            
            self::display_main();  

        }
        
    }
    
    /**
     * Check url base from get[url]
     * validates from accepted urls only
     * 
     * @param none
     * @return mixed | displays main screen.
     */
    protected static function check_url(){
        
        $file_loc = utility::get_base();
        
        if(isset($_GET["url"]) && !empty($_GET["url"]) ){
            $url = trim($_GET["url"]);
            if(strpos($url,"/") > -1){
               header("Location:$file_loc");
               exit();
            } else {
                // to prevent call from outside ajax
                if(in_array($url,self::$clean_url) && (!empty($_POST["args"]))){
                    return $url;    
                } else {
                    header("Location:$file_loc");
                    exit();
                }
            }
        } else {
            return false;
        }

    }
    
    /**
     * Instantiates the main display
     * 
     * @param none
     * @return mixed | displays main screen.
     */
    protected static function display_main(){
        
        // redisplay table
        $query = array('stmt' => "SELECT cust.*, COALESCE(SUM(p.transactions_amount), 0) AS total 
                                  FROM customers cust 
                                  LEFT JOIN transactions p 
                                  ON p.transactions_customer_id = cust.customer_id 
                                  GROUP BY cust.customer_id
                                  ORDER BY cust.customer_id DESC",
                       'bind' => '',
                       'fields' => '');
        
        
        $data["customers"] = db::execute_query($query,true);
        self::add_screen("main_screen",$data);
        
    }

    /**
     * Instantiate screen files and data
     * 
     * @param string name of the screen file
     * @param array fields of data
     * @return mixed | display appropriate screen
     */
    protected static function add_screen($screen_name = NULL, $data){
        
        if(is_null($screen_name)) return false;
        require_once $screen_name . ".php";
        
    }

    /**
     * Add new customer data
     * 
     * @param post string name of the customer
     * @param post string email of the customer
     * @param post string country
     * @return mixed | new data added in db customers
     */
    protected static function add_customer(){
        
        $json = json_decode($_POST["args"]);
        
        $name = $json->name;
        $email = $json->email;
        $country = $json->country;
        
        $query = array('stmt' => "INSERT INTO 
                                  customers(customer_name,customer_email,customer_country) 
                                  VALUES(?,?,?)",
                       'bind' => 'sss',
                       'fields' => array($name,$email,$country));
        
        db::execute_query($query);
        
        self::display_table();
        exit();
        
    }

    /**
     * Update Customer Data
     * 
     * @param post string name of the customer
     * @param post string email of the customer
     * @param post string country
     * @return mixed | new data added in db customers
     */
    protected static function update_customer(){
        
        $json = json_decode($_POST["args"]);
        
        $c_id = $json->id;
        $name = $json->name;
        $email = $json->email;
        $country = $json->country;
        
        $query = array('stmt' => "UPDATE customers 
                                  SET customer_name = ?,
                                  customer_email = ?,
                                  customer_country = ?
                                  WHERE customer_id = ?",
                       'bind' => 'sssi',
                       'fields' => array($name,$email,$country,$c_id));
        
        db::execute_query($query);
        
        self::display_table();
        exit();        
    }   

    /**
     * Update Customer Data
     * 
     * @param post string name of the customer
     * @param post string email of the customer
     * @param post string country
     * @return mixed | new data added in db customers
     */
    protected static function delete_customer(){
        
        $id = $_POST["args"];
        
        $query = array('stmt' => "DELETE FROM customers 
                                  WHERE customer_id = ?",
                       'bind' => 'i',
                       'fields' => array($id));
        
        db::execute_query($query);
        
        self::display_table();
        exit();        
    }      
    
    /**
     * Display all table from ajax call
     * 
     * @param none
     * @return mixed | customer data table
     */    
    protected static function display_table(){

        // redisplay table
        $query = array('stmt' => "SELECT cust.*, COALESCE(SUM(p.transactions_amount), 0) AS total 
                                  FROM customers cust 
                                  LEFT JOIN transactions p 
                                  ON p.transactions_customer_id = cust.customer_id 
                                  GROUP BY cust.customer_id
                                  ORDER BY cust.customer_id DESC",
                       'bind' => '',
                       'fields' => '');
        
        $c = $data["customers"] = db::execute_query($query,true);
        self::add_screen("main_table",$data);

    }
    
    /**
     * Sort table by ajax call
     * 
     * @param none
     * @return mixed | customer data table
     */    
    protected static function sort_by(){
        
        $sort = $_POST["args"];

        $query = array('stmt' => "SELECT cust.*, COALESCE(SUM(p.transactions_amount), 0) AS total
                                  FROM customers cust 
                                  LEFT JOIN transactions p 
                                  ON p.transactions_customer_id = cust.customer_id 
                                  GROUP BY cust.customer_id
                                  ORDER BY $sort",        
                       'bind' => '',
                       'fields' => '');
        
        $data["customers"] = db::execute_query($query,true);
        self::add_screen("main_table",$data);

    }
    
    /**
     * Search customer by customer name
     * 
     * @param none
     * @return mixed | customer data table
     */    
    protected static function search_customer(){
        
        $search = trim($_POST["args"]);
        
        if($search == "*") $search = "";
        
        
        // redisplay table
        $query = array('stmt' => "SELECT cust.*, COALESCE(SUM(p.transactions_amount), 0) AS total
                                  FROM customers cust 
                                  LEFT JOIN transactions p 
                                  ON p.transactions_customer_id = cust.customer_id
                                  WHERE cust.customer_name LIKE '%$search%'
                                  GROUP BY cust.customer_id
                                  ORDER BY cust.customer_id DESC",
                       'bind' => '',
                       'fields' => '');
        
        $data["customers"] = db::execute_query($query,true);
        self::add_screen("main_table",$data);

    }

    /**
     * Search customer by customer name
     * 
     * @param none
     * @return mixed | customer data table
     */    
    protected static function paginate(){
        
        $j = json_decode($_POST["args"]);
        $limit = $j->limit;
        $start = $j->start;
        $total = self::total_count();
        $start_main = ($start * $limit) - $limit;
        if($start_main < 0) $start_main = 0;
        
        if($limit == "all"){
            // redisplay table
            $query = array('stmt' => "SELECT cust.*, COALESCE(SUM(p.transactions_amount), 0) AS total 
                                      FROM customers cust 
                                      LEFT JOIN transactions p 
                                      ON p.transactions_customer_id = cust.customer_id 
                                      GROUP BY cust.customer_id
                                      ORDER BY cust.customer_id DESC",
                           'bind' => '',
                           'fields' => '');
            
        } else {
        
            // redisplay table
            $query = array('stmt' => "SELECT cust.*, COALESCE(SUM(p.transactions_amount), 0) AS total
                                      FROM customers cust 
                                      LEFT JOIN transactions p 
                                      ON p.transactions_customer_id = cust.customer_id 
                                      GROUP BY cust.customer_id
                                      ORDER BY cust.customer_id DESC
                                      LIMIT $start_main, $limit",
                           'bind' => '',
                           'fields' => '');
        
            
        }
        
        $data["customers"] = db::execute_query($query,true);
        $data["pagination_links"] = self::create_pagination_links($total,$limit,$start);
        self::add_screen("main_table",$data);
        exit();

    }    

    /**
     * create pagination links
     * 
     * @param integer total record format
     * @param integer count per page
     * @param integer selected page
     * @return string | html structure for bottom links
     */        
    protected static function create_pagination_links($total = NULL, 
                                                      $count_per_page = NULL, 
                                                      $selected_page = 0 ){
                 
        $html = "";

        if(($total == NULL ) ||
           ($count_per_page == NULL || $count_per_page == "")) return "";

           @$ceiling = ceil($total / $count_per_page);

           if($ceiling > 1){

                $html .= "<div style='padding:12px;float:left; clear:both'>";

                if(($ceiling - $selected_page) != ($ceiling - 1) && ($selected_page != 0)){
                   $html .= "<a href='javascript:;' id='prev' style='margin:12px'>prev</a>";
                }

                $html .= "<select id='paginate_page' style='width:100px'>";

                          for($x = 1; $x <= $ceiling; $x++){
                                  //$start = $x - 1;
                                  $start = $x;
                                  if($x == $selected_page){
                                      $sel = 'selected="selected"';
                                  } else {
                                      $sel = "";
                                  }    
                                  $html .= "<option value='".$start."' ".$sel.">".$x."</option>";
                          }

                $html .= "</select>";

                if(($ceiling - $selected_page) != 0){
                        $html .= "<a href='javascript:;' id='next' style='margin:12px'>next</a>";
                }

                $html .= "</div>";
                return $html;   
            }

        return "";

    }    
 
    /**
     * count total records from testapp db
     * 
     * @param none
     * @return integer total count of records
     */           
    protected static function total_count(){
        
        //get total count
        $total_count = 0;
        
        $query = array('stmt' => "SELECT COUNT(1) as total 
                                  FROM customers",
                       'bind' => '',
                       'fields' => '');
        
            
        
        $total = db::execute_query($query,true);
        
        if(count($total) > 0){
          $total_count = $total[0]["total"];    
        }
        
        return $total_count;
        
    }
    
    /**
     * Load transactions per user
     * 
     * @param none
     * @return mixed | customer data table
     */    
    protected static function view_transactions(){
        
        $id = trim($_POST["args"]);
        
        // redisplay table
        $query = array('stmt' => "SELECT * FROM transactions
                                  WHERE transactions_customer_id = ?",
                       'bind' => 'i',
                       'fields' => $id);
        
        $data["transactions"] = db::execute_query($query,true);
        self::add_screen("view_transactions",$data);
        exit();

    }   
    
    /**
     * Check Email DNS
     * 
     * @param string post email
     * @return string 1 = true, 0=false
     */    
    protected static function check_email(){
        
        $j = json_decode($_POST["args"]);
        $email = trim($j->email);
        if ($email !== ""){
             if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))  { 
                list($userid, $d) = explode( "@", $email);
                if (checkdnsrr($d, 'MX')) { 
                     exit("1");	
                } 
             } 
        }
        exit("0");

    }       
    
    /**
     * Arrange html message then call utility email
     * 
     * @param none
     * @return mixed | customer data table
     */    
    protected static function send_email(){
        
        $j = json_decode($_POST["args"]);
        
        $id = $j->id;
        $name = $j->name;
        $email = $j->email;
        $country = $j->country;
        
        //basic information
        $html ="<p>
                   Hello $name, <br><br>
                   We are pleased to inform you about your latest information on testapp below:    
                   <br><br>    
                </p>
                <h1>Your Current Information at TESTAPP</h1>
                  <table>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Country</td>
                    </tr>
                    <tr>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$email</td>
                        <td>$country</td>
                    </tr>
                  </table>";  
        
        //transactions
        $query = array('stmt' => "SELECT * FROM transactions
                                  WHERE transactions_customer_id = ?",
                       'bind' => 'i',
                       'fields' => $id);
        
        $transactions = db::execute_query($query,true);
        
        $html .= "<h1>List of all your transactions</h1>
                  <table>
                    <tr>
                        <td>ID</td>
                        <td>Item</td>
                        <td>Price</td>
                        <td>Date</td>
                    </tr>";
        
        $total = 0;
        
        foreach($transactions as $t){
            $total += $t['transactions_amount'];    
            $html .= "<tr>
                        <td>".$t['transactions_id']."</td>
                        <td>".$t['transactions_item']."</td>
                        <td>".$t['transactions_amount']."</td>
                        <td>".date("M jS\, Y",  strtotime($t["transactions_date"]))."</td>
                     </tr>";
            
        }
        
        $html .= "<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style='color:green; font-size:18px; margin:12px 0px; padding-top:5px; border-top:1px dashed #333'>Total: ".number_format($total, 2, '.', ',')."</td>
                </tr>
             </table>
             <p><br><br>
                   Best Regards, <br>
                   TestApp Team    
                   <br><br>    
             </p>";
        
        utility::email_data($html, $email);
        exit();

    }  
    
    
}


?>
