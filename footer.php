<!-- <script src="js/scripts.min.js"></script> -->
<div class="footer-wrap <?php if(!isset($_GET['city']) && !isset($_GET['filter'])) echo 'abs'; ?>">
	<footer class="container footer grid">
		<div class="footer-logo">
			<img src="<?php echo get_stylesheet_directory_uri().'/img/logo_black_18plus.jpg'; ?>" alt="">
		</div>
		<div class="menu-one">
			<?php wp_nav_menu( array('theme_location' => 'footer-one') ); ?>
		</div>
		<div class="menu-two">
			<?php wp_nav_menu( array('theme_location' => 'footer-two') ); ?>
		</div>
		<div class="subscribe">
			<a href="http://eepurl.com/cegdhL" target="_blank">подписаться на рассылку</a>
		</div>
		<div class="made">
			дизайн: <a href="http://cargocollectiVe.com/lupanova" target="_blank">cargocollectiVe.com/lupanova</a><br />разработка: <a href="http://spotdigital.ru/" target="_blank">SPOT DIGITAL</a>
		</div>
		<div class="copy">
			использование материалов разрешено только с предварительного согласия правообладателей. все права на картинки и тексты принадлежат их авторам.
		</div>
	</footer>
</div>

<?php if(isset($_GET['wtf'])) { ?><style>*{transition: all 0.3s;}*:hover{transform: rotate(180deg);}</style><?php } ?>
<?php if(isset($_GET['city']) && $_GET['city'] != '') { ?>
    <script>
        //var globalcity = document.querySelector('#global-city');
        //var index = document.querySelector('#global-city option[value=<?php echo sanitize_text_field($_GET["city"]); ?>]').index;
        //globalcity.selectedIndex = index;
    </script>
<?php } ?>


<?php wp_footer(); ?>
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-83134716-1', 'auto');
ga('send', 'pageview');
</script>
</div>
</body>
</html>