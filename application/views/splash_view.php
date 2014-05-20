<!doctype html>
<html lang='en' ng-app>
<head>
	<meta charset='utf-8'>
	<meta name='index' content='gregtennant contents directory'>

	<title>GT Web Demo</title>

	<!-- Viewport meta tag to ensure proper rendering and touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap styling -->
	<link rel="stylesheet" href='/assets/bootstrap-3.1.1-dist/css/bootstrap.min.css'>

	<!-- Codeigniter style sheet link -->
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

	<!-- Ajax Posts style sheet link -->
	<link rel="stylesheet" type="text/css" href="/assets/css/ajax_posts.css">

	<!-- Color Clicker style sheet link -->
	<link rel="stylesheet" type="text/css" href="/assets/css/color_clicker.css">

	<!-- Manific Popup core CSS file -->
	<link rel="stylesheet" href="/assets/magnific-popup/dist/magnific-popup.css">

	<!-- jQuery library -->
	<script type="text/javascript" src='/assets/jquery-ui-1.10.4/jquery-1.10.2.js'></script>

	<!-- Magnific Popup core JS file -->
	<script src="/assets/magnific-popup/dist/jquery.magnific-popup.js"></script> 

	<!-- Angular.js library -->
	<script src='/assets/angular.js'></script>

	<!-- Bootstrap script library -->
 	<script type="text/javascript" src='/assets/bootstrap-3.1.1-dist/js/bootstrap.min.js'></script>

 	<!-- Begin on hover script -->
 	<script type="text/javascript">
 		$(document).ready(function()
 		{
 			$('#trigger_color').hover(function()
 			{
 				$('.color').addClass('highlight');
 			},
 			function()
 			{
 				$('.color').removeClass('highlight');
 			})


 			$('#trigger_others').hover(function()
 			{
 				$('.other').addClass('highlight');
 			},
 			function()
 			{
 				$('.other').removeClass('highlight');
 			})

 			$('.swims').hover(function()
 			{
 				var aux = $(this).attr('src');

 				$(this).attr('src', $(this).attr('alt'));
 				$(this).attr('alt', aux);
 			})

 			// Also the popup script
 			$('.image-link').magnificPopup({type:'image'});
 		})
 	</script>
 	<!-- End on hover script -->

	<!-- Begin Color Clicker script -->
	<script type="text/javascript">
		function random_color()
		{
			var rgb = ['a','b','c','d','e','f','0','1','2','3','4','5','6','7','8','9'];
			color = '#'  //this is what we'll return!
			for(var i = 0; i < 6; i++) 
			{
				x = Math.floor((Math.random()*16))
				color += rgb[x];	
			};
			return color;
		}

		$(document).ready(function(){

			$('#large_box').click(function(){
				$(this).children().andSelf().css('background-color',random_color);
			})
			$('#middle_box').click(function(){
				$(this).parent().css('background-color',random_color);
				event.stopPropagation();
			})
			$('.side_box').click(function(){
				$(this).siblings().css('background-color',random_color);
				event.stopPropagation();
			})
		});
	</script>
	<!-- End Color Clicker script -->

	<!-- Begin Ajax script -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			var counter = 1;

			// Generate a new random password
			$('#pwgen').submit(function()
			{
				$.post
				(
					$(this).attr('action'), 
					function(pw)
					{
						console.log(pw);
						$('#spinnumber').text(++counter);
						$('#newpw').text(pw);
					}, 
					'json')
				return false;
			}) 

			// Reset the password counter
			$('#reset').submit(function()
			{
				$.post
				(
					$(this).attr('action'),
					function(pw)
					{
						console.log(pw);
						counter = 1;
						$('#spinnumber').text(counter);
						$('#newpw').text(pw);
					},
					'json')
				return false;
			})

			// Add a remark
			$('#msgbox').submit(function()
			{
				$.post
				(
					$(this).attr('action'), 
					$(this).serialize(), 
					function(data)
					{
						console.log(data);
						$('#ajaxremarks').prepend("<tr><td>" + data[0]['description'] + "</td><td><span class='x'><a class='delx' href='/ajax_posts/delete/?id=" + data[0]['id'] + "'>x</a></span></td></tr>");
						$('#inbox').val("");
					}, 
					'json')
				return false;
			})

			// Delete a remark
			$(document).on('click', '.delx', function()
			{
				var remark = $(this)
				$.get
				(
					$(this).attr('href'),
					$(this).serialize(),
					function()
					{
						var tr = $(remark).parent().parent().parent()
						$(tr).remove()
					}
				)
				return false;
			})
		}); 

	</script>
	<!-- End Ajax script -->

	<!-- Angular script for character counter -->
	<script>
		function angController($scope)
		{
			$scope.countChars = function()
			{
				$scope.charcount = 140;
			}
		}
	</script>
	<!-- End Angular script -->

