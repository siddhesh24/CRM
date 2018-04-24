<?php 	session_start(); 
	error_reporting(0); 
	include( 'includes/config.php'); 
	if(isset($_GET[ 'action']) && $_GET[ 'action']=="add" ){ 
	$id=intval($_GET[ 'id']); 	
	if(isset($_SESSION[ 'cart'][$id])){ 
		$_SESSION[ 'cart'][$id][ 'quantity']++; 
	}
	else{ 
		$sql_p="SELECT * FROM products WHERE id={$id}" ; 
		$query_p=mysql_query($sql_p); 
	if(mysql_num_rows($query_p)!=0){
		$row_p=mysql_fetch_array($query_p); 
		$_SESSION[ 'cart'][$row_p[ 'id']]=array( "quantity"=> 1, "price" => $row_p['productPrice']); 
		header('location:index.php'); 
	}
	else{ 
		$message="Product ID is invalid"; 
	} 
	} 
	} 
?>
<!DOCTYPE html>
<html>

	<!==============================================Head===================================================>
	<?php include( 'includes/top-header.php');?>
	<head>
		<?php include('includes/head.php');?>
		
	</head>
	<!===============================================Head End==============================================>




	<!==================================================Header=============================================>
	<div class="header">
		<?php include('includes/header.php');?>	

	</header>
	<!==================================================Header End=========================================>

<body>
<!==========================================================EXAMPLE==================================================>
		<div class="mainContainer">   
		            
                <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
                    <div class="more-info-tab clearfix">
                        <h3 class="new-product-title pull-left">Featured Products</h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active"><a href="#all" data-toggle="tab">All</a>
                            </li>
                            <li><a href="#books" data-toggle="tab">Books</a>
                            </li>
                            <li><a href="#furniture" data-toggle="tab">Furniture</a>
                            </li>
                        </ul>
                        <!-- /.nav-tabs -->
                    </div>

               
<div class="product-slider">
<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    <?php $ret=mysql_query( "select * from products"); while ($row=mysql_fetch_array($ret)) { # code... ?>



                                            <div class="product">
						<div class="productThumb">
						
					 <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
<img src="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>"  ></a>
                                                
                                                    <!-- /.image -->
						</div>
						
                                                <!-- /.product-image -->


                                                <div class="productName">
                                                    <h6 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h6>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="productPrice">Rs.<?php echo htmlentities($row['productPrice']);?></span>

							<div class="originalPrice">
							<span class="originalPrice">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?>	</span>	
							</div></div></div>
                                                        

                                              
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                         
                                        <!-- /.products -->
                                 
                                    <?php } ?>

               




                        <div class="tab-pane" id="books">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <?php $ret=mysql_query( "select * from products where category=3"); while ($row=mysql_fetch_array($ret)) { # code... ?>


                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="productThumb">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
                                                    </div>
                                                    <!-- /.image -->


                                                </div>
                                                <!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
					Rs. <?php echo htmlentities($row['productPrice']);?>			</span>
                                                        <span class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>

                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>

                                                <!-- /.product-info -->
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a>
                                                </div>
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                    <?php } ?>


                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>





                        <div class="tab-pane" id="furniture">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <?php $ret=mysql_query( "select * from products where category=5"); while ($row=mysql_fetch_array($ret)) { ?>


                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="160" height="0" alt=""></a>
                                                    </div>


                                                </div>


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
					Rs.<?php echo htmlentities($row['productPrice']);?>			</span>
                                                        <span class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>

                                                    </div>

                                                </div>
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Add to Cart</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php } ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

 
<!==================================================SmartPhone session Start======================================>

<section class="productsContainer">
    <h3 class="more-info-tab clearfix">Smart Phones</h3>


    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
        <?php $ret=mysql_query( "select * from products where category=4 and subCategory=4"); while ($row=mysql_fetch_array($ret)) { # code... ?>
        			<div class="product">
						<div class="productThumb">

                                  
                                        <a href="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
													<img data-echo="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>"  alt="">
												
												</a>
                                   <!-- /.image -->
						</div>
						
                                                <!-- /.product-image -->



                                                <div class="productName">
                                                    <h6 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h6>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="productPrice">Rs.<?php echo htmlentities($row['productPrice']);?></span>

							<div class="originalPrice">
							<span class="originalPrice">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?>	</span>	
							</div></div></div>
                                                        

                                              
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                         
                                        <!-- /.products -->
                                 
                             

               
        <?php } ?>
    </div>
</section>


<!==================================================Laptop session Start======================================>

<section class="productsContainer">
    <h3 class="more-info-tab clearfix">Laptops</h3>


    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
        <?php $ret=mysql_query( "select * from products where category=4 and subCategory=6"); while ($row=mysql_fetch_array($ret)) { # code... ?>
        			<div class="product">
						<div class="productThumb">

                                  
                                        <a href="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
													<img data-echo="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" width="170" height="174" alt="">
													<div class="zoom-overlay"></div>
												</a>
                                   <!-- /.image -->
						</div>
						
                                                <!-- /.product-image -->



                                                <div class="productName">
                                                    <h6 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h6>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="productPrice">Rs.<?php echo htmlentities($row['productPrice']);?></span>

							<div class="originalPrice">
							<span class="originalPrice">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?>	</span>	
							</div></div></div>
                                                        

                                              
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                         
                                        <!-- /.products -->
                                 
                             

               
        <?php } ?>
    </div>
</section>




<!==================================================Fashion session Start======================================>

<section class="productsContainer">
    <h3 class="more-info-tab clearfix">Fashion</h3>


    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
        <?php $ret=mysql_query( "select * from products where category=6"); while ($row=mysql_fetch_array($ret)) { # code... ?>
        			<div class="product">
						<div class="productThumb">

                                  
                                        <a href="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
													<img data-echo="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" width="170" height="174" alt="">
													<div class="zoom-overlay"></div>
												</a>
                                   <!-- /.image -->
						</div>
						
                                                <!-- /.product-image -->



                                                <div class="productName">
                                                    <h6 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h6>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="productPrice">Rs.<?php echo htmlentities($row['productPrice']);?></span>

							<div class="originalPrice">
							<span class="originalPrice">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?>	</span>	
							</div></div></div>
                                                        

                                              
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                         
                                        <!-- /.products -->
                                 
                             

               
        <?php } ?>
    </div>
</section>


<!======================================================================================>


                <?php include( 'includes/brands-slider.php');?>
            </div>
        </div>











			</div>
		</div>
		</div>
</div>
</div>




<!==========================================================EXAMPLE END==============================================>
	

<!============================================Footer=======================================================================>

		<div class="footer">
			<?php include('includes/footer.php');?>

			<script src="assets/js/jquery-1.11.1.min.js"></script>

        <script src="assets/js/bootstrap.min.js"></script>

        <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>

        <script src="assets/js/echo.min.js"></script>
        <script src="assets/js/jquery.easing-1.3.min.js"></script>
        <script src="assets/js/bootstrap-slider.min.js"></script>
        <script src="assets/js/jquery.rateit.min.js"></script>
        <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <!-- For demo purposes – can be removed on production -->

        <script src="switchstylesheet/switchstylesheet.js"></script>

        <script>
            $(document).ready(function() {
                $(".changecolor").switchstylesheet({
                    seperator: "color"
                });
                $('.show-theme-options').click(function() {
                    $(this).parent().toggleClass('open');
                    return false;
                });
            });

            $(window).bind("load", function() {
                $('.show-theme-options').delay(2000).trigger('click');
            });
        </script>
        <!-- For demo purposes – can be removed on production : End -->




		</div>
	</body>
</html>
		





