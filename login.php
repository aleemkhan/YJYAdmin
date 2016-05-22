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
    
    <title>Handy</title>
    <link href="css/bootstrap.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dbconnection.js"></script>
    <script src="js/requests.js"></script>
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
    		<div class="col-lg-12">
			    <nav class="navbar navbar-default">
			            <h1 style="margin:10px;">YJY Admin</h1>
			    </nav>
		</div>
	</div>
    
        <div class="row">
            <div class="col-lg-12">
                <div class="row" style="margin-top:100px;">
                    <div id="error" class="col-lg-12">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <button onclick="loginQuery();" class="btn btn-success col-lg-4 col-lg-offset-8">Login</button>
                    </div>
                </div>

<?php
    include('footer.php');
?>
