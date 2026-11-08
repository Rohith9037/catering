<?php 
require('head.php'); 
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Our Catering Services</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active text-white">Services</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Services Introduction Start -->
<div class="container-fluid py-5">
    <div class="container py-4">
        <div class="text-center mx-auto mb-5" style="max-width: 760px;">
            <h4 class="text-primary font-weight-bold text-uppercase">What We Offer</h4>
            <h1 class="display-5 mb-3">Comprehensive Catering Solutions</h1>
            <p class="text-muted fs-5">
                From intimate family gatherings to grand wedding banquets and corporate conferences, Chic Catering provides full-service catering tailored to your exact taste, budget, and guest requirements.
            </p>
        </div>

        <!-- 6 Core Services Grid -->
        <div class="row g-4 justify-content-center">
            <!-- Service 1: Wedding Catering -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white hover-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="btn-square rounded-circle bg-light me-3 d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; min-width: 65px;">
                            <i class="fas fa-rings-wedding fa-2x text-primary" style="font-size: 26px;">
                                <i class="fa fa-heart"></i>
                            </i>
                        </div>
                        <div>
                            <span class="badge bg-primary-subtle text-primary mb-1">Most Popular</span>
                            <h4 class="mb-0 text-dark">Wedding Catering</h4>
                        </div>
                    </div>
                    <p class="text-muted flex-grow-1">
                        Grand wedding feasts, engagement dinners, and reception buffets. Choose from traditional multi-course Kerala Sadhyas on plantain leaves or lavish multi-cuisine banquets with live dessert counters.
                    </p>
                    <ul class="list-unstyled small text-muted mb-4 border-top pt-3">
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Traditional Kerala Sadhya & Biryani Banquets</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>VIP Table Service & Bridal Party Treats</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Complete Buffet Setup & Decorative Display</li>
                    </ul>
                    <a href="menu.php" class="btn btn-outline-primary rounded-pill w-100 py-2 mt-auto">Explore Wedding Packages</a>
                </div>
            </div>

            <!-- Service 2: Corporate Events -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white hover-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="btn-square rounded-circle bg-light me-3 d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; min-width: 65px;">
                            <i class="fa fa-building fa-2x text-primary"></i>
                        </div>
                        <div>
                            <span class="badge bg-secondary text-dark mb-1">Business & Conferences</span>
                            <h4 class="mb-0 text-dark">Corporate Catering</h4>
                        </div>
                    </div>
                    <p class="text-muted flex-grow-1">
                        Professional breakfast spreads, executive executive boxed meals, high-tea snack breaks, and annual gala dinners designed for businesses, seminars, and networking conferences.
                    </p>
                    <ul class="list-unstyled small text-muted mb-4 border-top pt-3">
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Punctual on-site delivery for conferences</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Individual packed meal boxes available</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Coffee, tea, and finger food refreshment stations</li>
                    </ul>
                    <a href="contact.php" class="btn btn-outline-primary rounded-pill w-100 py-2 mt-auto">Request Corporate Quote</a>
                </div>
            </div>

            <!-- Service 3: Birthday & Private Celebrations -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white hover-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="btn-square rounded-circle bg-light me-3 d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; min-width: 65px;">
                            <i class="fa fa-birthday-cake fa-2x text-primary"></i>
                        </div>
                        <div>
                            <span class="badge bg-secondary text-dark mb-1">Family & Friends</span>
                            <h4 class="mb-0 text-dark">Private Celebrations</h4>
                        </div>
                    </div>
                    <p class="text-muted flex-grow-1">
                        Memorable catering for birthdays, anniversary dinners, housewarmings, christenings, and reunions. Personalized menu curation with kid-friendly treats and gourmet adult fare.
                    </p>
                    <ul class="list-unstyled small text-muted mb-4 border-top pt-3">
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Customized birthday & anniversary menus</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Kid-friendly bites, pasta, and finger foods</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Custom mocktail bar & dessert spreads</li>
                    </ul>
                    <a href="submenu.php" class="btn btn-outline-primary rounded-pill w-100 py-2 mt-auto">Browse Party Dishes</a>
                </div>
            </div>

            <!-- Service 4: Live Food Counters -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white hover-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="btn-square rounded-circle bg-light me-3 d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; min-width: 65px;">
                            <i class="fa fa-fire fa-2x text-primary"></i>
                        </div>
                        <div>
                            <span class="badge bg-secondary text-dark mb-1">Interactive Experience</span>
                            <h4 class="mb-0 text-dark">Live Food Counters</h4>
                        </div>
                    </div>
                    <p class="text-muted flex-grow-1">
                        Bring dynamic theatre to your event with on-site live cooking stations where chefs prepare fresh dishes right in front of your guests.
                    </p>
                    <ul class="list-unstyled small text-muted mb-4 border-top pt-3">
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Hot Dosa & Appam live counters</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Barbeque grill, shawarma & tandoor stations</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Chaat street food & fresh jalebi stations</li>
                    </ul>
                    <a href="contact.php" class="btn btn-outline-primary rounded-pill w-100 py-2 mt-auto">Inquire Live Counters</a>
                </div>
            </div>

            <!-- Service 5: Outdoor & Community Feasts -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white hover-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="btn-square rounded-circle bg-light me-3 d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; min-width: 65px;">
                            <i class="fa fa-users fa-2x text-primary"></i>
                        </div>
                        <div>
                            <span class="badge bg-secondary text-dark mb-1">Large Scale</span>
                            <h4 class="mb-0 text-dark">Community & Festival Feasts</h4>
                        </div>
                    </div>
                    <p class="text-muted flex-grow-1">
                        Equipped to prepare and serve authentic large-scale feasts for temple/church festivals, Onam, Eid, Christmas, and social club gatherings up to 2,000+ attendees.
                    </p>
                    <ul class="list-unstyled small text-muted mb-4 border-top pt-3">
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>High-capacity production kitchen</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Authentic wood-fire dum biryani pots</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Efficient queue management & swift service</li>
                    </ul>
                    <a href="menu.php" class="btn btn-outline-primary rounded-pill w-100 py-2 mt-auto">View Feast Packages</a>
                </div>
            </div>

            <!-- Service 6: Full Hospitality & Service Staff -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white hover-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="btn-square rounded-circle bg-light me-3 d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; min-width: 65px;">
                            <i class="fa fa-concierge-bell fa-2x text-primary"></i>
                        </div>
                        <div>
                            <span class="badge bg-secondary text-dark mb-1">Complete Care</span>
                            <h4 class="mb-0 text-dark">Hospitality & Setup</h4>
                        </div>
                    </div>
                    <p class="text-muted flex-grow-1">
                        Leave the stress to us! We provide complete event tableware, chafing warmers, linen decor, certified service staff, and end-of-event venue cleanup.
                    </p>
                    <ul class="list-unstyled small text-muted mb-4 border-top pt-3">
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Courteous, uniformed waitstaff and servers</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-primary me-2"></i>Stainless steel chafing dishes & chinaware</li>
                        <li><i class="fa fa-check-circle text-primary me-2"></i>Hygienic waste collection & post-service cleanup</li>
                    </ul>
                    <a href="contact.php" class="btn btn-outline-primary rounded-pill w-100 py-2 mt-auto">Book Service Staff</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services Introduction End -->

