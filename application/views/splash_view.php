<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta name='index' content='gregtennant contents directory'>

		<title>GT Web Demo</title>

		<!-- Viewport meta tag to ensure proper rendering and touch zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<!-- jQuery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		<!-- Ajax Posts style sheet -->
		<link rel="stylesheet" type="text/css" href="/assets/css/ajax_posts.css">

		<!-- Begin Ajax Posts script -->
		<script type="text/javascript">
			$(document).ready(function(){
				$('form').submit(function()
				{
					$.post
					(
						$(this).attr('action'), 
						$(this).serialize(), 
						function(data)
							{
								console.log(data);
								$('#ajaxposts').prepend("<div class='postit'><span id='x'><a href='/ajax_posts/delete/{$id}'>x</a></span>" + data + "</div>")
							}, 
						'json'
					)
					return false
				}) //end of submit
			});  //end of document.ready
		</script>
		<!-- End Ajax Posts script -->

	</head>
	<body>
		<div class='container'>

			<h1>Demo Page <small>Localhost:80</small></h1>

			<!-- Begin canvas for colored balls -->
			<div id='circlebox' height='500px'>
				<div class='row'>
					
					<svg id="svg" style='background-color:cyan;border-radius:3px;' height='15px' xmlns="http://www.w3.org/2000/svg"></svg>
				
					<h2>Hi, nice to see you</h2>

					<div class='col-md-4'>
						<h4>Have some fun with color:</h4>
						<a href="/projects/superwide">
						<img src="/assets/img/superwide12.jpg" height='100px;'>
						<p><em>Javascript circles</em></p></a>
						
						<!-- Put superwide code page up on GitHub -->
						<a href="https://github.com/gjtennant/javascript_circles.git"> 
							<img src="/assets/img/code_superwide.jpg" height='109px;'>
							<p><em>See the code</em></p>
						</a>
					</div>

					<div class='col-md-4'>
						<h4 style='text-align:center'>Random Password Generator</h4>
						<h6 style='text-align:center'>8 characters</h6>
						<h6 style='text-align:center'>(attempt #<?php echo $this->session->userdata('counter'); ?>)</h6>
						<p style='text-align:center'><?php echo $rand ?></p>

						<!-- Hey! It would be great to make this Ajax so it doesn't reset the circle banner but instead adds circles to it -->
						<form style='text-align:center' action='projects/index'>
							<input type='submit' class='btn btn-xs btn-primary' value='Generate'>
						</form>
						<form style='text-align:center' action='projects/clear'>
							<input type='submit' class='btn btn-xs btn-default' value='Reset Count'>
						</form>
						
						<!-- Put WordGen up on GitHub -->
						<a href="">
							<img src="/assets/img/code_generator.jpg" height='109px;'>
							<p><em>See the code</em></p>
						</a>
					</div>

				</div>
			</div> 
				
				<!-- Begin colored balls script for the banner strip -->
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
				<!-- End colored balls script for the banner strip -->
			<!-- End canvas for colored balls for the banner strip -->

			<!-- Begin Ajax Posts -->
			<!--<div>
				Like to leave a remark?
				<form action='/ajax_posts/create' method='post'>
					<textarea name='description'></textarea><br>
					<input class='btn btn-success btn-xs' type='submit' name='post_it' value='Send'>
				</form>
			</div>
			<div id='ajaxposts'>
				<?php
					foreach ($posts as $key)
					{
						// echo('<br>dollar-key:');
						// var_dump($key);

						echo "
							<div class='postit'>
								<span id='x'>
									<a href='/ajax_posts/delete/{$key['id']}'>x</a>
								</span>
								{$key['description']}
							</div>";
					}
				?>
			</div>--> 
			<!-- End Ajax Posts -->

		</div>
	</body>
</html>