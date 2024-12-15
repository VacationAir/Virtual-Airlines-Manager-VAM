    /**
     * @Project: Virtual Airlines Manager (VAM)
     * @Author: Alejandro Garcia
     * @Web http://virtualairlinesmanager.net
     * Copyright (c) 2013 - 2016 Alejandro Garcia
     * VAM is licensed under the following license:
     *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
     *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
     */
// Route Live searcher
    $(function(){
            $("#search_result").hide();
            $('#routedeparture').keyup(function(){
                var search_dep = $('#routedeparture').val();
                var search_arr = $('#routearrival').val();
                if (search_dep.length==0 && search_arr.length==0)
                {
                    $("#no_search_result").show(1000);
                    $("#search_result").hide(1000);
                }
                else
                {
                    $("#no_search_result").hide(1000);
                    $("#search_result").show(1000);
                    $.post("ajax/searcher.php",{"search_dep":search_dep,"search_arr":search_arr},function(data){
                        $('.entry').html(data); });
                }
            });
        });
    $(function(){
            $('#routearrival').keyup(function(){
                var search_dep = $('#routedeparture').val();
                var search_arr = $('#routearrival').val();
                if (search_dep.length==0 && search_arr.length==0)
                {
                    $("#no_search_result").show(1000);
                    $("#search_result").hide(1000);
                }
                else
                {
                    $("#no_search_result").hide(1000);
                    $("#search_result").show(1000);
                    $.post("ajax/searcher.php",{"search_dep":search_dep,"search_arr":search_arr},function(data){
                        $('.entry').html(data); });
                }
            });
        });
