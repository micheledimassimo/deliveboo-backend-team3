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
    #notfound {
        min-height: 100vh;
    }

    img{
        max-width: 100%;
    }

    .notfound-error {
        font-size: 5rem;
        font-family: "Knewave", system-ui;
    }


    </style>
</head>
<body>


    <div id="notfound" class="d-flex align-items-center justify-content-center">
        <h1 class="text-center">
            <div class="notfound-error text-warning d-flex align-items-center justify-content-center mb-3">
                4<span>
                <img class="mx-1" src="/DELIVEBOO.png" alt="deliveboo">
                </span>4
            </div>
            <div class="notfound-error mb-3">
                Not found :(
            </div>
            <button class="btn btn-outline-dark border-dark-subtle rounded-pill px-4 fw-bold fs-4">
                <a class="nav-link p-0 text-warning" href="{{ url('/login') }}">Torna alla dashboard</a>
            </button>
        </h1>
        
    </div>

    
</body>
</html>