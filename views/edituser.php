<?php
require_once __DIR__ . '/../helpers.php';
if (!empty($_FILES)){
    $userid=currentUser()['id'];
    move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . "/../public/photo1/$userid.png");
   echo "df";
    }

$db = new Database();

if(isset($_POST['name'])&&isset($_POST['lastname'])&&isset($_POST['email'])&&isset($_POST['address'])&&isset($_POST['city'])){
    $userid=currentUser()['id'];
    $photo="photo1/$userid.png";
   $db->updateUser($_POST['name'],$_POST['lastname'],$_POST['city'],$_POST['address'],$_POST['email'],$photo,$userid);
 redirect("/userdetail");
  
}  
?>
<style>
#p{
    width:150px;
    height:150px;
}
</style>
<div class="container">
    <div class="row m-y-2">
        <!-- edit form column -->
        <div class="col-lg-4 text-lg-center">
            <h2>Edit Profile</h2>
        </div>
        <div class="col-lg-8">
     
        </div>
        <div class="col-lg-8 push-lg-4 personal-info">
             <form role="form" method="post" enctype="multipart/form-data"  >
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">First name</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="name" value="<?php echo  currentUser()['name'];?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="lastname" value="<?php echo  currentUser()['lastname'];?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="email"name="email" value="<?php echo  currentUser()['email'];?>" />
                    </div>
                </div>
           
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Address</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="address"  value="<?php echo  currentUser()['address'];?>"  />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">City</label>
                    <div class="col-lg-6">
                        <input class="form-control" type="text" name="city" value="<?php echo  currentUser()['city'];?>"/>
                    </div>
                    
            
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                        <input type="reset" class="btn btn-secondary" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Save Changes" />
                    </div>
                </div>
        </div>
        <div class="col-lg-4 pull-lg-8 text-xs-center">
                <img src="<?php echo currentUser()['user_photo'];?>" id="p" class="m-x-auto img-fluid img-circle" alt="avatar" />
                <h6 class="m-t-2">Upload a different photo</h6>
                <label class="custom-file">
                  <input type="file" name="photo" id="file" class="custom-file-input" >
                  <span class="custom-file-control">Choose file</span>
                </label>
                </form>
        </div>

    </div>
</div>
<hr />