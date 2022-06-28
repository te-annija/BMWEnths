<div class="bg-dark text-light" >
    <footer class="container" >

        <div class="row py-3 d-flex justify-content-center">
            <div class="col-sm">
                <ul class="navbar flex-column list-unstyled">
                    <li class="nav-item mb-2">
                        <x-application-logo height="50" class="block w-auto p-1" />
                    </li>
                    <li class="nav-item mb-2 text-center"> <h5>BMW Enthusiasts</h5></li>

                    <li class="nav-item mb-2">
                        <p class="p-0 text-muted text-center ">
                        Place to find like-minded friends and find out about our latest events.
                        </p>
                        <p class="p-0 text-muted text-center "> A CAR MOVES YOU. A BMW TOUCHES YOU.</p>
                    </li>
                </ul>

        </div>
            <div class="col-sm">
                <ul class="navbar flex-column list-unstyled">
                    <li class="nav-item mb-2 text-center"> <h5 >Pages</h5></li>
                    @guest
                    <li class="nav-item mb-2">
                        <a href="/" class="nav-link p-0 text-muted">
                            Welcome
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/login" class="nav-link p-0 text-muted">
                            Login
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/register" class="nav-link p-0 text-muted">
                            Register
                        </a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item mb-2">
                        <a href="/" class="nav-link p-0 text-muted">
                            Welcome
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/profile/{{auth()->user()->profile->id}}" class="nav-link p-0 text-muted">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/post" class="nav-link p-0 text-muted">
                            Blog
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/event" class="nav-link p-0 text-muted">
                            Events
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            <div class="col-sm">
                <ul class="navbar flex-column list-unstyled">
                    <li class="nav-item mb-2 text-center"> <h5 >Find us</h5></li>
                    <li class="nav-item mb-2">
                        <p class="p-0 text-muted">
                            Address: Raiņa bulvāris 19, Rīga, LV-1586
                        </p>
                    </li>
                    <li class="nav-item mb-2">
                            <p class="p-0 text-muted">
                            Phone: +371 22220000
                            </p>
                    </li>
                </ul>
            </div>

        <div class="row d-flex justify-content-center border-top">
                <p class=" text-center py-2">Copyrights Annija Karitone, 2022</p>
        </div>

    </footer>
</div>
