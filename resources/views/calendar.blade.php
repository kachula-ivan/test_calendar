@extends('layouts.head-calendar')
@section('title', 'Календар')
@section('content')
    <!-- Modal Create -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h3 class="modal__title">Розпочати подію</h3>
                <form id="bookingForm" action="{{ route('calendar.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="eventName">Введіть ім'я події</label>
                        <input type="text" class="form-control" placeholder="" id="eventName" name="title">
                    </div>
                    <div class="modal-body">
                        <label for="eventColor">Виберіть колір</label>
                        <input type="color" class="form-control" placeholder="" id="eventColor" name="color">
                    </div>
                    <div class="modal-body">
                        <label for="eventStart">Початок події</label>
                        <input type="datetime-local" class="form-control" placeholder="" id="eventStart"
                               name="start_date">
                    </div>
                    <div class="modal-body">
                        <label for="eventEnd">Кінець події</label>
                        <input type="datetime-local" class="form-control" placeholder="" id="eventEnd" name="end_date">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Вийти</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Create Reminder -->
    <div class="modal fade" id="bookingModal-reminder" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h3 class="modal__title">Розпочати нагадування</h3>
                <form id="bookingForm-reminder" action="{{ route('calendar.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="eventName-reminder">Введіть ім'я нагадування</label>
                        <input type="text" class="form-control" placeholder="" id="eventName-reminder"
                               name="title-reminder">
                    </div>
                    <div class="modal-body">
                        <label for="eventColor-reminder">Виберіть колір</label>
                        <input type="select" class="form-control" placeholder="" id="eventColor-reminder"
                               name="color-reminder">
                    </div>
                    <div class="modal-body">
                        <label for="eventStart-reminder">Початок нагадування</label>
                        <input type="datetime-local" class="form-control" placeholder="" id="eventStart-reminder"
                               name="start_date-reminder">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Вийти</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn-reminder">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Права клавіша миші -->
    <div id="myContextMenu" class="context-menu">
        <ul>
            <li><a id="editMenuItem" href="#">Редагувати подію</a></li>
            <li><a id="deleteMenuItem" href="#">Видалити подію</a></li>
        </ul>
    </div>

    <header class="header">
        <div class="header__container">
            <div class="header__group">
                <div class="logo">
                    <a href="{{ route('home') }}" class="logo-link">
                        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="Лого"/>
                        <span class="logo-text">calendar</span>
                    </a>
                </div>
                <ul class="menu">
                    <li class="menu-item">
                        <a href="{{ route('calendar.index') }}" class="menu-link">календар</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">про нас</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">контакти</a>
                    </li>
                </ul>
                <ul class="header__user">
                    <li class="header__username">
                        <span class="username">{{ Auth::user()->name }}</span>
                        <div class="profile_user">
                            <svg class="icon mail-icon calendar-icon">
                                <use xlink:href="{{ asset('images/icons.svg#user') }}"></use>
                            </svg>
                            <ul class="profile-menu">
                                <li class="profile-item">
                                    <a href="{{ route('profile') }}" class="profile__window-link">Мій профіль</a>
                                </li>
                                <li class="profile-item">
                                    <a href="{{ route('profile.edit') }}" class="profile__window-link">Редагувати
                                        дані</a>
                                </li>
                                <li class="profile-item">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); this.closest('form').submit();"
                                           class="profile-item">Вийти</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div id="calendar"></div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);
            $('#calendar').fullCalendar({
                timeFormat: 'H(:mm)',
                locale: 'uk',
                timeZone: 'UTC',
                customButtons: {
                    Event: {
                        text: '+Подія',
                        click: function (start, end) {
                            $('#bookingModal').modal('toggle');

                            $('#saveBtn').click(function () {
                                var title = $('#eventName').val();
                                var color = $('#eventColor').val();
                                var start_date = $('#eventStart').val();
                                var end_date = $('#eventEnd').val();
                                var user_id = 1;
                                console.log(title);
                                $.ajax({
                                    url: "{{ route('calendar.store') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function () {
                                        $('#bookingModal').modal('hide')
                                        $('#calendar').fullCalendar('renderEvent', {
                                            'title': title,
                                            'end': end_date,
                                            'start': start_date,
                                            'color': color,
                                            'user_id': user_id
                                        });
                                    },
                                });
                            });
                        }
                    },
                    Reminder: {
                        text: '+Нагадування',
                        click: function (start) {
                            $('#bookingModal-reminder').modal('toggle');

                            $('#saveBtn-reminder').click(function () {
                                var title = $('#eventName-reminder').val();
                                var color = $('#eventColor-reminder').val();
                                var start_date = $('#eventStart-reminder').val();
                                var end_date = null;
                                var user_id = 1;
                                console.log(title);
                                console.log(start_date);
                                console.log(color);
                                $.ajax({
                                    url: "{{ route('calendar.store') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    data: {title, color, start_date, end_date, user_id},
                                    success: function (response) {
                                        $('#bookingModal-reminder').modal('hide')
                                        $('#calendar').fullCalendar({
                                            'title': title,
                                            'start': start_date,
                                            'end': end_date,
                                            'color': color,
                                            'user_id': user_id
                                        });
                                    },
                                });
                            });
                        }
                    }
                },

                header: {
                    left: 'today',
                    center: 'prev, title, next',
                    right: 'Event, Reminder'
                },
                footer:{
                    right: 'month, agendaWeek, agendaDay'
                },
                buttonText: {
                    today: 'Сьогодні',
                    month: 'Місяць',
                    agendaWeek: 'Тиждень',
                    agendaDay: 'День'
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDays) {
                    $('#bookingModal').modal('toggle');

                    $('#saveBtn').click(function () {
                        var title = $('#title').val();
                        var start_date = moment(start).format('YYYY-MM-DD HH:mm');
                        var end_date = moment(end).format('YYYY-MM-DD HH:mm');
                        var user_id = 1;

                        $.ajax({
                            url: "{{ route('calendar.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {title, start_date, end_date},
                            success: function (response) {
                                $('#bookingModal').modal('hide')
                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'start': response.start,
                                    'end': response.end,
                                    'color': response.color,
                                    'user_id': user_id
                                });
                            },
                            error: function (error) {
                                if (error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON.errors.title);
                                }
                            },
                        });
                    });
                },
                editable: true,
                eventDrop: function (event) {
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD HH:mm');
                    var end_date = moment(event.end).format('YYYY-MM-DD HH:mm');

                    $.ajax({
                        url: "{{ route('calendar.update', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        data: {start_date, end_date},
                        success: function (response) {
                            console.log('Подію перенесено');
                        },
                        error: function (error) {
                            console.log(error)
                        },
                    });
                },
                eventClick: function (event) {
                    var id = event.id;

                    if (confirm('Ви впевнені що хочете видалити цю подію')) {
                        $.ajax({
                            url: "{{ route('calendar.destroy', '') }}" + '/' + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function (response) {
                                $('#calendar').fullCalendar('removeEvents', response);
                                console.log('Подію під id ' + id + ' видалено');
                            },
                            error: function (error) {
                                console.log(error)
                            },
                        });
                    }
                },
                selectAllow: function (event) {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'month');
                },
            });
            $('#bookingModal').on('hidden.bs.modal', function () {
                $('#saveBtn').unbind();
            });
        });
    </script>
@endsection
