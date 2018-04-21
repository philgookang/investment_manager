<!DOCTYPE html>
<html lang="en">
	<head>
        <!-- Page Encoding -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta charset="UTF-8"/>

        <!-- Page Meta Data-->
		<meta name="description" content="<?php echo (isset($description)) ? $description : ''; ?>"/>
		<meta name="keywords" content="<?php echo (isset($keywords)) ? $keywords : ''; ?>"/>
		<meta name="author" content="Phil Goo Kang"/>
        <meta name="copyright" content="Copyrights © Phil's Got All The Rights!" />

        <!-- IE Condition Where Breaking CSS -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!-- Mobile first -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

        <!-- Page Title -->
        <title><?php echo (isset($title)) ? $title : 'Phil\'s Blog'; ?></title>

		<!-- Tags for SNS -->
		<meta property="og:type"               content="website" />
		<meta property="og:title"              content="강필구 (Phil Goo Kang)" />
		<meta property="og:site_name"          content="Phil's Blog"/>

        <!-- DSN Prefetch -->
        <meta http-equiv="x-dns-prefetch-control" content="on">
        <link rel="dns-prefetch" href="//code.jquery.com" />
        <link rel="dns-prefetch" href="//netdna.bootstrapcdn.com" />
        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />

        <!-- VENDOR -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<!-- CSS CSS -->
		<!-- base -->
		<link rel="stylesheet" type="text/css" href="/res/css/reset.css"/>

		<!-- template -->
		<link rel="stylesheet" type="text/css" href="/res/css/template/layout.css"/>

		<!-- component -->
		<link rel="stylesheet" type="text/css" href="/res/css/component/article.css"/>
		<link rel="stylesheet" type="text/css" href="/res/css/component/sidemenu.css"/>
		<link rel="stylesheet" type="text/css" href="/res/css/component/navigation.css"/>
		<link rel="stylesheet" type="text/css" href="/res/css/component/list.css"/>

	</head>
	<body>
		<div class="header">
			<div class="container">
				<div class="navigation">
					<ul>
						<li>
							<a href="/blog/">
								Blog
							</a>
						</li>
						<li>
							<a href="http://github.com/philgookang/">
								Github
							</a>
						</li>
					</ul>
				</div>
				<!--/.navigation-->
			</div>
			<!--/.container-->
		</div>
		<!--/.header-->

		<div class="body">
