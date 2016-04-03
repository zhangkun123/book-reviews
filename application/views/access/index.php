<h1 class="page-header"> Welcome to Book Reviews</h1>
<div class="row">
	<div class="col-md-5">
		<h3>Registration</h3>
		<div>
			<form action="access/register" method="post" class="well">
				<div class="form-group">
					<label>First name</label>
					<input type="text" name="first_name" class="form-control" >
				</div>
				<div class="form-group">
					<label>Last name</label>
					<input type="text" name="last_name" class="form-control" >
				</div>
				<div class="form-group">
					<label>User Name</label>
					<input type="email" name="username" placeholder="someone@xxx.com" class="form-control" >
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<label>Password Confirmation</label>
					<input type="password" name="password_conf" class="form-control">
				</div>
				<input type="submit" name="form_action" value="Register" class="btn btn-primary">
			</form>
		</div>
	</div>
	<div class="col-md-5">
		<h3>Already a member ? !!! Please Login</h3>
			<form action="/access/login" method="post" class="well">
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="username" class="form-control" >
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<input type="submit" name="form_action" value="Login" class="btn btn-primary">
			</form>
	</div>
</div>
