	</div>
</div>

	<!--footer start-->
		 <footer class="footer">
	<div class="copyright">
		  <p>Copyright © Designed &amp; Developed by <a href="http://dexignzone.com/" target="_blank">DexignZone</a> 2023</p>
	</div>
</footer>        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
                    <script src="/sage/admin_page/vendor/global/global.min.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/vendor/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/vendor/chart-js/chart.bundle.min.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/vendor/owl-carousel/owl.carousel.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/vendor/peity/jquery.peity.min.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/vendor/apexchart/apexchart.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/js/dashboard/dashboard-1.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/js/custom.min.js" type="text/javascript"></script>
                    <script src="/sage/admin_page/js/deznav-init.js" type="text/javascript"></script>
					<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	    
	<script>
		function carouselReview(){
			/*  testimonial one function by = owl.carousel.js */
			jQuery('.testimonial-one').owlCarousel({
				nav:true,
				loop:true,
				autoplay:true,
				margin:30,
				dots: false,
				left:true,
				navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
				responsive:{
					0:{
						items:1
					},
					484:{
						items:2
					},
					882:{
						items:3
					},	
					1200:{
						items:2
					},			
					
					1540:{
						items:3
					},
					1740:{
						items:4
					}
				}
			})			
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});
	</script>
	
</body>

<!-- Mirrored from gymove.dexignzone.com/laravel/demo/index by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Dec 2023 12:05:59 GMT -->
</html>