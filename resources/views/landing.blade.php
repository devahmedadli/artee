<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Platform Landing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('your-hero-image.jpg') center/cover;
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.5rem;
        }

        .features-section,
        .how-it-works-section,
        .testimonials-section,
        .pricing-section,
        .faqs-section {
            padding: 60px 0;
        }

        .testimonials-section .card {
            margin: 20px 0;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 30px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Connect with Top Freelancers for Your Projects</h1>
            <p>Hire professionals across various industries to get your tasks done efficiently.</p>
            <a href="#register" class="btn btn-primary btn-lg mt-4">Get Started</a>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section text-center">
        <div class="container">
            <h2>How It Works</h2>
            <div class="row">
                <div class="col-md-3">
                    <h4>Create an Account</h4>
                    <p>Sign up quickly as a customer or freelancer.</p>
                </div>
                <div class="col-md-3">
                    <h4>Browse Freelancers</h4>
                    <p>Search for freelancers with the skills you need.</p>
                </div>
                <div class="col-md-3">
                    <h4>Place an Order</h4>
                    <p>Submit your project details and hire the right person.</p>
                </div>
                <div class="col-md-3">
                    <h4>Communicate and Collaborate</h4>
                    <p>Use our chat feature to manage your projects seamlessly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section bg-light">
        <div class="container">
            <h2 class="text-center">Features</h2>
            <div class="row text-center">
                <div class="col-md-3">
                    <h4>Order Management</h4>
                    <p>Easily manage your orders with our user-friendly interface.</p>
                </div>
                <div class="col-md-3">
                    <h4>Secure Payments</h4>
                    <p>Our platform ensures secure transactions with escrow services.</p>
                </div>
                <div class="col-md-3">
                    <h4>24/7 Support</h4>
                    <p>We offer around-the-clock support to assist you anytime.</p>
                </div>
                <div class="col-md-3">
                    <h4>User Ratings</h4>
                    <p>Rate freelancers and check reviews before hiring.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="text-center">Testimonials</h2>
            <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card">
                            <div class="card-body">
                                <p>"This platform made it easy to find the right freelancer for my project. Highly
                                    recommend!" - Jane Doe</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card">
                            <div class="card-body">
                                <p>"Great experience! The support team was very helpful throughout the process." - John
                                    Smith</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section bg-light">
        <div class="container">
            <h2 class="text-center">Pricing</h2>
            <p class="text-center">Transparent pricing with no hidden fees. Choose the best plan that fits your needs.
            </p>
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="faqs-section">
        <div class="container">
            <h2 class="text-center">FAQs</h2>
            <div class="row">
                <div class="col-md-6">
                    <h5>How do I create an account?</h5>
                    <p>Simply click on the 'Get Started' button and follow the instructions.</p>
                </div>
                <div class="col-md-6">
                    <h5>How secure are the payments?</h5>
                    <p>All payments are secured through our encrypted payment gateway.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Freelancer Platform. All Rights Reserved.</p>
            <a href="#terms" class="text-white">Terms of Service</a> |
            <a href="#privacy" class="text-white">Privacy Policy</a> |
            <a href="#contact" class="text-white">Contact Us</a> |
            <a href="#social" class="text-white">Follow Us on Social Media</a>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
