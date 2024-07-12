<?php require_once('../php/userconfig.php');
session_start();

 $macaddress = $_SESSION['macaddress'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant.IQ | Home</title>
  <link rel="icon" href="../assets/img/icon.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300;400;500;600;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
  
  <!-- Main Template -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/calendar.css">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
  <style scoped>

    .btn-info.text-light:hover,
    .btn-info.text-light:focus {
        background: #000;
    }

    table, tbody, td, tfoot, th, thead, tr {
      border-color: #ededed !important;
      border-style: solid;
      background: #fff;
      border-width: 1px !important;
    }

    .fc-daygrid-day-top{
      text-align: center;
    }

    .fc-dayGridMonth-button, .fc-dayGridWeek-button, .fc-list-button{
      display: none;
    }

    .fc-toolbar-chunk{
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 5px 10px;
      
    }

    .fc .fc-daygrid-day.fc-day-today {
      background-color: rgba(38, 219, 35, 0.15) !important; /* Change the background color and use !important */
    }

    .fc .fc-highlight{
      background: rgba(38, 219, 35, 0.3);
    }

    /* For mobile screens (less than or equal to 768px width) */
    @media (max-width: 768px) {
      .fc-toolbar-chunk h2.fc-toolbar-title {
        font-size: 16px !important; /* Adjust font size for mobile screens */
        font-weight: bold;
      }
    }

    /* For medium screens (greater than 768px width) */
    @media (min-width: 769px) {
      .fc-toolbar-chunk h2.fc-toolbar-title {
        font-size: 22px !important; /* Adjust font size for medium screens */
        font-weight: bold;
      }
    }

  </style>

</head>

<body>

  <!-- CoverPhoto -->
  <?php include '../pages/components/cover.php'; ?>

  <!-- TOP NAVBAR -->
  <?php include '../pages/components/navbar.php'; ?>

  <!-- HOME NAVBAR -->
  <?php include '../pages/components/navbar-home.php'; ?>

  <div class="container py-5" id="page-container">

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-note">
        Add notes
    </button>

    <div class="mt-4" id="calendar"></div>
    
    <br> <br> <br>

  </div>

  <!-- BOTTOM NAVBAR -->
  <?php include '../pages/components/navbar-bottom.php'; ?>

<!-- Add Event Modal -->
    <div class="modal fade" id="add-note" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Schedule Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="calendar_qry.php" method="post" id="add-schedule-form">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="device_mac" id="device_mac" value="<?php echo $macaddress; ?>" required hidden>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
                            <label for="title">Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a description here" id="description" name="description" style="height: 100px" required></textarea>
                            <label for="description">Description</label>
                        </div>
                        <div class="d-flex">
                            <div class="form-floating mb-3 w-50 me-1">
                                <input type="date" class="form-control" id="start_datetime" name="start_datetime" placeholder="Enter a date" required>
                                <label for="start_datetime">Starting Date</label>
                            </div>
                            <div class="form-floating mb-3 w-50 ms-1">
                                <input type="date" class="form-control" id="end_datetime" name="end_datetime" placeholder="Enter a date">
                                <label for="end_datetime">Ending Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary" name="savechanges"><i class="fa fa-save"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Add Event Modal -->

<?php
    // Check for success message
    if (isset($_SESSION['success_message'])) {
        echo "
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: 'Success',
                    text: '{$_SESSION['success_message']}',
                    icon: 'success',
                });
            });
        </script>
        ";
        // Unset the session variable
        unset($_SESSION['success_message']);
    }

    // Check for error message
    if (isset($_SESSION['error_message'])) {
        echo "
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: 'Error',
                    text: '{$_SESSION['error_message']}',
                    icon: 'error',
                });
            });
        </script>
        ";
        // Unset the session variable
        unset($_SESSION['error_message']);
    }
    ?>
  
  <!-- Event Details Modal -->
  <div class="modal fade" id="edit-note" tabindex="-1" aria-labelledby="edit-note" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Schedule Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close" onclick="reloadPage()"></button>
        </div>
        <form action="calendar_editqry.php" method="post" id="schedule-form">
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input type="hidden" id="edit-id" name="edit-id">
              <input type="text" class="form-control" id="edit-title" name="edit-title" placeholder="Title" required>
              <label for="edit-title">Title</label>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" placeholder="Leave a description here" id="edit-description" name="edit-description" style="height: 100px" required></textarea>
              <label for="edit-description">Description</label>
            </div>
            <div class="d-flex">
              <div class="form-floating mb-3 w-50 me-1">
                <input type="date" class="form-control" id="edit-start" name="edit-start" placeholder="Enter a date" required>
                <label for="edit-start">Starting Date</label>
              </div>
              <div class="form-floating mb-3 w-50 ms-1">
                <input type="date" class="form-control" id="edit-end" name="edit-end" placeholder="Enter a date">
                <label for="edit-end">Ending Date</label>
              </div>
            </div>
          </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" id="update" data-bs-dismiss="modal">Update</button>
          <button type="button" class="btn btn-sm btn-danger" id="delete" data-bs-dismiss="modal">Delete</button>
          <button type="button" id= "close" class="btn btn-dark btn-sm rounded-0" data-bs-dismiss="modal" onclick="reloadPage()">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function reloadPage() {
        location.reload();
    }
