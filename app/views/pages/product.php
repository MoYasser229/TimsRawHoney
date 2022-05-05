<?php
class product extends View{

public function output(){
    $title = $this->model->title;
     require_once APPROOT . "/views/inc/header.php";
     $ID=$_GET['id'];
    $Image=$this->model->getimage($ID);
    $cost=$this->model->getCost($ID);
    $offer =$this->model->getOffer();
    $material= $this->model->getMaterial();
    $size=$this->model->getSize();
    // $productid=$this->model->getProductId();
    $productname=$this->model->getProductName($ID);
?>
<html>
<head>   
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . 'css/productstyle.css'; ?>">
    <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Tim Raw Honey</title>
</head>
<body>
  <?php
    
  ?> 
  <div id="wrap">
    <div id="product_layout_1">
      <form method="post" action="">
      <div class="top">
      <div class="product_images">
        <div class="product_image_1">
        <img name="productimage" src = "<?php echo IMAGEROOT.$Image ; ?>" /> 
        </div>
        </div>
        <div class="product_info">
          <h1 name="productname"><?php echo $productname ?></h1>
          <div class="price">
          <h2 name="productprice" class="original_price"><?php echo $cost?></h2>
          <h2 class="sale_price"><?php echo $offer?></h2>
          </div>
          <div class="rating">
            <i class="fa fa-star fa-3x"></i><i class="fa fa-star fa-3x"></i><i class="fa fa-star fa-3x"></i><i class="fa fa-star-half-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i>
          </div>
          <div class="product_description">
          <p>An immunity booster formula.
Delicious natural and healthy.
Propolis is a natural compount that bees produce from the sap on needle-leaved trees, trees and/or evergreens. Bees mix Sap mixed with their secreations and beeswax forming a sticky, greenish-brown product used as a coating and blocking cracks in the hive and many more in-hive usage.</p>
          </div>
         <div class="related_info">
           <span class="sku">SKU:1234567</span><span class="quantity">QTY:85</span>
         </div>
         <div class="options">
         <div class="buying_options">
         
                 <div class="select">
                 <select id="color" name="material">
                   <option value = "1" id="glass"><?php echo $material[0][0] ?></option>
                   <option value = "2"id="plastic"><?php echo $material[0][1] ?></option>
                   
                 </select>
                 </div>
                 <div class="select">
                 <select id="size" name="size">
                   <option value = "1" id="small"><?php echo $size[0][0]?></option>
                   <option value = "2" id="medium"><?php echo $size[0][1]?></option>
                   <option value = "3" id="large"><?php echo $size[0][2]?></option>
                   <option value = "4" id="xlarge"><?php echo $size[0][3]?></option>
                 </select>
                 </div>
          </div>
          <div class="buying">
                 <div class="quantity">
                   <label for="quantity">QTY:</label>
                   <input type="text">
                 </div>
                 <div class="cart">
                   <!-- <a href="#" class="add">Add to Cart <i class="fa fa-shopping-cart fa-lg"></i></a> -->
                   <!-- <button class="add" name="addtocart"> Add to Cart <i class="fa fa-shopping-cart fa-lg"></i></button> -->
                   <?php if(isset($_SESSION['ID'])){
      ?>
                <a href="<?php echo URLROOT.'pages/Cart'?>?id=<?php echo $row['ID']; ?>" name="addtocart" class="add" id=>Add to Cart <i class="fa fa-shopping-cart fa-lg"></i> </a>
                <?php
                }
                else{
                ?>
               <a href="<?php echo URLROOT.'pages/signup'?>" class="add"  id=>Add to Cart <i class="fa fa-shopping-cart fa-lg"></i> </a>
                <?php
                }
                ?>
                  
                 </div>
          </div>
          </div>
                 <div class="social">
                   <span class="share">Share This:</span><span class="buttons"><img src="https://i.imgur.com/M8D8rr8.jpg"/></span>
           </div>
          </div>
        </div>
      </form>
    <!-- </div>
  </div> -->
        <div class="bottom">
        <div class="reviews">
          <div class="head">
            <h2>Reviews</h2>
          </div>
          <?php
          if (isset($_SESSION['ID']))
          ?>
          <button id="add_review" class="writeReview">Write your Own Review</button>
            <div class="content">
              <span class="name">Marty McFly</span><span class="stars"><i class="fa fa-star fa-2x"></i><i class="fa fa-star fa-2x"></i><i class="fa fa-star fa-2x"></i><i class="fa fa-star-half-o fa-2x"></i><i class="fa fa-star-o fa-2x"></i></span>
              <p class="review_text">"Check out that four by four. That is hot. Someday, Jennifer, someday. Wouldn't it be great to take that truck up to the lake. Throw a couple of sleeping bags in the back. Whoa, wait, Doc. Here you go, lady. There's a quarter. Well, it will just happen. Like the way I met your father..."</p>
              <!-- <p class="fullReview"><a href="#">View Full Review</a></p> -->
              
            </div>
          </div>
      
</body>

</html>
<!-- habd -->
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                </h4>
                <!-- <div class="form-group">
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                </div> -->
                <div class="form-group">
                    <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                </div>
                <div class="form-group text-center mt-4">
                    <button  type="button" class="btn btn-primary" id="save_review">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- habd -->
<script>

$(document).ready(function(){

    var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

   $('#save_review').click(()=>{
    review=$('#user_review').val();

    $.ajax({
        type: 'POST',
        url: 'product',
        data:{"rating":rating_data,"review":review},
        success: (result)=>{
             $(".reviews").append(result)
            // alert(result);
        }
    })
    });


    // $('#save_review').click(function(){

    //     var user_name = $('#user_name').val();

    //     var user_review = $('#user_review').val();

    //     var product_id = 

    //     if(user_name == '' || user_review == '')
    //     {
    //         alert("Please Fill Both Field");
    //         return false;
    //     }
    //     else
    //     {
    //         $.ajax({
    //             url:"submit_rating.php",
    //             method:"POST",
    //             data:{rating_data:rating_data, user_name:user_name, user_review:user_review,product_id:product_id},
    //             success:function(data)
    //             {
    //                 $('#review_modal').modal('hide');

    //                 load_rating_data();

    //                 alert(data);
    //             }
    //         })
    //     }

    // });

    // load_rating_data();

    // function load_rating_data()
    // {
        //  var product_id = 

    //     $.ajax({
    //         url:"submit_rating.php",
    //         method:"POST",
    //         data:{action:'load_data',product_id:product_id},
    //         dataType:"JSON",
    //         success:function(data)
    //         {
    //             $('#average_rating').text(data.average_rating);
    //             $('#total_review').text(data.total_review);

    //             var count_star = 0;

    //             $('.main_star').each(function(){
    //                 count_star++;
    //                 if(Math.ceil(data.average_rating) >= count_star)
    //                 {
    //                     $(this).addClass('text-warning');
    //                     $(this).addClass('star-light');
    //                 }
    //             });

    //             $('#total_five_star_review').text(data.five_star_review);

    //             $('#total_four_star_review').text(data.four_star_review);

    //             $('#total_three_star_review').text(data.three_star_review);

    //             $('#total_two_star_review').text(data.two_star_review);

    //             $('#total_one_star_review').text(data.one_star_review);

    //             $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

    //             $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

    //             $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

    //             $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

    //             $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

    //             if(data.review_data.length > 0)
    //             {
    //                 var html = '';

    //                 for(var count = 0; count < data.review_data.length; count++)
    //                 {
    //                     html += '<div class="row mb-3">';

    //                     html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

    //                     html += '<div class="col-sm-11">';

    //                     html += '<div class="card">';

    //                     html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

    //                     html += '<div class="card-body">';

    //                     for(var star = 1; star <= 5; star++)
    //                     {
    //                         var class_name = '';

    //                         if(data.review_data[count].rating >= star)
    //                         {
    //                             class_name = 'text-warning';
    //                         }
    //                         else
    //                         {
    //                             class_name = 'star-light';
    //                         }

    //                         html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
    //                     }

    //                     html += '<br />';

    //                     html += data.review_data[count].user_review;

    //                     html += '</div>';

    //                     html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

    //                     html += '</div>';

    //                     html += '</div>';

    //                     html += '</div>';
    //                 }

    //                 $('#review_content').html(html);
    //             }
    //         }
    //     })
    // }

});

</script>
<?php

}


}
?>
