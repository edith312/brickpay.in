<div class="page-body pt-3 px-2">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm border-0">
                <div class="card-body text-center">

                    <h5 class="mb-3">Find Nearby Places</h5>

                    <!-- Location Button -->
                    <div class="mb-3">
                        <button class="btn btn-outline-primary w-100" onclick="getLocation()">
                            📍 Use My Current Location
                        </button>
                        <small id="locationStatus" class="text-muted d-block mt-2"></small>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Select Category</label>
                        <select class="form-select" id="categorySelect">
                            <option value="">-- Select Category --</option>
                            <option value="beauty_salon">Salon</option>
                            <option value="spa">Spa</option>
                            <option value="restaurant">Restaurant</option>
                            <option value="lodging">Hotel</option>
                            <option value="gym">Gym</option>
                            <option value="cafe">Cafe</option>
                            <option value="hospital">Hospital</option>
                        </select>
                    </div>

                    <!-- Search -->
                    <div class="d-grid">
                        <button class="btn btn-primary" onclick="searchNearby()">Search Nearby</button>
                    </div>

                </div>
            </div>

        </div>
        <div class="row mt-4" id="results"></div>

    </div>
</div>


<script>
    let userLat = null;
    let userLng = null;

    function getLocation() {
        const status = document.getElementById("locationStatus");

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                userLat = pos.coords.latitude;
                userLng = pos.coords.longitude;
                status.innerText = "Location detected ✅";
            },
            () => {
                status.innerText = "Permission denied ❌";
            }
        );
    }

    async function searchNearby() {
        const category = document.getElementById('categorySelect').value;

        if (!userLat || !userLng) {
            alert("Allow location first");
            return;
        }

        if (!category) {
            alert("Select category");
            return;
        }

        try {
            const response = await fetch("https://places.googleapis.com/v1/places:searchNearby", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Goog-Api-Key": "YOUR_API_KEY",
                    "X-Goog-FieldMask": "places.displayName,places.formattedAddress,places.rating"
                },
                body: JSON.stringify({
                    includedTypes: [category],
                    maxResultCount: 10,
                    locationRestriction: {
                        circle: {
                            center: {
                                latitude: userLat,
                                longitude: userLng
                            },
                            radius: 3000
                        }
                    }
                })
            });

            const data = await response.json();

            if (!data.places) {
                document.getElementById('results').innerHTML = "<p>No results found</p>";
                return;
            }

            let html = '';

            data.places.forEach(place => {
                html += `
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h6>${place.displayName?.text || 'N/A'}</h6>
                                <p class="text-muted">${place.formattedAddress || ''}</p>
                                <small>⭐ ${place.rating || 'N/A'}</small>
                            </div>
                        </div>
                    </div>
                `;
            });

            document.getElementById('results').innerHTML = html;

        } catch (err) {
            console.error(err);
            alert("API error");
        }
    }
</script>