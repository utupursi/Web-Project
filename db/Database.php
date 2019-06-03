<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $database;
    public $errors=array();
    public $errors1=array();
    public $passwordErr=array();
    public $id;
    private $connection;

    public function __construct()
    {
        $config = require __DIR__ . '/../config.php';
        $this->servername = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['database'];
        $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    public function loginUser($name,$email, $password)
    {
        $stmt = $this->getConnection()
            ->prepare("SELECT * FROM users ");
        $stmt->execute();
        $users = $stmt->fetchall();
        $t=0;
        foreach($users as $user){
            if ($user['name']==$name&&$user['email']!=$email){
                $this->errors[]="Email incorect";
            }
            if ($user['name']!=$name&&$user['email']==$email){
                $this->errors[]="Name incorrect";
            }
            if($user['name']==$name&&$user['email']==$email){
               if(password_verify($password,$user['password'])){
            $t++;
               }
               else{
                $this->errors[]="Incorrect password";
               }
               break;
            }
    }
      
        if ($t==1){
            $_SESSION['currentUser'] = $user;
            return true;
        }
   else {
   return false;
   }
    }
    // public function select(){
    //     $stmt = $this->getConnection()
    //     ->prepare("SELECT * FROM users");
    //     $stmt->execute();
    //     $users = $stmt->fetchall();
    //     return $users;
    // }
    public function selectCategory($category){
        $stmt = $this->getConnection()
        ->prepare("SELECT * FROM blog INNER JOIN users ON blog.userid=users.id where blog.category= :category");
        $stmt->execute(['category' => $category]);
        $users = $stmt->fetchall();
        return $users;
    }
    public function selectUserBlogs($id){
        $stmt = $this->getConnection()
        ->prepare("SELECT * FROM blog INNER JOIN users ON blog.userid=users.id where users.id= :id");
        $stmt->execute(['id' => $id]);
        $users = $stmt->fetchall();
        return $users;
    }
    public function selectLatest(){
        $stmt = $this->getConnection()
        ->prepare("SELECT * FROM blog INNER JOIN users ON blog.userid=users.id order by post_date desc limit 4");
       $stmt->execute();
       $users = $stmt->fetchall();
       return $users;
    }
    public function select1(){
        $stmt = $this->getConnection()
        ->prepare("SELECT * FROM blog INNER JOIN users ON blog.userid=users.id");
        $stmt->execute();
        $users = $stmt->fetchall();
        return $users;
    }
    public function finduserbyId($id){
        $stmt = $this->getConnection()
        ->prepare("SELECT * FROM blog  INNER JOIN users ON blog.userid=users.id where  blog.blog_id= :id ");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function info($header,$category,$photo,$text,$link,$id){
        $stmt = $this->getConnection()
        ->prepare("INSERT INTO blog (header, category, photo,text,link,userid)
        VALUES ('{$header}', '{$category}', '{$photo}','{$text}','{$link}','{$id}')");
       $stmt->execute();

    }
    public function updateUser($name,$lastname,$city,$address,$email,$photo,$id){
        $stmt = $this->getConnection()
        ->prepare("UPDATE users SET name='{$name}',lastname='{$lastname}',city='{$city}',address='{$address}',email='{$email}',user_photo='{$photo}' WHERE id= :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['currentUser']['name']=$name;
        $_SESSION['currentUser']['lastname']=$lastname;
        $_SESSION['currentUser']['city']=$city;
        $_SESSION['currentUser']['address']=$address;
        $_SESSION['currentUser']['email']=$email;
        $_SESSION['currentUser']['user_photo']=$photo;
    }
    public function signupUser($name,$lastname,$city,$address,$email,$password){
        $stmt = $this->getConnection()
        ->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchall();
        $i=0; 
        if (strlen($password) <= '8') {
            $this->passwordErr[] = "Your Password Must Contain At Least 8 Characters!";
        $i++;
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $this->passwordErr[] = "Your Password Must Contain At Least 1 Number!";
            $i++;
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $this->passwordErr[] = "Your Password Must Contain At Least 1 Capital Letter!";
           $i++;
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $this->passwordErr[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
           $i++;
        }
        foreach($users as $user){
            if($user['email']==$email){
                $this->errors1[]='Email exist';
                $i++;
            }
          
        }
        if($i>1){
            return false;
        }
        if($i<1){
            $password1=password_hash($password,PASSWORD_DEFAULT);
            $stmt = $this->getConnection()
            ->prepare("INSERT INTO users (name, lastname, city,address,email,password)
            VALUES ('{$name}', '{$lastname}', '{$city}','{$address}','{$email}','{$password1}')");
           $stmt->execute();
           return true;
        }

    }
}