// front end js script begin
// datatables begin
$(document).ready(function(){
    $('#fleet_public').DataTable();
    $('#pilot_flights').DataTable(
    {
    columnDefs: [
         { targets: 5, type: 'numeric' },

    ],
    "order": []  
}
        );
    $('#pilots_public').DataTable();
    $('#routes_public').DataTable();
    $('#tours').DataTable();
    $('#ranks').DataTable({
        "order": []
    });
    $('#pilots_flights_per_month').DataTable();
    $('#pilots_hours_per_month').DataTable();
    $('#hub_pilot').DataTable();
    $('#hub_fleet').DataTable();
    $('#hub_routes').dataTable( {
      "searching": false
    } );
    $('#mails').DataTable();
    $('#route_select_one').DataTable();
    $('#route_select_two').DataTable();
    $('#my_bank').DataTable({
        "order": []
    });
    $('#downloads').DataTable();
    $('#report_plane_out').DataTable();
    $('#validate_flights').DataTable();
    $('#validate_jumps').DataTable();
    $('#tour_active').DataTable();
    $('#tour_inactive').DataTable();
    $('#report_pilot').DataTable({
        "order": []
    });
});
// datatables end
// validations begin
$(document).ready(function () {
    // Validation for change location form
    var validator_recover_password = $("#login-form").bootstrapValidator({
        feedbackIcons: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            user: {
                message: "Callsign is required",
                validators: {
                    notEmpty: {
                        message: "Please provide Callsign"
                    }
                }
            },
            password: {
                message: "Password is required",
                validators: {
                    notEmpty: {
                        message: "Please provide Password"
                    }
                }
            }
        }
    });
    // Validation for password reset form
    var validator_recover_password = $("#password-recover-form").bootstrapValidator({
        feedbackIcons: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            callsign: {
                message: "Callsign is required",
                validators: {
                    notEmpty: {
                        message: "Please provide Callsign"
                    }
                }
            },
            email: {
                message: "Email address is required",
                validators: {
                    notEmpty: {
                        message: "Please provide Email address"
                    },
                    emailAddress: {
                        message: "Email address was invalid"
                    }
                }
            }
        }
    });
    // Validation for register form
    var validator_register_form = $("#register-form").bootstrapValidator({
        feedbackIcons: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
        },
        fields: {
            name: {
                message: "Name  is required",
                validators: {
                    notEmpty: {
                        message: "Please provide a Name"
                    }
                }
            },
            surname: {
                message: "Last name is required",
                validators: {
                    notEmpty: {
                        message: "Please provide a Last name"
                    }
                }
            },
            city: {
                message: "City is required",
                validators: {
                    notEmpty: {
                        message: "Please provide City"
                    }
                }
            },
            email: {
                message: "Email address is required",
                validators: {
                    notEmpty: {
                        message: "Please provide Email address"
                    },
                    emailAddress: {
                        message: "Email address was invalid"
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: "Password is required"
                    },
                    stringLength: {
                        min: 6,
                        message: "Password must be 6 characters long"
                    },
                    different: {
                        field: "email",
                        message: "Email address and password can not match"
                    }
                }
            },
            password2: {
                validators: {
                    notEmpty: {
                        message: "Confirm password field is required"
                    },
                    identical: {
                        field: "password",
                        message: "Password and confirmation must match"
                    }
                }
            },
            birthdate: {
                message: "Birthdate is required",
                validators: {
                    notEmpty: {
                        message: "Please provide a Birthdate"
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'The format is dd/mm/yyyy'
                    }
                }
            },
            ivao: {
                message: "IVAO VID must be a number",
                validators: {
                    integer: {
                        message: 'The value is not an integer'
                    },
                    stringLength: {
                        message: 'Maximun 8 digits',
                        max: 8
                        }
                }
            },
            vatsim: {
                message: "IVAO VID must be a number",
                validators: {
                    integer: {
                        message: 'The value is not an integer'
                    },
                    stringLength: {
                        message: 'Maximun 8 digits',
                        max: 8
                    }
                }
            }
        }
    });
    $('#datetimepicker').datetimepicker({
        pickTime: false,
        language: 'es'
    });
    $("#datetimepicker").on("dp.change", function (e) {
        $('#register-form').bootstrapValidator('revalidateField', 'birthdate');
    });
});
// validations end
// Live flight map begin
var semaforo=1;
function refreshflightsdiv()
  {
    $.ajax({
          url: 'get_live_flights.php',
          data: "",
          dataType: 'json',
          success: function(data, textStatus, jqXHR) {
            drawTable(data);
            }
        });
  };
  function drawTable(data) {
    $("#live_flights_table").find("tr:gt(0)").remove();
    for (var i = 0; i < data.length; i++) {
        drawRow(data[i]);
    }
}
function drawRow(rowData) {
    var image_arr=' <IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/' + rowData.arr_country + '.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
    var image_dep=' <IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/' + rowData.dep_country + '.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
    var name_dep = '<br><font size="1">'+rowData.dep_name.replace('Airport', '') +'</font>';
    var name_arr = '<br><font size="1">'+rowData.arr_name.replace('Airport', '') +'</font>';
    var progress = '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'+ rowData.perc_completed+'" aria-valuemin="0" aria-valuemax="100" style="width:'+ rowData.perc_completed +'%">'
             + rowData.perc_completed +'% </div></div>';



    var row = $("<tr />")
    $("#live_flights_table").append(row);
    row.append($("<td>" + rowData.callsign + "</td>"));
    row.append($("<td>" + rowData.name_pilot + " " + rowData.surname + "</td>"));
    row.append($("<td>" + image_dep + rowData.departure + name_dep +"</td>"));
    row.append($("<td>" + image_arr + rowData.arrival + name_arr +"</td>"));
    row.append($("<td>" + rowData.flight_status + "</td>"));
    row.append($("<td>" + rowData.plane_type + "</td>"));
    row.append($("<td>" + progress + "</td>"));
    row.append($("<td>" + rowData.pending_nm + "</td>"));
}
$( document ).ready(refreshflights);
var contador=0;
function refreshflights(){
refreshflightsdiv();
setInterval(function () {$.ajax({
          url: 'get_live_flights.php',
          data: "",
          dataType: 'json',
          success: function(data, textStatus, jqXHR) {
                   drawTable(data);
            }
        })}, 120000);
 }
