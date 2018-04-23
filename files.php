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


<!-- ... Your code goes here ... -->
<main>
  	<section class="p-5">
	  <div class="container text-center">
		<table class="table table-bordered table-hover">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Filename</th>
		      <th scope="col">Filetype</th>
		      <th scope="col">Author</th>
		      <th scope="col">Download</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>Test</td>
		      <td>.docx</td>
		      <td>Test</td>
		      <td><button type="button" class="btn btn-primary">Download</button></td>
		    </tr>
		    <tr>
		      <td>Greentext</td>
		      <td>.parchment</td>
		      <td>Plague Doctor</td>
		      <td><button type="button" class="btn btn-primary">Download</button></td>
		    </tr>
		    <tr>
		      <td>Test</td>
		      <td>.pdf</td>
		      <td>Test</td>
		      <td><button type="button" class="btn btn-primary">Download</button></td>
		    </tr>
		    <tr>
		      <td>Projectmeeting</td>
		      <td>.docx</td>
		      <td>Ola Nordmann</td>
		      <td><button type="button" class="btn btn-primary">Download</button></td>
		    </tr>
		    <tr>
		      <td>Projectmeeting</td>
		      <td>.docx</td>
		      <td>Ola Nordmann</td>
		      <td><button type="button" class="btn btn-primary">Download</button></td>
		    </tr>
		    <tr>
		      <td>Projectmeeting</td>
		      <td>.docx</td>
		      <td>Ola Nordmann</td>
		      <td><button type="button" class="btn btn-primary">Download</button></td>
		    </tr>
		  </tbody>
		</table>
	  </div>
	</section>
</main>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>
