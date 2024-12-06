<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Knewave&display=swap" rel="stylesheet">
    <title>403 Forbidden</title>

    @vite('resources/js/app.js')
    <style scoped>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 10%;
        }
        p {
            font-size: 1.5rem;
            color: #555;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }

        #notfound{
        min-height: 100vh;
        }

        .logo-big {
            max-width: 100%;
            max-height: 100%;
        }

        .error {
            font-size: 6rem;
            font-family: "Knewave", system-ui;
        }

    </style>
</head>
<body>
    
    <div id="notfound" class="d-flex align-items-center justify-content-center">
        <h1 class="text-center">
            <div class="error text-warning d-flex align-items-center justify-content-center mb-3">
                4<span>
                <img class="mx-1 logo-big" src="/DELIVEBOO.png" alt="deliveboo">
                </span>3
            </div>
            <p>Non hai l'autorizzazione per visualizzare questa pagina.</p>
            {{-- <a class="nav-link p-0 text-warning" href="{{ url('/login') }}">Torna alla dashboard</a> --}}
            <button class="btn btn-outline-dark border-dark-subtle rounded-pill px-4 fw-bold fs-4">
                <a class="nav-link p-0 text-warning" href="{{ url('/login') }}">Torna alla dashboard</a>
            </button>
        </h1>
    </div>
</body>
</html>