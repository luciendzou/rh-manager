@extends('utils.head')
@section('content')
<div class="container-fluid">

    <div class="row">
        @foreach ($allUser as $item)
        <div class="col-lg-3">
            <div class="card overflow-hidden hover-img">
                <div class="position-relative">
                    <div style="height: 100px; width: 100%; display: block; background: rgb(2, 88, 218)">

                    </div>
                    <img src="../assets/images/profile/user-3.jpg" alt="matdash-img"
                        class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="80"
                        height="80" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Georgeanna Ramero">
                </div>
                <div class="card-body p-4">
                    <a class="d-block my-4 fs-4 text-dark fw-semibold" >
                        {{ Str::limit($item->name,18) }} <br>
                        <span style="font-size: 10px"><i class="ti ti-user text-dark fs-5"></i>{{ $item->poste }}</span>
                    </a>
                    <div class="d-flex align-items-center gap-4">
                        <a class="d-flex align-items-center fs-2 ms-auto" href="/admin/user-detail/{{ $item->code }}">
                            <i class="ti ti-eye text-dark fs-5"></i>view
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
