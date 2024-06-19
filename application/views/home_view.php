<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Market </title>
    <link rel="website icon"href="<?= base_url('upload/ic/apple_logo_icon_147318.ico')?>"/>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href=<?= base_url('assets/css/style_7.css')?>>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body> 
    <div id="nav">
        <div id="menu-icon">&#9776;</div>
        <ul>
            <li><a href="<?= base_url('produk/home');?>"><i class="ri-apple-fill"></i> Store</a></li>    
            <li><a href="#"><i class="ri-information-fill"></i> Tentang Kami</a></li>
            <li><a href="#"><i class="ri-ha nd-heart-fill"></i> Support</a></li>
        </ul>
        
        <form data-type="form-search" method="get" action="<?php echo base_url('produk/cari'); ?>">
            <input  type="text" name="keyword" placeholder="Cari produk...">
            <button name="search" type="submit"><i class="ri-search-line"></i></button>
        </form>
      
      <a href="<?= base_url('user-keranjang') ?>"><i class="ri-shopping-bag-line"></i></a>


        <div id="userIcon">
            <a href="<?= base_url('login'); ?>"> 
            <i class="ri-user-fill"></i>
            </a>       
        </div>
        
        
        </div>
            <div id="center">
                <h1>iPhone 14 pro</h1>
                <h2>Pro.Beyond.</h2>
                <div id="link">
                    <a href="<?= base_url('login');?>">Buy ›</a>
                </div>
                

            </div>
        </div>
        <div id="page2">
            <h1>iPhone 14</h1>
                <h2>Wonderful</h2>
                <div id="link1">
                    <a href="<?= base_url('login');?>">Buy ›</a>
                </div>

        </div>

        <div id="page3">
        
        
            <i class="ri-apple-fill"></i>
                <h1>WATCH</h1><br>
                <h2>SERIES 8</h2><br>
                <p>A healthy leap ahead. </p>
                <div id="link2">
                    <a href="">Learn more ›</a><a href="">Buy ›</a>
                </div>
            
        

        </div>
        </div>
        <div id="page4">
            
                <div id="img1">
                    <i class="ri-apple-fill"></i>
                <h1>Trade In</h1><br>
                <p>Upgrade and save.it's that easy.</p>
                <div id="link3">
                    <a href="">See what your device is worth ›</a>
                </div>


                </div>
                <div id="img2">
                    <i class="ri-apple-fill"></i>
                    <h1>WWDC23</h1><br>
                    <h4>Apple Worldwide Developers Conference.</h4>  <br>
                        <h5> Join us online from 5 to 9 June</h5>
            
                    <div id="link4">
                        <a href="">Learn more ›</a>
                    </div>

                </div>
                
        </div>
    </body>


        <div class="gallery">
            <img src="https://th.bing.com/th/id/OIP.E9vVmU942mFkxAXDLqzmnQHaFt?w=500&h=386&rs=1&pid=ImgDetMain" alt="Image 1">
            <img src="https://th.bing.com/th/id/OIP.GcW4_TsOiE-jYFuvf9P2lgHaFj?pid=ImgDet&w=474&h=355&rs=1" alt="Image 2">
            <img src="https://www.apple.com/v/home/az/images/promos/macbook-pro-14-and-16/promo_mbp__ek7p477bkp6q_medium.jpg" alt="image 3">
            <img src="https://i.pinimg.com/736x/dc/a9/5e/dca95e895aa11691a68030e7028e1f25.jpg" alt="Image 4">
            <img src="https://nigerianprice.com/wp-content/uploads/2021/06/Apple-iPad-Pro-11-2021-Price-in-Nigeria.jpg" alt="Image 5">
            <img src="https://www.apple.com/v/home/az/images/promos/ipad/promo_ipad__fioegapg12qi_medium.jpg" alt="Image 6">
            <img src="https://cdn.eraspace.com/pub/media/wysiwyg/homepage-webp-desktop/Banner_Section_Aksesoris_500x500px_16_Maret_2021__desktop.webp" alt="Image 7">
            <img src="https://cdn.eraspace.com/pub/media/wysiwyg/homepage-webp-desktop/Halobox_500x500px_7_Juni_2022-_desktop.webp" alt="Image 8">
            <img src="https://www.apple.com/in/home/promos/apple-watch-ultra/images/promo_apple_watch_ultra__gnsqulvdc4a6_medium.jpg" alt="Image 9">
        </div>

    </div>
    
    <div id="main">

                

                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div id="sli">
                                <img src="https://is3-ssl.mzstatic.com/image/thumb/Features116/v4/a5/5c/3d/a55c3dab-6013-36fc-8c9b-781b33f69a33/a8a18563-8e91-48fd-8b2a-98dd758232d1.png/274x593.jpg" alt="" srcset="">
                                <button>Stream now</button>
                            </div>
                            
                        
                        </div>
                        <div class="swiper-slide">
                            <img src="https://is3-ssl.mzstatic.com/image/thumb/Features126/v4/64/50/3e/64503e10-fedd-1675-88a7-0390a9b52812/7a77a7ef-c3b1-4932-a68c-ba787ec24c87.png/274x593.jpg" alt="">
                        <button>Stream now</button>
            
                        </div>
                        <div class="swiper-slide">
                            <img src="https://is3-ssl.mzstatic.com/image/thumb/Features126/v4/97/82/da/9782da98-ff81-3cba-c4c9-a1d4ca098434/0b6e540e-78a2-43a6-8ba7-1aae32a3094b.png/274x593.jpg" alt="">
                            <button>Stream now</button>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://is4-ssl.mzstatic.com/image/thumb/Features126/v4/07/52/74/075274db-9cc1-be06-ad65-042131c07c34/1232a4e6-a37a-4a29-8240-0f9a2e715e6c.png/274x593.jpg" alt="">
                            <button>Stream now</button>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://is2-ssl.mzstatic.com/image/thumb/Features126/v4/ea/d3/0a/ead30a4d-af1a-c83a-74b3-db5802902f28/1b254aeb-39cb-4627-8014-602fbd981e50.png/274x593.jpg" alt="">
                            <button>Stream now</button>
                        </div>
                            
                            <div class="swiper-slide">
                            <img src="https://is1-ssl.mzstatic.com/image/thumb/Features116/v4/a0/0a/6f/a00a6f87-5c8b-9db6-2dea-df6525d18a4f/37466094-0c94-4459-8a56-1275470f56af.png/274x593.jpg" alt="">
                            <button>Stream now</button>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://is1-ssl.mzstatic.com/image/thumb/Features116/v4/13/ad/2d/13ad2dba-7ec0-7283-bc79-cb111723f441/c1bc1790-74c9-4b4a-9bf4-250f9d91d49d.png/274x593.jpg" alt="">
                            <button>Stream now</button>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://is2-ssl.mzstatic.com/image/thumb/Features126/v4/b3/fa/77/b3fa7718-b692-ca56-87ce-5af818a447f7/955d54ab-6986-4e68-981d-b11df46a0029.png/274x593.jpg" alt="">
                            <button>Stream now</button>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://is1-ssl.mzstatic.com/image/thumb/Features116/v4/fc/54/08/fc54084e-1b43-4990-1c0c-e43a71fd0b3a/7b598f54-1b64-4a9e-bb50-600955eea497.png/274x593.jpg" alt="">
                            <button>Stream now</button>
                        </div>
                        </div> 
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script src=<?= base_url('assets/js/script_1.js');?>></script>
        </div>

        <footer>
            <div id="para">
                <p>*Instant savings, otherwise referred to as instant Cashback on the Apple Store Online, is available with the purchase of an eligible product for qualifying HDFC Bank credit cards & HDFC Bank credit card EMI only. Minimum transaction value of ₹10001 applies. Click here to see instant savings amounts and eligible devices. Instant savings are available for up to two orders per rolling 90-day period with an eligible card. Card eligibility is subject to terms and conditions between you and your card-issuing bank. Total transaction value is calculated after any trade-in credit or eligible discount applied. Any subsequent order adjustment(s) or cancellation(s) may result in instant savings being recalculated, and any refund may be adjusted to account for instant savings clawback; this may result in no refund being made to you. Offer may be revised or withdrawn at any time without any prior notice. Terms and conditions apply. Offer cannot be combined with Apple Store for Education or Corporate Employee Purchase Plan pricing. Multiple separate orders cannot be combined for instant savings.
                </p>
            </div>
            <hr>
            <div id="list">
                <div class="list1">
                    <h5>Shop and Learn</h5>
                    <ul>
                        <li>Store</li>
                        <li>Mac</li>
                        <li>iPad</li>
                        <li>iPhone</li>
                        <li>Watch</li>
                        <li>AirPods</li>
                        <li>TV & Home</li>
                        <li>AirTag</li>
                        <li>Accessories</li>
                        <li>Gift Cards</li>
                    </ul>
                    <h5>Apple Wallet</h5>
                    <ul>
                        <li>Wallet</li>
                    </ul>
                </div>
                <div class="list1">
                    <h5>Account</h5>
                    <ul>
                        <li>Manage Your Apple ID</li>
                        <li>Apple Store Account</li>
                        <li>iCloud.com</li>
                    </ul>
                    <h5>Entertainment</h5>
                    <ul>
                        
                        <li>Apple One</li>
                        <li>Apple TV+</li>
                        <li> Apple Music</li>
                        <li> Apple Arcade</li>
                        <li>Apple Podcasts</li>
                        <li>Apple Books</li>
                        <li>App Store</li>
                    </ul>
                </div><div class="list1">
                    <h5>Apple store</h5>
                    <ul>
                        <li>Find a Store</li>
                        <li> Genius Bar</li>
                        <li>Today at Apple</li>
                        <li>Apple Camp</li>
                        <li>Apple Trade In</li>
                        <li> Ways to Buy</li>
                        <li>Recycling Programme</li>
                        <li>Order Status</li>
                        <li> Shopping Help</li>
                    </ul>
                    
                </div><div class="list1">
                    <h5>For Bussiness</h5>
                    <ul>
                        <li>Apple and Business</li>
                        <li> Shop for Business</li>
                    
                    </ul>
                    <h5>For Education</h5>
                    <ul>
                        <li>Apple and Education</li>
                            <li>Shop for Education</li>
                            <li>Shop for University</li>
                    </ul>
                    <h5>For Healthcare</h5>
                    <ul>
                        <li>Apple in Healthcare</li>
                            <li> Health on Apple Watch</li>
                            
                    </ul>
                </div>
                <div class="list1">
                    <h5>Apple Values</h5>
                    <ul>
                        <li>Accessibility</li>
                        <li>Education</li>
                        <li>Environment</li>
                        <li>Privacy</li>
                        <li>Supplier Responsibility</li>
                        
                    </ul>
                    <h5>About Apple</h5>
                    <ul>
                        <li>Newsroom </li>
                        <li>Apple Leadership</li>
                        <li>Career Opportunities</li>
                        <li> Investors</li>
                        <li>Ethics & Compliance</li>
                        <li> Events</li>
                        <li>Contact Apple</li>
                    </ul>
                </div>
            </div>
            <div id="foot">
                <p>More ways to shop: <a href="#">Find an Apple Store</a> or <a href="">other retailer near you.</a> Or call 000800 040 1966.</p>
            </div>
            <hr>
            <div id="footlast">
                <div id="ff">
                <p>Copyright © 2023 Apple Inc. All rights reserved.</p>
                </div>
                <div id="ff2">
                    <p>Privacy Policy |  Terms of Use | Sales Policy | Legal | Site Map</p>
                </div>
                <div id="ff3">
                    <a href="#">Indonesia</a>
                </div>
            </div>


        </footer>
    
</body>
</html>