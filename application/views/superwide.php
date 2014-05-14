<!doctype html>
	<html lang='en'>
	<head>
		<meta name='Javascript Circles' content='Based on a Coding Dojo assignment by Michael Choi'>
		<title>Javascript Circles</title>
		<style type="text/css">
			body{ 
				margin:0;
				background-color: cyan;
			}
		</style>
	</head>
	<body>
		<svg id="svg" xmlns="http://www.w3.org/2000/svg"></svg>

		<script>

			// MAKING A NEW CIRCLE BASED ON MOUSEDOWN TIME
			(function(){
				var mousedown_time;
				function getTime()
				{
					var date = new Date();
					return date.getTime();
				}
				document.onmousedown = function(e)
				{
					mousedown_time = getTime();
					console.log('click x-value: ', e.x)
				}
				document.onmouseup = function(e)
				{
					time_pressed = getTime() - mousedown_time;
					console.log(time_pressed);
					playground.createNewCircle(e.x,e.y, time_pressed/5);
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
						{ 	cx: this.info.cx,
						  	cy: this.info.cy,
						  	r:  this.info.r,
						  	id: html_id,
						  	style: 'fill: rgb('+randomColorNumber(0,255)+","+randomColorNumber(0,255)+","+randomColorNumber(0,255)+')'
						});

					document.getElementById('svg').appendChild(circle);
				}


				this.update = function(time){
					var el = document.getElementById(html_id);

					//see if the circle is going outside the browser. if it is, reverse the velocity
					if( this.info.cx > document.body.clientWidth || this.info.cx < 0)
					{
						this.info.velocity.x = this.info.velocity.x * -1;
					}
					if( this.info.cy > document.body.clientHeight || this.info.cy < 0)
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

				//create one circle when the game starts
				this.createNewCircle(document.body.clientWidth/2, document.body.clientHeight/2,10);
			}
			// END BACKGROUND

			// INSTANTIATING THE ACTIVE BACKGROUND
			var playground = new PlayGround();
			setInterval(playground.loop, 15);

		</script>
	</body>
</html>