<!-- 4-Step Process Section Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h4 class="text-primary font-weight-bold text-uppercase">How It Works</h4>
            <h1 class="display-5 mb-3">Our 4-Step Catering Process</h1>
            <p class="text-muted">A seamless, stress-free experience from your initial inquiry to the final delicious bite.</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-sm-6 col-lg-3">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="btn-square rounded-circle bg-primary text-white mx-auto mb-3 fw-bold fs-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">1</div>
                    <h5 class="mb-2">Choose Your Menu</h5>
                    <p class="text-muted small mb-0">Browse our signature packages or hand-pick specific dishes from our a la carte categories online.</p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="btn-square rounded-circle bg-primary text-white mx-auto mb-3 fw-bold fs-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">2</div>
                    <h5 class="mb-2">Schedule & Book</h5>
                    <p class="text-muted small mb-0">Select your program date, dining time, estimated guest count, and venue address in Kochi.</p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="btn-square rounded-circle bg-primary text-white mx-auto mb-3 fw-bold fs-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">3</div>
                    <h5 class="mb-2">Chef Preparation</h5>
                    <p class="text-muted small mb-0">Our culinary masters source fresh ingredients on event morning to prepare your feast under strict hygiene standards.</p>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="btn-square rounded-circle bg-primary text-white mx-auto mb-3 fw-bold fs-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">4</div>
                    <h5 class="mb-2">On-Site Setup & Service</h5>
                    <p class="text-muted small mb-0">Our team arrives early, arranges hot buffet warmers, assists guests with courteous service, and cleans up afterwards.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 4-Step Process Section End -->

