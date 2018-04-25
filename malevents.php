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
    <div class="card">
      <img class="card-img-top mx-auto d-block" src="rsc/img/Post/feels-good-man.png" alt="Card image cap">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <a href="#" class="btn btn-primary mt-auto">Go somewhere</a>
        </div>
    </div>
    <div class="card">
      <img class="card-img-top mx-auto d-block" src="rsc/img/Post/feels-good-man.png" alt="Card image cap">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary mt-auto">Go somewhere</a>
        </div>
    </div>
    <div class="card">
     <img class="card-img-top mx-auto d-block" src="rsc/img/Post/feels-good-man.png" alt="Card image cap">
     	<div class="card-body d-flex flex-column">
       <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary mt-auto">Go somewhere</a>
      </div>
    </div>
  </section>
  <!-- Cards stop -->


	<!-- Fjern knappen om du ikke trenger -->
  <section class="container py-5">
	  <div class="row">
		  <div class="col text-center">
			  <p>
				  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
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
