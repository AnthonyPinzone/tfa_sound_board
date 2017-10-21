<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Catamaran:400,800" rel="stylesheet">
	<link href="modules/plyr/plyr.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
	<script src="https://use.fontawesome.com/8ae358415a.js"></script>
  <title>TFA Sound Board</title>
</head>

<body>
	<div id="page_container">

		<header id="page_header">
			<nav id="main_nav">
				<ul class="podcast_select">
					<li class="tfa_podcast"><a href="?podcast=tfa_podcast">TFA Pod</a></li>
					<li class="dynasty_life"><a href="?podcast=dynasty_life">Dynasty Life</a></li>
					<li class="degenation"><a href="?podcast=degenation">DegeNation</a></li>
				</ul>
				<ul class="audio_action">
					<li class="add_audio" title="Add new audio">Add Audio</li>
					<!-- <li class="remove_audio" title="Remove audio"><i class="fa fa-minus" aria-hidden="true"></i></li> -->
				</ul>
			</nav>
		</header>

		<aside id="new_file_form">
			<form id="add_new_file" action="upload.php" method="post" enctype="multipart/form-data">
				<div class="formField select_podcast">
					<label>Select Podcast</label>
					<select name="podcasts" class="podcasts">
						<option selected disabled>Choose Podcast</option>
						<option value="tfa_podcast">TFA Podcast</option>
						<option value="dynasty_life">Dynasty Life</option>
						<option value="degenation">DegeNation</option>
					</select>
				</div>
				<div class="formField button_label">
					<label>Enter Button Text</label>
					<input type="text" name="audioName" id="audioName">
				</div>
				<div class="formField file_selection">
					<label>Choose an audio file</label>
					<input type="file" name="fileToUpload" id="fileToUpload">
				</div>
				<div class="formField formBtn">
					<input type="submit" value="Upload File" name="submit">
				</div>
			</form>
		</aside>

		<main id="sound_board">
			<div id="errors"><ul></ul></div>
			<?php
				if (isset($_GET['podcast'])) {
					$podcast = $_GET['podcast'];
					include 'includes/' . $podcast . '.php';
				}
				else {
					include 'includes/tfa_podcast.php';
				}
			?>
		</main>

		<footer id="audioplayer">
			<h4 id="now_playing">Now Playing: <span></span></h4>
			<audio id="audio_file" controls>
				<source src="">
			</audio>
		</footer>

</div><!-- page-container -->

<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script src="modules/plyr/plyr.js"></script>
<script src="assets/js/scripts.js"></script>

</body>
</html>