<div class="bg-dark text-light" >
    <footer class="container" >

        <div class="row py-3 d-flex justify-content-center">
            <div class="col-sm">
                <ul class="navbar flex-column list-unstyled">
                    <li class="nav-item mb-2">
                        <x-application-logo height="50" class="block w-auto p-1" />
                    </li>
                    <li class="nav-item mb-2 text-center"> <h5>{{__('messages.app_name')}}</h5></li>

                    <li class="nav-item mb-2">
                        <p class="p-0 text-muted text-center ">
                        {{__('messages.app_description')}}
                        </p>
                        <p class="p-0 text-muted text-center "> {{__('messages.app_slogan')}}</p>
                    </li>
                </ul>

        </div>
            <div class="col-sm">
                <ul class="navbar flex-column list-unstyled">
                    <li class="nav-item mb-2 text-center"> <h5 >{{__('messages.pages')}}</h5></li>
                    @guest
                    <li class="nav-item mb-2">
                        <a href="/" class="nav-link p-0 text-muted">
                            {{__('messages.welcome')}}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/login" class="nav-link p-0 text-muted">
                            {{__('messages.login')}}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/register" class="nav-link p-0 text-muted">
                            {{__('messages.register')}}
                        </a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item mb-2">
                        <a href="/" class="nav-link p-0 text-muted">
                            {{__('messages.welcome')}}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/profile/{{auth()->user()->profile->id}}" class="nav-link p-0 text-muted">
                            {{__('messages.profile')}}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/post" class="nav-link p-0 text-muted">
                            {{__('messages.blog')}}
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/event" class="nav-link p-0 text-muted">
                            {{__('messages.events')}}
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            <div class="col-sm">
                <ul class="navbar flex-column list-unstyled">
                    <li class="nav-item mb-2 text-center"> <h5 >{{__('messages.find_us')}}</h5></li>
                    <li class="nav-item mb-2">
                        <p class="p-0 text-muted">
                            {{__('messages.address')}}: Raiņa bulvāris 19, Rīga, LV-1586
                        </p>
                    </li>
                    <li class="nav-item mb-2">
                            <p class="p-0 text-muted">
                            {{__('messages.phone')}}: +371 22220000
                            </p>
                    </li>
                </ul>
            </div>

        <div class="row d-flex justify-content-center border-top">
                <p class=" text-center py-2">Copyrights Annija Karitone, 2022</p>
        </div>

    </footer>
</div>
