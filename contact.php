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



<main>

    <section class="jumbotron jumbotron-fluid">
        <div class="container text-center">

            <!-- logo navbar start -->
            <a href="#" class=""><img src="rsc/img/logo/sustour/logo_symbol_black.svg" width="150"></a>
            <!-- logo navbar stop -->
            <h1 class="display-3">Contact us</h1>

        </div>
    </section>

    <section class="container p-5">
      <div class="row">
        <div class="col-sm-6">

          <div class="card border-secondary mb-3" style="width: 18rem;">
            <h5 class="card-header">
            E-mail
            </h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>Anne Gry Sturød:</b></li>
              <li class="list-group-item">anne.g.sturod@usn.no</li>
              <li class="list-group-item"><b>Tim T. Abessadze:</b></li>
              <li class="list-group-item">tim.t.abessadze@usn.no</li>
            </ul>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="card border-secondary mb-3" style="width: 18rem;">
            <h5 class="card-header">
            Call
            </h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>Anne Gry Sturød:</b></li>
              <li class="list-group-item">95888581</li>
              <li class="list-group-item"><b>Tim T. Abessadze</b></li>
              <li class="list-group-item"></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

</main>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php' ?>