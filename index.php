<!DOCTYPE html>
<html>
<head>
	<title>Motor de busca</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="center">
		<form method="post">
			<input type="text" name="q" placeholder="buscar">
			<input type="submit" name="action_search" value="Pesquisar">
		</form>
	</div><!--center-->
	<?php
		if(isset($_POST['action_search'])) {
			define('KEY', 'AIzaSyDHoCxY9Z4pwbEV5pKtAoy-sh1Jn0gURkM');
			define('CX', '013164849312691447787:tuchz6johsw');
			$q = urlencode(trim($_POST['q']));
			
			if(!empty($q)) {
				$url = 'https://www.googleapis.com/customsearch/v1?key='.KEY.'&cx='.CX.'&q='.$q.'';
				$ch  = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$request = curl_exec($ch);
				curl_close($ch);

				$result  = json_decode($request);
				$tam 	 = count($result->items);
				
				for($i = 0; $i < $tam; $i++) {
					echo '	<div class="center">
							<div class="feed">
							<div class="feed-item">

          						<div class="icon-holder col-1-5">
          						<div class="icon" style=" background-image: url('.$result->items[0]->pagemap->cse_thumbnail[0]->src.');background-size: 55px 55px;"></div>
          						</div>

								<div class="text-holder">
									<div class="feed-title">
										<a href="'.$result->items[$i]->link.'" target="_blank">
										'.$result->items[$i]->title.'
										</a>
									</div>
									<div class="feed-description">
									'.$result->items[$i]->snippet.'
									</div>
							</div>
							</div>
						  </div>
						  </div><div class="clear"></div>';					
				}
			}
		}

	?> 
</body>
</html>