// Live flight end
// vam index_op begin
$(document).ready(function () {
        // Validation for change location form
        var validator_change_location = $("#change-location-form").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                destiny: {
                    message: "Airport (ICAO) Location is required",
                    validators: {
                        notEmpty: {
                            message: "Airport (ICAO) Location"
                        }, stringLength: {
                            min: 4,
                            max: 4,
                            message: "Airport ICAO code must be 4 characters long"
                        }
                    }
                }
            }
        });
        // Validation for my-profile-form
        var validator_my_profile = $("#my-profile-form").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                password: {
                    validators: {
                        notEmpty: {
                            message: "Password is required"
                        },
                        stringLength: {
                            min: 6,
                            message: "Password must be 6 characters long"
                        }
                    }
                },
                password2: {
                    validators: {
                        notEmpty: {
                            message: "Confirm password field is required"
                        },
                        identical: {
                            field: "password",
                            message: "Password and confirmation must match"
                        }
                    }
                }
            }
        });
        // Validation for pirep form
        var validator_manual_pirep_form = $("#manual-pirep-form").bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                departure: {
                    message: "Departure  is required",
                    validators: {
                        notEmpty: {
                            message: "Please provide a Departure"
                        },
                        stringLength: {
                            message: 'Minimum 4 characters',
                            min: 4
                        }
                    }
                },
                arrival: {
                    message: "Departure  is required",
                    validators: {
                        notEmpty: {
                            message: "Please provide a Departure"
                        },
                        stringLength: {
                            message: 'Minimum 4 characters',
                            min: 4
                        }
                    }
                },
                flight_date: {
                    message: "Flight date is required",
                    validators: {
                        notEmpty: {
                            message: "Please provide a Flight date"
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            message: 'The format is dd/mm/yyyy'
                        }
                    }
                },
                fuel: {
                    message: "Fuel must be a number",
                    validators: {
                        integer: {
                            message: 'The value is not an integer'
                        },
                        stringLength: {
                            message: 'Maximun 12 digits',
                            max: 12
                        },
                        notEmpty: {
                            message: "Fuel is required"
                        }
                    }
                },
                distance: {
                    message: "Distance must be a number",
                    validators: {
                        integer: {
                            message: 'The value is not an integer'
                        },
                        stringLength: {
                            message: 'Maximun 10 digits',
                            max: 10
                        },
                        notEmpty: {
                            message: "Distance is required"
                        }
                    }
                },
                duration: {
                    validators: {
                        notEmpty: {
                            message: 'The price is required'
                        },
                        numeric: {
                            message: 'The price must be a number',
                            transformer: function($field, validatorName) {
                                var value = $field.val();
                                return value.replace(',', '');
                            }
                        }
                    }
                }
            }
        });
        $('#datetimepicker').datetimepicker({
            pickTime: false,
            language: 'es'
        });
        $("#datetimepicker").on("dp.change", function (e) {
            $('#manual-pirep-form').bootstrapValidator('revalidateField', 'flight_date');
        });
        // Ajax calls for valiation VAM PIREPS
        $( "#addcommentbtn" ).click(function( event ) {
          var flight=  $("#vamflightid").val();
          var comment = $("#comment").val();
          var dataString = 'action=addcomment&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/vampirep.php",
            data: dataString,
            cache: false,
            success: function(result){
                location.reload();
            }
            });
            $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#acceptbtn" ).click(function( event ) {
          var flight=  $("#vamflightid").val();
          var comment = $("#comment").val();
          var dataString = 'action=acceptflight&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/vampirep.php",
            data: dataString,
            cache: false,
            success: function(result){
                location.reload();
            }
            });
          $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#rejectbtn" ).click(function( event ) {
          var flight=  $("#vamflightid").val();
          var comment = $("#comment").val();
          var dataString = 'action=rejectflight&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/vampirep.php",
            data: dataString,
            cache: false,
            success: function(result){
                location.reload();
            }
            });
            $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#deletebtn" ).click(function( event ) {
            $.confirm({
                text: "This is a confirmation dialog! Operation can not be rolled back!! Please confirm you want to delete the flight",
                confirm: function(button) {
                    alert("You just confirmed. The flight is deleted!");
                    var flight=  $("#vamflightid").val();
                    var comment = $("#comment").val();
                    var dataString = 'action=deleteflight&flightid='+ flight + '&comment='+ comment;
                    $.ajax({
                        type: "POST",
                        url: "ajax/vampirep.php",
                        data: dataString,
                        cache: false,
                        success: function(result){
                            history.go(-1);
                        }
                    });
                },
                cancel: function(button) {
                    alert("You cancelled.");
                }
            });
        });
        // Ajax calls for valiation FS KEEPER PIREPS
        $( "#fskeeperaddcommentbtn" ).click(function( event ) {
          var flight=  $("#fskeeperid").val();
          var comment = $("#fskeepercomment").val();
          var dataString = 'action=addcomment&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/fskeeperpirep.php",
            data: dataString,
            cache: false,
            success: function(result){
                location.reload();
            $('#fskeepercomment').html(comment);
            }
            });
            $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#fskeeperacceptbtn" ).click(function( event ) {
          var flight=  $("#fskeeperid").val();
          var comment = $("#fskeepercomment").val();
          var dataString = 'action=acceptflight&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/fskeeperpirep.php",
            data: dataString,
            cache: false,
            success: function(result){
            location.reload();
            $('#fskeepercomment').html(comment);
            }
            });
          $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#fskeeperrejectbtn" ).click(function( event ) {
          var flight=  $("#fskeeperid").val();
          var comment = $("#fskeepercomment").val();
          var dataString = 'action=rejectflight&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/fskeeperpirep.php",
            data: dataString,
            cache: false,
            success: function(result){
                location.reload();
            }
            });
            $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#fskeeperdeletebtn" ).click(function( event ) {
            $.confirm({
                text: "This is a confirmation dialog! Operation can not be rolled back!! Please confirm you want to delete the flight",
                confirm: function(button) {
                    alert("You just confirmed. The flight is deleted!");
                    var flight=  $("#fskeeperid").val();
                    var comment = $("#fskeepercomment").val();
                    var dataString = 'action=deleteflight&flightid='+ flight + '&comment='+ comment;
                    $.ajax({
                        type: "POST",
                        url: "ajax/fskeeperpirep.php",
                        data: dataString,
                        cache: false,
                        success: function(result){
                            history.go(-1);
                        }
                    });
                },
                cancel: function(button) {
                    alert("You cancelled.");
                }
            });
        });
        // Ajax calls for valiation Manual reports
        $( "#manualaddcommentbtn" ).click(function( event ) {
          var flight=  $("#manualflightid").val();
          var comment = $("#manualcomment").val();
          var dataString = 'action=addcomment&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/manualpirep.php",
            data: dataString,
            cache: false,
            error: function(result){
                location.reload();
            },
            success: function(result){
                location.reload();
            $('#manualcomment').html(comment);
            }
            });
            $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#manualacceptbtn" ).click(function( event ) {
          var flight=  $("#manualflightid").val();
          var comment = $("#manualcomment").val();
          var dataString = 'action=acceptflight&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/manualpirep.php",
            data: dataString,
            cache: false,
            success: function(result){
                location.reload();
            $('#manualcomment').html(comment);
            }
            });
          $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#manualrejectbtn" ).click(function( event ) {
          var flight=  $("#manualflightid").val();
          var comment = $("#manualcomment").val();
          var dataString = 'action=rejectflight&flightid='+ flight + '&comment='+ comment;
          $.ajax({
            type: "POST",
            url: "ajax/manualpirep.php",
            data: dataString,
            cache: false,
            success: function(result){
                location.reload();
            }
            });
            $("#result").html('Successfully updated ');
            $("#result").addClass("alert alert-success").delay( 2000 );
        });
        $( "#manualdeletebtn" ).click(function( event ) {
            $.confirm({
                text: "This is a confirmation dialog! Operation can not be rolled back!! Please confirm you want to delete the flight",
                confirm: function(button) {
                    alert("You just confirmed. The flight is deleted!");
                    var flight=  $("#manualflightid").val();
                    var comment = $("#manualcomment").val();
                    var dataString = 'action=deleteflight&flightid='+ flight + '&comment='+ comment;
                    $.ajax({
                        type: "POST",
                        url: "ajax/manualpirep.php",
                        data: dataString,
                        cache: false,
                        success: function(result){
                            history.go(-1);
                        }
                    });
                },
                cancel: function(button) {
                    alert("You cancelled.");
                }
            });
        });
    });
// vam index_op end