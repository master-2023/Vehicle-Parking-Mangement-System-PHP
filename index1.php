<?php
require("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYPARK</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- for contact form -->
    <!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

 <style>    
 @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    padding: 0;
    margin: 0;
    font-family: 'poppins', sans-serif;
    box-sizing: border-box;
    text-transform: capitalize; 
    transition: all .4s ease;
    text-decoration: none;
}

:root{
    --dark-green: #112a34;
    --green-color: #004047;
    --white-color: #fff;
}

::selection{
    background: var(--green-color);
    color: var(--white-color);
}

body{
    width: 100%;
    height: 100%;
}


section{
    padding: 0 8rem;
    width: 100%;
}
.label{
    font-size: 1.1rem;
    color: #666;
    text-transform: uppercase;
    font-weight: 500;
}
.heading{
    font-size: 3rem;
    margin-top: 1rem;
}
section.home{
    padding: 1rem;
    width: 100%;
    height: 100vh;
}
.home .home-box{
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(0,0,0,.1), rgba(0,0,0,.1)), url(assets/img/back1.jpg);
    background-size: cover;
    background-position: center;
    padding: .5rem;
    border-radius: .5rem;
}
.home .home-box nav{
    width: 100%;
    height: 64px;
    background: linear-gradient(rgba(255,255,255,.2), rgba(255,255,255,.2));
    backdrop-filter: blur(2px);
    border-radius: .7rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 4rem;
    z-index: 10;
    position: relative;
}
nav .logo{
    display: flex;
    align-items: center;
    gap: 1rem;
}
nav .logo .bar{
    font-size: 1.5rem;
    color: var(--white-color);
    cursor: pointer;
    display: none;
}
nav .logo .bar:hover{
    color: var(--green-color);
}
nav .logo h3{
    color: var(--white-color);
    font-weight: 400;
    font-style: italic;
}
nav .menu .close{
    display: none;
}
nav .menu ul{
    display: flex;
    gap: 3rem;
    list-style: none;
}
nav .menu ul li a{
    color: var(--white-color);
    font-weight: 400;
}
nav .menu ul li a:hover{
    color: orangered;
}
nav .signup-login{
    display: flex;
    align-items: center;
    gap: .5rem;
}
nav .signup-login a{
    color: var(--white-color);
    padding: .3rem 1rem;
    border-radius: 2rem;
}
nav .signup-login a:last-child{
    background: var(--green-color);
    padding: .3rem 1rem;
    border-radius: 2rem;
}
nav .signup-login a:hover{
    color: orangered;
}
nav .signup-login a:last-child:hover{
    color: var(--white-color);
    background: #02636e;
}
/*  */
nav .signup-user{
    display: flex;
    align-items: center;
    gap: .5rem;
}
nav .signup-user a{
    color: var(--white-color);
    padding: .3rem 1rem;
    border-radius: 2rem;
}
nav .signup-user a:last-child{
    background: var(--green-color);
    padding: .3rem 1rem;
    border-radius: 2rem;
}
nav .signup-user a:hover{
    color: orangered;
}
nav .signup-user a:last-child:hover{
    color: var(--white-color);
    background: #02636e;
}

.home .home-box .content{
    width: 100%;
    height: calc(100% - 64px);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    transform: translate(0, -64px);
}
.content h5{
    text-transform: uppercase;
    color: var(--white-color);
    font-size: .9rem;
    font-weight: 400;
    margin-bottom: 2rem;
}

.content h1{
    font-size: 4rem;
    max-width: 50rem;
    color: var(--white-color);
    text-align: center;
    font-weight: 600;
    line-height: 1.2;
    margin-bottom: 1rem;
}
.content p{
    color: #eee;
    font-weight: 300;
    max-width: 40rem;
    font-size: 1.1rem;
    text-align: center;
    margin-bottom: 2rem;
}


.travel .container{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 4rem;
    padding: 5rem 0;
}
.travel .container .box{
    padding: 0 1rem;
    text-align: center;
    max-width: 30rem;
    transform: translate(0,100px);
    opacity: 0;
}
.travel .container .box img{
    height: 10rem;
}
.travel .container .box h4{
    font-size: 1.2rem;
    margin: 1rem 0;
    margin-top: 2rem;
    font-weight: 600;
}
.travel .container .box p{
    color: #666;
}

.destinations{
    width: 100%;
    padding-top: 4rem;
    padding-bottom: 4rem;
}

.destinations .container{
    width: 100%;
}
.destinations .container .container-box{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}
.destinations .container .container-box .heading{
    max-width: 30rem;
}
.destinations .container .container-box .content{
    max-width: 35rem;
}
.destinations .container .container-box .content p{
    line-height: 1.7;
    color: #666;
    margin-bottom: 1rem;
}
.destinations .container .container-box .content a{
    color: var(--green-color);
    font-weight: 600;
}
.destinations .container .container-box .content a i{
    margin-left: .5rem;
}
.destinations .container .container-box .content a:hover i{
    margin-left: .1rem;
}
.gallery{
    margin-top: 4rem;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}
