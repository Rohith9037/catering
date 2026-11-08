<?php 
require('head.php'); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Contact Us</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded shadow-sm">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto mb-4" style="max-width: 700px;">
                        <h4 class="text-primary font-weight-bold">We'd Love to Hear from You</h4>
                        <h1 class="display-5">Get in Touch with Our Team</h1>
                        <p class="text-muted">
                            Dedicated to making your celebrations unforgettable with gourmet food and seamless catering hospitality. Tell us about your upcoming event!
                        </p>
                    </div>
                </div>

                <div class="col-lg-12 mb-4">
                    <div class="rounded shadow-sm overflow-hidden" style="height: 380px;">
                        <iframe class="w-100 h-100 border-0" 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31632.47480215495!2d76.3576898!3d10.1765273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b08645ed1f83e03%3A0x6af4a6aa69362b88!2sDe%20Paul%20Institute%20of%20Science%20%26%20Technology%20(DiST)!5e0!3m2!1sen!2sin!4v1694259649153!5m2!1sen!2sin" 
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Chic Catering Location Map"></iframe>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h4 class="mb-4">Send Us a Message</h4>
                        <form action="" method="POST" onsubmit="alert('Thank you for contacting Chic Catering! Our event coordinator will get back to you shortly.'); return false;">
                            <div class="mb-3">
                                <label for="contact_name" class="form-label small fw-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="contact_name" class="form-control py-3" placeholder="Enter your full name" required autocomplete="name">
                            </div>
                            <div class="mb-3">
                                <label for="contact_email" class="form-label small fw-bold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" id="contact_email" class="form-control py-3" placeholder="Enter your email" required autocomplete="email">
                            </div>
                            <div class="mb-3">
                                <label for="contact_phone" class="form-label small fw-bold">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" id="contact_phone" class="form-control py-3" placeholder="Enter phone number" required autocomplete="tel">
                            </div>
                            <div class="mb-4">
                                <label for="contact_msg" class="form-label small fw-bold">Event Details & Requirements <span class="text-danger">*</span></label>
                                <textarea id="contact_msg" class="form-control" rows="4" placeholder="Tell us about your event date, expected guest count, and menu preferences..." required></textarea>
                            </div>
                            <button class="w-100 btn btn-primary py-3 rounded-pill text-white fs-5 fw-bold" type="submit">
                                <i class="fa fa-paper-plane me-2"></i> Submit Inquiry
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white shadow-sm align-items-center">
                        <div class="btn-square rounded-circle bg-light me-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; min-width: 60px;">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Central Office</h5>
                            <p class="mb-0 text-muted">Muthoot Plaza, 12th Floor, Kacheripady, Kochi, Kerala 682018</p>
                        </div>
                    </div>

                    <div class="d-flex p-4 rounded mb-4 bg-white shadow-sm align-items-center">
                        <div class="btn-square rounded-circle bg-light me-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; min-width: 60px;">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Email Us</h5>
                            <p class="mb-0 text-muted">contact@chiccatering.in</p>
                            <small class="text-muted">Inquiries answered within 2 hours</small>
                        </div>
                    </div>

                    <div class="d-flex p-4 rounded bg-white shadow-sm align-items-center">
                        <div class="btn-square rounded-circle bg-light me-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; min-width: 60px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Call Booking Hotline</h5>
                            <p class="mb-0 text-muted">+91 6841234567</p>
                            <small class="text-muted">Available 8:00 AM - 10:00 PM</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php require('footer.php'); ?>
