<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Şifreni Değiştir</div>
                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>

                    <a href="{{ route('resetPassword',$token) }}">Buraya tıkla</a>
                </div>
            </div>
        </div>
    </div>
</div>
