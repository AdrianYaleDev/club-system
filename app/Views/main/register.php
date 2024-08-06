<body>
	<div class="container py-4">
		<div class="row">
			<div class="col-lg-6 offset-lg-3">
				<form action="/signup" class="row" id="register">

					<div class="col-12">
						<label for="firstname" class="form-label">First Name</label>
						<input type="text" id="firstname" name="firstname_s" class="form-control">
					</div>

					<div class="col-12">
						<label for="lastname" class="form-label">Last Name</label>	
						<input type="text" id="lastname" name="lastname_s" class="form-control">
					</div>

					<div class="col-12">
						
						<label for="email" class="form-label">Email</label>	
						<input type="text" id="email" name="email_e" class="form-control">
					</div>

					<div class="col-12">
						
						<label for="password" class="form-label">Password</label>	
						<input type="text" id="password" name="password_p" class="form-control">
					</div>

					<div class="col-12">					
						<label for="clubname" class="form-label">Club Name</label>
						<input type="text" id="clubname" name="clubname_s" class="form-control">
					</div>

					<dic class="col-12">					
						<label for="sport" class="form-label">Sport</label>
						<select type="text" id="sport" name="sport_s" class="form-control">
							<option value="1">Hockey</option>
						</select>
					</div>

					<div class="col-12">
						<button type="submit" id="register_submit" class="btn btn-primary">Sign Up</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>