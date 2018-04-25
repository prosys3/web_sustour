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
      <img class="card-img-thumbnail-top rounded mx-auto d-block" src="rsc/img/Post/feels-good-man.png" alt="Card image cap">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">FeelsGoodMan</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <button type="button" class="btn btn-dark mt-auto">Go somewhere</a>
        </div>
    </div>
    <div class="card border-dark">
      <img class="card-img-thumbnail-top rounded mx-auto d-block" src="rsc/img/Post/feels-good-man.png" alt="Card image cap">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center">FeelsBetterMan</h5>
          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          <button type="button" class="btn btn-dark mt-auto">Go somewhere</a>
        </div>
    </div>
  </section>
  <!-- Cards stop -->

  <!-- Button start -->
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
  <!-- Button stop -->


</main>







<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>
