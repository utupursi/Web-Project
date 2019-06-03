<?php
   require_once __DIR__ . '/../db/Database.php';

   $db=new Database();
   $users=$db->select();
?>

<div>
    <h1>About us</h1>
<div>
    <?php  foreach($users as $user):?>
      <dl>
            <dt>Name:</dt>
            <dd><?php echo $user['full_name']  ?></dd>
            <a class="btn btn-sm btn-outline-primary" href="/login?id=<?php echo $user['id'];?>">View</a>
            <dt>Email:</dt>
            <?php echo $user['email']?>
     
        </dl>
  
<?php endforeach;?>


</div>
    <?php require_once __DIR__ . '/../helpers.php';
      if(isLoggedIn()):?>
      <dl>
            <dt>Name:</dt>
            <dd><?php echo currentUser()['full_name'] ?></dd>
            <dt>Email:</dt>
            <dd><?php echo currentUser()['email'] ?></dd>
        </dl>
        <?php endif; ?>
  


</div>
