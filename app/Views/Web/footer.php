<!-- footer are  -->
<section>
    <footer class="footer">
        <div class="container">
            <div class="row pt-5">

                <div class="col-md-4 col-sm-12 ">
                    <div class="footer-text">
                        <h5 class="text-white ml-2">Address</h5>
                        <p class="text-white ml-2">Firoz Mansion, 1nd floor, Post code 7460, Noapara, Avayanagor, Jessore, Bangladesh.</p>
                        <p class="text-white ml-2"><i class="fas fa-phone-alt"></i> +8801924329315</p>

                        <p class="text-white ml-2"><i class="far fa-envelope"></i>  doctor7days@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="footer-text">
                        <h5 class="text-white ml-2">Office Time</h5>
                        <p class="text-white ml-2">saturday to friday form 09:00 am to 09:00pm for Bangladesh time (GTM 3:00am to 3:00pm.)</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="footer-text">
                        <h5 class="text-white ml-2">Social Media</h5>
                    </div>
                    <div class="social-icons ">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-pinterest-p"></i>
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="dow-img pt-3">
                    <img src="<?php echo base_url()?>/assets/web/image/dow.png" alt=""  class="img-fluid" >
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <p class="text-white text-center">Copyright@doctor7days</p>
    </div>
</section>
<!-- footer are  end-->
<script src="<?php echo base_url();?>/assets/web/js/owl.carousel.min.js"></script>
<script>
    $(".owl-carousel").owlCarousel({
        loop: true,
        autoplay:true,
        margin: 10,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 3,
            },
        },
    });
</script>
</body>
</html>