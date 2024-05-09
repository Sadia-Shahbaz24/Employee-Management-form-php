<?php
include("connection.php");
?>
<?php
if(isset($_POST['search']))
{
    $search=  $_POST['id'];

   
 $query = "select * from form where id = '$search'";
 $data = mysqli_query($conn,$query);
 //data is coming on web page by thse lines
  $result =mysqli_fetch_assoc($data);
//  $name = $result['name']
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="employeeForm" action="#" method="post">
    <h1 style="text-align: center;">Employee Management</h1>

            <div class="form-group">
                <label for="employeeID">Employee ID:</label>
                <input type="text"  name="id" value="<?php if(isset($_POST['search'])){ echo $result['id'];} ?>">
            </div>
            <div class="form-group">
                <label for="employeeName">Name:</label>
                <input type="text"  name="name" value="<?php if(isset($_POST['search'])){ echo $result['name'];} ?>">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender">
                <option value="Not Selected" >Select Gender</option>

                    <option value="male" <?php if($result['gender'] =='male')
                    {
                        echo "selected";
                    } ?>
                    >Male</option>
                    <option value="female" <?php if($result['gender'] =='female')
                    {
                        echo "selected";
                    } ?>>Female</option>
                    <option value="other" <?php if($result['gender'] =='other')
                    {
                        echo "selected";
                    } ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select  name="department">
                    <option value="Sales">Sales</option>
                    <option value="HR" 
                    <?php if($result['department'] =='HR')
                    {
                        echo "selected";
                    } ?>>HR</option>
                    <option value="IT"
                    <?php if($result['department'] =='IT')
                    {
                        echo "selected";
                    } ?>>IT</option>
                    <option value="Finance" 
                    <?php if($result['department'] =='Finance')
                    {
                        echo "selected";
                    } ?>>Finance</option>
                    <option value="Marketing"
                    <?php if($result['department'] =='Marketing')
                    {
                        echo "selected";
                    } ?>>Marketing</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email"value="<?php if(isset($_POST['search'])){ echo $result['email'];} ?>">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea  name="address"><?php if(isset($_POST['search'])){ echo $result['address'];} ?></textarea>
            </div>
            <div id="btn">
            <input type="submit"  name="save" value="Save">
<input type="submit"  name="search" value="Search">
<input type="submit"  name="update" value="Update">
<input type="submit"  name="delete" value="Delete" onclick=" return confirmdelete()">
<input type="reset"  name="clear" value="Clear">
            </div>
    </form>
</body>
</html>
<script>
    function confirmdelete(){
        return confirm(' Are you sure you want to delete');
    }
</script>

<?php
if(isset($_POST['save'])){
   $n=  $_POST['name'];
   $g=  $_POST['gender'];
   $d=  $_POST['department'];
   $e=  $_POST['email'];
   $a=  $_POST['address'];
$query = "insert into form(name,gender,department,email,address) 

Values('$n','$g','$d','$e','$a')";
$data = mysqli_query($conn,$query);
if($data){
       echo "<script> alert(' Data Saved') </script>";
}
else{
    echo  "<script>
    alert(' Failed to Save') </script>";
}

}
?>
<?php
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $query = " delete from form where id= '$id'";
    $data = mysqli_query($conn,$query);
    if($data){
        echo "<script> alert(' Data deleted') </script>";
 }
 else{
    echo "<script> alert(' Failed to delete') </script>"; 
 
 }

}
?>
<?php
if(isset($_POST['update'])){
    $id=  $_POST['id'];

   $n=  $_POST['name'];
   $g=  $_POST['gender'];
   $d=  $_POST['department'];
   $e=  $_POST['email'];
   $a=  $_POST['address'];
$query = "update form set name= '$n',gender='$g',department='$d',email='$e',address='$a' where id='$id'";

$data = mysqli_query($conn,$query);
if($data){
       echo "<script> alert(' Data Updated') </script>";
}
else{
    echo  "<script>
    alert(' Failed to Update') </script>";
}

}
?>