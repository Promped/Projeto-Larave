<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LogisticsPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Camada para a imagem do cerrado com transparência no lado direito */
        .bg-cerrado {
            position: relative;
            background-color: #cfe4fdff; /* Sua cor original */
            overflow: hidden;
        }

        .bg-cerrado::before {
            content: "";
            position: absolute;
            top: 0; 
            left: 0;
            width: 100%; 
            height: 100%;
            /* Ajuste o asset para o nome exato da sua imagem */
            background: url('{{ asset('Projeto-Cerrado-15.png') }}') center center / cover no-repeat;
            opacity: 0.7; /* Aqui você controla a transparência da imagem (0.1 é 10%) */
            z-index: 0;
        }

        .login-content {
            position: relative;
            z-index: 1; /* Garante que o formulário fique na frente da imagem */
        }
        
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid min-vh-100 d-flex align-items-stretch justify-content-center bg-light p-0">
    <div class="row w-100 h-100 flex-nowrap m-0" style="min-height: 100vh;">
        
        <div class="col-md-6 d-none d-md-flex p-0" style="background: #1565c0 url('{{ asset('caminhoes.png') }}') center center / cover no-repeat; min-height: 100vh;">
        </div>

        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center p-5 bg-cerrado" style="min-height: 100vh;">
            
            <div class="w-100 login-content" style="max-width: 350px;">
                <div class="mb-4">
                    <div class="mb-4" style="margin-top: -1.5rem;">
                        <span class="fw-semibold text-uppercase" style="font-size: 1rem; letter-spacing: 2px; color: #1565c0;">LogisticsPro</span>
                    </div>
                    <h3 class="fw-black text-uppercase" style="font-size: 2.5rem; font-weight: 900; color: #222;">Login</h3>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold text-muted small uppercase">E-mail</label>
                        <input type="email" 
                               class="form-control form-control-lg shadow-sm @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                        @error('email')
                        <div class="invalid-feedback font-weight-bold">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold text-muted small uppercase">Senha</label>
                        <input type="password" 
                               class="form-control form-control-lg shadow-sm @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required>
                        @error('password')
                        <div class="invalid-feedback font-weight-bold">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 shadow uppercase tracking-wider">Entrar</button>
                </form>

                <div class="mt-5 text-center">
                    <small class="text-muted fw-bold italic" style="font-size: 0.7rem;">© 2026 LOGISTICSPRO SYSTEM</small>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>