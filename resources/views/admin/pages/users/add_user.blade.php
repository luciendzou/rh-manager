@extends('utils.head')
@section('content')
    <div class="p-3">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/admin/adding-user">
                    @csrf
                    <div class="row">
                        <h1 class="mb-5 border-bottom pb-2"><i class="ti ti-users-plus me-2"></i> Ajout d'un utilisateur</h1>
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex w-100 mb-5" role="alert">
                            <strong>Erreur ! </strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show d-flex w-100 mb-5" role="alert">
                                <strong>Félécitations ! </strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                        @endif
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom Complet</label>
                            <input type="text" name="name" class="form-control">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Téléphone</label>
                            <input type="tel" name="phone" class="form-control">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Poste</label>
                            <input type="text" name="poste" class="form-control">
                            @if ($errors->has('poste'))
                                <span class="text-danger">{{ $errors->first('poste') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Localisation</label>
                            <select name="location" id="location" class="form-control">
                                <option selected disabled>Choisir une option</option>
                                <option value="Direction Generale">Direction Generale</option>
                                <option value="Agence Yaounde">Agence Yaounde</option>
                                <option value="Agence Douala">Agence Douala</option>
                                <option value="Agence Garoua">Agence Garoua</option>
                            </select>
                            @if ($errors->has('location'))
                                <span class="text-danger">{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Sexe utilisateur</label>
                            <select name="sexe" id="sexe" class="form-control">
                                <option selected disabled>Choisir une option</option>
                                <option value="M">Masculin</option>
                                <option value="F">Feminin</option>
                            </select>
                            @if ($errors->has('sexe'))
                                <span class="text-danger">{{ $errors->first('sexe') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Rôle utilisateur</label>
                            <select name="role" id="role" class="form-control">
                                <option selected disabled>Choisir une option</option>
                                <option value="admin">Administrateur</option>
                                <option value="user">Utilisateur simple</option>
                                <option value="superadmin">Super Administrateur</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Matricule</label>
                            <input type="text" name="matricule" class="form-control">
                            @if ($errors->has('matricule'))
                                <span class="text-danger">{{ $errors->first('matricule') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Code utilisateur</label>
                            <input type="text" name="code" value="{{ $code }}" class="form-control" readonly
                                style="background: rgba(128, 128, 128, 0.096)">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" value="{{ $password }}" readonly
                                style="background: rgba(128, 128, 128, 0.096)">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
