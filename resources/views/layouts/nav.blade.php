<!--section navigation-->
<div class="navigation col-xs-2 ">
	@if(Auth::check())
	<ul class="navigation__sections">		
		<li>
			<a href="{{url('admin/users')}}">
				<i class="icon-people"></i>
				<span>Users</span>
				<ul>
					<li><a href="{{url('users')}}">View Users</a></li>
					<li><a href="{{url('users/add')}}">Add a User</a></li>
				</ul>
			</a>
			
		</li>


		<li>
			<a href="{{url('admin/users')}}">
				<i class="icon-coins"></i>
				<span>Currencies</span>
				<ul>
					<li><a href="{{url('currency')}}">Set Default Currency</a></li>
					
				</ul>
			</a>
		</li>
	</ul>
	@endif
</div>
<!--//section navigation-->	