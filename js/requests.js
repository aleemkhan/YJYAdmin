var serverurl = 'http://jackbluck.com.cp-in-11.webhostbox.net/yjyapp/server.php';


function loginQuery(){
	if($("#email").val()=="" || $("#password").val()==""){
		$("#error").html('<div class="alert alert-danger">Fill empty fields</div>');
	}else{
		$("#error").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
		$.ajax({
			type: 'GET',
	        data: {'request': 'ADMIN_LOGIN', 'email' : $("#email").val(), 'password':$("#password").val()},
	        url: serverurl,
	        dataType: 'text',
	        success: function(data){
	            data = JSON.parse(data);
	            d = data;
	            console.log(data);
	            $("#content").html("");
	            if(data.STATUS == "OK"){

	                $("#error").html('<div class="alert alert-success">Login successfull</div>');
	                window.top.location = "index.php";
	            }else{
	                console.log(data.STATUS);
	                
	                $("#error").html('<div class="alert alert-danger">'+data.MSG+'</div>');

	            }
	        },
	        error: function(a, b, c){
	            console.log("error occured. "+ b);
	            $("#error").html("Something went wrong. Check your internet connectivity.");
	        }
		});
	}
}



var offset_val = 0;
var map = {"HOME_CLEANER":"HOME_CLEANER", "HANGING_ITEMS":"HANDY_MAN",  "AC_INSTALLATION":"HANDY_MAN", "FURNITURE_ASSEMBLY":"HANDY_MAN", "MOVING_HELP":"HANDY_MAN", "DRAINS": "PLUMBER", "FAUCETS": "PLUMBER", "TOILETS": "PLUMBER", "GARBAGE_DISPOSAL": "PLUMBER", "LIGHTING": "ELECTRICIAN", "FANS": "ELECTRICIAN", "OUTLETS": "ELECTRICIAN", "SOMETHING_ELSE": "ELECTRICIAN"};
var sicon = {"HOME_CLEANER":"icon1.png", "HANGING_ITEMS":"Hanging_items.jpg",  "AC_INSTALLATION":"ac.jpg", "FURNITURE_ASSEMBLY":"Furniture.jpg", "MOVING_HELP":"Moving.jpg", "DRAINS": "drains.jpg", "FAUCETS": "faucet.jpg", "TOILETS": "toilets.jpg", "GARBAGE_DISPOSAL": "garbages.jpg", "LIGHTING": "lights.jpg", "FANS": "fans.jpg", "OUTLETS": "switches.jpg", "SOMETHING_ELSE": "something-eles2.jpg"};
var cicon = {"HOME_CLEANER":"icon1.png", "HANDY_MAN": "icon2.png", "PLUMBER":"icon3.png", "ELECTRICIAN": "icon4.png"};
var catcol = {"HOME_CLEANER":"#8CC63F", "HANDY_MAN": "#43D1B9", "PLUMBER":"#FF5C5C", "ELECTRICIAN": "#FFB600"};