.gallery .box{
    height: 23rem;
    flex-grow: 1;
    overflow: hidden;
    border-radius: .8rem;
    position: relative;
}
.gallery .box img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
.gallery .box .text{
    position: absolute;
    bottom: 0;
    padding: 1.5rem 2rem;
    left: 0;
    z-index: 1;
}
.gallery .box .text h2{
    font-size: 1.4rem;
    color: var(--white-color);
    font-weight: 500;
}
.destinations .container .container-box .heading,
.destinations .container .container-box .content{
    transform: translate(-200px);
    opacity: 0;
}
.featured{
    padding-top: 2rem;
    padding-bottom: 2rem;
}
.featured .gallery .box:first-child{
    border: 1px solid rgba(0,0,0,.3);
    padding: 2rem 1.5rem;
}
.featured .gallery .box:first-child h2{
    margin-bottom: .5rem;
}
.featured .gallery .box:first-child p{
    margin-bottom: .5rem;
    color: #666;
}
.featured .gallery .box:first-child a{
    position: absolute;
    bottom: 2rem;
    padding: .4rem 1rem;
    color: var(--white-color);
    background: var(--green-color);
    border-radius: 3rem;
    font-size: .9rem;
    font-weight: 400;
}
.featured .gallery .box:first-child .image{
    width: 40%;
    position: absolute;
    bottom: -1rem;
    right: 2rem;
}
.featured .gallery .box .content{
    width: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 1.5rem 2rem;
}

.featured .gallery .box .content h2{
    font-weight: 500;
    color: var(--white-color);
}
.featured .gallery .box .content p{
    font-size: .9rem;
    color: #eee;
}
.featured .gallery .box .content .review-and-idr .review{
    font-size: .9rem;
    color: #eee;
}
.featured .gallery .box .content .review-and-idr .review{
    color: #ffa600;
}
.featured .gallery .box .content .review-and-idr p{
    font-size: 1.1rem;
    text-transform: uppercase;
    font-weight: 500;
    color: var(--white-color);
}
.featured .gallery .box{
    transform: translate(0,100px);
    opacity: 0;
}

.feedback {
    background: url("assets/img/section-background.jpg");
    background-position: center;
    background-size: cover;
    margin-top: 6rem;
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.feedback .container {
    display: flex;
    align-items: center;
    flex-direction: column;
}

.feedback .container h4 {
    color: rgb(255 255 255/90%);
}

.feedback .container h2 {
    max-width: 40rem;
    color: var(--white-color);
    text-align: center;
}

.feedback .container p {
    color: #eee;
    font-size: 1.2rem;
    margin-top: 1rem;
    text-align: center;
}

.feedback .voices {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 3rem;
}

.feedback .voices .voice {
    flex: 1 0 320px;
    background: var(--white-color);
    padding: 2rem;
    border-radius: .7rem;
}

.feedback .voices .voice .profile {
    display: flex;
    align-items: center;
}

.feedback .voices .voice .profile img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    object-position: center;
    border-radius: 2rem;
}

.feedback .voices .voice .profile .detail {
    margin-left: 1rem;
}

.feedback .voices .voice .profile .detail li {
    list-style: none;
}

.feedback .voices .voice .profile .detail li:first-child {
    font-size: 1.1rem;
    color: #000;
    font-weight: 600;
}

.feedback .voices .voice p {
    margin-top: 1rem;
}
.feedback .container .label,
.feedback .container .heading,
.feedback .container .paragraph{
    transform: translate(0, 10px);
    opacity: 0;
}
.feedback .voices .voice{
    transform: translate(0,100px);
    opacity: 0;
}


.article {
    padding-top: 3rem;
    padding-bottom: 3rem;
    margin-top: 5rem;
}

.article .container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-top: 2rem;
}

.article .container .latest-article,
.article .container .more-article {
    width: 100%;
    flex:  1 0 350px;
}

.article .container .latest-article img {
    width: 100%;
    height: 28rem;
    border-radius: 1rem;
    object-fit: cover;
    object-position: center;
}

.article .container .latest-article p {
    margin: .8rem 0;
    color: #666;
}

.article .container .latest-article h3 {
    font-size: 1.4rem;
    font-weight: 600;
}

.article .container .latest-article .author {
    display: flex;
    align-items: center;
    gap: .7rem;
}

.article .container .latest-article .author img {
    width: 30px;
    height: 30px;
    border-radius: 3rem;
}

.article .container .latest-article .author p {
    font-size: .9rem;
}

.article .container .more-article {
    display: grid;
    gap: 1rem;
    overflow: hidden;
}

.article .container .more-article .box {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.article .container .more-article .box img {
    width: 135px;
    height: 120px;
    object-fit: cover;
    object-position: center;
    border-radius: .5rem;
}

.article .container .more-article .text h3 {
    font-size: 1.2rem;
    font-weight: 600;
}

.article .container .more-article .text li {
    margin-top: .3rem;
    list-style: none;
    color: #666;
}

.article .label, .article .heading {
    opacity: 0;
}

.article .latest-article, .article .more-article .box {
    transform: translate(-200px, 0);
    opacity: 0;
    transition: all .4s ease-out;
}
footer {
    padding:  1rem;
    width: 100%;
}

footer .footer {
    background: var(--dark-green);
    border-radius: .7rem;
    padding: 6rem 7rem;
    padding-bottom: 1rem;
}

footer .footer .container {
    display: flex;
    justify-content: space-between;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--green-color);
    gap: 2rem;
}

footer .footer .container .detail {
    max-width: 32rem;
}

