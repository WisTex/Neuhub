<style>
{{if $size == 'hz_large'}}
.hz_card {
/*	-moz-transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); 
	transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); */
	font-family: sans-serif, arial, freesans;
}
.hz_cover_photo {
	max-width: 100%;
}
.hz_profile_photo {
	position: relative;
	top: -300px;
	// top: -500px;
	left: 30px;
	background-color: white;
	border: 1px solid #ddd;
	border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 10px;
	width: 320px;
	height: 320px;
}

.hz_name {
	position: relative;
	top: -100px;
	left: 400px;
	color: #fff;
	font-size: 48px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}
.hz_addr {
	position: relative;
	top: -110px;
	left: 400px;
	color: #fff;
	font-size: 24px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}	
{{elseif $size == 'hz_medium'}}
.hz_card {
/*	-moz-transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); 
	transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); */
	font-family: sans-serif, arial, freesans;
	width: 100%;
	overflow: hidden; 
	height: 390px; 
}
.hz_cover_photo img {
	width: {{$maxwidth}}px;
/*	max-width: 100%; */
}
.hz_profile_photo {
	position: relative;
	// top: -165px;
	top: -200px;
	left: 30px;

	width: 150px;
	height: 150px;
}
.hz_profile_photo img {
	background-color: white;
	border: 1px solid #ddd;
	border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 5px;
	width: 150px;
	height: 150px;
}

.hz_name {
	position: relative;
	top: -100px;
	left: 210px;
	color: #fff;
	font-size: 32px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}
.hz_addr {
	position: relative;
	top: -100px;
	left: 210px;
	color: #fff;
	font-size: 18px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}	


{{else}}
.hz_card {
/*	-moz-transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); 
	transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); */
	font-family: sans-serif, arial, freesans;
}
.hz_cover_photo {
	max-width: 100%;
}
.hz_profile_photo {
	position: relative;
	top: -75px;
	// top: -200px;
	left: 20px;
	background-color: white;
	border: 1px solid #ddd;
/*	border-radius: 5px;
	-moz-border-radius: 5px; */
	padding: 3px;
	width: 80px;
	height: 80px;
}

.hz_name {
	position: relative;
	top: -40px;
	left: 120px;
	color: #fff;
	font-size: 18px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}
.hz_addr {
	position: relative;
	top: -40px;
	left: 120px;
	color: #fff;
	font-size: 10px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}	
{{/if}}

</style>

<!--
<div class="hz_card card {{$size}}" style="width: 100%;">
    
	<div class="hz_cover_photo"><img width="100%" src="{{$cover.href}}" alt="{{$zcard.chan.xchan_name}}" />
		<div class="hz_name">{{$zcard.chan.xchan_name}}</div>
		<div class="hz_addr">{{$zcard.chan.channel_addr}}</div>
	</div>
	
	<div class="hz_profile_photo"><img src="{{$pphoto.href}}" alt="{{$zcard.chan.xchan_name}}" /></div>
</div>
-->
<!--
<div class="card mb-3">
  <img class="card-img-top" src="{{$cover.href}}" alt="Card image cap">
  
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
  
</div>
-->

<div class="card hz_card !bg-dark !text-white">
  <img class="card-img" src="{{$cover.href}}" alt="Card image">
  <div class="card-img-overlay">
      <!--
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text">Last updated 3 mins ago</p>
-->
  </div>
      		<div class="hz_name">{{$zcard.chan.xchan_name}}</div>
		<div class="hz_addr">{{$zcard.chan.channel_addr}}</div>
  <div class="hz_profile_photo"><img src="{{$pphoto.href}}" alt="{{$zcard.chan.xchan_name}}" /></div>
</div>

<div id="pizza"></div>
<p id="demo"></p>

<script>
drawImage = async img_path => {
  let canvas = document.createElement("canvas");
  canvas.src = img_path;
  const context = canvas.getContext("2d");

  const img = await loadImage(img_path);
  canvas.width = img.width;
  canvas.height = img.height;
  context.drawImage(img, 0, 0);

  return { canvas, context };
};

function loadImage(img_path) {
  return new Promise(r => {
    let i = new Image();

    i.onload = () => r(i);
    i.src = img_path;
  });
}

calculateResult = (canvas, context) => {
  let store = {};
  const imgData = context.getImageData(0, 0, canvas.width, canvas.height);
  const data = imgData.data;

  const total_pixels = canvas.width * canvas.height;
  const coverage = total_pixels / 4;

  const max_pixel_index = total_pixels - 1;

  for (let i = 0; i < coverage; ++i) {
    const x = getPixelIndex(Math.floor(Math.random() * max_pixel_index));
    const key = `${data[x]},${data[x + 1]},${data[x + 2]}`;
    const val = store[key];
    store[key] = val ? val + 1 : 1;
  }

  const rgb_code = Object.keys(store).reduce((a, b) =>
    store[a] > store[b] ? a : b
  );

  return `rgb(${rgb_code})`;
};

function getPixelIndex(numToRound) {
  //Each pixel is 4 units long: r,g,b,a
  const remainder = numToRound % 4;
  if (remainder == 0) return numToRound;
  return numToRound + 4 - remainder;
}

main = async () => {
  const { canvas, context } = await drawImage("{{$cover.href}}");
  const result = await calculateResult(canvas, context);
  console.log(result);
  // return "Hello";
  // document.write("<div>Let's print an additional DIV here</div>");
  /*
    let newDiv = document.createElement("div");
    newDiv.innerText = "Let's print an additional DIV here";
    document.body.appendChild(newDiv);
    */
    // document.getElementById("demo").innerHTML = 5 + 6;
    // document.getElementById("demo").innerHTML = result;
    // set background color to blue
    pizza.style.backgroundColor = result;
};

main();    
    
</script>
