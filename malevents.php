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

	<!-- Cards start -->
	<section class="p-5">

	 <div class="card-deck mx-auto w-50">
    <div class="card border-dark">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title text-center">Rånerydding</h5>
        <h6 class="card-subtitle">University College of Southeast Norway</h6>
        <h6 class="card-subtitle my-2 text-muted">Bø</h6>
      	<ul class="list-group list-group-flush">
    			<li class="list-group-item">June 7th 2018</li>
    			<li class="list-group-item">14:00-18:00</li>
  			</ul>
      	<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      	<button type="button" class="btn btn-dark mt-auto">Go somewhere</a>
      </div>
    </div>

    <div class="card border-dark">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title text-center">Suicide 101: Allahu Akbar</h5>
        <h6 class="card-subtitle">Bishkek Academy of Finance and Economics</h6>
        <h6 class="card-subtitle my-2 text-muted">The Cave</h6>
      	<ul class="list-group list-group-flush">
    			<li class="list-group-item">July 7th - 2018</li>
    			<li class="list-group-item">17:00-23:00</li>
  			</ul>
      	<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      	<button type="button" class="btn btn-dark mt-auto">Go somewhere</a>
      </div>
    </div>

    <div class="card border-dark">
     	<div class="card-body d-flex flex-column">
      	<h5 class="card-title text-center">Curry bonanza</h5>
      	<h6 class="card-subtitle">Batumi Shota Rustaveli State University</h6>
      	<h6 class="card-subtitle my-2 text-muted">Somewhere in curryland</h6>
      	<ul class="list-group list-group-flush">
    			<li class="list-group-item">August 7th - 2018</li>
    			<li class="list-group-item">09:00-12:00</li>
  			</ul>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
        <button type="button" class="btn btn-dark mt-auto">Go somewhere</a>
      </div>
    </div>

  </section>
  <!-- Cards stop -->


	<!-- Fjern knappen om du ikke trenger -->
  <section class="container py-5">
	  <div class="row">
		  <div class="col text-center">
			  <p>
				  <a class="btn btn-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	Link with href
				  </a>
				</p>
				<div class="collapse" id="collapseExample">
				  <div class="card card-body">
				    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
			  	</div>
				</div>
			</div>
		</div>
	</section>
	<!-- knapp slutt -->

</main>







<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>
