<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta name='index' content='gregtennant contents directory'>

		<title>GT Web Demo</title>

		<!-- Viewport meta tag to ensure proper rendering and touch zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap library -->
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		<!-- Ajax Posts style sheet link -->
		<link rel="stylesheet" type="text/css" href="/assets/css/ajax_posts.css">

		<!-- Color Clicker style sheet link -->
		<link rel="stylesheet" type="text/css" href="/assets/css/color_clicker.css">

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

		<script type="text/javascript">
			$(document).ready(function()
			{
				var counter = 1;

				// Adding a new remark
				$('#msgbox').submit(function()
				{
					$.post
					(
						$(this).attr('action'), 
						$(this).serialize(), 
						function(data)
						{
							console.log(data);
							$('#ajaxposts').prepend("<tr><td>" + data + "</td><td><span id='x'><a href='/ajax_posts/delete/{$key['id']}'>x</a></span></td></tr>")
						}, 
						'json'
					)
					return false;
				}) 

				// Generating a new random password
				$('#pwgen').submit(function()
				{
					$.post
					(
						$(this).attr('action'), 
						// $(this).serialize(), 
						function(pw)
						{
							console.log(pw);
							$('#spinnumber').text(++counter);
							$('#newpw').text(pw);
						}, 
						'json'
					)
					return false;
				}) 

				// Resetting the counter
				$('#reset').submit(function()
				{
					$.post
					(
						$(this).attr('action'),
						// $(this).serialize(),
						function(pw)
						{
							console.log(pw);
							counter = 1;
							$('#spinnumber').text(counter);
							$('#newpw').text(pw);
						},
						'json'
					)
					return false;
				})

				// Also create an Ajax function to handle deleting a remark

			});  //end of document.ready
		</script>
		<!-- End Ajax Posts script -->

	</head>
	<body>
		<div class='container'>

			<h1>Demo Page <small>on Localhost:80</small></h1>

			<!-- Canvas for colored balls -->
			<!-- (row with JS circles, PW generator, color clicker) -->
			<div id='circlebox' height='500px'>
				<div class='row'>
					
					<svg id="svg" style='background-color:cyan;' height='15px' xmlns="http://www.w3.org/2000/svg"></svg>
				
					<h2>Hi, nice to see you</h2>
					<p id='intro'>The things on this page are made with jQuery and Javascript. The color items I received as partly-built class exercises with errors to fix and incompletes to finish. The others I wrote from scratch.</p>

					<!-- Begin Javascript circles -->
					<div class='col-md-4'>
						<h4>Fun with color:</h4>
						<a href="/projects/superwide">
						<img src="/assets/img/superwide12.jpg" height='100px'>
						<p><em>Javascript circles</em></p></a>
						
						<!-- Put superwide code page up on GitHub -->
						<a href="https://github.com/gjtennant/javascript_circles"> 
							<img src="/assets/img/code_superwide.jpg" height='109px;'>
							<p><em>See the code</em></p>
						</a>
					</div>
					<!-- End Javascript circles -->

					<!-- Begin Random Password Generator -->
					<div class='col-md-4'>
						<h4>Random Password Generator</h4>
						<p>Spin #<span id='spinnumber'>1</span>:</p>

						<h4 id='newpw'><?php echo $pw ?></h4>

						<!-- It would be great to make this Ajax so it doesn't reset the circle banner but instead adds circles to it -->
						<form id='pwgen' action='projects/generate' method='post'>
							<input type='submit' class='btn-sm btn-primary' value='Generate'>
						</form>
						<form id='reset' action='projects/generate'>
							<input type='submit' class='btn-sm btn-success' value='Reset Counter' style='margin-top:4px;margin-bottom:4px;'>
						</form>

						<!-- Put WordGen up on GitHub so this link can point to it -->
						<a href="">
							<img src="/assets/img/code_generator.jpg" height='109px'>
							<!-- additional paramters taken back out of the img tag:
							 class='img-responsive' alt='Responsive image' -->
							<p><em>See the code</em></p>
						</a>
					</div>
					<!-- End Random Password Generator -->

					<!-- Begin Color Clicker -->
					<div class='col-md-4'>
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
					<!-- End Color Clicker -->

				</div> <!-- end row -->
			</div> <!-- end circle-generating div and first row -->

			<!-- Next row, with SCM page -->
			<div class='row'>
				<div class='col-md-3'>
					<img src="/assets/img/screenshot_SCMS.jpg" height='150px'>
				</div>
				<div class='col-md-9'>
					<p>Before I attended the Coding Dojo, I worked on the team that built this site.</p>
				</div>
			</div>

			<!-- Next row, with Ajax message list -->
			<div class='row'>
				<!-- Begin Ajax Posts -->
				<div class='col-md-6'>
					<h4>Like to leave a remark?</h4>
					<h4><small>240 character limit</small></h4>
					<form id='msgbox' action='/ajax_posts/create' method='post'>
						<textarea name='description' rows='3' cols='42'></textarea><br>

						(Insert Angular.js counter here)<br>

						<input class='btn btn-success btn-xs' type='submit' name='post_it' value='Post'>
					</form>
					
					<div>
						<table class='table table-striped table-hover table-condensed'>
							<thead>
								<tr>
									<th>Remark</th>
									<th>Delete</th> <!-- Make the delete function an Ajax call -->
								</tr>
							</thead>
							<tbody id='ajaxposts'>
							<?php
								foreach ($posts as $key)
								{
									echo "
										<tr>
											<td>{$key['description']}</td>
											<td><span id='x'><a href='/ajax_posts/delete?id={$key['id']}'>x</a></span></td>
										</tr>";
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- End Ajax Posts -->
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