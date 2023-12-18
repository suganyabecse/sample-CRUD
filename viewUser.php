<?php
require('db.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
<div class="testbox">
      <div id="myform" class="form">


<h1>View Records</h1>
<p class="hrefClass"><a href="index.php">Insert New Record</a> </p>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>S.No</strong></th>
<th><strong>First Name</strong></th>
<th><strong>Last Name</strong></th>
<th><strong>Email</strong></th>
<th><strong>Gender</strong></th>
<th><strong>Pin code</strong></th>

<th><strong>Country</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$sel_query="Select * from users ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["first_name"]; ?></td>
<td align="center"><?php echo $row["last_name"]; ?></td>
<td align="center"><?php echo $row["email"]; ?></td>
<td align="center"><?php echo $row["gender"]; ?></td>
<td align="center"><?php echo $row["country"]; ?></td>
<td align="center"><?php echo $row["pin_code"]; ?></td>
<td align="center"><a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
</td>
<td align="center">
<a href="#" id="<?php echo $row["id"]; ?>" class="delete">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</div>
</div>
<script type="text/javascript">
    $('.delete').click(function (e) {

        var fileDeleteId = $(this).attr('id'); 
        if(confirm('Are you sure to remove this record ?'))
        {
        $(this).closest("tr").remove();
        // alert(fileDeleteId);
        var dataString ="fileDeleteId="+fileDeleteId+"&action=deleteUser";
        $.ajax({
            type:"POST",
            url:"process.php",
            data:dataString,
            cache:true,
            success:function(data)
            {            
                        alert(data);
            }

            });
        }else{
		       alert('Record not deleted.');
	           }

    });
</script>
</body>
</html>