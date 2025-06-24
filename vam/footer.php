<?php
/**
 * @Project: Vacation Air Virtual Airlines
 * @Author: [Tu Nombre]
 * @Web [Tu Sitio Web]
 * Copyright (c) 2023 Vacation Air
 */
?>

<?php
// Verificar conexión a la base de datos
if (!isset($db) || !($db instanceof mysqli)) {
    die('Error de conexión a la base de datos');
}
?>
 <!-- Footer -->
<footer class="footer bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5>About Vacation Air</h5>
                <p>Vacation Air is a virtual airline created by flight simulation enthusiasts for flight simulation enthusiasts. We strive to provide the most realistic virtual airline experience possible.</p>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="./index.php" class="text-white">Home</a></li>
                    <li class="mb-2"><a href="./index.php?page=fleet_public" class="text-white">Our Fleet</a></li>
                    <li class="mb-2"><a href="./index.php?page=route_public" class="text-white">Routes</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                <h5>Operations</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="./index.php?page=hubs" class="text-white">Hubs</a></li>
                    <li class="mb-2"><a href="./index.php?page=tours" class="text-white">Tours</a></li>
                    <li class="mb-2"><a href="./index.php?page=ranks" class="text-white">Ranks</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> vacationair.va@gmail.com </li>
                    <li class="mb-2"><i class="fas fa-comment me-2"></i> <a href='https://discord.gg/eWYCxqm7tY'>Discord</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Vacation Air Virtual Airlines. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
