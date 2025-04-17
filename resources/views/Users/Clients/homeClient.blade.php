@extends('../Template.app')

@section('Travel')
<title>Client-Home</title>

<!-- Carousel -->
<div id="destinationCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#destinationCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#destinationCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#destinationCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a" class="d-block w-100" alt="Paris">
            <div class="carousel-caption">
                <h2>Paris</h2>
                <p>Découvrez la ville de l'amour</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1544085311-11a028465b03" class="d-block w-100" alt="Dubai">
            <div class="carousel-caption">
                <h2>Dubai</h2>
                <p>Le luxe au cœur du désert</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1524293581917-878a6d017c71" class="d-block w-100" alt="Tokyo">
            <div class="carousel-caption">
                <h2>Tokyo</h2>
                <p>L'alliance parfaite entre tradition et modernité</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#destinationCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#destinationCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Search Section -->
<section class="search-section py-5">
    <div class="container">
        <div class="search-box p-4 rounded-3 shadow">
            <h3 class="text-center mb-4">Trouvez votre prochain voyage</h3>
            <form>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Départ</label>
                        <input type="text" class="form-control" placeholder="Ville de départ">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Destination</label>
                        <input type="text" class="form-control" placeholder="Ville d'arrivée">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Passagers</label>
                        <select class="form-select">
                            <option>1 Passager</option>
                            <option>2 Passagers</option>
                            <option>3 Passagers</option>
                            <option>4+ Passagers</option>
                        </select>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Avis de nos voyageurs</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <div class="testimonial-avatar">
                            <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Sophie Martin">
                        </div>
                        <h5 class="card-title mt-3">Sophie Martin</h5>
                        <div class="stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">"Service exceptionnel ! La réservation était simple et rapide. Je recommande vivement !"</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <div class="testimonial-avatar">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Thomas Dubois">
                        </div>
                        <h5 class="card-title mt-3">Thomas Dubois</h5>
                        <div class="stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="card-text">"Des prix compétitifs et un service client au top. Je n'hésite pas à réserver régulièrement."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <div class="testimonial-avatar">
                            <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Marie Leroy">
                        </div>
                        <h5 class="card-title mt-3">Marie Leroy</h5>
                        <div class="stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">"Une expérience de voyage parfaite du début à la fin. Je suis ravie !"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>VoyageExpress</h5>
                <p>Votre partenaire de confiance pour des voyages inoubliables.</p>
            </div>
            <div class="col-md-4">
                <h5>Liens Utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Conditions générales</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Suivez-nous</h5>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>


@if ($errors->any())
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           // Récupère toutes les erreurs de validation
           let errors = @json($errors->all());
           // Affiche chaque erreur dans une alerte SweetAlert
           errors.forEach(function(message) {
               swal("Erreur", message, "error");
           });
       });
   </script>
   @endif

   @if (session()->has('success'))
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           swal("Succès", "{{ session('success') }}", "success");
       });
   </script>
   @endif
@endsection