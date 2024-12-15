<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensoue.php)
 */
$cakeDescription = __d('cake_dev', 'Virtual Airlines Manager');
?>
<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title>
    <?php echo $cakeDescription ?>:
    <?php echo $title_for_layout; ?>
  </title>
<?php
  echo $this->Html->meta('icon');
  // VAM begin Added for VAM Boostrap and JQuery libraries
  echo $this->Html->css(array('bootstrap.min','bootstrap-theme.min'));
  echo $this->Html->script(array('jquery.min','docs.min','bootstrap.min'));
  // VAM end Added for VAM Boostrap and JQuery libraries
  // VAM 2.6 CK editor added Begin
  echo $this->Html->script('ckeditor/ckeditor.js');
  // VAM 2.6 CK editor added End
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');
  $id='zzz';
  $usertype='zzz';
  if (isset($_SESSION["id"]))
  {
    $id = $_SESSION["id"] ;
  }
  if (isset($_SESSION["usertype"]))
  {
    $admin_access= $_SESSION["access_administration_panel"] == 1 ;
  }
  if ($id=='' || $admin_access!=1) {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=http://virtualairlinesmanager.net\">";
  }
  else{
?>
</head>
<body>
  <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Virtual Airlines Manager</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><?php echo $this->Html->link('Exit administration',
                    '../../vam/index_vam_op.php?page=pilot_options'); ?></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  <div class="container theme-showcase" role="main">
  <!-- VAM 2.1 Icons menu Begin-->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo 'VAM Administration Panel [version 2.6]';?></h3>
      <br>
      <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#admin">Show / Hide modules</button>
    </div>
    <div id="admin" class="collapse in">
      <div class="row">
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("vaparameters.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'VaParameters', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_PARA;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("hub.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Hubs', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_HUB_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("fleet.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Fleettypes', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_FLEET_TYPE_MGR;?></strong></p>
            </div>
          </div>
        </div>
      <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("aircraft.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Fleets', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_FLEET_MGR;?></strong></p>
            </div>
          </div>
        </div>
      <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("rank.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Ranks', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_PILOT_RANK_MGR;?></strong></p>
            </div>
          </div>
        </div>
      <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("pilot.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Gvausers', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_PILOT_MGR;?></strong></p>
            </div>
          </div>
        </div>
      </div>
    <!-- row 2 -->
    <div class="row">
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("routes.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Routes', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_ROUTE_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("fleet_route.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'FleettypesRoutes', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_ROUTE_FLEET_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("user_type.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'UserTypes', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_USER_TYPE_MGR;?></strong></p>
            </div>
          </div>
        </div>
      <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->link($this->Html->image('jump.png',array('alt'=>'passanger', 'height'=>'50','width'=>'50')),'../../vam/index_vam_op.php?page=validate_jumps', array('target'=>'_blank','escape'=>false)); ?>
              <p class="text-center"><strong><?php echo ADM_JUMP_MGR;?></strong></p>
            </div>
          </div>
        </div>
      <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->link($this->Html->image('validate.png',array('alt'=>'Validate Flights', 'height'=>'50','width'=>'50')),'../../vam/index_vam_op.php?page=validate_flights', array('target'=>'_blank','escape'=>false)); ?>
              <p class="text-center"><strong><?php echo ADM_FLIGHT_MGR;?></strong></p>
            </div>
          </div>
        </div>
      <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("event.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Events', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_EVENT_MGR;?></strong></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Row 3 -->
     <div class="row">
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("notam.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Notams', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_NOTAM_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("email.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'ConfigEmails', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_EMAIL_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("languages.gif", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Languages', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_LANGUAGES_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("acars.jpg", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'VamacarsParameters', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_ACARS_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("icon-treasure.gif", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'FinancialParameters', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_FINANTIAL_MODULE_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("tour.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Tours', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_TOUR_MODULE_MGR;?></strong></p>
            </div>
          </div>
        </div>
      </div>
<!-- row 4 -->
<div class="row">
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("pilot_award.jpg", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Awards', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_AWARDS_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("pilot_award.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'AwardPilots', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_AWARDS_PILOR_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("course-icon.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Gvausers', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_COURSES_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("training-icon.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Gvausers', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_TRAININGS_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("web_configuration.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'WebConfigurations', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_WEB_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("staff.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Staffs', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_STAFF_MGR;?></strong></p>
            </div>
          </div>
        </div>
      </div>
<! ROW 4 END -->
<!-- row 5 -->
<div class="row">
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("airport-icon.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Airports', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_AIRPORTS_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("simacars.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Vampireps', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_SIMACARS_FLIGHTS_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("logo-manual.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Pireps', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo ADM_MANUAL_FLIGTS_MGR;?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("new.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Gvausers', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo 'Reserved';?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("new.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Gvausers', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo 'Reserved';?></strong></p>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2">
          <div class="thumbnail">
            <div class="caption">
              <?php echo $this->Html->image("new.png", array(
                    'height' => 50, 'width' => 50,
                    'url' => array('controller' => 'Gvausers', 'action' => 'index')
              ));?>
              <p class="text-center"><strong><?php echo 'Reserved';?></strong></p>
            </div>
          </div>
        </div>
      </div>
<! ROW 5 END -->
    </div>
  </div>
  <!-- VAM 2.1 Icons menu End-->
  </div> <!-- marca -->
<div class="container theme-showcase" role="main">
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content');
      }?>
</div>
</body>
</html>
