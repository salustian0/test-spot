<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($title) ? $title . ' | Test spot' : 'Test spot' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
</head>
<body>
<div class="loading">
    <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<header>
    <!-- Imagem e texto -->
    <nav class="navbar navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">
            <svg xmlns="http://www.w3.org/2000/svg" width="148" height="35" viewBox="0 0 148 35"> <g> <g> <g> <path fill="#585857" d="M13.305 33.451C4.32 31.258-1.187 22.195 1.006 13.21 3.2 4.224 12.262-1.283 21.248.91c8.986 2.194 14.492 11.257 12.299 20.243-2.194 8.985-11.256 14.492-20.242 12.298z"></path> </g> <g> <path fill="#585857" d="M51.09 33.451c-8.986-2.193-14.493-11.256-12.3-20.241C40.985 4.224 50.048-1.283 59.033.91c8.986 2.194 14.493 11.257 12.3 20.243-2.194 8.985-11.257 14.492-20.243 12.298z"></path> </g> <g> <path fill="#585857" d="M126.752 33.968c-8.986-2.194-14.492-11.256-12.299-20.242C116.647 4.74 125.71-.766 134.695 1.427c8.986 2.194 14.492 11.256 12.299 20.242-2.194 8.986-11.256 14.492-20.242 12.299z"></path> </g> <g> <path fill="#bd0d2e" d="M88.97 33.451c-8.987-2.193-14.493-11.256-12.3-20.241C78.864 4.224 87.926-1.283 96.912.91c8.986 2.194 14.492 11.257 12.299 20.243-2.193 8.985-11.256 14.492-20.242 12.298z"></path> </g> <g> <path fill="#fff" d="M14.85 8.008h10.7v3.477H15.499c-2.12 0-3.18.845-3.18 2.534 0 .718.242 1.24.727 1.563.467.36 1.087.539 1.86.539h5.364c1.041 0 1.967.072 2.776.216.736.161 1.495.597 2.277 1.307s1.172 2.026 1.172 3.948c0 .522-.04 1.002-.12 1.442-.082.44-.243.957-.486 1.55-.242.593-.656 1.114-1.24 1.563-.584.45-1.28.764-2.089.944-.737.197-1.689.296-2.857.296H8.867V23.91h10.189c1.005 0 1.782-.148 2.33-.445.549-.296.823-.857.823-1.684v-.404c-.054-.557-.198-.962-.432-1.213a2.36 2.36 0 0 0-1.04-.54 6.236 6.236 0 0 0-1.39-.134H14.54c-2.07 0-3.669-.431-4.794-1.294-1.125-.862-1.687-2.308-1.687-4.34 0-1.023.17-1.94.512-2.748.34-.809.808-1.433 1.401-1.873a5.48 5.48 0 0 1 2.049-.93c.7-.198 1.644-.297 2.83-.297z"></path> </g> <g> <path fill="#fff" d="M56.46 11.485c1.222 0 2.179.193 2.87.58.692.386 1.038 1.145 1.038 2.277 0 1.887-1.23 2.83-3.692 2.83h-4.932v-5.687h4.716zm-4.716 9.11h7.223c.305 0 .61-.031.917-.095.305-.063.713-.162 1.226-.297.511-.136 1.095-.451 1.752-.948.655-.496 1.159-1.186 1.509-2.07.35-.885.525-1.823.525-2.816a7.412 7.412 0 0 0-.673-3.14c-.45-.974-1.123-1.714-2.022-2.22-.683-.432-1.465-.708-2.345-.825-.88-.117-1.994-.176-3.342-.176h-8.84v19.38h4.07z"></path> </g> <g> <path fill="#fff" d="M132.812 27.387h-4.232V11.431h-6.199V8.062h16.684v3.37h-6.253z"></path> </g> </g> </g> </svg>
            | <span class="text-dark">Teste tecnico (Renan Salustiano)</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('/category')}}">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/product')}}">Produtos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="p-2">
        @stack('breadcrumb')
    </div>

</header>
<main class="container">
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4bc15c2656.js" crossorigin="anonymous"></script>
<script>

    function setActiveLink() {
        const currentUrl = "{{ request()->url() }}";
        const links = document.querySelectorAll('.nav-link');

        links.forEach(link => {

            if (link.href.replace(/\/$/, '') === currentUrl) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function(){
        document.querySelector('.loading').style.display = 'none'

        //Delete script
        const frmDelete = document.querySelector('#frm-delete');
        const btnYes = document.querySelector('#btn-yes');
        const modalDelete = document.querySelector('#modalDelete')


        modalDelete.addEventListener('shown.bs.modal', (e) => {
            const btnTrigger = e.relatedTarget;
            if(btnTrigger){
                const id = btnTrigger.getAttribute('id')
                frmDelete.action = `{{request()->url()}}/${id}`;
            }
        });

        if(btnYes){
            btnYes.addEventListener('click', () => {
                if(frmDelete)
                    frmDelete.submit();
            })
        }
        //Delete script

    })

    window.onload = () => {
        setActiveLink();
        document.querySelector('.loading').style.display = 'none'
    }

</script>

@stack('scripts')
</body>
</html>
