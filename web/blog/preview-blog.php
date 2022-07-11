<?php


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Preview</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
     
    <div class="container">
        <div class="modal fade" id="checkModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Troubleshooting</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<p>An absence record already exists for this delegate. Do you want to convert this record?</p>
						</div>
						<div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
              <a class="btn btn-danger" href="convert.php">Yes</a>
						</div>
					</div>
				</div>
			</div>
        </div>



  </body>
</html>