<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Appointment Calendar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fullcalendar/main.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">

    <!-- Moment.js - Required for FullCalendar -->
    <script src="{{ asset('Admin/plugins/moment/moment.min.js') }}"></script>
    <!-- FullCalendar JS -->
    <script src="{{ asset('Admin/plugins/fullcalendar/main.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('Dokter.Common.Navbar')
    @include('Dokter.Common.Sidebar')
    @yield('DokterContent')
    @include('Dokter.Common.Footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('Admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Admin/dist/js/adminlte.min.js') }}"></script>

<!-- Inisialisasi Kalender -->
<script>
    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');

        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    @if (isset($appointments))
                        @foreach ($appointments as $appointment)
                            {
                                title: '{{ $appointment->patient ? $appointment->patient->name : "Doctor Availability" }}',  <!-- Check if patient exists -->
                                start: '{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i:s') }}',
                                backgroundColor: '#0073b7',
                                borderColor: '#0073b7',
                            },
                        @endforeach
                    @endif
                ],
                dateClick: function(info) {
                    var selectedDate = info.dateStr;
                    window.location.href = '{{ route("dokter.appointments.index") }}?date=' + selectedDate;
                }
            });

            calendar.render();
        } else {
            console.error("Element for calendar not found.");
        }
    });
</script>
</body>
</html>
