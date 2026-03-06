<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<style>
	body {
		background-color: #fff;
		font-family: Arial, sans-serif;
	}

	.login-container {
		max-width: 520px;

		padding: 2rem;
		background-color: white;
		border-radius: 12px;
		box-shadow: 0 3px 5px #4aa09f;
	}

	.bvite {
		color: #1e8d9c
	}

	.heading {
		color: #0d5774;
		font-weight: 700;
		margin-top: 20px;

	}

	.otp-button {
		background-color: #1e8d9c;
		color: white;
		border: none;
		padding: 0.5rem 1rem;
		border-radius: 6px;
		font-weight: bold;
		transition: background-color 0.3s, color 0.3s;
		cursor: pointer;
	}

	.otp-button:hover {
		background-color: #167382;
		color: #e0e0e0;
	}

	.google-btn {
		display: flex;
		align-items: center;
		justify-content: center;
		background-color: white;
		color: #555;
		border: 1px solid #ddd;
		padding: 10px 20px;
		border-radius: 6px;
		font-weight: 500;
		cursor: pointer;
		transition: background-color 0.3s, box-shadow 0.3s;
		width: 100%;
		max-width: 300px;
		margin: 10px auto;
		text-decoration: none;
	}

	.google-btn:hover {
		background-color: #f0f0f0;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}

	.google-btn img {
		margin-right: 8px;
		width: 20px;
		height: 20px;
	}

	.text-muted a {
		text-decoration: none;
		color: #1e8d9c;
	}

	.text-muted a:hover {
		text-decoration: underline;
	}

	.form {
		padding-top: 30px;
	}

	.form-control {
		padding: 10px;
		border: 1px solid #ddd;
		border-radius: 4px;
		transition: border-color 0.3s;
		width: 100%;
	}

	.form-control:focus,
	.form-control:hover {
		border-color: #1e8d9c;
		outline: none;
		box-shadow: 0 0 5px rgba(30, 141, 156, 0.2);
	}
</style>
<!-- Shiv Web Developer -->

<body>
	<div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
		<div class="login-container">
			<div class="text-center">
				<svg height="40" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill="#1e8d9c" fill-rule="evenodd" clip-rule="evenodd" d="M8.30814 0C6.02576 0 4.33695 1.99763 4.41254 4.16407C4.48508 6.24542 4.39085 8.94102 3.7122 11.1393C3.03153 13.3441 1.88034 14.7407 0 14.92V16.9444C1.88034 17.1237 3.03153 18.5203 3.7122 20.7251C4.39085 22.9234 4.48508 25.619 4.41254 27.7003C4.33695 29.8664 6.02576 31.8644 8.30847 31.8644H31.6949C33.9773 31.8644 35.6658 29.8668 35.5902 27.7003C35.5176 25.619 35.6119 22.9234 36.2905 20.7251C36.9715 18.5203 38.1197 17.1237 40 16.9444V14.92C38.1197 14.7407 36.9715 13.3441 36.2905 11.1393C35.6119 8.94136 35.5176 6.24542 35.5902 4.16407C35.6658 1.99797 33.9773 0 31.6949 0H8.30814Z" />
					<path fill="white" d="M30.0474 8.81267L20.0721 26.7214C19.8661 27.0911 19.337 27.0933 19.128 26.7253L8.95492 8.81436C8.72711 8.41342 9.06866 7.92768 9.52124 8.009L19.5072 9.80102C19.5709 9.81245 19.6361 9.81234 19.6998 9.80069L29.4769 8.01156C29.928 7.92899 30.2711 8.41086 30.0474 8.81267Z" />
					<path fill="#1e8d9c" d="M22.9634 11.0029L18.4147 11.8178C18.3784 11.8243 18.3455 11.8417 18.3211 11.8672C18.2967 11.8927 18.2823 11.9248 18.2801 11.9586L18.0003 16.2791C17.9937 16.3808 18.0959 16.4598 18.2046 16.4369L19.471 16.1697C19.5895 16.1447 19.6966 16.2401 19.6722 16.3491L19.2959 18.0335C19.2706 18.1468 19.387 18.2438 19.5081 18.2101L20.2903 17.9929C20.4116 17.9592 20.5281 18.0564 20.5025 18.1699L19.9045 20.8157C19.8671 20.9812 20.1079 21.0715 20.2083 20.9296L20.2754 20.8348L23.9819 14.0722C24.044 13.959 23.937 13.8299 23.8009 13.8539L22.4974 14.0839C22.3749 14.1055 22.2706 14.0012 22.3052 13.8916L23.156 11.1951C23.1906 11.0854 23.086 10.981 22.9634 11.0029Z" />
				</svg>
				<span class="fw-bold bvite  d-none d-xl-inline-flex ">BVITE</span>
			</div>
			<h3 class="heading text-center">Welcome to My Digital Bricks</h3>
			<p class="text-center text-muted">Sign in to access your account</p>
			<form id="login-form">
				<div class="mb-4 form ">
					<label for="phone" class="form-label">Phone Number</label>
					<div class="input-group">
						<input type="tel" id="phone" class="form-control" placeholder="Enter phone number" required>
						<button type="button" class="otp-button" id="send-otp">Send OTP</button>
					</div>
					<small class="text-muted">You'll receive a 6-digit OTP on this number.</small>
				</div>

				<div class="mb-3" id="otp-section">
					<label for="otp" class="form-label">Enter OTP</label>
					<input type="text" id="otp" class="form-control" placeholder="Enter OTP" required>
				</div>

				<div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="Rememberme">
					<label class="form-check-label" for="Rememberme">Remember this Device</label>
				</div>

				<div class="d-grid gap-2 mb-3">
					<button type="submit" class="otp-button">Login</button>

					<a class="google-btn" href="<?= base_url('auth/google'); ?>">
						<img src="<?= base_url('assets/images/search.png'); ?>" alt="Google Icon">
						Sign in with Google
					</a>
				</div>

				<div class="text-center">
					<span class="text-muted">New to My Digital Bricks? <a href="#">Create an account</a></span>
				</div>
			</form>
		</div>
	</div>
</body>

<!-- Shiv Web Developer -->

</html>