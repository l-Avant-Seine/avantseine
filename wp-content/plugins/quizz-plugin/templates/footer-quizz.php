<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cdn
 */
?>



<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,900italic,900,700italic,700,400italic|Roboto+Slab:400,700' rel='stylesheet' type='text/css'>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63808747-1', 'auto');
  ga('send', 'pageview');




  $( document ).ready(function() {

    $( "#quizzform" ).change(function(event) {
      event.preventDefault();
      $(this).submit();
    });

  });



</script>

<?php wp_footer(); ?>

</body>
</html>
