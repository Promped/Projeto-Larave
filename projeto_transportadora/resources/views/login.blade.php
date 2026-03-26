<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid min-vh-100 d-flex align-items-stretch justify-content-center bg-light p-0">
    <div class="row w-100 h-100 flex-nowrap m-0" style="min-height: 100vh;">
        <!-- Lado da imagem -->
        <div class="col-md-6 d-none d-md-flex p-0" style="background: #1565c0 url('{{ asset('caminhoes.png') }}') center center / cover no-repeat; min-height: 100vh; min-width: 0;">
        </div>
        <!--formulário -->
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center p-5" style="min-height: 100vh; min-width: 0; background: #cfe4fdff;">
            <div class="w-100" style="max-width: 350px;">
                <div class="mb-4">
                    <div class="mb-4" style="margin-top: -1.5rem;">
                        <span class="fw-semibold" style="font-size: 1.1rem; letter-spacing: 1px; color: #222;">LogisticsPro</span>
                    </div>
                    <h3 class="fw-bold" style="font-size: 2rem;">Login</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
