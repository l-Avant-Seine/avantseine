<?php session_start();
define("DOMAIN", "http://" . $_SERVER['HTTP_HOST']);
?>

<!DOCTYPE html>
<html lang="fr" class="html-quizz">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" />
<?php wp_head(); ?>

</head>

<body class="body-quizz">

