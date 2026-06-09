<?php
// index.php — Homepage
require_once 'includes/config.php';
$pageTitle = 'Home – Find Trusted Plumbers Near You';

// Fetch active plumbers for homepage preview
$sql     = "SELECT * FROM plumbers WHERE status='active' ORDER BY rating DESC LIMIT 4";
$result  = $conn->query($sql);
$plumbers = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Fetch services
$svcResult = $conn->query("SELECT * FROM services WHERE status=1 ORDER BY id LIMIT 6");
$services  = $svcResult ? $svcResult->fetch_all(MYSQLI_ASSOC) : [];

require_once 'includes/header.php';
?>

<!-- ==================== HERO ==================== -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <div class="hero-content">
          <div class="hero-badge animate-fade-down">
            <span class="dot"></span> #1 Plumbing Service Platform in AP
          </div>
          <h1 class="hero-title animate-fade-up">
            Find <span class="highlight">Trusted Plumbers</span> Near You
          </h1>
          <p class="hero-description animate-fade-up delay-1">
            Book verified professional plumbers instantly. Fast, reliable, and affordable plumbing services available 24/7 across Andhra Pradesh.
          </p>
          <div class="hero-buttons animate-fade-up delay-2">
            <a href="pages/plumbers.php" class="btn btn-accent btn-lg">
              <i class="fas fa-search"></i> Book Now
            </a>
            <a href="pages/register-plumber.php" class="btn btn-outline-white btn-lg">
              <i class="fas fa-hard-hat"></i> Register as Plumber
            </a>
          </div>
          <div class="hero-stats animate-fade-up delay-3">
            <div class="hero-stat">
              <span class="number">500<span>+</span></span>
              <span class="label">Plumbers</span>
            </div>
            <div class="hero-stat">
              <span class="number">10K<span>+</span></span>
              <span class="label">Bookings Done</span>
            </div>
            <div class="hero-stat">
              <span class="number">4.8<span>★</span></span>
              <span class="label">Avg. Rating</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==================== SEARCH ==================== -->
