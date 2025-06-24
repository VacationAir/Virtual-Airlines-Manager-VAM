
<?php
/**
 * @Project: Vacation Air Virtual Airlines
 * @Author: [Your Name]
 * @Web [Your Website]
 * Copyright (c) 2023 Vacation Air
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vacation Air</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        :root {
            --vacation-blue: #1e88e5;
            --vacation-dark-blue: #1565c0;
            --vacation-green: #4caf50;
            --vacation-dark-green: #388e3c;
            --vacation-light: #f5f9fc;
        }
        
        body {
            background-color: var(--vacation-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 56px;
        }
        
        .vacation-header {
            background: linear-gradient(135deg, var(--vacation-blue), var(--vacation-green));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .vacation-btn-primary {
            background-color: var(--vacation-blue);
            border-color: var(--vacation-blue);
        }
        
        .vacation-btn-primary:hover {
            background-color: var(--vacation-dark-blue);
            border-color: var(--vacation-dark-blue);
        }
        
        .vacation-btn-secondary {
            background-color: var(--vacation-green);
            border-color: var(--vacation-green);
        }
        
        .vacation-btn-secondary:hover {
            background-color: var(--vacation-dark-green);
            border-color: var(--vacation-dark-green);
        }
        
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            color: var(--vacation-blue);
        }
        
        .stat-card {
            transition: all 0.3s ease;
            border: none;
        }
        
        .stat-card:hover {
            transform: scale(1.03);
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand img {
            height: 40px;
        }
        
        .carousel-item {
            height: 500px;
            background-size: cover;
            background-position: center;
        }
        
        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 20px;
        }
        
        .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 1000;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .navbar {
            z-index: 1030;
        }
        
        .vam-datatable {
            width: 100% !important;
        }
        
        /* Estilos para DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 0.5em 1em;
        }
    </style>
    
    <!-- Bootstrap JS y plugins -->
<?php
    // Cargar Bootstrap 3 solo en páginas específicas que lo necesiten
    if (isset($_GET['page']) && $_GET['page'] === 'pilot_details') {
        echo '<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">';
    }
?>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css"/>
	<script src="js/bootstrapValidator.min.js" type="text/javascript"></script>
	<script src="Charts/Chart.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.js"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/jquery.confirm.min.js" type="text/javascript"></script>
	<!-- Custom styles for this template -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/social-vam.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/morris.css" rel="stylesheet">
	<!-- data tables plugins -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/numeric-comma.js"></script>
	<script src="js/raphael.min.js" type="text/javascript"></script>
	<script src="js/morris.min.js" type="text/javascript"></script>
	<!-- VAM javascript -->
	<script src="js/vam.js" type="text/javascript"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                <img src="./images/logo.png" alt="Vacation Air Logo" height="40">
                <span class="ms-2">Vacation Air</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="./index.php"><i class="fas fa-home"></i> <?php echo 'Home'; ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-info-circle"></i> <?php echo ABOUT; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item" href="./index.php?page=staff"><i class="fas fa-users"></i> <?php echo STAFF; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=rules"><i class="fas fa-file-alt"></i> <?php echo RULES; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=school"><i class="fas fa-graduation-cap"></i> <?php echo SCHOOL; ?></a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-comments"></i> <?php echo FORUM; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=pilot_register"><i class="fas fa-handshake"></i> <?php echo REGISTER; ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="opsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plane"></i> <?php echo OPERATIONS; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="opsDropdown">
                            <li><a class="dropdown-item" href="./index.php?page=fleet_public"><i class="fa fa-plane fa-fw"></i> <?php echo FLEET; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=route_public"><i class="fas fa-route"></i> <?php echo ROUTES; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=hubs"><i class="fas fa-map-marker-alt"></i> <?php echo HUBS; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=tours"><i class="fas fa-passport"></i> <?php echo TOURS; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=ranks"><i class="fas fa-bookmark"></i> <?php echo PILOT_RANKS; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=awards"><i class="fas fa-star"></i> <?php echo AWARDS; ?></a></li>
                            <li><a class="dropdown-item" href="./index.php?page=va_global_financial_report"><i class="fas fa-dollar-sign"></i> <?php echo GLOBAL_FINANCES; ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php?page=pilots_public"><i class="fas fa-user-astronaut"></i> <?php echo PILOTS; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php?page=stats"><i class="fas fa-chart-line"></i> <?php echo STATS; ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-language"></i> <?php echo LANGUAGES; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="langDropdown">
                            <?php echo $linklanguage; ?>
                        </ul>
                    </li>
                </ul>
                
                <?php if ($user_logged == 0): ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?page=pilot_register"><i class="fas fa-user-plus"></i> Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light ms-2" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['user']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="./index_vam.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="https://vacationairva.com/vam/index_vam_op.php?page=pilot_options"><i class="fas fa-user"></i> My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./index.php?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Pilot Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="./login.php" method="post">
                        <div class="mb-3">
                            <label for="loginCallsign" class="form-label">Callsign</label>
                            <input type="text" class="form-control" id="loginCallsign" name="user" placeholder="VA-XXX" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <p class="mb-0">New to Vacation Air? <a href="./index.php?page=pilot_register" data-bs-dismiss="modal">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container mt-4">