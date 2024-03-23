<?php 
session_start();
// DB values
$db_hostname = "localhost";
$bd_name = "root";
$bd_password = "";
$db_name = "dev2304";

$db_connect = mysqli_connect($db_hostname, $bd_name, $bd_password, $db_name);




// value from register
$flag = false;
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$country = $_POST['country'];
$hobbie = $_POST['hobbie'];
$password = $_POST['password'];

//password condition
$upper = preg_match('@[A-Z]@',$password);
$lower = preg_match('@[a-z]@',$password);
$num = preg_match('@[0-9]@',$password);
$spacial = preg_match('@[#,$,%,&,*]@',$password);

//for name
if(empty($name)){
    $_SESSION['name_err']='plz enter your name';
    $flag = true;
}
else {
    $_SESSION['name_value']=$name;
}
// for email
if(empty($email)){
    $_SESSION['email_err']='plz enter your email';
    $flag = true;
}
else {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['email_err']='plz enter valid email';
        $flag = true;
        $_SESSION['email_value']=$email;
    }
    else{
        $_SESSION['email_value']=$email;
    }   
}
//for number
if(empty($number)){
    $_SESSION['nam_err']='plz enter your number';
    $flag = true;
}
else {
    if(!filter_var($number, FILTER_VALIDATE_INT) || strlen($number) < 8 || strlen($number) > 11 ){
        $_SESSION['nam_err']='plz inter valid number and maxximum 11 Characteristics ';
        $flag = true;
        $_SESSION['nam_value']=$number;
    }
    else{
            $_SESSION['nam_value']=$number;
        }
    }
//for gender
if(empty($gender)){
    $_SESSION['gender_err']= 'plz inter your gender';
    $flag = true;
}
else{
    $_SESSION['gender_value']=$gender;
}
//for address 
if(empty($address)){
    $_SESSION['address_err']= 'plz inter your address';
    $flag = true;
    $_SESSION['address_value']=$address;
}
else{
    $_SESSION['address_value']=$address;
}
//for country
if($country=='false'){
    $_SESSION['country_err']= 'plz inter your country';
    $flag = true;
    $_SESSION['country_value']=$country;
}
else {
    $_SESSION['country_value']=$country;
}
//for hobbie
if(empty($hobbie)){
    $_SESSION['hobbie_err']= 'plz inter your hobbie';
    $flag = true;
    $_SESSION['hobbie_value']=$hobbie;
}
else {
    $_SESSION['hobbie_value']=$hobbie;
}
//for password
if(empty($password)){
    $_SESSION['pass_err']='plz enter your password';
    $flag = true;
}
else {
    if(!$upper || !$lower || !$num || !$spacial || !$upper || strlen($password) < 8){
        $_SESSION['pass_err']='plz enter must 1 upper case , plz enter must 1 lower case , plz enter must 1 number , 1 spacial charekter , and minimum 8 charekter';
        $flag = true;
        $_SESSION['pass_value']=$password;
    }
    else {
        $_SESSION['pass_value']=$password;
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    }
}
if($flag){
    header('location:register.php');
}
else {
    $insert = "INSERT INTO users (name, email, number, gender, address, country, hobbie, password)VALUES('$name','$email','$number','$gender','$address','$country','$hobbie','$pass_hash')";
    mysqli_query($db_connect,$insert);
    $_SESSION['sucsess']='succsess fully registered';
    header('location:register.php');
}
?>