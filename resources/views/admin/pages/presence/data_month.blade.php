@extends('utils.head')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="border-bottom pb-3 mb-5"><i class="ti ti-calendar-month me-2"></i>Données mensuelles</h1>
                <div class="row">
                    <div class="col-6">
                        <select name="month" id="ddlViewBy" class="form-control" onchange="selected()">
                            <option selected disabled>Choisir un mois</option>
                            @foreach ($month as $item)
                                <option value="{{ $item->id_month }}">{{ $item->month }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('month'))
                            <span class="text-danger">{{ $errors->first('month') }}</span>
                        @endif
                    </div>
                    <div class="col-6">
                        <a href="" id="Linked" class="btn btn-danger">Afficher</a>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 d-flex bg-primary py-3 mb-2">
                        <a href="" class="me-3 text-white"><i class="ti ti-file-spreadsheet fs-8"></i>Exporter en
                            XLS</a>
                        <a href="/admin/export-pdf-data-month/{{ $dayly }}" target="_blank" class="text-white me-auto"><i class="ti ti-file-type-pdf fs-8"></i>Exporter en
                            PDF</a>
                        <h3 class="text-white">Données du mois: {{ dateToFrench('06.' . $dayly . '.2024', 'F') }} </h3>
                    </div>
                    <div class="table-responsive mb-5" data-simplebar>
                        <table class="table text-nowrap align-middle table-custom mb-0" id="example">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-dark fw-normal ps-0 text-uppercase">
                                        {{ dateToFrench('06.' . $dayly . '.2024', 'F') }}</th>

                                    @foreach ($alluser as $item)
                                        <th scope="col" class="text-dark text-center fw-normal">
                                            {{ $item->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= $days; $i++)
                                    <tr>
                                        <td class="ps-0">
                                            {{ dateToFrench($i . '.' . $dayly . '.2024', 'j-l') }}
                                        </td>

                                        @foreach ($alluserid as $users)
                                            <td class="text-center">
                                                @foreach ($attendence as $idea)
                                                    @if (date('d', strtotime($idea->date_check)) == $i)
                                                        @if ($idea->id_utilisateurs == $users->id_utilisateurs)
                                                            @if ($idea->time_check < '08:05:00' && $idea->event_check == 'check-in')
                                                                <span
                                                                    class="badge bg-success-subtle text-success">{{ $idea->time_check }}</span>
                                                            @elseif ($idea->time_check > '16:30:00' && $idea->event_check == 'check-out')
                                                                <span
                                                                    class="badge bg-primary-subtle text-primary">{{ $idea->time_check }}</span>
                                                            @elseif ($idea->time_check < '16:30:00' && $idea->event_check == 'check-out')
                                                                <span
                                                                    class="badge bg-danger-subtle text-danger">{{ $idea->time_check }}</span>
                                                            @elseif ($idea->time_check > '08:05:00' && $idea->event_check == 'check-in')
                                                                <span
                                                                    class="badge bg-danger-subtle text-danger">{{ $idea->time_check }}</span>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function selected() {
            var e = document.getElementById("ddlViewBy");
            var value = e.value;
            var text = e.options[e.selectedIndex].value;
            console.log(text);

            var a = document.getElementById('Linked'); //or grab it by tagname etc
            a.href = "/admin/data-month/" + text
        }
    </script>
@endsection
