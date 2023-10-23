<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.page-not-found {
			background-color: #3f51b5;
			height: 100vh;
		}

		.page-not-found h2 {
			font-size: 130px;
			color: #e91e63;
		}

		.page-not-found h3 {
			font-size: 42px;
		}

		.page-not-found .bg-light {
			width: 50%;
			padding: 50px;
			text-align: center;
			border-radius: 5px;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		@media (max-width: 767px) {
			.page-not-found h2 {
				font-size: 100px;
			}

			.page-not-found h3 {
				font-size: 28px;
			}

			.page-not-found .bg-light {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<div class="page-not-found pt-5">
		<div class="bg-light shadow ">
			<h2>404</h2>
			<h3 class="mt-4">Opps! <?= $heading ?></h3>
			<p><?= $message ?></p>

		</div>
	</div>
</body>

</html>