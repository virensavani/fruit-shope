<?php get_header(); ?>
<!-- /.hero -->
<main id="main" class="site-main">

    <section class="site-section subpage-site-section section-contact-us">

        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <h2>Send a message</h2>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="POST" id="contactForm">
                        <input type="hidden" name="action" value="createcontact">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="user_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Subject:</label>
                            <input class="form-control" id="subject" name="user_subject"></input>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control form-control-comment" id="message"
                                name="user_message"></textarea>
                        </div>
                        <div class="text-center">
                            <button id="submit" type="submit" class="btn btn-green">Contact us</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-5">
                    <div class="contact-info">
                        <h2>Contact information</h2>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Address</h3>
                                <ul class="list-unstyled">
                                    <li>
                                        <p> 1105 City Center 2, Science City Road</p>
                                        <p>, Near CIMS Hospital, 380060</p>
                                    </li>
                                </ul>
                                <h3>Visit Our site</h3>
                                <p><a class="site-footer__link" href="https://www.karmaleen.com/">www.karmaleen.com</a>
                                </p>
                                <p><a href="tel:9727819869" target="_blank">9727819869</a></p>
                            </div>
                        </div>
                    </div><!-- /.contact-info -->
                </div>
            </div>
        </div>

    </section><!-- /.section-contact-us -->

    <section id="map" class="section-map"></section><!-- /.section-map -->

</main><!-- /#main -->
<?php get_footer(); ?>
<style>
.error {
    color: red;
}
</style>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script type="text/javascript">
var $ = jQuery;
$("#contactForm").validate({
    rules: {
        user_name: {
            required: true
        },
        user_subject: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        user_message: {
            required: true
        }
    },
    messages: {
        user_name: {
            required: "Name field is required."
        },
        user_subject: {
            required: "Subject is required."
        },
        user_message: {
            required: "The message field is required."
        }
    },
    submitHandler: function() {
        $ = jQuery
        $('#submit').submit();
    }
});
</script>