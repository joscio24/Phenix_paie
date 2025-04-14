@extends('layouts.auth')

@section('content')


<div class="login-page bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="mb-3"><img src="/assets/img/PHENIX_LOGO.png" width="140px" height="auto" alt="logo"></div>
                <h5 class="mb-3">Se Connecter</h5>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <form method="POST" action="{{ route('login') }}" class="row g-4">
                                    @csrf
                                    <div class="col-12">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fa fa-person-fill"></i></div>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Saisir email">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label>Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                            <label class="form-check-label" for="inlineFormCheck">Rester connecté</label>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                            <a href="#" class="float-end text-primary">Mot de passe ?</a>
                                        </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4 float-end mt-4">Connexion</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block ">
                            <img src="/assets/img/employee.png" style="position:absolute; top: -90px; right: 20px; border-radius: 26px; " width="350px" height="auto" alt="">
                        </div>
                    </div>
                </div>
                <p class="text-end text-secondary mt-3"></p>
            </div>
        </div>
    </div>
</div>


@endsection
