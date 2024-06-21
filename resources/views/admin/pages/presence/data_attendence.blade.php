@extends('utils.head')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="border-bottom pb-3 mb-5">
                    <i class="ti ti-brand-databricks me-2"></i>
                    Données des présences
                </h1>

                <div class="row">
                    <div class="col-6">
                        <label for="exampleInputEmail1" class="form-label">Date début</label>
                        <input type="date" id="date_start" value="{{ $from }}" class="form-control">
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail1" class="form-label">Date fin</label>
                        <input type="date" id="date_end" value="{{ $to }}" class="form-control">
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-danger" onclick="geted()">Afficher</button>
                    </div>
                    <div class="col-12 mt-3">
                        <h4>Du
                            {{ dateToFrench($from, 'j F Y') }} au {{ dateToFrench($to, 'j F Y') }}</h4>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex bg-primary py-3 mb-2">
                        <a href="" class="me-3 text-white"><i class="ti ti-file-spreadsheet fs-8"></i>Exporter en
                            XLS</a>
                        <a href="" class="me-3 text-white"><i class="ti ti-file-type-pdf fs-8"></i>Exporter en
                            PDF</a>
                    </div>
                    <div class="table-responsive mb-5" data-simplebar>
                        <table class="table text-nowrap align-middle table-custom mb-0" id="example">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-dark fw-normal ps-0">Utilisateurs
                                    </th>
                                    <th scope="col" class="text-dark fw-normal">Dates</th>
                                    <th scope="col" class="text-dark fw-normal">Heures</th>
                                    <th scope="col" class="text-dark fw-normal">Localisation</th>
                                    <th scope="col" class="text-dark fw-normal">Evenements</th>
                                    <th scope="col" class="text-dark fw-normal">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendence as $item)
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center gap-6">
                                                <img src="{{ asset('assets/images/products/dash-prd-1.jpg') }}" alt="prd1"
                                                    width="48" class="rounded" />
                                                <div>
                                                    <h6 class="mb-0">{{ $item->name }}</h6>
                                                    <span>{{ $item->poste }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{ $item->date_check }}</span>
                                        </td>
                                        <td>
                                            @if ($item->time_check < '08:05:00' && $item->event_check == 'check-in')
                                                <span
                                                    class="badge bg-success-subtle text-success">{{ $item->time_check }}</span>
                                            @elseif ($item->time_check > '16:30:00' && $item->event_check == 'check-out')
                                                <span
                                                    class="badge bg-primary-subtle text-primary">{{ $item->time_check }}</span>
                                            @elseif ($item->time_check < '16:30:00' && $item->event_check == 'check-out')
                                                <span
                                                    class="badge bg-danger-subtle text-danger">{{ $item->time_check }}</span>
                                            @elseif ($item->time_check > '08:05:00' && $item->event_check == 'check-in')
                                                <span
                                                    class="badge bg-danger-subtle text-danger">{{ $item->time_check }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-dark">{{ $item->location }}</span>
                                        </td>
                                        <td>
                                            @if ($item->event_check == 'check-in')
                                                <i class="ti ti-arrows-up text-success"></i>
                                                <span class="text-dark">{{ $item->event_check }}</span>
                                            @else
                                                <i class="ti ti-arrows-down text-primary"></i>
                                                <span class="text-dark">{{ $item->event_check }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->time_check > '08:05:00' && $item->event_check == 'check-in')
                                                <span class="text-danger">En retard</span>
                                            @elseif ($item->time_check < '16:30:00' && $item->event_check == 'check-out')
                                                <span class="text-danger">Rentrer trop tôt</span>
                                            @else
                                                <span class="text-success">Correct</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function geted() {
            var e = document.getElementById("date_end");
            var s = document.getElementById("date_start");
            var valueE = e.value;
            var valueS = s.value;
            console.log(valueE);
            console.log(valueS);

            const queryString = window.location.origin;
            console.log(queryString);
            window.location = queryString+"/admin/data-attendence/"+valueS+"/"+valueE;
        }
    </script>
@endsection
