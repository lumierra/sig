<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Login SIG</title>
		<meta name="description"> <meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="{{ asset('css/masuk/css/vendor.css') }}">
		<link rel="stylesheet" href="{{ asset('css/masuk/css/main.css') }}">
	</head>
	<body ng-app="yapp" class="ng-scope">
		<div>
			<div ui-view="" class="ng-scope">
				<div class="ui-base ng-scope">
					<div ui-view="" class="ng-scope">
						<div class="login-page ng-scope">
							<div class="img-container">
								<div class="text-center pull-right photo">
									<img src="{{ asset('css/masuk/asset/logo.png') }}" class="user-avatar img-circle img-responsive">
									<h1>RSUD LANGSA<br>
									<span>Gizi</span>
									<small><a class="link" href="http://e-rsud.langsakota.go.id">www.e-rsud.langsakota.go.id</a></small>
									</h1>
								</div>
							</div>
							<div class="form-content">
								<form role="form" class="bottom-75 ng-pristine ng-valid" name="login" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="popup" value="true" />
									<div class="table-form">
										<div class="form-groups">
											<div class="form-group">
												<input type="email" class="form-control input-lg" name="email" autocomplete="on" placeholder="ID. PEG / EMAIL">
											</div>
											<div class="form-group">
												<input type="password" class="form-control input-lg" name="password" placeholder="PASSWORD">
											</div>
										</div>
										<div class="button-container">
											<button type="submit" class="btn btn-default login">
											<img src="{{ asset('css/masuk/asset/arrow.png') }}"></button>
										</div>
									</div>
										<div class="remember">
										<label class="checkbox1" for="Option">
											<input id="Option" type="checkbox"> <span></span> </label>
											Simpan password <span class="pass">Lupa password?</span>
									</div><br>
									<center><span>Support by Team IT RSUD Langsa</span></center>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
 	</body>
</html>
