<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licensed under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php
	include ('./vam_index_header.php');
    include ('./helpers/conversions.php');
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>
		<?php
			$sql = 'select callsign, arrival, departure, flight_status, name, surname, pending_nm, plane_type from vam_live_flights vf, gvausers gu where gu.gvauser_id = vf.gvauser_id ';
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$row_cnt = $result->num_rows;
			$sql = "SELECT flight_id FROM `vam_live_flights` WHERE UNIX_TIMESTAMP (now())-UNIX_TIMESTAMP (last_update)>180";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc())
			{
				$sql_inner = "delete from vam_live_acars where flight_id='".$row["flight_id"]."'";
				if (!$result_acars = $db->query($sql_inner))
				{
				die('There was an error running the query [' . $db->error . ']');
				}
				$sql_inner = "delete from vam_live_flights where flight_id='".$row["flight_id"]."'";
				if (!$result_acars = $db->query($sql_inner))
				{
				die('There was an error running the query [' . $db->error . ']');
				}
			}
			if ($row_cnt>0){
		?>
		<div class="row" id="live_flights">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><IMG src="images/icons/ic_flight_takeoff_white_18dp_1x.png">&nbsp;<?php echo "LIVE FIGHTS" ?></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover" id="live_flights_table">
							<?php
									echo "<tr><th>" . LF_CALLSIG . "</th><th>" . LF_PILOT . "</th><th>" . LF_DEPARTURE . "</th><th>" . LF_ARRIVAL . "</th><th>" . FLIGHT_STAGE . "</th><th>". BOOK_ROUTE_ARICRAFT_TYPE . "</th><th>" . PERC_DONE ."</th><th>" . PENDING_NM . "</th></tr>";
							?>
							</table>
						<?php include ('./vam_live_flights_map.php') ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
<section class="stats-section py-5 bg-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="stat-card p-4 rounded shadow-sm">
                    <i class="fas fa-users fa-3x text-primary mb-3" style="color: var(--vacation-blue);"></i>
                    <h2 class="counter" data-target="<?php echo isset($total_pilots) ? $total_pilots : $num_pilots; ?>">0</h2>
                    <p class="text-muted">Active Pilots</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="stat-card p-4 rounded shadow-sm">
                    <i class="fas fa-plane-departure fa-3x text-primary mb-3" style="color: var(--vacation-blue);"></i>
                    <h2 class="counter" data-target="<?php 
                        $total_flights = $num_pireps + $num_reports + $num_vamacars + $num_fskeeper;
                        if ($no_count_rejected == 1) {
                            $total_flights -= ($num_pireps_rejected + $num_fsacars_rejected + $num_vamacars_rejected + $num_fskeeper_rejected);
                        }
                        echo $total_flights;
                    ?>">0</h2>
                    <p class="text-muted">Completed Flights</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-4 rounded shadow-sm">
                    <i class="fas fa-clock fa-3x text-primary mb-3" style="color: var(--vacation-blue);"></i>
                    <h2 class="counter" data-target="<?php echo round($va_hours, 1); ?>">0</h2>
                    <p class="text-muted">Flight Hours</p>
                </div>
            </div>
        </div>
    </div>
</section>
		<!-- Features Section -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">Why Choose Vacation Air?</h2>
                <p class="lead text-muted">We offer the most realistic virtual airline experience</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card p-4 h-100 rounded shadow-sm bg-white">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-globe-americas fa-3x"></i>
                    </div>
                    <h3>Global Network</h3>
                    <p class="text-muted">Fly to hundreds of destinations worldwide with our extensive route network covering all continents.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 h-100 rounded shadow-sm bg-white">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-plane fa-3x"></i>
                    </div>
                    <h3>Modern Fleet</h3>
                    <p class="text-muted">Choose from our diverse fleet of aircraft, from regional jets to long-haul wide-bodies, all meticulously modeled.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 h-100 rounded shadow-sm bg-white">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-trophy fa-3x"></i>
                    </div>
                    <h3>Career Progression</h3>
                    <p class="text-muted">Advance through our pilot ranking system, earn awards, and unlock new aircraft as you gain experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Call to Action -->
<section class="cta-section py-5 text-white" style="background: linear-gradient(135deg, var(--vacation-blue), var(--vacation-green));">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mb-4">Ready for Takeoff?</h2>
                <p class="lead mb-5">Join Vacation Air today and start your virtual aviation journey. Whether you're a seasoned virtual pilot or just starting out, we have everything you need to enjoy flight simulation to the fullest.</p>
                <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                    <a href="./index.php?page=pilot_register" class="btn btn-light btn-lg px-4">Register Now</a>
                    <a href="https://vacationairva.com/vam/index.php?page=rules" class="btn btn-outline-light btn-lg px-4">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row g-4">
            <!-- NOTAMs Section -->
            <div class="col-md-4">
                <div class="info-card p-4 h-100 rounded shadow-sm">
                    <div class="info-header mb-4">
                        <i class="fas fa-bullhorn fa-2x me-2" style="color: var(--vacation-blue);"></i>
                        <h3 class="d-inline-block">NOTAMs</h3>
                    </div>
                    <?php
                    $sql = "SELECT notam_id, notam_name, 
                           DATE_FORMAT(publish_date,'%d-%m-%Y') as publish_date_web,
                           DATE_FORMAT(publish_date,'%Y%m%d') as publish_date,
                           DATE_FORMAT(hide_date,'%Y%m%d') as hide_date, 
                           DATE_FORMAT(now(),'%Y%m%d') as currdat
                           FROM notams 
                           ORDER BY publish_date ASC LIMIT 5";
                    
                    if (!$result = $db->query($sql)) {
                        die('Error running NOTAMs query [' . $db->error . ']');
                    }
                    ?>
                    <div class="info-content">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>NOTAM</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        if (($row["publish_date"]-$row["currdat"] <= 0) && ($row["hide_date"]-$row["currdat"] > 0)) {
                                            echo '<tr>';
                                            echo '<td><a href="index.php?page=notam&notam_id='.$row["notam_id"].'" class="text-decoration-none">'.$row["notam_name"].'</a></td>';
                                            echo '<td>'.$row["publish_date_web"].'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- New Pilots Section -->
            <div class="col-md-4">
                <div class="info-card p-4 h-100 rounded shadow-sm">
                    <div class="info-header mb-4">
                        <i class="fas fa-user-plus fa-2x me-2" style="color: var(--vacation-blue);"></i>
                        <h3 class="d-inline-block">Newest Pilots</h3>
                    </div>
                    <?php
                    $sql = "SELECT gvauser_id, 
                           CONCAT(callsign,'-',name,' ',surname) as pilot, 
                           DATE_FORMAT(register_date,'$va_date_format') as register_date 
                           FROM gvausers 
                           WHERE activation=1 
                           ORDER BY DATE_FORMAT(register_date,'%Y%m%d') DESC 
                           LIMIT 5";
                    
                    if (!$result = $db->query($sql)) {
                        die('Error running pilots query [' . $db->error . ']');
                    }
                    ?>
                    <div class="info-content">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Pilot</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td><a href="./index.php?page=pilot_details&pilot_id='.$row["gvauser_id"].'" class="text-decoration-none">'.$row["pilot"].'</a></td>';
                                        echo '<td>'.$row["register_date"].'</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-2">
                            <a href="index.php?page=pilots_public" class="btn btn-sm btn-outline-primary">View All Pilots</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Events Section -->
            <div class="col-md-4">
                <div class="info-card p-4 h-100 rounded shadow-sm">
                    <div class="info-header mb-4">
                        <i class="fas fa-calendar-alt fa-2x me-2" style="color: var(--vacation-blue);"></i>
                        <h3 class="d-inline-block">Upcoming Events</h3>
                    </div>
                    <?php
                    $sql = "SELECT event_id, event_name,
                           DATE_FORMAT(publish_date,'$va_date_format') as publish_date_web,
                           DATE_FORMAT(publish_date,'%Y%m%d') as publish_date,
                           DATE_FORMAT(hide_date,'%Y%m%d') as hide_date, 
                           DATE_FORMAT(now(),'%Y%m%d') as currdat
                           FROM events 
                           ORDER BY publish_date ASC 
                           LIMIT 5";
                    
                    if (!$result = $db->query($sql)) {
                        die('Error running events query [' . $db->error . ']');
                    }
                    ?>
                    <div class="info-content">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Event</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        if (($row["publish_date"]-$row["currdat"] <= 0) && ($row["hide_date"]-$row["currdat"] > 0)) {
                                            echo '<tr>';
                                            echo '<td><a href="index.php?page=event&event_id='.$row["event_id"].'" class="text-decoration-none">'.$row["event_name"].'</a></td>';
                                            echo '<td>'.$row["publish_date_web"].'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				<div class="clearfix visible-lg"></div>
			</div>
		</div>
		<!-- Stats Section -->

			<!-- REMOVE COMMENTS to display ONLNE NETWORKS section
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php //echo FLIGHT_NETWORKS; ?></h3>
					</div>
					<div class="panel-body">
						<div class="container">
							<?php
							/*
								if ($ivao == 1) {
									echo '<img src="./images/ivao.gif" height="50" width="50">';
								}
								if ($vatsim == 1) {
									echo '<img src="./images/Vatsim.png" height="50" width="50">';
								}
							*/
							?>
						</div>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div> -->
		</div>
		<br>
		<!-- HOME PAGE End -->
	<?php
	}
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
	} else {
		$Existe = file_exists($_GET["page"] . ".php");
		if ($Existe == true) {
			include($_GET["page"] . ".php");
		} else {
			echo "Page Not Found";
		}
	}
?>
</div>
<?php include('footer.php');?>
</body>
</html>
<script>
// Versión segura sin polyfills conflictivos
document.addEventListener('DOMContentLoaded', function() {
    // 1. Verificar e inicializar Bootstrap Dropdowns
    const initDropdowns = () => {
        try {
            if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
                const dropdowns = document.querySelectorAll('.dropdown-toggle');
                dropdowns.forEach(toggle => {
                    new bootstrap.Dropdown(toggle);
                });
                return true;
            }
            // Fallback manual
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const menu = this.nextElementSibling;
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if (m !== menu) m.classList.remove('show');
                    });
                    menu.classList.toggle('show');
                });
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            return false;
        } catch (e) {
            console.error('Dropdown initialization error:', e);
            return false;
        }
    };

    // 2. Animación de contadores segura
    const animateCounters = () => {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 2000;
            let start = null;

            const step = (timestamp) => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                counter.textContent = Math.floor(progress * target).toLocaleString();
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        });
    };

    // 3. Inicialización segura
    const safeInit = () => {
        if (window.trustedTypes) {
            window.trustedTypes.createPolicy('default', {
                createHTML: (string) => string,
                createScriptURL: (string) => string,
                createScript: (string) => string
            });
        }

        initDropdowns();
        animateCounters();
    };

    safeInit();
});

// Limpieza de event listeners al salir
window.addEventListener('beforeunload', () => {
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.replaceWith(toggle.cloneNode(true));
    });
});
</script>