footer .footer .container .detail h3 {
    font-size: 1.3rem;
    font-weight: 500;
    margin-bottom: 1rem;
    color: var(--white-color);
}

footer .footer .container .detail p {
    line-height: 1.6;
    color: rgb(255 255 255/80%);
    margin-bottom: 1.5rem;
}

footer .footer .container .detail h5 {
    font-size: 1rem;
    font-weight: 400;
    color: var(--white-color);
}

footer .footer .container .detail a {
    color: rgb(255 255 255/80%);
    font-size: .9rem;
    border-bottom: 2px solid #00cee4;
    padding: 1px 0;
    display: inline-block;
}

footer .footer .container .detail .social {
    display: flex;
    gap: .8rem;
    margin-top: 1rem;
}

footer .footer .container .detail .social a {
    border: none;
    font-size: 1.3rem;
    color: var(--white-color);
}

footer .footer .container h4 {
    font-size: 1.1rem;
    font-weight: 500;
    margin-bottom: .5rem;
    color: var(--white-color);
}

footer .footer .container li {
    list-style: none;
    margin-top: 1rem;
}

footer .footer .container a {
    color: rgb(255 255 255/80%);
}

footer .footer .container a:hover {
    color: var(--white-color);
}

footer .footer .container span {
    color: #000;
    background: #00cee4;
    font-size: .9rem;
    padding: .1rem .5rem;
    border-radius: .3rem;
    font-weight: 500;
}

footer .footer .copyright {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
    font-size: .9rem;
    color: rgb(255 255 255/80%);
    text-align: center;
}

footer .footer .copyright a {
    color: rgb(255 255 255/80%);
    margin-left: 1rem;
    text-align: center;
}
@media (max-width: 1020px) {
    html {
        font-size: 85%;
    }

    section {
        padding: 0 2rem;
    }

    footer .footer {
        padding: 2rem;
    }
}

@media (max-width: 910px) {

    .home .home-box nav {
        padding: 0 1rem;
    }

    .home .home-box nav .menu ul {
        gap: 2rem;
    }

    .destinations .container .container-box {
        flex-direction: column;
        align-items: flex-start;
    }

    footer .footer .container {
        flex-direction: column;
    }
}

@media (max-width: 767px) {

    .heading {
        font-size: 2rem;
    }
    .home .home-box nav .menu {
        display: none;
    }

    .home .home-box nav .logo .bar {
        display: block;
    }

    .home .home-box nav .menu.active {
        display: block;
        position: absolute;
        left: -1.5rem;
        top: -1.5rem;
        width: 100vw;
        height: 100vh;
        background: rgb(0 0 0/90%);
        display: flex;
        align-items: center;
        padding: 0 3rem;
    }

    .home .home-box nav .menu .close {
        display: block;
        position: absolute;
        left: 3rem;
        top: 3rem;
        cursor: pointer;
        color: var(--white-color);
        font-size: 2rem;
    }

    .home .home-box nav .menu .close:hover {
        color: rgb(255 255 255/40%);
    }

    .home .home-box nav .menu ul {
        flex-direction: column;
        font-size: 1.3rem;
        gap: 1rem;
    }

    .home .home-box nav .menu ul:hover li a {
        color: rgb(255 255 255/40%);
    }

    .home .home-box nav .menu ul li a:hover {
        color: var(--white-color);
    }

    .home .home-box .content {
        padding: 2rem;
    }

    .travel .container {
        flex-direction: column;
        padding: 4rem 0;
        gap: 4rem;
    }

    .travel .container .box img {
        height: 6rem;
    }

    .destinations .container .container-box .content {
        font-size: .8rem;
    }

    .feedback .container p {
        font-size: .9rem;
    }
}

@media (max-width: 607px) {
    .home .home-box .content h1 {
        font-size: 2rem;
    }

    .home .home-box .content p {
        font-size: .8rem;
    }
}

@media (max-width: 457px) {
    .article .container .latest-article,
    .article .container .more-article {
        width: 100%;
        flex: 1 0 250px;
    }

    .article .container .more-article .box img {
        width: 100px;
        height: 85px;
    }

    .article .container .more-article .text h3 {
        font-size: 1.1rem;
    }
 }
 /* contact section */
 *, *:before, *:after {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

 body, button, input {
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
  letter-spacing: 1.4px;
}

.background {
  display: flex;
  min-height: 100vh;
}
 .container {
  flex: 0 1 700px;
  margin: auto;
  padding: 10px;
  width:100%;
}

.screen {
  position: relative;
  background: #3e3e3e;
  border-radius: 15px;
}

.screen:after {
  content: '';
  display: block;
  position: absolute;
  top: 0;
  left: 20px;
  right: 20px;
  bottom: 0;
  border-radius: 15px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, .4);
  z-index: -1;
}

