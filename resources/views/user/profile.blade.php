@extends('partials.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-6">
                    <div class="card-header mb-0">
                        <h5 class="card-title">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.password') }}">
                            @csrf
                            @method('PUT')
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">New Password</label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        autofocus="" required>
                                    @error('password')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" required>
                                    @error('password_confirmation')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-6 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form action={{ route('users.deactivate') }} method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-check my-8 ms-2">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" required>
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
