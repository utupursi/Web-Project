<?PHP 
require_once __DIR__ . '/../helpers.php';
if (!empty($_FILES)){
  $id=rand(1,1000);
  move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . "/../public/photo/$id.png");
  }
   
if(isset($_POST['submit'])){
$db = new Database();
$photo="photo/$id.png";
$userid=currentUser()['id'];
$d=$db->info($_POST['field1'],$_POST['select'],$photo,$_POST['text'],$_POST['field4'],$userid);
}
?>
<style>
    #p{
        margin-top:10px;
    }
    #k{
        font-size:20px;
    }
   body{
/* background-image: url("https://i.ytimg.com/vi/jkEL-9TlN8Y/maxresdefault.jpg"); */
background-size:100%;
   }
   #field1{
       width:300px;
       /* border:1px solid whitesmoke; */
   }
</style>
<!DOCTYPE html>
<head>

</head>
 <body>

<div class="content">
<div class="container">
<h2 class="text-center"></h2>
<form method="post" enctype="multipart/form-data" action=/writeblog >
     <div class="form-group" id="p">
    <label for="field1" id="k">Header</label>
    <input type="text" class="form-control" name="field1" id="field1" placeholder="Insert header">
  </div>
  
  <div class="container py-2">
   <div class="row">
       <div class="col-4">
     
       </div>
   </div>
</div>
  <div class="form-group">
    <label for="field1" id="k">Blog category</label></br>
   <select class="browser-default custom-select" name="select" id="field1">
 <option selected>Select Category</option>
 <option  value="International">International</option>
 <option  value="Tours and Travel">Tours and Travels</option>
 <option value="Cooking Tips">Cooking Tips</option>
</select>
  </div>

  <div class="form-group">
   <!-- <label for="field1">Photo</label> -->
   <input type="file" name="photo" id="file" >
  </div>
  <div class="form-group">
    <label for="text">Text</label> 
    <textarea class="form-control" name="text" id="text" placeholder="Введите данные"></textarea>
   </div>
   <div class="form-group">
    <label for="field1">Video Link</label>
    <input type="text" class="form-control" name="field4" id="field1" placeholder="example: https://www.youtube.com/watch?v=_xeVAjOCNzI">
  </div>
  <button type="submit" name='submit' class="btn btn-primary">Post</button>
</form>

</div> 

</div>     

 </body>
 
</html>