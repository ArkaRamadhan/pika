<?php

include 'koneksi.php';

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = mysqli_query($koneksi, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart succesfully';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css -->
    <link rel="stylesheet" href="styles/style.css">
    <title>PIKA</title>

    <!-- swaper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- swaper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</head>

<body>

    <!-- header section starts -->
    <?php
    require_once('header.php');
    ?>
    <!-- header section ends -->
    <div class="container">

        <form action="" id="search-form">
            <input type="search" placeholder="search here.." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
            <i class="fas fa-times" id="close"></i>
        </form>

        <!-- home section start -->

        <section class="home" id="home">

            <div class="swiper mySwiper home-slider">

                <div class="swiper-wrapper wrapper">

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>menu special</span>
                            <h3>Nasi Goreng</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorum quasi ab cumqu</p>
                            <a href="#" class="btn">order disini</a>
                        </div>
                        <div class="image">
                            <img src="images/nasigoreng.png" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>menu special</span>
                            <h3>Nasi Goreng</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorum quasi ab cumqu</p>
                            <a href="#" class="btn">order disini</a>
                        </div>
                        <div class="image">
                            <img src="images/nasigoreng.png" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>menu special</span>
                            <h3>Nasi Goreng</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorum quasi ab cumqu</p>
                            <a href="#" class="btn">order disini</a>
                        </div>
                        <div class="image">
                            <img src="images/nasigoreng.png" alt="">
                        </div>
                    </div>

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </section>

        <!-- home section ends -->

        <!-- dishes section start -->
        <section class="dishes" id="dishes">
            <h3 class="sub-heading">our dishes</h3>
            <h1 class="heading">popular dishes</h1>

            <div class="box-container">

                <?php

                include 'koneksi.php';

                $details = mysqli_query($koneksi, "select * from menu where soldout='yes'");
                $cek = mysqli_num_rows($details);

                if ($cek > 0) {
                    while ($d = mysqli_fetch_assoc($details)) {
                        $id_menu = $d['id_menu'];
                        $nama_makanan = $d['nama_makanan'];
                        $harga = $d['harga'];
                        $foto = $d['foto'];
                ?>

                        <div class="box" style="filter: grayscale(100%);">
                            <?php
                            if ($foto == "") {
                                echo "<div>Gambar tidak tersedia</div>";
                            } else {
                            ?>
                                <h2 id="soldout">SOLD OUT</h2>
                                <img src="admin/gambar/<?php echo $foto ?>" alt="">
                            <?php
                            }
                            ?>
                            <h3> <?php echo $nama_makanan; ?></h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span>Rp. <?php echo $harga; ?></span>
                            <!-- <input type="submit" class="btn" name="add_to_cart" value="add to cart"> -->
                            <input type="hidden" name="id_menu" value='<?= $d['id_menu'] ?>'>
                            <button type="submit" class="btn" name="add_to_cart">add to cart</button>

                        </div>

                <?php
                    }
                }
                ?>



                <?php
                include 'koneksi.php';

                $details = mysqli_query($koneksi, "select * from menu where soldout='no'");
                $cek = mysqli_num_rows($details);

                if ($cek > 0) {
                    while ($d = mysqli_fetch_assoc($details)) {
                        $id_menu = $d['id_menu'];
                        $nama_makanan = $d['nama_makanan'];
                        $harga = $d['harga'];
                        $foto = $d['foto'];
                        $soldout = $d['soldout'];
                ?>
                        <div class="box">
                            <form action="liked_aksi.php" method="post">
                                <input type="hidden" value="<?= $d['id_menu'] ?>" name='id_menu'>
                                <input type="hidden" value="<?php echo $d['foto']; ?>" name='foto'>
                                <input type="hidden" value="<?php echo $d['nama_makanan'] ?>" name='nama_makanan'>
                                <input type="hidden" value="<?php echo $d['harga'] ?>" name='harga'>
                                <input type="hidden" value="<?php echo $d['soldout'] ?>" name='soldout'>
                                <button type="submit" name="liked" class="fas fa-heart"></button>
                            </form>
                            <form method="post" action="">
                                <?php
                                if ($foto == "") {
                                    echo "<div>Gambar tidak tersedia</div>";
                                } else {
                                ?>
                                    <img src="admin/gambar/<?php echo $foto ?>" alt="">
                                <?php
                                }
                                ?>
                                <h3> <?php echo $nama_makanan; ?></h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span>Rp. <?php echo $harga; ?></span>

                                        <input type="hidden" value="<?php echo $d['foto']; ?>" name='product_image'>
                                        <input type="hidden" value="<?php echo $d['nama_makanan'] ?>" name='product_name'>
                                        <input type="hidden" value="<?php echo $d['harga'] ?>" name='product_price'>
                                        <button type="submit" class="btn" name="add_to_cart">add to cart</button>
                            </form>
                        </div>





        <?php
                                    }
                                }
                            
        ?>




            </div>
        </section>

        <!-- dishes section ends -->

        <!-- about section starts -->

        <section class="about" id="about">

            <h3 class="sub-heading"> about us </h3>
            <h1 class="heading"> why choose us? </h1>

            <div class="row">

                <div class="image">
                    <img src="images/food.png" alt="">
                </div>

                <div class="content">
                    <h3>best food in PI school</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat ut exercitationem quia quasi, cumque
                        adipisci a facere aperiam. Molestias ipsam esse veniam est inventore ea nesciunt porro magni rerum
                        sint.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, quo earum dolore nulla est eius ipsa
                        optio cumque similique ipsum!</p>
                    <div class="icons-container">
                        <div class="icons">
                            <i class="fas fa-shipping-fast"></i>
                            <span>free delivery</span>
                        </div>
                        <div class="icons">
                            <i class="fas fa-dollar-sign"></i>
                            <span>easy payment</span>
                        </div>
                        <div class="icons">
                            <i class="fas fa-headset"></i>
                            <span>24/7 service</span>
                        </div>
                    </div>
                    <a href="#" class="btn">learn more</a>
                </div>

            </div>

        </section>

        <!-- about section ends -->

        <!-- menu section starts -->

        <!-- <section class="menu" id="menu">

            <h3 class="sub-heading"> our menu </h3>
            <h1 class="heading"> today's speciality </h1>

            <div class="box-container">

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

            </div>

        </section> -->

        <!-- menu section ends -->

        <!-- review section starts -->

        <section class="review" id="review">

            <h3 class="sub-heading"> customer's review </h3>
            <h1 class="heading"> what they say </h1>

            <div class="swiper-container review-slider">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slide">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <img src="images/user.jpg" alt="">
                            <div class="user-info">
                                <h3>john kontol</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis ea in minima quaerat
                            officiis,
                            nulla exercitationem architecto quos laudantium a doloremque nesciunt minus iure aperiam,
                            accusantium corrupti nam, non fugit.</p>
                    </div>

                    <div class="swiper-slide slide">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <img src="images/user.jpg" alt="">
                            <div class="user-info">
                                <h3>john kontol</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis ea in minima quaerat
                            officiis,
                            nulla exercitationem architecto quos laudantium a doloremque nesciunt minus iure aperiam,
                            accusantium corrupti nam, non fugit.</p>
                    </div>

                    <div class="swiper-slide slide">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <img src="images/user.jpg" alt="">
                            <div class="user-info">
                                <h3>john kontol</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis ea in minima quaerat
                            officiis,
                            nulla exercitationem architecto quos laudantium a doloremque nesciunt minus iure aperiam,
                            accusantium corrupti nam, non fugit.</p>
                    </div>

                    <div class="swiper-slide slide">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <img src="images/user.jpg" alt="">
                            <div class="user-info">
                                <h3>john kontol</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis ea in minima quaerat
                            officiis,
                            nulla exercitationem architecto quos laudantium a doloremque nesciunt minus iure aperiam,
                            accusantium corrupti nam, non fugit.</p>
                    </div>

                    <div class="swiper-slide slide">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <img src="images/user.jpg" alt="">
                            <div class="user-info">
                                <h3>john kontol</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis ea in minima quaerat
                            officiis,
                            nulla exercitationem architecto quos laudantium a doloremque nesciunt minus iure aperiam,
                            accusantium corrupti nam, non fugit.</p>
                    </div>

                </div>

            </div>

        </section>

        <!-- review section ends -->

        <!-- order section starts -->

        <section class="order" id="order">

            <h3 class="sub-heading"> order now </h3>
            <h1 class="heading"> free and fast </h1>

            <form action="">

                <div class="inputBox">
                    <div class="input">
                        <span>your name</span>
                        <input type="text" name="" placeholder="enter your name">
                    </div>
                    <div class="input">
                        <span>your number</span>
                        <input type="number" name="" placeholder="enter your number">
                    </div>
                </div>

                <div class="inputBox">
                    <div class="input">
                        <span>your order</span>
                        <input type="text" name="" placeholder="enter food name">
                    </div>
                    <div class="input">
                        <span>additional food</span>
                        <input type="text" name="" placeholder="extra with food">
                    </div>
                </div>

                <div class="inputBox">
                    <div class="input">
                        <span>how much</span>
                        <input type="number" name="" placeholder="how many orders">
                    </div>
                    <div class="input">
                        <span>date and time</span>
                        <input type="datetime-local">
                    </div>
                </div>

                <div class="inputBox">
                    <div class="input">
                        <span>your address</span>
                        <textarea name="" id="" placeholder="enter your address" cols="30" rows="10"></textarea>
                    </div>
                    <div class="input">
                        <span>your message</span>
                        <textarea name="" id="" placeholder="enter your message" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <input type="submit" value="order now" class="btn">

            </form>

        </section>

        <!-- order section ends -->

        <!-- footer section start -->

        <section class="footer">

            <div class="box-container">

                <div class="box">
                    <h3>locations</h3>
                    <a href="#">india</a>
                    <a href="#">indonesia</a>
                    <a href="#">amerika</a>
                    <a href="#">rusia</a>
                    <a href="#">japan</a>
                </div>

                <div class="box">
                    <h3>quick links</h3>
                    <a href="#">home</a>
                    <a href="#">dishes</a>
                    <a href="#">about</a>
                    <a href="#">review</a>
                    <a href="#">order</a>
                </div>

                <div class="box">
                    <h3>contact info</h3>
                    <a href="#">+123-456-7890</a>
                    <a href="#">+111-222-3333</a>
                    <a href="#">+arkaramadhan@gmail.com</a>
                    <a href="#">+arka@gmail.com</a>
                    <a href="#">bandung, indonesia</a>
                </div>

                <div class="box">
                    <h3>follow us</h3>
                    <a href="#">facebook</a>
                    <a href="#">twitter</a>
                    <a href="#">instagram</a>
                    <a href="#">linkedin</a>
                </div>

            </div>

            <div class="credit"> copyright @ 2023 by <span>Arka Ramadhan</span> </div>

        </section>
    </div>
    <!-- footer section ends -->

    <!-- loader part -->
    <div class="loader-container">
        <img src="images/Bean Eater-1s-200px.gif" alt="">
    </div>

    <!-- java script -->
    <script src="js/script.js"></script>



</body>

</html>