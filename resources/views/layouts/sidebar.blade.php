<aside class="main-sidebar" id="sidebar-wrapper">
	<section class="sidebar">
		<ul class="sidebar-menu">
			@if(Auth::user()->isAdmin())
				@include('layouts.menu-admin')
			@elseif(Auth::user()->isUpt())
				@include('layouts.menu-upt')
			@elseif(Auth::user()->isPimti())
				@include('layouts.menu-pimti')
			@endif
		</ul>
	</section>
</aside>