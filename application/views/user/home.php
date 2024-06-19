<?php 
    $this->load->view('header_user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Produk</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    #banner {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
            z-index: -1;
        }

        #banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

.produk-container{
        display: flex;
      flex-wrap: wrap;
      justify-content: left;
      margin-left: 10%;
      margin-bottom: 20%;
    }

    .produk-card {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 15px;
      width: 180px;
      margin: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      opacity: 0; /* Initially set opacity to 0 */
      transform: translateY(20px); /* Move cards down initially */
      transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }

    .produk-card img {
      width: 100px;
      height: 100px; /* Set a fixed height for the product images */
      object-fit: cover; /* Ensure the image covers the specified height without stretching */
    }

    .produk-card h3 {
      margin: 10px 0;
      font-size: 1rem;
      color: #333;
    }

    .produk-card p {
      margin: 5px 0;
      color: #666;
    }

    .buy-button {
      width: 3em;
      height: 2em;
      background-color: #007bff; /* Changed background color */
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      transition-duration: 0.4s;
      outline: none;
      box-shadow: 0 0 1em rgba(0, 0, 0, .2);
      animation: pulse 1.5s infinite;
    }

    .buy-button:hover {
      background-color: #00C9A7;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
      100% {
        transform: scale(1);
      }
    }

    .flash-message {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .flip-container {
      perspective: 1000px;
    }

    .flip-card {
      transform-style: preserve-3d;
      transition: transform 0.5s;
    }

    .flip-card.flip {
      transform: rotateY(180deg);
    }

    .flip-card .front,
    .flip-card .back {
      backface-visibility: hidden;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }

    .flip-card .back {
      transform: rotateY(180deg);
    }

    .star-container {
      display: flex;
    }

    .star-container i {
      font-size: 1.2rem;
      margin-right: 2px;
      color: #fdd835; /* Warna kuning untuk bintang terisi */
    }
    .star-container i.filled {
  color: #fdd835; /* Warna kuning untuk bintang terisi */
}
.star-container i.half-filled {
  position: relative;
  display: inline-block;
  overflow: hidden;
}

.star-container i.half-filled:after {
  content: '\2605'; /* Karakter Unicode untuk bintang penuh */
  position: absolute;
  left: 0;
  top: 0;
  width: 50%;
  overflow: hidden;
}

h2 {
  background: linear-gradient(90deg, #000, #E6E6FA, #000);
  letter-spacing: 5px;
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  background-repeat: no-repeat;
  background-size: 80%;
  position: relative;
  animation: shine 5s linear infinite;
  font-size: 50px;
}

@keyframes shine {
  0% {
    background-position-x: -500%;
  }
  100% {
    background-position-x: 500%;
  }
}

@media screen and (max-width: 768px) {
  #banner {
    height: 50vh; 
  }

  .produk-container {
    margin-left: 5%; /* Adjust the margin for smaller screens */
    margin-bottom: 10%; /* Adjust the margin for smaller screens */
  }

  .produk-card {
    width: 48%; /* Make the cards take up 48% of the width for smaller screens */
    margin: 10px 1%; /* Adjust margin and add a small gap between cards for smaller screens */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
  }

  .produk-container {
    display: flex;
    flex-wrap: wrap;
  }
}


  </style>
</head>
<body>
<div id="banner">
        <div class="slider">
            
            <div class="slide"><img src="https://storage.googleapis.com/eraspacelink/pmp/production/banners/images/gtkxWNWBgZSz7r2SZYfkiOLzJoC6KO6hfED4uRqH.webp" alt="Banner 1"></div>
            <div class="slide"><img src="https://storage.googleapis.com/eraspacelink/pmp/production/banners/images/86vjFcjiQEu1LTJMaqyVgS8WkQ4Yyv3jtrnTnfUm.webp" alt="Banner 2"></div>
            <div class="slide"><img src="https://storage.googleapis.com/eraspacelink/pmp/production/banners/images/g1I832RMqt20oKuX9GnzQeFgFamobCyyhSag9e81.webp" alt="Banner 3"></div>
            <div class="slide"><img src="https://storage.googleapis.com/eraspacelink/pmp/production/banners/images/zeXIu4nx2m4ue2yHHYoV1xz2lhmAGSGbJ7KnHfOA.webp" alt="Banner 4"></div>
            <div class="slide"><img src="https://storage.googleapis.com/eraspacelink/pmp/production/banners/images/05V2aksuwE9QexzVu1R1WPGEXrXTThgnSKZbW9IN.webp" alt="Banner 5"></div>
           
        </div>
    </div>



 <?php $this->load->view('user/produk'); ?>
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

  <script>
    
//slinder
const slider = document.querySelector('.slider');
        let isSliding = false;

        function slide() {
            if (!isSliding) {
                isSliding = true;
                const firstSlide = document.querySelector('.slide');
                slider.style.transition = 'transform 0.5s ease-in-out';
                slider.style.transform = `translateX(-${firstSlide.offsetWidth}px)`;

                setTimeout(() => {
                    const clonedSlide = firstSlide.cloneNode(true);
                    slider.appendChild(clonedSlide);
                    slider.style.transition = 'none';
                    slider.style.transform = 'translateX(0)';
                    slider.removeChild(firstSlide);
                    isSliding = false;
                }, 500);
            }
        }

        setInterval(slide, 3000);
  </script>
</body>
</html>
 