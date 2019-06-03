<?php

$db = new Database();

$request=new Request();
$body = $request->getBody();
?>
<?php
if($db->signupUser($body['name'],$body['lastname'],$body['city'],$body['address'],$body['email'], $body['password'])):?>
<div style="color:red;font-size:20px;">
       <?php redirect('/succesfull');?>
<?php else:?>
    <div style="color:red;font-size:20px;"> <?php echo array_shift($db->errors1);?></div>
    <div style="color:red;font-size:20px;"> <?php echo array_shift($db->passwordErr);?></div>
    <?php endif; ?>
    <div>
    <h1>Sign up</h1>
    <form method="post" action="/submit-signup">
    <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="name" class="form-control" id="exampleInputEmail1" name="name"  
            value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"
                   placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="name" class="form-control" id="exampleInputEmail1" name="lastname"
            value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>"
                   placeholder="Enter Last Name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">City</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="city"
            value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>"
                   placeholder="Enter city">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="address"
            value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>"
                   placeholder="Enter address">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
            value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"
                   placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" 
            value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"
             placeholder="Password">
            
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

