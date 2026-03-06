<!-- Filter Modal -->
<!-- Shiv Web Developer -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="filterModalLabel">Filter Companies</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<form>
					<div class="row g-3">

						<div class="col-md-4">
							<label class="form-label">Work Type</label>
							<input type="text" class="form-control" placeholder="Work Type">
						</div>

						<div class="col-md-4">
							<label class="form-label">Location</label>
							<input type="text" class="form-control" placeholder="Location">
						</div>

						<div class="col-md-4">
							<label class="form-label">Project Revenue</label>
							<input type="text" class="form-control" placeholder="Project Revenue">
						</div>

						<div class="col-md-4">
							<label class="form-label">Country</label>
							<input type="text" class="form-control" placeholder="Country">
						</div>

						<div class="col-md-4">
							<label class="form-label">State</label>
							<input type="text" class="form-control" placeholder="State">
						</div>

						<div class="col-md-4">
							<label class="form-label">Range</label>
							<input type="text" class="form-control" placeholder="Range">
						</div>

						<div class="col-md-4">
							<label class="form-label">Skills</label>
							<input type="text" class="form-control" placeholder="Skills">
						</div>

						<div class="col-md-4">
							<label class="form-label">Industry</label>
							<input type="text" class="form-control" placeholder="Industry">
						</div>

						<div class="col-md-4">
							<label class="form-label">Department</label>
							<input type="text" class="form-control" placeholder="Department">
						</div>

						<div class="col-md-4">
							<label class="form-label">Education</label>
							<input type="text" class="form-control" placeholder="Education">
						</div>

						<div class="col-md-4">
							<label class="form-label">Select Type of Bricks</label>
							<select class="form-select">
								<option selected>-- Select --</option>
								<option>Brick A</option>
								<option>Brick B</option>
							</select>
						</div>

						<div class="col-md-4">
							<label class="form-label">Execution Time</label>
							<input type="text" class="form-control" placeholder="Execution Time">
						</div>

						<!-- Radio Options -->
						<div class="col-md-12">
							<label class="form-label d-block">Execution Time Unit</label>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="timeUnit" value="seconds">
								<label class="form-check-label">Seconds</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="timeUnit" value="minutes">
								<label class="form-check-label">Minutes</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="timeUnit" value="hours">
								<label class="form-check-label">Hours</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="timeUnit" value="days">
								<label class="form-check-label">Days</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="timeUnit" value="week">
								<label class="form-check-label">Week</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="timeUnit" value="month">
								<label class="form-check-label">Month</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="timeUnit" value="years">
								<label class="form-check-label">Years</label>
							</div>
						</div>

						<!-- Monetization Range -->
						<div class="col-md-12">
							<label class="form-label d-block">Monetization Range</label>
							<div class="d-flex gap-4">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="monetization" id="durationRadio">
									<label class="form-check-label" for="durationRadio">Duration</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="monetization" id="fixedRadio">
									<label class="form-check-label" for="fixedRadio">Fixed Price</label>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-md-6">
									<select class="form-select">
										<option>Select Time Unit</option>
									</select>
								</div>
								<div class="col-md-6">
									<select class="form-select">
										<option>Select Option</option>
									</select>
								</div>
							</div>
						</div>

					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Apply Filter</button>
			</div>

		</div>
	</div>
</div>

<!-- Shiv Web Developer -->
<script src="<?= base_url() ?>assets/bundles/libscripts.bundle.js"></script>
<script src="<?= base_url() ?>assets/bundles/tagify.bundle.js"></script>
<script src="<?= base_url() ?>assets/bundles/flatpickr.bundle.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script src="<?= base_url() ?>assets/bundles/dataTables.bundle.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
	const userPaymentBtn = document.querySelector("#userPaymentBtn");
	userPaymentBtn?.addEventListener('click', function(e) {
		e.preventDefault();
		e.target.innerHTML = "Processing...";
		fetch('<?= base_url('CompanyAuth/userPayment') ?>', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					user_id: 1,
				})
			})
			.then(response => response.json())
			.then(data => {
				if (data.success && data.razorpay_order_id) {
					console.log("Payment data", data);
					const options = {
						key: data.st_razorpay_api_key,
						amount: data.amount,
						currency: data.currency,
						order_id: data.razorpay_order_id,
						handler: async function(response) {
							const verifyResponse = await fetch('<?= base_url() ?>/CompanyAuth/handle_payment_response', {
								method: 'POST',
								headers: {
									'Content-Type': 'application/json'
								},
								body: JSON.stringify(response),
							});
							const verifyData = await verifyResponse.json();
							alert(verifyData.message);
							if (verifyData.success) {
								window.location.href = "<?= base_url() ?>user/payment/success?id=" + data.razorpay_order_id;
							}
						},
						theme: {
							color: '#0b5ed7'
						},
					};
					const razorpay = new Razorpay(options);
					razorpay.open();
					// showFormMsg('success', data.message);
					// window.location.href = "thankyou";
				} else {
					showFormMsg('danger', data.message);
				}
			})
			.catch(error => {
				console.error('Error:', error);
				alert('There was an issue submitting the form.');
			});
	});