var toggled = false;

            var d = "";
			function loadJobs(e){
				$("#contnet").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': e},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    d = data;
	                    console.log(data);
	                    $("#content").html("");
	                    if(data.STATUS == "OK"){
	                        //$("#error").html(data.MSG);

	                        //$("#content").html('<p class="text-center">'+data.MSG+'</p>');
	                        for(var i=0; i < data.DATA.length; i++ ){
	                        	$("#content").append(plotJobsHTML(data.DATA[i]));
	                    	}


	                        
	                    }else{
	                        console.log(data.STATUS);
	                        $("#content").html(data.MSG);

	                    }

	                    offset_val += 10;
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html("Something went wrong. Check your internet connectivity.");
	                }
	            });
			}

			function loadUsers(){
				$("#contnet").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': 'ALL_USERS'},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    d = data;
	                    console.log(data);
	                    $("#content").html("");
	                    var str = "";
	                    str += '<table class="table table-hover"><tr><td>Sr. #</td><td>Name</td><td>Email</td><td>Contact</td><td>Actions</td></tr>';
	                    if(data.STATUS == "OK"){
	                        for(var i=0; i < data.DATA.length; i++ ){
	                        	str += plotUsersHTML(data.DATA[i], i);
	                    	}
	                    	str += "</table>";
	                    	$("#content").append(str);	
	                    }else{
	                        console.log(data.STATUS);
	                    $("#error").html('<div class="alert alert-warning">'+data.MSG+'</div>');
	                    }
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html("Something went wrong. Check your internet connectivity.");
	                }
	            });
			}

			function loadTotalEarnings(){
				$("#contnet").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': 'TOTAL_EARNED'},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    if(data.STATUS == "OK"){
	                        console.log(data.DATA);
	                        if(data.DATA[0].total == null)
	                        	data.DATA[0].total = 0;
	                        $("#total").html("<h3>Total Confirmed Payments</h3><h1><small>$</small>"+data.DATA[0].total+"</h1><h4>Jobs served: "+data.DATA[0].counter+"</h4>");
	                    }else{
	                        console.log(data.STATUS);
	                    $("#error").html('<div class="alert alert-warning">'+data.MSG+'</div>');
	                    }
	                    loadTotalCredits();
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html('<div class="alert alert-danger">'+b+'</div>');
	                }
	            });
			}

			function loadTotalCredits(){
				$("#error").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': 'TOTAL_CREDIT'},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    if(data.STATUS == "OK"){
	                        console.log(data.DATA);
	                        if(data.DATA[0].total == null)
	                        	data.DATA[0].total = 0;
	                        $("#credits").html("<h3>Projected Future Earnings</h3><h1><small>$</small>"+data.DATA[0].total+"</h1><h4>Jobs to be served: "+data.DATA[0].counter+"</h4>");
	                    }else{
	                        console.log(data.STATUS);
	                    $("#error").html('<div class="alert alert-warning">'+data.MSG+'</div>');
	                    }
	                    loadTodaysCredits();
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html('<div class="alert alert-danger">'+b+'</div>');
	                }
	            });
			}

			function loadTodaysCredits(){
				$("#error").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': 'TODAYS_CREDIT'},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    if(data.STATUS == "OK"){
	                        console.log(data.DATA);
	                        if(data.DATA[0].total == null)
	                        	data.DATA[0].total = 0;
	                        $("#today").html("<h3>Today's Projected Earnings</h3><h1><small>$</small>"+data.DATA[0].total+"</h1><h4>Jobs to be served: "+data.DATA[0].counter+"</h4>");
	                        $("#error").html('<div class="alert alert-success">Financial data extracted.</div>');
	                    }else{
	                        console.log(data.STATUS);
	                    $("#error").html('<div class="alert alert-warning">'+data.MSG+'</div>');
	                    }
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html('<div class="alert alert-danger">'+b+'</div>');
	                }
	            });
			}

			function loadVendors(){
				$("#content").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': 'ALL_VENDORS'},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    d = data;
	                    console.log(data);
	                    $("#content").html("");
	                    var str = "";
	                    str += '<table class="table table-hover"><tr><td>Sr. #</td><td>Name</td><td>Email</td><td>Contact</td><td>Actions</td></tr>';
	                    if(data.STATUS == "OK"){
	                        for(var i=0; i < data.DATA.length; i++ ){
	                        	str += plotUsersHTML(data.DATA[i], i);
	                    	}
	                    	str += "</table>";
	                    	$("#content").append(str);	
	                    }else{
	                        console.log(data.STATUS);
	                    $("#error").html('<div class="alert alert-alert">'+data.MSG+'</div>');
	                    }
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html('<div class="alert alert-danger">'+b+'</div>');
	                }
	            });
			}

			function addUserByAdmin(){
				if($("#fname").val() != "" && $("#lname").val() != "" && $("#password").val() != "" && $("#email").val() != "" && $("#address").val() != "" && $("#appartment").val() != "" && $("#code").val() != "" && $("#phone").val() != ""){
					$("#error").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
					$.ajax({
		                type: 'GET',
		                data: {'request': 'ADMIN_ADD_USER', 'password': $("#password").val(), 'email': $("#email").val(), 'fname': $("#fname").val(), 'lname': $("#lname").val(), 'address': $("#address").val(), 'appartment': $("#appartment").val(), 'code': $("#code").val(), 'phone': $("#phone").val(), 'type': $("#type").val()},
		                url: serverurl,
		                dataType: 'text',
		                success: function(data){
		                    data = JSON.parse(data);
		                    if(data.STATUS == "OK"){
		                        $("#error").html('<div class="alert alert-success">'+data.MSG+'</div>');
		                        $("#fname").val("");
		                        $("#lname").val("");
		                        $("#email").val("");
		                        $("#password").val("");
		                        $("#address").val("");
		                        $("#appartment").val("");
		                        $("#code").val("");
		                        $("#phone").val("");
		                        $("#type").val(1);		
		                    }else{
		                        console.log(data.STATUS);
		                    	$("#error").html('<div class="alert alert-warning">'+data.MSG+'</div>');
		                    }
		                },
		                error: function(a, b, c){
		                    console.log("error occured. "+ b);
		                    $("#error").html('<div class="alert alert-danger">'+b+'</div>');
		                }
		            });
				}else{
					$("#error").html('<div class="alert alert-warning">Fill all fields with valid data.</div>');
				}
			}

			function deleteUser(e){
				$("#error").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': 'DELETE_USER', 'userid':e},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    if(data.STATUS == "OK"){
	                        $("#error").html('<div class="alert alert-success">'+data.MSG+'</div>');
	                        $("#user_"+e).remove();		
	                    }else{
	                        console.log(data.STATUS);
	                    	$("#error").html('<div class="alert alert-warning">'+data.MSG+'</div>');
	                    }
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html('<div class="alert alert-danger">'+b+'</div>');
	                }
	            });
			}

			function plotUsersHTML(obj, e){
				var html = "";
				html += '<tr id="user_'+obj.id+'"><td>'+ (e+1) +'</td><td>'+ obj.fname +' '+ obj.lname +'</td><td>'+obj.email+'</td><td>'+ obj.code +" "+obj.phone +'</td><td><a href="#" class="btn btn-sm btn-danger" onclick="deleteUser('+obj.id+')" >Remove</a></td></tr>';
				return html;
			}

			function deleteJob(e){
				$("#error").html('<div class="text-center"><img src = "img/preloader.gif"></div>');
				$.ajax({
	                type: 'GET',
	                data: {'request': 'DELETE_JOB', 'jobid':e},
	                url: serverurl,
	                dataType: 'text',
	                success: function(data){
	                    data = JSON.parse(data);
	                    d = data;
	                    console.log(data);
	                    if(data.STATUS == "OK"){
	                    	$("#error").html('<div class="alert alert-danger">'+data.MSG+'</div>');
	                    	$("#job_"+e).remove();	
	                    }else{
	                        console.log(data.STATUS);
	                        $("#error").html(data.MSG);
	                    }
	                },
	                error: function(a, b, c){
	                    console.log("error occured. "+ b);
	                    $("#error").html('<div class="alert alert-danger">'+b+'</div>');	
	                }
	            });
			}

			function plotJobsHTML(obj){
				var html = "";
				html +='<div id="job_'+obj.id+'"style="color:black;">';
				html +='<div class="col-xs-12 col-lg-4" style="border-radius:5px; background-color:white; border:1px solid silver; padding:10px; overflow:hidden;">';
				html +='<div class="row" style="margin:2px;">';
				html +='<div class="col-xs-12" style="border-bottom:1px solid #DAD8D8">';
                html +='<h4 style="margin-top:5px; margin-bottom:5px;">'+ plotTitle(obj) +' <span class="pull-right"><small>$</small>'+ obj.price+'</span></h4></div>';
                html +='<div class="col-xs-12"> <p class="ellipsis">'+obj.description+'</p>';
                html +='</div>';
                html +='</div>';
				/*
				html +='<div class="row">';
				html +='<div class="col-xs-12">';
				html +='<b>Details</b><br>';
				html +='<small>'+ obj.details +'</small>';
				html +='</div>';
				html +='</div>'; */
				html +='<div class="row text-center" style="border-top:1px solid #DAD8D8; ">';
				html +='<div class="col-xs-4" style="padding:0px;">';
				html +='<h4 style="margin:0px;">Hours</h4>';
				html +='</div>';
				html +='<div class="col-xs-4" style="padding:0px; border-left:1px solid #DAD8D8; border-right:1px solid #DAD8D8;">';
				html +='<h4 style="margin:0px;">Date</h4>';
				html +='</div>';
				html +='<div class="col-xs-4" style="padding:0px;">';
				html +='<h4 style="margin:0px;">Time</h4>';
				html +='</div>';
				html +='</div>';
				html +='<div class="row text-center" style=" border-bottom:1px solid #DAD8D8;">';
				html +='<div class="col-xs-4" style="padding:0px;">';
				html +='<small>'+obj.hours+' HOURS</small>';
				html +='</div>';
				html +='<div class="col-xs-4" style="padding:0px; border-left:1px solid #DAD8D8; border-right:1px solid #DAD8D8;">';
				html +='<small>'+obj.date+'</small>';
				html +='</div>';
				html +='<div class="col-xs-4" style="padding:0px;">';
				html +='<small>'+obj.time+'</small>';
				html +='</div>';
				html +='</div>';
				html +='<a href="#" style="margin-top:5px;" onclick="deleteJob('+obj.id+')" class="btn btn-danger btn-xs col-lg-6 col-lg-offset-6">Remove</a></div>';
				html += '</div>';
				return html;
			}


			function plotTitle(obj){
				var title = "";
				switch(obj.request){
                    case "HOME_CLEANER":
                        title = "Home Cleaner";
                    break;
                    case "HANGING_ITEMS":
                        title = "Hanging Items";
                    break;
                    case "AC_INSTALLATION":
                        title="AC Installation";
                    break;
                    case "FURNITURE_ASSEMBLY":
                        title = "Furniture Assembly";
                    break;
                    case "MOVING_HELP":
                        title = "Moving Help";
                    break;
                    case "DRAINS":
                        title = "Drains";
                    break;
                    case "FAUCETS":
                        title = "Faucets";
                    break;
                    case "TOILETS":
                        title = "Toilets";
                    break;
                    case "GARBAGE_DISPOSAL":
                        title = "Garbage Disposal";
                    break;
                    case "LIGHTING":
                        title = "Lighting";
                    break;
                    case "FANS":
                        title = "Ceiling/Bath Fans";
                    break;
                    case "SWITCHES":
                        title = "Outlets and Switches";
                    break;
                    case "SOMETHING_ELSE":
                        title = "Something else";
                    break;
                    default:
                    	title = "Annonymouse";
                    break;
                }

                return title;
			}

    