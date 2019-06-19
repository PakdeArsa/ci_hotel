<footer>
    <div class="col2">Copyright &copy; <a href="#">Domain Name</a> All Rights Reserved | Design by <a target="_blank" href="http://www.templatemonster.com/">TemplateMonster.com</a>
        <nav>
            <ul id="footer_menu">
                <li class="active"><a href="<?= base_url('depan'); ?>">About Us</a></li>
                <li><a href="<?= base_url('depan/service'); ?>">Services</a></li>
                <li><a href="<?= base_url('depan/booking'); ?>">Booking</a></li>
                <li><a href="<?= base_url('depan/rooms'); ?>">Rooms</a></li>
                <li class="last"><a href="<?= base_url('depan/locations'); ?>">Locations</a></li>
            </ul>
        </nav>
    </div>
    <div class="col1 pad_left1">
        <ul id="icons">
            <li><a href="#" class="normaltip"><img src="<?= base_url('assets/front/'); ?>images/icon1.jpg" alt=""></a></li>
            <li><a href="#" class="normaltip"><img src="<?= base_url('assets/front/'); ?>images/icon2.jpg" alt=""></a></li>
            <li><a href="#" class="normaltip"><img src="<?= base_url('assets/front/'); ?>images/icon3.jpg" alt=""></a></li>
            <li><a href="#" class="normaltip"><img src="<?= base_url('assets/front/'); ?>images/icon4.jpg" alt=""></a></li>
        </ul>
    </div>
    <!-- {%FOOTER_LINK} -->
</footer>
<!-- footer end -->
</div>
<script type="text/javascript">
    Cufon.now();
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.kwicks').kwicks({
            max: 500,
            spacing: 0,
            event: 'mouseover'
        });
    })
</script>
</body>

</html>