</script>


<script>
	document.querySelectorAll('input[type="password"]').forEach((input) => {
		// Create wrapper div to hold input and button
		const wrapper = document.createElement('div');
		wrapper.style.position = 'relative';
		wrapper.style.display = 'inline-block';

		// Insert wrapper before input and move input inside it
		input.parentNode.insertBefore(wrapper, input);
		wrapper.appendChild(input);

		// Create eye toggle button
		const toggleBtn = document.createElement('button');
		toggleBtn.type = 'button';
		toggleBtn.innerHTML = '👁️'; // You can replace this with an SVG/icon
		toggleBtn.style.position = 'absolute';
		toggleBtn.style.right = '5px';
		toggleBtn.style.top = '50%';
		toggleBtn.style.transform = 'translateY(-50%)';
		toggleBtn.style.background = 'none';
		toggleBtn.style.border = 'none';
		toggleBtn.style.cursor = 'pointer';
		toggleBtn.style.fontSize = '16px';

		// Append button to wrapper
		wrapper.appendChild(toggleBtn);

		// Toggle password visibility
		toggleBtn.addEventListener('click', () => {
			input.type = input.type === 'password' ? 'text' : 'password';
			toggleBtn.innerHTML = input.type === 'password' ? '👁️' : '🙈';
		});
	});
</script>

<script>
	var input = document.querySelector('input[name=skills]');
	new Tagify(input);


	var input = document.querySelector('input[name="brick_type"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"Silver Brick (0 - 1000 INR)",
				"Golden Brick (1000 INR to 10,000 INR)",
				"Platinum Brick (10,000 INR to 1,00,000 INR)",
				"Titanium Brick (1,00,000 INR to 10,00,000 INR)",
				"Vibranium Brick (10,00,000 INR to 100,000,000 INR)",
				"Palladium Brick (10000000 INR to 100000000 INR)",
				"Jarcodonium Brick (100000000 INR to 1000000000 INR)"
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})

	var input = document.querySelector('input[name="filter-range"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"₹1000 - ₹5000",
				"₹5000 - ₹10000",
				"₹10000 - ₹50000000",
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})
	var input = document.querySelector('input[name="filter-revenue"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"₹1000000 - ₹5000000",
				"₹5000000 - ₹10000000",
				"₹10000000 - ₹50000000",
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})
	var input = document.querySelector('input[name="filter_state"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"Any",
				"Madhya Pradesh",
				"Maharashtra",
				"Uttar Pradesh",
				"Gujrat",
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})
	var input = document.querySelector('input[name="filter_country"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"Any",
				"India",
				"USA",
				"UAE",
				"Australia",
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})
	var input = document.querySelector('input[name="category"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"IT Industry",
				"Medical",
				"Finance & Accounting",
				"Marketing & Advertising",
				"Education & Training",
				"Construction & Engineering",
				"E-commerce & Retail",
				"Legal Services",
				"Telecommunications",
				"Media & Entertainment",
				"Real Estate",
				"Hospitality & Tourism",
				"Automotive Industry",
				"Manufacturing & Production",
				"HR & Recruitment"
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})

	var input = document.querySelector('input[name="filter-category"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"IT Industry",
				"Medical",
				"Finance & Accounting",
				"Marketing & Advertising",
				"Education & Training",
				"Construction & Engineering",
				"E-commerce & Retail",
				"Legal Services",
				"Telecommunications",
				"Media & Entertainment",
				"Real Estate",
				"Hospitality & Tourism",
				"Automotive Industry",
				"Manufacturing & Production",
				"HR & Recruitment"
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})
	var input = document.querySelector('input[name="filter-department"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"R&D & Innovation",
				"Vendor listing",
				"Manufacturing",
				"Production",
				"Quality check",
				"Warehousing/storage",
				"Logistics /Supply chain",
				"Operational",
				"Investor relations",
				"HR",
				"Sales",
				"Marketing",
				"Account",
				"Public relation",
				"Management",
				"Top Leaders",
				"Growth strategy /Merger-acquisition",
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})
	var input = document.querySelector('input[name="filter-work"]'),
		tagify = new Tagify(input, {
			whitelist: [
				"Onsite",
				"Remote",
			],

			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})

	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}

	$(".f-date-disable").flatpickr({
		disable: ["2023-04-24", "2023-05-17", "2025-03-08", new Date(2025, 4, 9)],
		dateFormat: "F d, Y",
	});
