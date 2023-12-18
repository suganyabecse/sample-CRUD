<!DOCTYPE html>
<html>
  <head>
    <title>Application Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
  </head>
  <body>
    <div class="testbox">
      <div id="myform" class="form">
     
          <h1>Application Form</h1>
          <p class="hrefClass"><a href="viewUser.php">View Record</a> </p>
          <h2 class="success" id="thqmsg"></h2>
        <div class="item">
          <p>Name</p>
          <div class="name-item">
            <input type="text" placeholder="First Name" id="first_name" class="fetch_results"/>
            
            <input type="text" placeholder="Last Name" id="last_name" class="fetch_results"/>
          </div>
          <span class="error" id="fn_err"></span>
          <span class="error" id="ln_err"></span>
        </div>
        <div class="item">
          <p>Gender</p>
          <select id="gender">
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <span class="error" id="gender_err"></span>
        </div>
        <div class="item">
          <p>Email</p>
          <input type="text" placeholder="Email Address" id="email" class="fetch_results"/>
          <span class="error" id="email_err"></span>
        </div>
        
        <div class="item">
          <p>Address</p>
          
          <div class="city-item">
            
            <input type="text" placeholder="Pin code" id="pin_code" class="fetch_results"/>
            <input type="text" placeholder="Country" id="country" class="fetch_results"> 
            <span class="error" id="add_err"></span>
          </div>
        </div>     
        <div class="btn-block">
        <button type="submit" id="submitbtn">Submit</button>
        </div>
      </div>
      <div id="userList"></div>
    </div>
  </body>
  

  
  <script type="text/javascript">
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }
    $('#email').change(function () {
        if ($('#email').val() == "" || !validateEmail($('#email').val())) {
            $('#email_err').text("Invalid Email");
            return;
        }
        else {
            $('#email_err').text("");
            duplicateEmail();
        }
    });
   
    $('#submitbtn').click(function (e) {
      if ($('#first_name').val() == "") {
            $('#fn_err').text("Please Enter First Name");
            return;
        }
        else
        {
            $('#fn_err').text("");
        }
        if ($('#last_name').val() == "") {
            $('#ln_err').text("Please Enter Last Name");
            return;
        }
        else
        {
            $('#ln_err').text("");
        }
        if ($('#email').val() == "" || !validateEmail($('#email').val()) || duplicateEmail()) {
            $('#email_err').text("Invalid Email");
            return;
        }
        else
        {
            $('#email_err').text("");
        }
        if ($('#gender').val() == "") {
            $('#gender_err').text("Please Select Gender");
            return;
        } 
        else
        {
            $('#gender_err').text("");
        }
        if ($('#pin_code').val() == "") {
            $('#add_err').text("Please Enter Pin Code");
            return;
        }
        else
        {
            $('#add_err').text("");
        }
        if ($('#country').val() == "") {
            $('#add_err').text("Please Enter Country");
            return;
        }
        else
        {
            $('#add_err').text("");
        }

        if (!duplicateEmail()) {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                var gender = $('#gender').val();
                var country = $('#country').val();
                var pin_code = $('#pin_code').val();


                // var dataString ="user_reg=newUser&name="+name+"&email_id="+email_id+"&password="+password+"&phone_number="+phone_number+"&location_id="+location_id;

                    $.ajax({
                          type:"POST",
                          url:"process.php",
                          data: {
                            user_reg: "newUser",
                            first_name: first_name,
                            last_name: last_name,
                            email: email,
                            gender: gender,
                            country: country,
                            pin_code: pin_code

                            
                          },
                          cache:true,
                        success: function (Result) {
                            // alert(Result);
                            $('#thqmsg').text("Thanks for filling out our form!");
                            $('.fetch_results').find('input:text').val('');
                            document.getElementById('first_name').value = "";
                            document.getElementById('last_name').value = "";
                            document.getElementById('email').value = "";
                            document.getElementById('country').value = "";
                            document.getElementById('pin_code').value = "";
                            document.getElementById('gender').value = "";
                        }
                    });
                
            }
            else
            {
                $('#email_err').text("Email Is Already Exist!!");
                $('#submitbtn').hide();
            }

    });



    function duplicateEmail() {
        var Email = $('#email').val();
        var dataString ="dup_email="+Email;
        $.ajax({
            type:"POST",
          url:"process.php",
          data:dataString,
          cache:true,
            success: function (Result) {
              // alert(Result);
               
                if (Result == 'Error') {
                    $('#email_err').text("Email Is Already Exist!!");
                    $('#submitbtn').hide();
                    return false;
                }
                else {
                    $('#email_err').text("");
                    $('#submitbtn').show();
                }
                
            }
        });
    }



    </script>
</html>