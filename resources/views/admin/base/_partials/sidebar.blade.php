<aside class="sidebar">
    <nav class="sidebar-nav">
        <ul class="sidebar-nav__list">

            <li class="sidebar-nav__item">
                <a href="{{route('admin.home')}}" class="sidebar-nav__link {{ Str::startsWith(Route::current()->getName(),'admin.home')  ? 'sidebar-nav__link--active' : '' }}">
                    <span class="sidebar-nav__text">Главная</span>
                </a>
            </li>
            <li class="sidebar-nav__item">
                <a href="{{route('admin.orders')}}" class="sidebar-nav__link {{ Str::startsWith(Route::current()->getName(),'admin.orders')  ? 'sidebar-nav__link--active' : '' }}">
                    <span class="sidebar-nav__text">Заказы</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
