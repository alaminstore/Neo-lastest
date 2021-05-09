<nav class="kreen-MyAccount-navigation">
	<ul>
		<li class="kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--dashboard {{url()->current() == route('dashboard') ? 'is-active' : ''}}">
			<a href="{{route('dashboard')}}">Dashboard</a>
		</li>
		<li class="kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--orders {{url()->current() == route('orders') ? 'is-active' : ''}}">
			<a href="{{route('orders')}}">Orders</a>
		</li>
		<li class="kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--downloads {{url()->current() == route('favorites') ? 'is-active' : ''}}">
			<a href="{{route('favorites')}}">Favorites</a>
		</li>
		<li class="kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--edit-address {{url()->current() == route('address') ? 'is-active' : ''}}">
			<a href="{{route('address')}}">Addresses</a>
		</li>
		<li class="kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--edit-account {{url()->current() == route('account.details') ? 'is-active' : ''}}">
			<a href="{{route('account.details')}}">Account details</a>
		</li>
		<li class="kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--customer-logout">
            <a class="dash-log" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </li>
	</ul>
</nav>
