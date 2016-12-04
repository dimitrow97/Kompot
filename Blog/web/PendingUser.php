<?php
    require_once('User.php');
    require_once('class.sqlite3.inc.php');
    require_once('sendAuthenticationEmail.php');
    date_default_timezone_set("Europe/Sofia");



class PendingUser extends User
{
    
    
    private $user;
    
    public function __construct(User $user){
        
        $this->user = $user->initializePendingUser();
        
    }
    
    private function dbQuery($query="")
    {
        
        $db = new SQLite3_module();
        $dbPath = "../../DB Browser for SQLite/myDB.db";
        $dbr = $db->db_oper($dbPath,$query);
        return $dbr; 
        
    }
    
    #We don't want invalid and none-existant Emails - So we sendin out some authentication Emails
    
    public function initiateRegisterRequest()
    {
        
        $token = sha1(uniqid($this->user['password'],true));
        
        $url = "localhost:8080/Blog/web/accountActivation.php?token=$token";
        $email = $this->user['email'];
        $name = $this->user['name'];
        echo !extension_loaded('openssl')?"Not Available":"Available";
        $isEmailSent = sendAuthenticationEmail($email,$name,$url);
        
        if(!$isEmailSent){
            return;
        }
        
        $password = hash('sha256',$this->user['password']);
        $timestamp = new DateTime();
        $timestamp = date_format($timestamp,'Y-m-d T H:i:s');
        $query = "INSERT OR IGNORE INTO pending_user(email,password,name,token,timestamp) VALUES('$email','$password','$name','$token','$timestamp')";
        
        $result = $this->dbQuery($query);
        
        if(empty($result))
        {
         
            #Code to manage dbResult error here
    
        }
        
    }    
    
       
}



?>
