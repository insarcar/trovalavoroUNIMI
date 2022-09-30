<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<style media="screen">
.u-alert {
  display: block;
  height: 0;
  opacity: 0;
  height: 0;
  overflow: hidden;
  transition: ease 400ms;
  font-size: 0.8em;
  }

.u-alert.invalid {
  color: red;
  opacity: 1;
  height: auto;
  max-height: none;
  margin-top: 0.3em;
  }

.c-form-input {
  display: block;
  border-color: rgba(25, 25, 25, 0.1);
  border-width: 0 0 2px 0;
  padding: 0.2em 2em 0.2em 0;
  transition: border-color ease 300ms;
  background-repeat: no-repeat;
  background-size: 20px 20px;
  background-position: 99% 50%;
  width: 100%;
  }

.c-form-input:focus {
  border-color: #03A9F4;
  }

.c-form-input[aria-invalid="false"] {
  background-image: url("data:image/svg+xml;utf8,<svg version='1.1' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path fill='%234CAF50' d='M9.984 17.016l9-9-1.406-1.453-7.594 7.594-3.563-3.563-1.406 1.406zM12 2.016c5.531 0 9.984 4.453 9.984 9.984s-4.453 9.984-9.984 9.984-9.984-4.453-9.984-9.984 4.453-9.984 9.984-9.984z'></path></svg>");
  margin-bottom: 0;
  }

.c-form-input[aria-invalid="true"] {
  background-image: url("data:image/svg+xml;utf8,<svg version='1.1' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path fill='%23F44336' d='M17.016 15.609l-3.609-3.609 3.609-3.609-1.406-1.406-3.609 3.609-3.609-3.609-1.406 1.406 3.609 3.609-3.609 3.609 1.406 1.406 3.609-3.609 3.609 3.609zM12 2.016c5.531 0 9.984 4.453 9.984 9.984s-4.453 9.984-9.984 9.984-9.984-4.453-9.984-9.984 4.453-9.984 9.984-9.984z'></path></svg>");
  border-color: red;
  margin-bottom: 0;
  }

@media (max-width: 540px){
  .navbar-logo{
    font-size:80%;
  }
}

.bg{

      background-image: url("https://picsum.photos/id/1081/2000/1200");
      background-size: cover;
      background-repeat: no-repeat;
}


nav ul li a,
nav ul li a:after,
nav ul li a:before {
transition: all .5s;
}
nav ul li a:hover {
color: #555;
}

/* stroke */
nav.stroke ul li a,
nav.fill ul li a {
position: relative;
}

nav.stroke ul li a:after,
nav.fill ul li a:after {
position: absolute;
bottom: 0;
left: 0;
right: 0;
margin: auto;
width: 0%;
content: '.';
color: transparent;
background: #aaa;
height: 1px;
}

nav.stroke ul li a:hover:after {
width: 90%;
}

nav.fill ul li a {
transition: all 2s;
}

nav.fill ul li a:after {
text-align: left;
content: '.';
margin: 0;
opacity: 0;
}
nav.fill ul li a:hover {
color: #fff;
z-index: 1;
}
nav.fill ul li a:hover:after {
z-index: -10;
animation: fill 1s forwards;
-webkit-animation: fill 1s forwards;
-moz-animation: fill 1s forwards;
opacity: 1;
}


.modal-header{

background-color: rgba(0, 0, 0, 0.03);
border-bottm: 1px solid rgba(0, 0, 0, 0.03);
}

.modal-body{
text-align: center;
}

.modal-footer{
background-color: rgba(0, 0, 0, 0.03);
border-bottm: 1px solid rgba(0, 0, 0, 0.03);
}

.mb-5, .my-4{
text-align: center;
}

@font-face {
font-family: fontFigo;
src:url("css/css/TrajanPro-Regular.otf");
}

.navbar-logo{
font-family: fontFigo;
font-weight: 400;
margin-top: 0.5rem;
color: white;
}

header{
margin-bottom: 3rem;
}

.navbar-logo:hover{
transition: all .2s;
color: #ababab;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6{
margin-top: 0.5rem;
}

a.bg-secondary:focus, button.bg-secondary:focus{
background-color: #545b62;
}

.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
    width: 150px;
    height: 150px;
}
.profile-cover{
    max-width: 980px;
    max-height: 400px;
}
.post-img{
    width: 300px;
    height: 300px;
}
.comment-img{
    width: 85px;
    height: 85px;
}

.file input{
  color: blue;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
.signup{
  font-family: 'Roboto', sans-serif;
}
  .form-control{
  height: 40px;
  box-shadow: none;
  color: #969fa4;
}
.form-control:focus{
  border-color: #5cb85c;
}
  .form-control, .btn{
      border-radius: 3px;
  }
.signup-form{
  width: 400px;
  margin: 0 auto;
  padding: 30px 0;
}
.signup-form h2{
  color: #636363;
      margin: 0 0 15px;
  position: relative;
  text-align: center;
  }
.signup-form h2:before, .signup-form h2:after{
  content: "";
  height: 2px;
  width: 30%;
  background: #d4d4d4;
  position: absolute;
  top: 50%;
  z-index: 2;
}
.signup-form h2:before{
  left: 0;
}
.signup-form h2:after{
  right: 0;
}
  .signup-form .hint-text{
  color: #999;
  margin-bottom: 30px;
  text-align: center;
}
  .signup-form form{
  color: #999;
  border-radius: 3px;
    margin-bottom: 15px;
      background: #f2f3f7;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
  }
.signup-form .form-group{
  margin-bottom: 20px;
}
.signup-form input[type="checkbox"]{
  margin-top: 3px;
}
.signup-form .btn{
      font-size: 16px;
      font-weight: bold;
  min-width: 140px;
      outline: none !important;
  }
.signup-form .row div:first-child{
  padding-right: 10px;
}
.signup-form .row div:last-child{
  padding-left: 10px;
}
  .signup-form a{
  color: #fff;
  text-decoration: underline;
}
  .signup-form a:hover{
  text-decoration: none;
}
.signup-form form a{
  color: #5cb85c;
  text-decoration: none;
}
.signup-form form a:hover{
  text-decoration: underline;
}
.listing{
  border: 10px;
  border-radius: 10px;
  border-color: #cbd5e0;
  background-color: #e9ecef;
}
.listing:hover{
  background-color: #e1f0f0;
  border-color: #718096;;

}
.sticky-offset {
    top: 56px;
}

#body-row {
    margin-left:0;
    margin-right:0;
}

</style>

<link href="../css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/css/modern-business.css" rel="stylesheet">
<script src="../css/vendor/jquery/jquery.min.js"></script>
<script src="../css/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script scr="../css/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/283dc8a679.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/functions.js"></script>