<section class="search-section">
  <div class="container">
    <div class="search-card animate-fade-up">
      <div class="search-card-title">
        <i class="fas fa-search-location"></i> Find a Plumber
      </div>
      <form action="pages/plumbers.php" method="GET">
        <div class="search-form">
          <div class="search-input-group">
            <i class="fas fa-map-marker-alt input-icon"></i>
            <input type="text" name="location" class="form-control-custom" placeholder="Enter your city or area...">
          </div>
          <div class="search-divider d-none d-md-block"></div>
          <div class="search-input-group">
            <i class="fas fa-tools input-icon"></i>
            <select name="service" class="form-control-custom">
              <option value="">All Service Types</option>
              <?php foreach ($services as $svc): ?>
              <option value="<?php echo htmlspecialchars($svc['name']); ?>"><?php echo htmlspecialchars($svc['name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn-search">
            <i class="fas fa-search"></i> Search
          </button>
        </div>
      </form>
      <div class="popular-searches">
        <span>Popular:</span>
        <a href="pages/plumbers.php?service=Pipe+Repair" class="popular-tag">Pipe Repair</a>
        <a href="pages/plumbers.php?service=Drain+Cleaning" class="popular-tag">Drain Cleaning</a>
        <a href="pages/plumbers.php?service=Water+Heater" class="popular-tag">Water Heater</a>
        <a href="pages/plumbers.php?service=Emergency+Plumbing" class="popular-tag">Emergency</a>
      </div>
    </div>
  </div>
</section>

<!-- ==================== SERVICES ==================== -->
<section class="services-section section-padding">
  <div class="container">
    <div class="text-center">
      <h2 class="section-title">Our <span>Services</span></h2>
      <div class="title-underline mx-auto"></div>
      <p class="section-subtitle">We provide a wide range of professional plumbing services to meet all your needs.</p>
    </div>
    <div class="row g-4">
      <?php foreach ($services as $i => $svc): ?>
      <div class="col-lg-2 col-md-4 col-6 animate-fade-up delay-<?php echo $i+1; ?>">
        <div class="service-icon-card">
          <div class="service-icon-wrap"><i class="<?php echo htmlspecialchars($svc['icon']); ?>"></i></div>
          <div class="service-card-title"><?php echo htmlspecialchars($svc['name']); ?></div>
          <p class="service-card-text"><?php echo htmlspecialchars($svc['description']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ==================== PLUMBERS PREVIEW ==================== -->
<section class="plumbers-section section-padding" style="background:var(--off-white)">
  <div class="container">
    <div class="text-center">
      <h2 class="section-title">Top Rated <span>Plumbers</span></h2>
      <div class="title-underline mx-auto"></div>
      <p class="section-subtitle">Hand-picked, background-verified professionals ready to serve you.</p>
    </div>
    <div class="row g-4">
      <?php foreach ($plumbers as $p): ?>
      <div class="col-lg-3 col-md-6">
        <div class="plumber-card">
          <div class="plumber-card-header">
            <span class="plumber-card-badge"><?php echo ucfirst($p['status']); ?></span>
            <img src="<?php echo UPLOAD_URL . htmlspecialchars($p['profile_image']); ?>"
                 onerror="this.src='<?php echo APP_URL; ?>/images/default-avatar.png'"
                 alt="<?php echo htmlspecialchars($p['name']); ?>" class="plumber-avatar">
          </div>
          <div class="plumber-card-body">
            <div class="plumber-name"><?php echo htmlspecialchars($p['name']); ?></div>
            <div class="plumber-specialty">Professional Plumber</div>
            <div class="rating-stars justify-content-center d-flex gap-1 mb-3">
              <?php for ($i=1;$i<=5;$i++): ?>
                <i class="fas fa-star star<?php echo $i<=$p['rating']?'':' empty'; ?>"></i>
              <?php endfor; ?>
              <span class="rating-count">(<?php echo $p['total_reviews']; ?>)</span>
            </div>
            <ul class="plumber-info-list">
              <li><i class="fas fa-briefcase"></i><span><?php echo $p['experience']; ?> Years Exp.</span></li>
              <li><i class="fas fa-map-marker-alt"></i><span><?php echo htmlspecialchars($p['service_area']); ?></span></li>
              <li><i class="fas fa-phone-alt"></i><span><?php echo htmlspecialchars($p['phone']); ?></span></li>
            </ul>
            <div class="plumber-charge">₹<?php echo number_format($p['service_charge'], 0); ?><small>/visit</small></div>
            <div class="plumber-card-footer">
              <a href="pages/plumber-detail.php?id=<?php echo $p['id']; ?>" class="btn btn-primary-custom btn-sm">View Details</a>
              <a href="pages/booking.php?plumber_id=<?php echo $p['id']; ?>" class="btn btn-accent btn-sm">Book Now</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-5">
      <a href="pages/plumbers.php" class="btn btn-outline-primary-custom btn-lg">View All Plumbers <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
  </div>
</section>

<!-- ==================== HOW IT WORKS ==================== -->
<section class="how-it-works section-padding">
  <div class="container">
    <div class="text-center">
      <h2 class="section-title">How It <span>Works</span></h2>
      <div class="title-underline mx-auto"></div>
      <p class="section-subtitle">Book a plumber in just 3 simple steps.</p>
    </div>
    <div class="row g-4 align-items-center">
      <div class="col-md-3 animate-fade-up delay-1">
        <div class="step-card">
          <div class="step-number">1</div>
          <div class="step-title">Search Plumber</div>
          <p class="step-text">Enter your location and select the service you need to find available plumbers near you.</p>
        </div>
      </div>
      <div class="col-md-1 step-connector d-none d-md-flex animate-fade-up delay-1">
        <i class="fas fa-chevron-right"></i>
      </div>
      <div class="col-md-3 animate-fade-up delay-2">
        <div class="step-card">
          <div class="step-number">2</div>
          <div class="step-title">Book a Service</div>
          <p class="step-text">Choose a plumber, fill in your details, describe your problem, and confirm your booking.</p>
        </div>
      </div>
      <div class="col-md-1 step-connector d-none d-md-flex animate-fade-up delay-2">
        <i class="fas fa-chevron-right"></i>
      </div>
      <div class="col-md-3 animate-fade-up delay-3">
        <div class="step-card">
          <div class="step-number">3</div>
          <div class="step-title">Get Service Done</div>
          <p class="step-text">Your verified plumber arrives at your location and completes the job professionally.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==================== CTA ==================== -->
<section class="cta-section">
  <div class="cta-content container">
    <h2 class="cta-title">Need Emergency Plumbing?</h2>
    <p class="cta-text">Our expert plumbers are available 24/7 for emergency services. Call us now or book online instantly.</p>
    <div class="cta-buttons">
      <a href="tel:+919876543210" class="btn btn-accent btn-xl"><i class="fas fa-phone-alt"></i> Call Now</a>
      <a href="pages/booking.php" class="btn btn-outline-white btn-xl"><i class="fas fa-calendar-check"></i> Book Online</a>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