.screen-header {
  display: flex;
  align-items: center;
  padding: 10px 20px;
  background: #4d4d4f;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}

.screen-header-left {
  margin-right: auto;
}

.screen-header-button {
  display: inline-block;
  width: 8px;
  height: 8px;
  margin-right: 3px;
  border-radius: 8px;
  background: white;
}

.screen-header-button.close {
  background: #ed1c6f;
}

.screen-header-button.maximize {
  background: #e8e925;
}

.screen-header-button.minimize {
  background: #74c54f;
}

.screen-header-right {
  display: flex;
}

.screen-header-ellipsis {
  width: 3px;
  height: 3px;
  margin-left: 2px;
  border-radius: 8px;
  background: #999;
}

.screen-body {
  display: flex;
}

.screen-body-item {
  flex: 1;
  padding: 50px;
}

.screen-body-item.left {
  display: flex;
  flex-direction: column;
}

.app-title {
  display: flex;
  flex-direction: column;
  position: relative;
  color: #ea1d6f;
  font-size: 26px;
}

.app-title:after {
  content: '';
  display: block;
  position: absolute;
  left: 0;
  bottom: -10px;
  width: 25px;
  height: 4px;
  background: #ea1d6f;
}

.app-contact {
  margin-top: auto;
  font-size: 8px;
  color: #888;
}

.app-form-group {
  margin-bottom: 15px;
}

.app-form-group.message {
  margin-top: 40px;
}

.app-form-group.buttons {
  margin-bottom: 0;
  text-align: right;
}

.app-form-control {
  width: 100%;
  padding: 10px 0;
  background: none;
  border: none;
  border-bottom: 1px solid #666;
  color: #ddd;
  font-size: 14px;
  text-transform: uppercase;
  outline: none;
  transition: border-color .2s;
}

.app-form-control::placeholder {
  color: #666;
}

.app-form-control:focus {
  border-bottom-color: #ddd;
}

.app-form-button {
  background: none;
  border: none;
  color: #ea1d6f;
  font-size: 14px;
  cursor: pointer;
  outline: none;
}

.app-form-button:hover {
  color: #b9134f;
}

.credits {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  color: #ffa4bd;
  font-family: 'Roboto Condensed', sans-serif;
  font-size: 16px;
  font-weight: normal;
}

.credits-link {
  display: flex;
  align-items: center;
  color: #fff;
  font-weight: bold;
  text-decoration: none;
}

.dribbble {
  width: 20px;
  height: 20px;
  margin: 0 5px;
}

@media screen and (max-width: 520px) {
  .screen-body {
    flex-direction: column;
  }

  .screen-body-item.left {
    margin-bottom: 30px;
  }

  .app-title {
    flex-direction: row;
  }

  .app-title span {
    margin-right: 12px;
  }

  .app-title:after {
    display: none;
  }
}

@media screen and (max-width: 600px) {
  .screen-body {
    padding: 40px;
  }

  .screen-body-item {
    padding: 0;
  }
}
/* Align the logo and language selector */
.logo-container {
    display: flex;
    align-items: center;
    gap: 20px; /* Add space between logo and language selector */
}

/* Style the language selector */
.language-selector {
    display: flex;
    align-items: center;
    gap: 10px; /* Add space between label and dropdown */
    font-size: 14px;
}

.language-selector label {
    font-weight: bold;
}

.language-selector select {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

/* Adjust navigation bar */
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}


</style>

</head>
<body>
  <!--home section -->
  <section id="home" class="home">
    <div class="home-box">
        <nav>
            <div class="logo-container">
                <div class="logo bars">
                    <div class="bar">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <h3>PAYPARK</h3>
                </div>
                <!-- Language Dropdown -->
                <div class="language-selector">
                    <label for="language">Language:</label>
                    <select id="language">
                        <option value="en">English</option>
                        <option value="es">Spanish</option>
                        <option value="fr">French</option>
                        <option value="de">German</option>
                        <option value="hi">Hindi</option>
                    </select>
                </div>
            </div>
            <div class="menu">
                <div class="close">
                    <i class="fa-solid fa-close"></i>
                </div>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="#parking space">Parking Space</a></li>
                    <li><a href="#customer">Customer</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#blog">Blog</a></li>
                </ul>
            </div>
            <div class="signup-user">
    <a href="userlogin.php">
        <i class="fa-solid fa-square-parking"></i> Book Parking
    </a>
</div>
        </nav>

        <div class="content">
            <h5 id="brand">PAYPARK</h5>
            <h1 id="slogan">Providing Convenient Parking Solutions</h1>
            <p id="description">Find the Perfect Spot for Your Vehicle with Ease</p>
        </div>
    </div>
</section>


<!-- About Section -->
<section id="about" class="travel">
    <div class="container">
        <div class="box box1">
            <img src="assets/img/map.png" alt="">
            <div class="content">
                <h4 id="about-title1">Trusted and Verified Locations</h4>
                <p id="about-desc1">At PayPark, we ensure all parking locations are thoroughly vetted for security, cleanliness, and reliability. Our trusted partners meet high standards for safety and surveillance. Park with confidence knowing you're in a secure and verified space.</p>
            </div>
        </div>
        <div class="box box2">
            <img src="assets/img/planning.png" alt="">
            <div class="content">
                <h4 id="about-title2">Seamless Allocation of Parking</h4>
                <p id="about-desc2">With PayPark, find and reserve a parking spot effortlessly, anytime, anywhere. Our smart system allocates available spaces in real-time, reducing wait times and eliminating the stress of parking. Enjoy a smooth, hassle-free parking experience every time.</p>
            </div>
        </div>
        <div class="box box3">
            <img src="assets/img/trust.png" alt="">
            <div class="content">
                <h4 id="about-title3">Transparent Pricing and Easy Booking</h4>
                <p id="about-desc3">PayPark offers clear, upfront pricing with no hidden fees, ensuring you know exactly what you pay for. Our user-friendly platform makes booking a parking spot quick and straightforward. Enjoy peace of mind with fair rates and a hassle-free booking process.</p>
            </div>
        </div>
    </div>
</section>

        <!-- parking space -->
    <section id="parking space" class="destinations">
        <h4 class="label">parking space</h4>
        <div class="container">
            <div class="container-box">
                <h2 class="heading">perfect spot for parking vehicles</h2>
                <div class="content">
                    <p>Finding the perfect spot for your vehicle has never been easier with PayPark. Our platform offers real-time updates on available parking spaces, ensuring you always find a convenient and secure spot. Say goodbye to circling around—park with confidence every time.</p>
                    <a href="#">explore more <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="gallery">
                <div class="box box1">
                    <img src="assets/img/bike.jpg" alt="">
                    <div class="text">
                        <h2>two-wheeler</h2>
                    </div>
                </div>
                <div class="box box1">
                    <img src="assets/img/mustang.jpg" alt="">
                    <div class="text">
                        <h2>VIP-parking</h2>
                    </div>
                </div>
                <div class="box box1">
                    <img src="assets/img/car.jpg" alt="">
                    <div class="text">
                        <h2>four-wheeler</h2>
                    </div>
                </div>
                <div class="box box1">
                    <img src="assets/img/cycle.jpg" alt="">
                    <div class="text">
                        <h2>many more</h2>
                    </div>
                </div>
                <div class="box box5">
                    <img src="assets/img/download.gif" alt="">
                    <div class="text">
                        <h2>parking space</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <!-- cutomer section -->
    <section id="customer"class="feedback">
        <div class="container">
            <h4 class="label">happy Customer voices</h4>
            <h2 class="heading">customer's voices</h2>
            <p class="paragraph">
                real stories from our happy customer community.
            </p>
        </div>
        <div class="voices">
            <div class="voice box1">
                <div class="profile">
                    <img src="assets/img/photo1.jpg" alt="">
                    <div class="detail">
                        <li>lucky sharma</li>
                        <li>student</li>
                    </div>
                </div>
                <p>PayPark has made my daily commute so much easier! I no longer waste time searching for a parking spot. The real-time availability feature is a lifesaver!</p>
            </div>
            <div class="voice box2">
                <div class="profile">
                    <img src="assets/img/photo2.jpg" alt="">
                    <div class="detail">
                        <li>divya sharma</li>
                        <li>traveler</li>
                    </div>
                </div>
                <p>I love the transparency in pricing and the ease of booking through PayPark. I always know exactly what Im paying for, and the process is so quick and seamless.</p>
            </div>
            <div class="voice box3">
                <div class="profile">
                    <img src="assets/img/photo3.jpg" alt="">
                    <div class="detail">
                        <li>prem sharma</li>
                        <li>bussinesman</li>
                    </div>
                </div>
                <p>Finding a secure parking spot used to be a hassle, but with PayPark, it’s so simple. The app is user-friendly, and I trust their verified locations.</p>
            </div>
            <div class="voice box4">
                <div class="profile">
                    <img src="assets/img/photo4.jpg" alt="">
                    <div class="detail">
                        <li>gaurav sharma</li>
                        <li>lawyer</li>
                    </div>
                </div>
                <p>PayPark’s interactive map is a game-changer! I can see available spots and plan my parking ahead of time, making my trips stress-free.</p>
            </div>
            <div class="voice box5">
                <div class="profile">
                    <img src="assets/img/photo5.jpg" alt="">
                    <div class="detail">
                        <li>priya sharma</li>
                        <li>host</li>
                    </div>
                </div>
                <p>Excellent service and very reliable. PayPark always has great options, and their customer support is fantastic. Highly recommend it for anyone who drives!</p>
            </div>
            <div class="voice box1">
                <div class="profile">
                    <img src="assets/img/photo1.jpg" alt="">
                    <div class="detail">
                        <li>lucky sharma</li>
                        <li>cyclist</li>
                    </div>
                </div>
                <p>I love how PayPark provides transparent pricing and a seamless booking process. No more surprises or hidden fees — just straightforward, reliable parking!</p>
            </div>
        </div>

    </section>

    <!--Blog Section  -->
    <section id="blog" class="article">
        <h4 class="label">resources</h4>
        <h2 class="heading">latest articles</h2>
        <div class="container">
            <div class="latest-article">
                <img src="assets/img/hidden-game.jpg" alt="">
                <p>parking discovery</p>
                <h3>5 Smart Parking Solutions website to Save Time and Reduce Stress in asia</h3>
                <div class="author">
                    <img src="assets/img/photo7.jpg" alt="">
                    <p>harsh beniwal - 9 min read</p>
                </div>
            </div>
            <div class="more-article">
                <div class="box box1">
                    <div class="image">
                        <img src="assets/img/family.jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>Trust PayPark for Verified Parking Locations and Enhanced Security</h3>
                        <li>secure parking - 7 min read</li>
                    </div>
                </div>
                <div class="box box2">
                    <div class="image">
                        <img src="assets/img/food-article.jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>PayPark Commitment to Transparent Pricing and Customer Satisfaction</h3>
                        <li>customer report - 7 min</li>
                    </div>
                </div>
                <div class="box box3">
                    <div class="image">
                        <img src="assets/img/budget-travel.jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>Why More Drivers Are Choosing PayPark for Stress-Free Parking</h3>
                        <li>parking  travel - 7 min read</li>
                    </div>
                </div>
                <div class="box box4">
                    <div class="image">
                        <img src="assets/img/tips.jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>The Ultimate Guide to Secure and Affordable Parking</h3>
                        <li>parking  - 7 min read</li>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        
      <!-- Contact Section -->
      <section id="contact" style="background-image:url('assets/img/project3.gif'); bottom:0px; height:100%">
    <div class="background">
        <div class="container mx-auto px-3 text-center">
            <h2 class="text-4xl text-center font-bold text-blue-100">Contact Us</h2>
            <div class="screen">
                <div class="screen-header">
                    <div class="screen-header-left">
                        <div class="screen-header-button close"></div>
                        <div class="screen-header-button maximize"></div>
                        <div class="screen-header-button minimize"></div>
                    </div>
                    <div class="screen-header-right">
                        <div class="screen-header-ellipsis"></div>
                        <div class="screen-header-ellipsis"></div>
                        <div class="screen-header-ellipsis"></div>
                    </div>
                </div>
                <div class="screen-body">
                    <div class="screen-body-item left">
                        <div class="app-title">
                            <span>CONTACT</span>
                            <span>US</span>
                        </div>
                        <div class="app-contact">CONTACT INFO: +91 87 883 457 34</div>
                    </div>
                    <div class="screen-body-item">
                        <!-- Form pointing to PHP script -->
                        <form method="POST" action="" class="app-form">
                            <div class="app-form-group">
                                <input type="text" class="app-form-control" name="name" placeholder="NAME" required>
                            </div>
                            <div class="app-form-group">
                                <input type="email" class="app-form-control" name="email" placeholder="EMAIL" required>
                            </div>
                            <div class="app-form-group">
                                <input type="tel" maxlength="10" class="app-form-control" name="contact_no" placeholder="CONTACT NO" required>
                            </div>
                            <div class="app-form-group message">
                                <input type="text" class="app-form-control" name="message" placeholder="MESSAGE" required>
                            </div>
                            <div class="app-form-group buttons">
                                <button type="submit" href="contact.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700" name="SEND" value="SEND">SEND</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

if(isset($_POST['SEND'])) {
    $insert = "INSERT INTO contacts (name, email, contact_no, message) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[contact_no]', '$_POST[message]')";
    if(mysqli_query($conn, $insert)) {
        // SweetAlert2 success message
        echo "<script>
        Swal.fire({
            title: 'Message Sent Successfully!',
            text: 'We will contact you back soon.',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6',
            background: '#fff url(https://www.transparenttextures.com/patterns/diamond-upholstery.png)', // Optional background pattern
            customClass: {
                popup: 'animated fadeInDown faster' // Adds some animation
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php'; // Redirect after confirmation
            }
        });
        </script>";
    }
}
?>



    
    <!-- footer section -->
    <footer>
    <div class="footer">
        <div class="container">
            <div class="detail">
                <h3>PAYPARK</h3>
                <p>Your ultimate solution for hassle-free parking, offering secure and convenient parking spots at your fingertips. Simplify your parking experience with real-time availability and easy booking.</p>
                <h5>Get in Touch</h5>
                <a href="#">PAYPARK</a>
                <div class="social">
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            <div class="about-us">
                <h4>Address</h4>
                <li><a href="#">MIDC Road, in front of MIDC Police Station, 413006, Solapur</a></li>
                <li><a href="#">Email: paypark@gmail.com</a></li>
                <li><a href="#">Phone: +91 8788345734</a></li>
                <li><a href="#">Site Map</a></li>
            </div>
            <!-- Embed Google Map -->
            <div class="map">
                <h4>Find Us Here</h4>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.015127798512!2d75.9213648152211!3d17.659918887916054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc5e59f87a29e47%3A0x6f8b0730af690bb2!2sMIDC%20Road%2C%20Solapur%2C%20Maharashtra%20413006!5e0!3m2!1sen!2sin!4v1635848483674!5m2!1sen!2sin" 
                    width="300" 
                    height="200" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>

        <div class="copyright">
            <div>&copy; 2024 PAYPARK, Inc, all rights reserved</div>
            <div>
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="script.js"></script>

<script> 
      const bars = document.querySelector(".bars"),
      close = document.querySelector(".close"),
      menu = document.querySelector(".menu");

bars.addEventListener("click", () => {
    menu.classList.add("active");
    gsap.from(".menu", {
        opacity: 0,
        duration: .3
    })
    gsap.from(".menu ul", {
        opacity: 0,
        x: -300
    })
});   

close.addEventListener("click", () => {
    menu.classList.remove("active")
});


function animateContent(selector) {
    selector.forEach((selector) => {
        gsap.to(selector, {
            y: 30,
            duration: 0.1,
            opacity: 1,
            delay: 0.2,
            stagger: 0.2,
            ease: "power2.out",
        });
    });
}

function scrollTirggerAnimation(triggerSelector, boxSelectors) {
    const timeline = gsap.timeline({
        scrollTrigger: {
            trigger: triggerSelector,
            start: "top 50%",
            end: "top 80%",
            scrub: 1,
        },
    });

    boxSelectors.forEach((boxSelector) => {
        timeline.to(boxSelector, {
            y: 0,
            duration: 1,
            opacity: 1,
        });
    })
}

function swipeAnimation(triggerSelector, boxSelectors) {
    const timeline = gsap.timeline({
        scrollTrigger: {
            trigger: triggerSelector,
            start: "top 50%",
            end: "top 100%",
            scrub: 3,
        },
    });

    boxSelectors.forEach((boxSelector) => {
        timeline.to(boxSelector, {
            x: 0,
            duration: 1,
            opacity:1,
        });
    });
}

function galleryAnimation(triggerSelector, boxSelectors) {
    const timeline = gsap.timeline({
        scrollTrigger: {
            trigger: triggerSelector,
            start: "top 100%",
            end: "bottom 100%",
            scrub: 1,
        },
    });

    boxSelectors.forEach((boxSelector) => {
        timeline.to(boxSelector, {
            y: 0,
            opacity: 1,
            duration: 1,
        });
    });
}




animateContent([".home .content h5, .home .content h1, .home .content p, .home .content .search"]);

scrollTirggerAnimation(".travel", [".travel .box1", ".travel .box2", ".travel .box3"]);

scrollTirggerAnimation(".feedback .container", [".feedback .label", ".feedback .heading", ".feedback .paragraph"]);

scrollTirggerAnimation(".article", [".article .label", ".article .heading"]);

swipeAnimation(".destinations", [".destinations .heading", ".destinations .content"])

swipeAnimation(".article", [".article .latest-article", ".article .box1", ".article .box2", ".article .box3", ".article .box4"])

galleryAnimation(".destinations .gallery", [".destinations .gallery .box1",".destinations .gallery .box2",
".destinations .gallery .box3",".destinations .gallery .box4",".destinations .gallery .box5"])

galleryAnimation(".featured .gallery", [".featured .gallery .box1",".featured .gallery .box2",".featured .gallery .box3",
".featured .gallery .box4"])

galleryAnimation(".feedback .voices", [".feedback .voices .box1",".feedback .voices .box2",".feedback .voices .box3",
".feedback .voices .box4",".feedback .voices .box5",".feedback .voices .box6"])
// 
const translations = {
        en: {
            brand: "PAYPARK",
            slogan: "Providing Convenient Parking Solutions",
            description: "Find the Perfect Spot for Your Vehicle with Ease",
            aboutTitle1: "Trusted and Verified Locations",
            aboutDesc1: "At PayPark, we ensure all parking locations are thoroughly vetted for security, cleanliness, and reliability. Our trusted partners meet high standards for safety and surveillance. Park with confidence knowing you're in a secure and verified space.",
            aboutTitle2: "Seamless Allocation of Parking",
            aboutDesc2: "With PayPark, find and reserve a parking spot effortlessly, anytime, anywhere. Our smart system allocates available spaces in real-time, reducing wait times and eliminating the stress of parking. Enjoy a smooth, hassle-free parking experience every time.",
            aboutTitle3: "Transparent Pricing and Easy Booking",
            aboutDesc3: "PayPark offers clear, upfront pricing with no hidden fees, ensuring you know exactly what you pay for. Our user-friendly platform makes booking a parking spot quick and straightforward. Enjoy peace of mind with fair rates and a hassle-free booking process."
        },
        es: {
            brand: "PAYPARK",
            slogan: "Proporcionando Soluciones de Estacionamiento Convenientes",
            description: "Encuentra el lugar perfecto para tu vehículo con facilidad",
            aboutTitle1: "Ubicaciones Confiables y Verificadas",
            aboutDesc1: "En PayPark, garantizamos que todas las ubicaciones de estacionamiento se examinen a fondo para garantizar seguridad, limpieza y confiabilidad. Nuestros socios confiables cumplen con altos estándares de seguridad y vigilancia. Estacione con confianza sabiendo que está en un espacio seguro y verificado.",
            aboutTitle2: "Asignación Sin Problemas de Estacionamiento",
            aboutDesc2: "Con PayPark, encuentra y reserva un lugar de estacionamiento sin esfuerzo, en cualquier momento y lugar. Nuestro sistema inteligente asigna espacios disponibles en tiempo real, reduciendo los tiempos de espera y eliminando el estrés del estacionamiento. Disfruta de una experiencia de estacionamiento sin problemas cada vez.",
            aboutTitle3: "Precios Transparentes y Reserva Fácil",
            aboutDesc3: "PayPark ofrece precios claros y transparentes sin tarifas ocultas, asegurando que sepas exactamente lo que estás pagando. Nuestra plataforma fácil de usar hace que reservar un lugar de estacionamiento sea rápido y sencillo. Disfruta de tranquilidad con tarifas justas y un proceso de reserva sin complicaciones."
        },
        fr: {
    brand: "PAYPARK",
    slogan: "Offrant des solutions de stationnement pratiques",
    description: "Trouvez l'endroit idéal pour votre véhicule en toute simplicité",
    aboutTitle1: "Emplacements Fiables et Vérifiés",
    aboutDesc1: "Chez PayPark, nous veillons à ce que tous les emplacements de stationnement soient rigoureusement vérifiés pour leur sécurité, leur propreté et leur fiabilité. Nos partenaires de confiance répondent à des normes élevées de sécurité et de surveillance. Garez-vous en toute confiance dans un espace sécurisé et vérifié.",
    aboutTitle2: "Allocation Fluide des Places de Stationnement",
    aboutDesc2: "Avec PayPark, trouvez et réservez une place de stationnement sans effort, à tout moment et n'importe où. Notre système intelligent attribue des espaces disponibles en temps réel, réduisant les temps d'attente et éliminant le stress du stationnement. Profitez d'une expérience de stationnement fluide à chaque fois.",
    aboutTitle3: "Tarification Transparente et Réservation Facile",
    aboutDesc3: "PayPark propose des prix clairs et transparents sans frais cachés, vous assurant de savoir exactement ce que vous payez. Notre plateforme conviviale rend la réservation d'une place de stationnement rapide et simple. Profitez de la tranquillité d'esprit avec des tarifs équitables et un processus de réservation sans souci."
},
      de: {
    brand: "PAYPARK",
    slogan: "Bereitstellung praktischer Parklösungen",
    description: "Finden Sie ganz einfach den perfekten Platz für Ihr Fahrzeug",
    aboutTitle1: "Zuverlässige und Verifizierte Standorte",
    aboutDesc1: "Bei PayPark stellen wir sicher, dass alle Parkplätze gründlich auf Sicherheit, Sauberkeit und Zuverlässigkeit überprüft werden. Unsere vertrauenswürdigen Partner erfüllen hohe Standards in Bezug auf Sicherheit und Überwachung. Parken Sie mit Vertrauen, da Sie sich in einem sicheren und überprüften Bereich befinden.",
    aboutTitle2: "Nahtlose Zuweisung von Parkplätzen",
    aboutDesc2: "Mit PayPark finden und reservieren Sie mühelos einen Parkplatz, jederzeit und überall. Unser intelligentes System weist in Echtzeit verfügbare Plätze zu, reduziert Wartezeiten und eliminiert den Stress beim Parken. Genießen Sie jedes Mal ein reibungsloses Parkerlebnis.",
    aboutTitle3: "Transparente Preise und Einfache Buchung",
    aboutDesc3: "PayPark bietet klare, transparente Preise ohne versteckte Gebühren, sodass Sie genau wissen, wofür Sie bezahlen. Unsere benutzerfreundliche Plattform macht das Buchen eines Parkplatzes schnell und unkompliziert. Genießen Sie Ruhe mit fairen Tarifen und einem unkomplizierten Buchungsprozess."
},
hi: {
    brand: "PAYPARK",
    slogan: "सुविधाजनक पार्किंग समाधान प्रदान करना",
    description: "अपने वाहन के लिए सही स्थान आसानी से खोजें",
    aboutTitle1: "विश्वसनीय और सत्यापित स्थान",
    aboutDesc1: "PayPark में, हम यह सुनिश्चित करते हैं कि सभी पार्किंग स्थान सुरक्षा, स्वच्छता और विश्वसनीयता के लिए अच्छी तरह से जांचे गए हों। हमारे विश्वसनीय भागीदार उच्च सुरक्षा और निगरानी मानकों का पालन करते हैं। सुरक्षित और सत्यापित स्थान में आत्मविश्वास के साथ पार्क करें।",
    aboutTitle2: "पार्किंग का सुचारू आवंटन",
    aboutDesc2: "PayPark के साथ, कभी भी और कहीं भी बिना किसी कठिनाई के पार्किंग स्थान खोजें और बुक करें। हमारी स्मार्ट प्रणाली वास्तविक समय में उपलब्ध स्थान आवंटित करती है, प्रतीक्षा समय को कम करती है और पार्किंग के तनाव को समाप्त करती है। हर बार एक सहज पार्किंग अनुभव का आनंद लें।",
    aboutTitle3: "पारदर्शी मूल्य निर्धारण और आसान बुकिंग",
    aboutDesc3: "PayPark पारदर्शी मूल्य निर्धारण के साथ बिना किसी छिपे हुए शुल्क के स्पष्ट दरें प्रदान करता है, जिससे आप जान सकें कि आप किसके लिए भुगतान कर रहे हैं। हमारा उपयोगकर्ता-अनुकूल मंच पार्किंग स्थान बुक करना तेज़ और आसान बनाता है। निष्पक्ष दरों और एक झंझट-मुक्त बुकिंग प्रक्रिया के साथ शांति का अनुभव करें।"
},



    };

    const languageSelector = document.getElementById("language");

    languageSelector.addEventListener("change", (e) => {
        const selectedLang = e.target.value;
        const translation = translations[selectedLang];
        
        if (translation) {
            document.getElementById("brand").textContent = translation.brand;
            document.getElementById("slogan").textContent = translation.slogan;
            document.getElementById("description").textContent = translation.description;
            document.getElementById("about-title1").textContent = translation.aboutTitle1;
            document.getElementById("about-desc1").textContent = translation.aboutDesc1;
            document.getElementById("about-title2").textContent = translation.aboutTitle2;
            document.getElementById("about-desc2").textContent = translation.aboutDesc2;
            document.getElementById("about-title3").textContent = translation.aboutTitle3;
            document.getElementById("about-desc3").textContent = translation.aboutDesc3;
        }
    });
</script>


    
</body>
</html>