</head>
<body>
	<div class='container' ng-controller='angController'>

		<div id='topnav' class='btn-group'>
			<div class='btn-group'>
				<button type='button' class='btn btn-sm btn-default dropdown-toggle' data-toggle='dropdown'>Projects<span class='caret'></span>
				</button>
					<ul class='dropdown-menu'>
						<li><a href="/projects/superwide">Javascript Circles</a></li>
						<li><a href="http://www.scms.org/">Santa Cruz Montessori</a></li>
					</ul>
			</div>
			<button type='button' class='btn btn-sm btn-default'>
				<a href="https://github.com/gjtennant">
					GitHub
				</a>
			</button>
			<button type='button' class='btn btn-sm btn-default'>
				<a href="http://www.linkedin.com/pub/greg-tennant/6/b44/124">
					Linked In
				</a>
			</button>
			
		</div>

		<h1 id='topname'>Greg Tennant <small>Santa Cruz, CA</small></h1>

		<!-- Canvas for colored balls -->
		<!-- (also Row with JS circles, PW generator, color clicker) -->
		<div id='circlebox' height='500px'>
			<div class='row'>
				
				<svg id="svg" style='background-color:cyan;' height='15px' xmlns="http://www.w3.org/2000/svg"></svg>
			
				<h2>Hi, nice to see you</h2>
				<p id='intro'>The things on this page are made with jQuery, Javascript and PHP. The <span class='triggerwords' id='trigger_color'>color items</span> I received as partly-built class exercises with errors to fix and incompletes to finish. The <span class='triggerwords' id='trigger_others'>others</span> I wrote from scratch.</p>
				<p class='other'><em>See the code for this entire page on GitHub at <a href="https://github.com/gjtennant/GTWebDemo"> https://github.com/gjtennant/GTWebDemo</a></em></p>

				<!-- Begin Javascript circles -->
				<div class='col-md-4'>
					<div class='color'>
						<h4>Fun with color:</h4>
						<a href="/projects/superwide">
						<img src="/assets/img/superwide12.jpg" height='100px'>
						<p><em>Javascript circles</em></p></a>
						
						<a href="https://github.com/gjtennant/javascript_circles/blob/master/superwide.html"> 
							<img src="/assets/img/code_superwide.jpg" height='109px;'>
							<p><em>See the code</em></p>
						</a>
					</div>
				</div>
				<!-- End Javascript circles -->

				<!-- Begin Random Password Generator -->
				<div class='col-md-4'>
					<div class='other'>
						<h4>Random Password Generator</h4>
						<p>Spin #<span id='spinnumber'>1</span>:</p>

						<h4 id='newpw'><?php echo $pw ?></h4>

						<form id='pwgen' action='projects/generate' method='post'>
							<input type='submit' class='btn-sm btn-primary' value='Generate'>
						</form>
						<form id='reset' action='projects/generate'>
							<input type='submit' class='btn-sm btn-success' value='Reset Counter' style='margin-top:4px;margin-bottom:4px;'>
						</form>

						<a href="">
							<img src="/assets/img/code_generator.jpg" height='109px'>
							<p><em>See the code</em></p>
						</a>
					</div>
				</div>
				<!-- End Random Password Generator -->

				<!-- Begin Color Clicker -->
				<div class='col-md-4'>
					<div class='color'>
						<h4>More fun with color</h4>
						
						<div id='large_box'>
							<div class='side_box'></div>
							<div id='middle_box'></div>
							<div class='side_box'></div>
						</div>
						<br>
						<ol>
							<li>Clicking the big box changes color of both small and large boxes</li>
							<li>Clicking the middle box changes the color of the big box</li>
							<li>Clicking the left or right box changes the color of that box's siblings</li>
						</ol>
					</div>
				</div>
				<!-- End Color Clicker -->

			</div>
		</div> <!-- end circle-generating div and first row -->

		<!-- Next row, with on.hover swimsuits -->
		<div class='row'>
			<div class='other'>
				<div class='swimholder'>
					<img class='swims' src='/assets/img/dress_red_front.png' alt='/assets/img/dress_red_back.png'>
				</div>
				<div class='swimholder'>
					<img class='swims' src='/assets/img/dress_white_front.png' alt='/assets/img/dress_white_back.png'>
				</div>
				<div class='swimholder'>
					<img class='swims' src='/assets/img/dress_black_front.png' alt='/assets/img/dress_black_back.png'>
				</div>

				<div class='swimholder'>
					<img class='swims' src='/assets/img/wom4front.png' alt='/assets/img/wom4back.png'>
				</div>
				<div class='swimholder'>
					<img class='swims' src="/assets/img/wom3front.png" alt='/assets/img/wom3back.png'>
				</div>
				<div class="swimholder">
					<img class='swims' src="/assets/img/wom2front.png" alt="/assets/img/wom2back.png">
				</div>

				<div class='swimholder'>
					<img class='swims' src='/assets/img/wom7front.png' alt='/assets/img/wom7back.png'>
				</div>
				<div class='swimholder'>
				</div>
					<img class='swims' src="/assets/img/wom5front.png" alt='/assets/img/wom5back.png'>

				<div class="swimholder">
					<img class='swims' src="/assets/img/bikini_black_front.png" alt="/assets/img/bikini_black_back.png">
				</div>
				<div class='swimholder'>
					<img class='swims' src='/assets/img/bikini_brown_front.png' alt='/assets/img/bikini_brown_back.png'>
				</div>


				<a href="">
					<p><em>See the code</em></p>
				</a>
			</div>
		</div>

		<!-- Next row, with SCM page -->
		<div class='row'>
			<div class='col-md-3'>
				<a href="http://www.scms.org/">
					<img src="/assets/img/screenshot_SCMS_2.jpg" height='150px'>
					<p><em>See the site</em></p>
				</a>
			</div>
			<div id='Mont' class='col-md-9'>
				<p>Before I learned to code, I collaborated on a team of eight to create this public-facing web site for Santa Cruz Montessori School. </p>
				<p>We built an entirely new site from the ground up, organizing all the information you'd need to fall in love with the school and make a solid determination to send your kids there. It was quite an undertaking.</p>
				<p>(I also made the video on the bottom of the front page, <a href="https://www.youtube.com/watch?v=ND1FHC1TyUg">"Experience Family Work Day 2013."</a>)</p>
			</div>
		</div>

		<!-- Next row, with Ajax message list -->
		<div class='row'>
			<div class='other'>
				<!-- Begin Ajax Remarks -->
				<div class='col-md-6'>
					<h4>Like to leave a remark?</h4>
					<h4><small>{{140 - charcount.length}} characters</small></h4>

					<form id='msgbox' action='/ajax_posts/create' method='post'>
						<textarea id='inbox' name='description' rows='2' cols='98' ng-model='charcount'></textarea><br>
						<input class='btn btn-success btn-xs' type='submit' name='remark' value='Post'>
					</form>
					<div id='tablebounder'>
						<table class='table table-striped table-hover table-condensed'>
							<thead>
								<tr>
									<th>Remark</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody id='ajaxremarks'>
							<?php
								foreach ($posts as $key)
								{
									echo "
										<tr>
											<td>{$key['description']}</td>
											<td><span class='x'><a class='delx' href='/ajax_posts/delete?id={$key['id']}'>x</a></span></td>
										</tr>";
								}
							?>
								<tr>
									<td>You built this whole thing yourself? Impressive.</td>
									<td><span class='x'>x</span></td>
								</tr>
							</tbody>
						</table>
					</div>
			</div>
				</div>
				<!-- End Ajax Remarks -->
		</div>

		<!-- Begin colored circles script for the top banner strip -->
		<script>
			// MAKING A NEW CIRCLE BASED ON MOUSEDOWN TIME
			(function(){
				var mousedown_time;
				function getTime()
				{
					var date = new Date();
					return date.getTime();
				}
				document.onmousedown = function()
				{
					mousedown_time = getTime();
				}
				document.onmouseup = function(e)
				{
					console.log(e);
					time_pressed = getTime() - mousedown_time;
					// console.log('time pressed: ', time_pressed);
					playground.createNewCircle(document.getElementById('circlebox').clientWidth/2, document.getElementById('circlebox').clientHeight/2, time_pressed/3);
				}
			})();
			// END MOUSEDOWN BUSINESS

			// DEFINING WHAT A CIRCLE IS
			function Circle(cx, cy, html_id, r)
			{
				var html_id = html_id;
				this.info = {cx: cx, cy: cy, r: r};
				
				//private function that generates a random number
				var randomNumberBetween = function(min, max){
					return Math.random()*(max-min) + min;
				}

				//private function that generates a random whole number
				var randomColorNumber = function(min, max){
					return Math.floor(Math.random()*(max-min) + min);
				}

				//give a random velocity for the circle
				this.initialize = function(){
					this.info.velocity = {
						x: randomNumberBetween(-1,1),
						y: randomNumberBetween(-1,1)
					}

					//create a circle 
					var circle = makeSVG('circle', 
						{ 	
							// cx: this.info.cx,
						  	// cy: this.info.cy,
						  	cx: 0,
						  	cy: 0,
						  	r:  this.info.r,
						  	id: html_id,
						  	style: 'fill: rgb('+randomColorNumber(0,255)+","+randomColorNumber(0,255)+","+randomColorNumber(0,255)+')'
						});

					document.getElementById('svg').appendChild(circle);
				}


				this.update = function(time){
					var el = document.getElementById(html_id);
					var svg = document.getElementById('svg');
					// console.log(svg);

					//see if the circle is going outside the browser. if it is, reverse the velocity
					if( this.info.cx > document.body.clientWidth || this.info.cx < 0)
					{
						this.info.velocity.x = this.info.velocity.x * -1;
					}
					if( this.info.cy > (document.body.clientHeight) || this.info.cy < 0)
					{
						this.info.velocity.y = this.info.velocity.y * -1;
					}

					this.info.cx = this.info.cx + this.info.velocity.x*time;
					this.info.cy = this.info.cy + this.info.velocity.y*time;

					el.setAttribute("cx", this.info.cx);
					el.setAttribute("cy", this.info.cy);
				}

				//creates the SVG element and returns it
				var makeSVG = function(tag, attrs) {
			        var el= document.createElementNS('http://www.w3.org/2000/svg', tag);
			        for (var k in attrs)
			        {
			            el.setAttribute(k, attrs[k]);
			        }
			        return el;
			    }

			    this.initialize();
			}
			// END CIRCLE DEFINING

			// DEFINING THE ACTIVE BACKGROUND
			function PlayGround()
			{
				var counter = 0;  //counts the number of circles created
				var circles = [ ]; //array that will hold all the circles created in the app

				//a loop that updates the circle's position on the screen
				this.loop = function(){
					for(circle in circles)
					{
						circles[circle].update(1);
					}
					
				}	
				this.createNewCircle = function(x,y,r){
					var new_circle = new Circle(x,y,counter++,r);
					circles.push(new_circle);
					// console.log('created a new circle!', new_circle);
				}

				//creating circles on page load:
				this.createNewCircle(document.getElementById('circlebox').clientWidth/2, document.getElementById('circlebox').clientHeight/2, 400);
				this.createNewCircle(document.getElementById('circlebox').clientWidth/6, document.getElementById('circlebox').clientHeight/2, 400);
			}
			// END BACKGROUND

			// INSTANTIATING THE ACTIVE BACKGROUND
			var playground = new PlayGround();
			setInterval(playground.loop, 15);
		</script> 
		<!-- End colored circles script for the top banner strip -->

		
	</div>
</body>
</html>