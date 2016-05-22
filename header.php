<?php 
    session_start();
    if( isset($_SESSION['login']) ){
        if($_SESSION['login']!=true){
            header('Location: login.php');
        }
    }else{
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <meta http-equiv="Content-Security-Policy" content="default-src * 'unsafe-inline'; style-src 'self' 'unsafe-inline'; media-src *" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <meta name="description" content="">
    <meta name="author" content="Abdul Aleem Khan">
    
    <title>YJY</title>
    <link href="css/bootstrap.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dbconnection.js"></script>
    <script src="js/requests.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIQmJFeLUBsAQYB8ArKZYbbDIgQNCBetw"></script>
    <style>
        @font-face {
            font-family: Lato;
            src: url(fonts/Lato/Lato-Regular.ttf);
        }
        .service_header{
            margin:0px;
            margin-top:2px;
        }
        
        .navbar{
            margin:0px;
        }
        .container-fluid{

            background-color:#EEEEEE;
        }
        .navbar-header, .navbar, .navbar-default, .navbar-brand{
            background-color:#00CCEB;
            color:white;
        }
        
        html, body{
            background-color:#EEEEEE;
            font-family: Lato;
            min-height:100%;
            text-transform: none;
        }
        .row{
        	margin: 0px;
        }
        .ellipsis{
		    white-space: nowrap;
		    overflow: hidden;
		    text-overflow: ellipsis;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12" style="padding:0px;">
			    <nav class="navbar navbar-default">
			            <h1 style="margin:10px;">YJY Admin</h1>
			    </nav>
		</div>
	</div>
    
        <div class="row">
            <div class="col-lg-3">

                <?php
                	include('sidebar.php');
                ?>

            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div id="error" class="text-center" style="padding:20px;"></div>
                </div>