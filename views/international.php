	<?php
    require_once __DIR__ . '/../db/Database.php';	
   $category=$_GET['category'];	   
    $db=new Database();
$blogcategory=$db->selectCategory($category);
    ?>
    
    <style>
    #p{
        margin-top:100px;
        display:flex; 

    }
    
    #o{
		/* height:450px;
        width:450px; */
    }
    
    </style>


                 
    <div class="row" id="p">

							<div class="col-lg-6 col-md-6">
		<?php foreach($blogcategory as $category):?>
								<div class="single-post-item">
									<div class="post-thumb">
        
										<img class="img-fluid" id="o" src="<?php echo $category['photo'];?>" alt="">
									</div>
									<div class="post-details">
										<h4><a href="/blogdetails?id=<?php echo $category['blog_id'];?>"><?php echo $category['header'];?></a></h4>
										<!-- <p><?php echo $user['text']?></p> -->
										<div class="blog-meta">
											<a href="#" class="m-gap"><span class="lnr lnr-calendar-full"></span><?php echo $category['post_date'];?></a>
											<?php echo $category['name'];?>
										</div>
				
									</div>
								</div>
<?php endforeach;?>
							</div>
