<!doctype html>
<html class="fixed has-top-menu">
	<head>
    @include('layouts.head')
    @include('layouts.css')
	</head>
	<body>
		<section class="body">
			<div id="overlay" class="overlay" style="display: none;">
				<div class="spinner"></div>
			</div>
			<!-- start: header -->
			<header class="header header-nav-menu header-nav-stripe">
                @include('layouts.top_navbar')
                @include('layouts.top_profile_bar')
			</header>

			<div class="inner-wrapper">
            @yield('content')
            </div>

		</section>
		<div class="modal" id="passwordModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form enctype="multipart/form-data" method="post" action="{{ route('change_password') }}">
					<div class="modal-header">
						<h5 class="modal-title"><b style="color:orange">Change Password</b></h5>
						<a class="btn-close" onclick="closePassModal()" aria-label="Close"></a>
					</div>
					<div class="modal-body">
						@csrf
                        <div class="mb-3">
                            <label class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="new_password_confirmation">
                        </div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Confirm</button>
						<a class="btn btn-default" onclick="closePassModal()">Close</a>
					</div>
					</form>
				</div>
			</div>
		</div>
        @include('layouts.script')
		<script>
			function openPassModal(){
				$("#passwordModal").show()
			}
			function closePassModal(){
				$("#passwordModal").hide()
			}
		</script>
	</body>
</html>
