<?php
require('db.php');
?>
<?php
if(isset($_POST['dup_email'])){
$email = $_POST['dup_email'];
  $check  = "SELECT * FROM users WHERE email = '$email'";
  $r = mysqli_query($con,$check);
  if(mysqli_num_rows($r) == 1)
  {
    echo "Error";
  }
  else{
    echo "Success";
  }

 }

 if(isset($_POST['update_email'])){
  $email = $_POST['update_email'];
  $userId = $_POST['userId'];
    $check  = "SELECT * FROM users WHERE email = '$email' AND id != '$userId'";
    $r = mysqli_query($con,$check);
    if(mysqli_num_rows($r) == 1)
    {
      echo "Error";
    }
    else{
      echo "Success";
    }
  
   }

 if(isset($_POST['user_reg'])){
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$pinCode = $_POST['pin_code'];

mysqli_query($con, "INSERT INTO users (first_name, last_name, email, gender, country, pin_code) VALUES ('$firstName', '$lastName', '$email', '$gender', '$country','$pinCode')");
echo "New record has id: " . mysqli_insert_id($con);
 }

 if(isset($_POST['updateUser'])){
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $country = $_POST['country'];
  $pinCode = $_POST['pin_code'];
  $id = $_POST['userId'];
  mysqli_query($con, "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$email', gender='$gender', country='$country', pin_code='$pinCode' WHERE id=$id");
  echo "Updated";
   }

   

if(isset($_POST["action"]))
{
  $id=$_REQUEST['fileDeleteId'];
  $query = "DELETE FROM users WHERE id=$id"; 
  $result = mysqli_query($con,$query) or die ( mysqli_error($con));
  echo "Deleted";
}

?>