</script>

<!-- Shiv Web Developer -->
<script>
	jQuery(function() {

		// Revenue and Cost
		initApexChart(document.querySelector("#apex-MyAnalytics"), {
			series: [{
				name: 'Revenue',
				data: [13, 23, 20, 8, 13, 27, 33, 12, 67, 22, 43, 21, ]
			}, {
				name: 'Cost',
				data: [44, 55, 41, 67, 22, 43, 21, 49, 13, 23, 20, 8, ]
			}],
			chart: {
				type: 'bar',
				height: 240,
				stacked: true,
				//stackType: '100%',
				toolbar: {
					show: false,
				},
			},
			colors: ['var(--theme-color1)', 'var(--accent-color)'],
			responsive: [{
				breakpoint: 480,
				options: {
					legend: {
						position: 'bottom',
						offsetX: -10,
						offsetY: 0
					}
				}
			}],
			xaxis: {
				categories: ['Jan', 'Feb', 'Marc', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
			},
			yaxis: {
				labels: {
					style: {
						colors: ['#ffffff'],
					}
				}
			},
			fill: {
				opacity: 1
			},
			dataLabels: {
				enabled: false,
			},
			legend: {
				position: 'bottom',
			},
			tooltip: {
				y: [{
					title: {
						formatter: function(val) {
							return val + " (K)"
						}
					}
				}, {
					title: {
						formatter: function(val) {
							return val + " (K)"
						}
					}
				}]
			},
		});

		// Sales Analytics
		initApexChart(document.querySelector("#apex-SalesAnalytics"), {
			series: [{
				name: 'Mobile',
				data: [31, 40, 28, 51, 42, 109, 100, 40, 28, 51, 42, 22]
			}, {
				name: 'Web',
				data: [11, 32, 42, 109, 100, 40, 28, 45, 32, 34, 52, 41]
			}],
			chart: {
				height: 270,
				type: 'area',
				toolbar: {
					show: false,
				}
			},
			colors: ['var(--theme-color2)', 'var(--theme-color5)'],
			fill: {
				type: "gradient",
				gradient: {
					//shade: "dark",
					//type: "horizontal",
					shadeIntensity: 0.5,
					gradientToColors: ['var(--theme-color2)', 'var(--theme-color5)'],
					inverseColors: true,
					opacityFrom: 1,
					opacityTo: 0.3,
					stops: [0, 100]
				}
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				curve: 'smooth',
				width: 1,
			},
			xaxis: {
				categories: ["Jan", "Feb", "March", "April", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec", ]
			},
		});

		// Team Performance
		initApexChart(document.querySelector("#apex-TeamPerformance"), {
			chart: {
				height: 240,
				type: "radialBar",
			},
			series: [67],
			colors: ["var(--theme-color1)"],
			plotOptions: {
				radialBar: {
					startAngle: -90,
					endAngle: 90,
					track: {
						background: 'var(--bs-border-color)',
						startAngle: -90,
						endAngle: 90,
					},
					dataLabels: {
						name: {
							show: false,
						},
						value: {
							fontSize: "30px",
							show: true
						}
					}
				}
			},
			fill: {
				type: "gradient",
				gradient: {
					shade: "dark",
					type: "horizontal",
					gradientToColors: ["var(--theme-color3)"],
					stops: [0, 100]
				}
			},
			stroke: {
				lineCap: "butt"
			},
			labels: ["Progress"]
		});

		initApexChart(document.querySelector("#apex-EmployeeSalary"), {
			series: [{
				data: [400, 430, 448, 690, 1100, 1200, 1380]
			}],
			colors: ["var(--theme-color1)"],
			chart: {
				type: 'bar',
				height: 256,
				toolbar: {
					show: false,
				},
			},
			plotOptions: {
				bar: {
					borderRadius: 4,
					horizontal: true,
				}
			},
			dataLabels: {
				enabled: false
			},
			xaxis: {
				categories: ['Design', 'Developer', 'Marketing', 'SOE', 'BD', 'HR', 'Sales'],
			}
		});
	});
</script>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const startVoice = document.getElementById("startVoice");
		const taskDescription = document.getElementById("taskDescription");

		// Speech Recognition Setup
		const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
		const recognition = new SpeechRecognition();
		recognition.continuous = false; // Stop after user stops speaking
		recognition.interimResults = false; // Show only final results
		recognition.lang = "en-US"; // Set language (Change to "hi-IN" for Hindi)

		// Start Recognition
		startVoice?.addEventListener("click", function() {
			recognition.start();
			startVoice?.classList.add("btn-danger"); // Show recording state
		});

		// Capture Speech & Insert in Textarea
		recognition.onresult = function(event) {
			const transcript = event.results[0][0].transcript;
			taskDescription.value += transcript + " "; // Append text
		};

		// Reset Button Style When Done
		recognition.onspeechend = function() {
			recognition.stop();
			startVoice.classList.remove("btn-danger");
		};

		// Handle Errors
		recognition.onerror = function(event) {
			console.error("Speech Recognition Error:", event.error);
		};
	});
