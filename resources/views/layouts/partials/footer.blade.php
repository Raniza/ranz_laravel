<nav class="navbar navbar-expand-lg bg-body-tertiary border-top mt-5 fixed-bottom">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarForFooter">
            <div class="m-auto">
                <a target="_blank" class="navbar-brand" href="https://www.flaticon.com/free-icons/letter-r"
                    title="letter r icons">
                    <img class="align-middle" src="{{ asset('ranz2.png') }}" width="28" alt="ranz-logo"> <span
                        class="fw-bolder align-middle" style="color: #512DA8">RANZ</span>
                </a>
                <span class="navbar-text align-middle">
                    Signed in as: @auth
                    {{ auth()->user()->name }}
                    @else
                    Guest
                    @endauth
                </span>
            </div>
        </div>
    </div>
</nav>