<!-- Quality Guarantees Start -->
<div class="container-fluid py-5">
    <div class="container py-4">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h4 class="text-primary font-weight-bold text-uppercase">The Chic Standard</h4>
                <h1 class="display-5 mb-4">Why Families & Companies Trust Chic Catering</h1>
                <p class="text-muted mb-4 fs-5">
                    We understand that food is the heart of every Indian celebration. That is why we never cut corners on quality, freshness, or hospitality.
                </p>

                <div class="d-flex mb-3">
                    <div class="me-3 text-primary fs-3"><i class="fa fa-shield-alt"></i></div>
                    <div>
                        <h5 class="mb-1">100% Food Safety & Hygiene</h5>
                        <p class="text-muted small">Sanitized commercial kitchens, temperature-controlled transit, and trained chefs following FSSAI protocols.</p>
                    </div>
                </div>

                <div class="d-flex mb-3">
                    <div class="me-3 text-primary fs-3"><i class="fa fa-clock"></i></div>
                    <div>
                        <h5 class="mb-1">Punctual Serving Guarantee</h5>
                        <p class="text-muted small">Buffet setup is fully ready at least 30 minutes before your first guest arrives, ensuring no delayed meals.</p>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="me-3 text-primary fs-3"><i class="fa fa-seedling"></i></div>
                    <div>
                        <h5 class="mb-1">Separate Veg & Non-Veg Kitchens</h5>
                        <p class="text-muted small">Dedicated cooking zones, cookware, and service staff to honor religious and dietary preferences.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="position-relative rounded overflow-hidden shadow-lg">
                    <img src="img/banner-meat.jpg" class="img-fluid w-100" style="height: 420px; object-fit: cover;" alt="Catering Hospitality">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-dark bg-opacity-75 text-white">
                        <h4 class="text-white mb-1">Catering Over 500+ Events Across Kerala</h4>
                        <p class="mb-0 text-white-50 small">Weddings • Birthdays • Corporate Banquets • Festive Celebrations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quality Guarantees End -->

<!-- Call to Action Start -->
<div class="container-fluid py-5 bg-primary my-5">
    <div class="container py-4 text-center text-white">
        <h1 class="display-4 text-white mb-3">Ready to Plan Your Event Menu?</h1>
        <p class="fs-4 mb-4">Book your package online or speak directly with our head catering coordinator.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="menu.php" class="btn btn-light rounded-pill py-3 px-5 text-primary fs-5 fw-bold">Browse Packages</a>
            <a href="contact.php" class="btn btn-secondary rounded-pill py-3 px-5 text-white fs-5 fw-bold">Contact Our Coordinators</a>
        </div>
    </div>
</div>
<!-- Call to Action End -->

<?php require('footer.php'); ?>
