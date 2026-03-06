<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>


<style>
    #map {
        width: 100%;
        height: 77vh;
        background: #bcdff1;
    }
</style>

<div class="page-body pt-1 px-2">
    <?php $this->load->view('map/header') ?>

    <div id="map"></div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// 🌍 WORLD BOUNDS
const worldBounds = [
    [-85, -180], // Slightly cropped poles to allow better horizontal fit
    [85, 180]
];

// 🗺️ MAP INIT
const map = L.map('map', {
    zoomSnap: 0.1,      // 🔥 Allows smooth zooming to fit screen exactly
    minZoom: 1, 
    maxZoom: 6,
    worldCopyJump: false,
    maxBounds: worldBounds,
    maxBoundsViscosity: 1.0,
    zoomControl: true
});

// 🧱 TILE LAYER
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    noWrap: true,
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

// 🚀 THE FIX: Function to force map to fill width
function fillScreen() {
    // This forces the map to zoom until the left and right edges touch the screen
    map.fitBounds(worldBounds, { animate: false });
}

// 🌐 COUNTRY BORDERS
fetch('https://raw.githubusercontent.com/johan/world.geo.json/master/countries.geo.json')
.then(res => res.json())
.then(data => {
    const countries = L.geoJSON(data, {
        style: {
            color: '#222',
            weight: 1,
            fillOpacity: 0
        },
        onEachFeature: (feature, layer) => {
            const name = feature.properties.name || 'Country';
            layer.bindTooltip(name, { sticky: true });
            layer.on('mouseover', () => {
                layer.setStyle({ color: '#0d6efd', weight: 2, fillOpacity: 0.08 });
            });
            layer.on('mouseout', () => {
                countries.resetStyle(layer);
            });
        }
    }).addTo(map);
    
    fillScreen(); // Run after data loads
});

// 🔄 HANDLE RESIZE
window.addEventListener('resize', () => {
    map.invalidateSize();
    fillScreen();
});

// Final check for initial load
setTimeout(() => {
    map.invalidateSize();
    fillScreen();
}, 500);

</script>
