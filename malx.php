<?php

    // Preliminary code:
    include 'dbconfig.php';
    include 'admin/rsc/import/php/functions/functions.php';

    // Regular template:
    include 'rsc/import/php/components/head.php';
    include 'rsc/import/php/components/header.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->






<!-- Main er obligatorisk -->
<main>

  <style>
    .card-custom {
      max-width: 350px;
    }
    .card-collapse {
      max-width: 340px;
    }
  </style>

	<section class="container pt-2">
    <div class="row mt-5 ">

      <!-- Column one start -->
      <div class="card card-custom mx-2 mb-3 border-dark">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">Rånerydding</h5>
          <h6 class="card-subtitle">University College of Southeast Norway</h6>
          <h6 class="card-subtitle my-2 text-muted">Bø</h6>
        	<ul class="list-group list-group-flush">
      			<li class="list-group-item">June 7th 2018</li>
      			<li class="list-group-item">14:00-18:00</li>
    			</ul>
        	<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        	<button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
        </div>
      </div>
      <!-- Column one end -->


      <!-- Column two start -->
      <div class="card card-custom mx-2 mb-3 border-dark">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">Suicide 101: Allahu Akbar</h5>
          <h6 class="card-subtitle">Bishkek Academy of Finance and Economics</h6>
          <h6 class="card-subtitle my-2 text-muted">The Cave</h6>
        	<ul class="list-group list-group-flush">
      			<li class="list-group-item">July 7th - 2018</li>
      			<li class="list-group-item">17:00-23:00</li>
    			</ul>
        	<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        	<button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
        </div>
      </div>
      <!-- Column two end -->

      <!-- Column three start -->
      <div class="card card-custom mx-2 mb-3 border-dark">
       	<div class="card-body d-flex flex-column">
        	<h5 class="card-title text-center">Curry bonanza</h5>
        	<h6 class="card-subtitle">Batumi Shota Rustaveli State University</h6>
        	<h6 class="card-subtitle my-2 text-muted">Somewhere in curryland</h6>
        	<ul class="list-group list-group-flush">
      			<li class="list-group-item">August 7th - 2018</li>
      			<li class="list-group-item">09:00-12:00</li>
    			</ul>
          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          <button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
        </div>
      </div>
      <!-- Column three end -->


      <!-- Column one start -->
      <div class="card card-custom mx-2 mb-3 border-dark">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">Rånerydding</h5>
          <h6 class="card-subtitle">University College of Southeast Norway</h6>
          <h6 class="card-subtitle my-2 text-muted">Bø</h6>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">June 7th 2018</li>
            <li class="list-group-item">14:00-18:00</li>
          </ul>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
        </div>
      </div>
      <!-- Column one end -->

      <!-- Column two start  -->
      <div class="card card-custom mx-2 mb-3 border-dark">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">Suicide 101: Allahu Akbar</h5>
          <h6 class="card-subtitle">Bishkek Academy of Finance and Economics</h6>
          <h6 class="card-subtitle my-2 text-muted">The Cave</h6>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">July 7th - 2018</li>
            <li class="list-group-item">17:00-23:00</li>
          </ul>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
        </div>
      </div>
      <!-- Column two end -->

      <!-- Column three start -->
      <div class="card card-custom mx-2 mb-3 border-dark">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">Curry bonanza</h5>
          <h6 class="card-subtitle">Batumi Shota Rustaveli State University</h6>
          <h6 class="card-subtitle my-2 text-muted">Somewhere in curryland</h6>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">August 7th - 2018</li>
            <li class="list-group-item">09:00-12:00</li>
          </ul>
          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          <button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
        </div>
      </div>
      <!-- Column three end -->
    </div>


  <!-- Collapse button start -->
  <section class="container pt-2">
	  <div class="row">
		  <div class="col text-center">
			  <p>
				  <a class="btn btn-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	View completed events
				  </a>
				</p>
				<div class="collapse" id="collapseExample">
          <div class="card text-white bg-dark">
  				  <div class="card card-header">
  				  COMPLETED EVENTS
  			  	</div>
          </div>
  <!-- Collapse button end -->


          <!-- Collapse content start -->
          <section class="container">
            <div class="row my-4 ">

              <div class="card card-collapse mx-2 mb-3 border-dark">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title text-center">Rånerydding</h5>
                  <h6 class="card-subtitle">University College of Southeast Norway</h6>
                  <h6 class="card-subtitle my-2 text-muted">Bø</h6>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">June 7th 2018</li>
                    <li class="list-group-item">14:00-18:00</li>
                  </ul>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
                </div>
              </div>

              <div class="card card-collapse mx-2 mb-3 border-dark">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title text-center">Suicide 101: Allahu Akbar</h5>
                  <h6 class="card-subtitle">Bishkek Academy of Finance and Economics</h6>
                  <h6 class="card-subtitle my-2 text-muted">The Cave</h6>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">July 7th - 2018</li>
                    <li class="list-group-item">17:00-23:00</li>
                  </ul>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
                </div>
              </div>

              <div class="card card-collapse mx-2 mb-3 border-dark">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title text-center">Curry bonanza</h5>
                  <h6 class="card-subtitle">Batumi Shota Rustaveli State University</h6>
                  <h6 class="card-subtitle my-2 text-muted">Somewhere in curryland</h6>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">August 7th - 2018</li>
                    <li class="list-group-item">09:00-12:00</li>
                  </ul>
                  <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                  <button type="button" class="btn btn-dark mt-auto">Go somewhere</button>
                </div>
              </div>
            </div>
          </section>
          <!-- Collapse content end -->

				</div>

      </div>

		</div>

	</section>
	<!-- knapp slutt -->

</main>
<!-- Main end -->







<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>