</script>
<?php
  $schedules = $conn->query("SELECT * FROM `schedule_list` WHERE device_mac = '$macaddress'");
  $sched_res = [];

  while ($row = $schedules->fetch_assoc()) {
    $event = [
      'id' => $row['id'],
      'title' => $row['title'],
      'description' => $row['description'],
      'start_datetime' => $row['start_datetime'],
      'end_datetime' => $row['end_datetime'],
    ];
    $sched_res[] = $event;
  }
  ?>
  <?php
  if (isset($conn)) $conn->close();
  ?>

  <script>
    var scheds = <?php echo json_encode($sched_res); ?>;
  </script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/navbarmenu.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="../assets/js/calendars.js"></script>


<script>
    var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];

    $(function () {
        if (!!scheds) {
            events = scheds.map(row => ({
                id: row.id,
                title: row.title,
                description: row.description,
                start: row.start_datetime,
                end: row.end_datetime
            }));
        }

        var date = new Date();

        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,dayGridWeek,list',
                center: 'title',
            },
            selectable: true,
            themeSystem: 'bootstrap',
            events: events,
            eventClick: function (info) {
                var _details = $('#edit-note');
                var id = info.event.id;
                var clickedEvent = events.find(event => event.id === id);

                if (clickedEvent) {
                    _details.find('#edit-id').val(clickedEvent.id);
                    _details.find('#edit-title').val(clickedEvent.title);
                    _details.find('#edit-description').val(clickedEvent.description);
                    _details.find('#edit-start').val(moment(clickedEvent.start).format('YYYY-MM-DD'));
                    _details.find('#edit-end').val(moment(clickedEvent.end).format('YYYY-MM-DD'));
                    _details.modal('show');
                } else {
                    // Event not found in local array, fetch it from the server or handle accordingly
                    console.log("Event not found in local array");
                }
            },
            eventDidMount: function (info) {
                // Do Something after events mounted
            },
            editable: true
        });

        calendar.render();

        $('#schedule-form').on('reset', function () {
            $(this).find('input:hidden').val('')
            $(this).find('input:visible').first().focus()
        });

        $('#update').click(function () {
            var id = $('#edit-id').val();
            var title = $('#edit-title').val();
            var description = $('#edit-description').val();
            var start_datetime = $('#edit-start').val();
            var end_datetime = $('#edit-end').val();
        
            $.post('calendar_editqry.php', {
                'edit-id': id,
                'edit-title': title,
                'edit-description': description,
                'edit-start': start_datetime,
                'edit-end': end_datetime
            }, function (response) {
                if (response.status === 'success') {
                    var existingEventIndex = events.findIndex(event => event.id == id);
                    if (existingEventIndex !== -1) {
                        // Update the existing event
                        events[existingEventIndex].title = title;
                        events[existingEventIndex].description = description;
                        events[existingEventIndex].start = start_datetime;
                        events[existingEventIndex].end = end_datetime;
                        calendar.removeAllEvents();
                        calendar.addEventSource(events);
                        Swal.fire({
                            title: 'Success',
                            text: 'Schedule saved successfully!',
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Event not found in the array',
                            icon: 'error'
                        });
                    }
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                }
            }, 'json');
        });

        $('#delete').click(function () {
            var id = $('#edit-id').val();

            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to delete this event?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get('calendar_deleteqry.php', { id: id }, function (response) {
                        if (response.status === 'success') {
                            // Remove the event from the local array
                            events = events.filter(event => event.id != id);
                            calendar.refetchEvents(); // Refresh the calendar events
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success'
                            }).then(() => {
                        // Reload the page after the success message is acknowledged
                        location.reload();
                    });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });
</script>


</body>
</html>