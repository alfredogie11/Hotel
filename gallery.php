
<script>

	var cacheImagesPath = []	
	var cacheImagesPathLen = 0;
	
	fetch('http://localhost/Hotel/getGalleryImages.php', {
			method: 'GET',
			headers: {
				'Accept': 'application/json',
			},
		})
		.then(response => response.json())
		.then(response => {
			console.log(JSON.stringify(response))
			console.log(response)
			cacheImagesPath = response;


			var ACTIVE = "active"
			for (const iterator of response) {
				//alert(iterator)
			document.getElementById("gallery-slider").innerHTML += 
			`<div class="item ${ACTIVE}">
      				<img src="images/newGallery/${iterator}" alt="no image available"/>
   			 </div>`

			 ACTIVE= "";
			}
			
	
	});

		
</script>

<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin: 5rem !important;">
  <!-- Indicators -->
  <!-- <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol> -->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" id="gallery-slider">
    <!-- <div class="item active">
      <img src="la.jpg" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="chicago.jpg" alt="Chicago">
    </div>

    <div class="item">
      <img src="ny.jpg" alt="New York">
    </div> -->
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<style>
	#gallery-slider .item img{
		max-height: 35rem !important;
		min-height: 15rem !important;
		width: 100% !important;
	}
</style>