</script>

<script>
	function validateFiles(input) {
		const maxSize = 3 * 1024 * 1024; // 3MB in bytes
		const errorDiv = document.getElementById('file-error');
		errorDiv.textContent = ''; // Clear previous messages

		for (let i = 0; i < input.files.length; i++) {
			if (input.files[i].size > maxSize) {
				errorDiv.textContent = "Each file must be 3MB or less.";
				input.value = ""; // Clear the file input
				break;
			}
		}
	}
</script>

<script>
	if (!localStorage.getItem('layersData')) {
		const sampleData = [{
				"id": "Layer 1",
				"name": "sagar",
				"collaboratorCount": 13
			},
			{
				"id": "Layer 2",
				"name": "thakur",
				"collaboratorCount": 5
			},
			{
				"id": "Layer 3",
				"name": "sdfsdf",
				"collaboratorCount": 3
			}
		];
		localStorage.setItem('layersData', JSON.stringify(sampleData));
	}

	const storedData = localStorage.getItem('layersData');
	const layersData = storedData ? JSON.parse(storedData) : [];

	const timeline = document.getElementById("timeline");

	// layersData.forEach(layer => {
	// 	const row = document.createElement("div");
	// 	row.className = "row";

	// 	// Replace "Layer" with "L" in label
	// 	const shortId = layer.id.replace("Layer", "L");

	// 	const label = document.createElement("div");
	// 	label.className = "label";
	// 	label.innerText = `${shortId} - ${layer.name}`;
	// 	row.appendChild(label);

	// 	const line = document.createElement("div");
	// 	line.className = "line agreement-start";

	// 	// 📄 Orange Document Icon using Font Awesome
	// 	const docIcon = document.createElement("div");
	// 	docIcon.className = "doc-icon";
	// 	docIcon.innerHTML = '<i class="fas fa-file-alt"></i>';
	// 	line.appendChild(docIcon);

	// 	const totalCircles = layer.collaboratorCount;
	// 	for (let i = 0; i < totalCircles; i++) {
	// 		const circle = document.createElement("div");
	// 		circle.className = "circle";

	// 		const position = (i / (totalCircles - 1)) * 100;
	// 		circle.style.left = totalCircles === 1 ? "50%" : `${position}%`;

	// 		const onlineDiv = document.createElement("div");
	// 		onlineDiv.className = "active-status";
	// 		circle.appendChild(onlineDiv);

	// 		const nameSpan = document.createElement("span");
	// 		nameSpan.className = "circle-name";
	// 		nameSpan.innerText = `${shortId} - T ${i + 1}`;
	// 		circle.appendChild(nameSpan);

	// 		line.appendChild(circle);
	// 	}

	// 	row.appendChild(line);
	// 	timeline?.appendChild(row);
	// });
</script>

<script>
	function showSubDropdown() {
		var mainDropdown = document.getElementById("mainDropdown");
		var subDropdown = document.getElementById("subDropdown");
		if (mainDropdown.value === "decision") {
			subDropdown.classList.remove("d-none");
		} else {
			subDropdown.classList.add("d-none");
		}
	}
</script>
<script>
	let scale = 1;
	const graph = document.getElementById("graph");

	function zoomIn() {
		if (scale < 5) scale += 1;
		updateZoom();
	}

	function zoomOut() {
		if (scale > 1) scale -= 1;
		updateZoom();
	}
	if (graph) {

		function updateZoom() {
			graph.style.transform = `scale(${1 + (scale - 1) * 0.3})`;

			for (let i = 1; i <= 5; i++) {
				const layer = document.querySelector(`.layer-${i}`);
				layer.style.display = (i <= scale) ? "block" : "none";
			}
		}

		// Initial render
		updateZoom();
	}
</script>
<script>
	const wrapper = document.querySelector(".circle-wrapper");
	const dot = document.querySelector(".center-dot");
	let count = 5;
	for (let i = 0; i < count; i++) {
		const circle = document.createElement("div");
		circle.className = "circle-layer";
		wrapper?.insertBefore(circle, dot);
	}
	const circles = document.querySelectorAll(".circle-layer");
	circles.forEach((el, i) => {
		const size = 100 + i * 100;
		el.style.width = `${size}px`;
		el.style.height = `${size / 2}px`;
		el.style.zIndex = `${circles.length - i}`;
	});
</script>
<script>
	document.documentElement.setAttribute('data-bs-theme', 'light');
</script>

</body>
<!-- Shiv Web Developer -->

</html>