<div class="page-body pt-1 px-2">
    <!-- <?php $this->load->view('map/header')?> -->
    <h5 class="text-center">Third Dimension</h5>
    <div id="chart" style="width:100%; height:100vh;"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128/examples/js/controls/OrbitControls.js"></script>

<script>
const users = <?= json_encode($users); ?>;
const sprites = [];
const labelSprites = [];
const graphMin = -5;
const graphMax = 5;

const scene = new THREE.Scene();
scene.background = new THREE.Color(0xffffff);

const camera = new THREE.PerspectiveCamera(
  75,
  window.innerWidth / window.innerHeight,
  0.1,
  1000
);

const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);

const chart = document.getElementById('chart');
chart.appendChild(renderer.domElement);

const controls = new THREE.OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.target.set(0, 0, 0);

scene.add(new THREE.AxesHelper(10));
scene.add(new THREE.GridHelper(10, 10, 0xcbd5e1, 0xe2e8f0));

function scaleValue(value, min, max, newMin, newMax) {
  if (max === min) {
    return (newMin + newMax) / 2;
  }

  return ((value - min) / (max - min)) * (newMax - newMin) + newMin;
}

function makeTextSprite(text) {
  const canvas = document.createElement('canvas');
  const context = canvas.getContext('2d');
  const fontSize = 32;
  const paddingX = 16;
  const paddingY = 10;

  context.font = `600 ${fontSize}px Arial`;
  const textWidth = context.measureText(text).width;

  canvas.width = Math.ceil(textWidth + paddingX * 2);
  canvas.height = Math.ceil(fontSize + paddingY * 2);

  context.font = `600 ${fontSize}px Arial`;
  context.fillStyle = 'rgba(255, 255, 255, 0.96)';
  context.fillRect(0, 0, canvas.width, canvas.height);
  context.strokeStyle = 'rgba(30, 64, 175, 0.4)';
  context.lineWidth = 3;
  context.strokeRect(0, 0, canvas.width, canvas.height);
  context.fillStyle = '#111827';
  context.textBaseline = 'middle';
  context.fillText(text, paddingX, canvas.height / 2);

  const texture = new THREE.CanvasTexture(canvas);
  texture.minFilter = THREE.LinearFilter;

  const material = new THREE.SpriteMaterial({
    map: texture,
    transparent: true,
    depthTest: false,
    depthWrite: false
  });

  const sprite = new THREE.Sprite(material);
  sprite.scale.set(canvas.width / 150, canvas.height / 150, 1);

  return sprite;
}

function addProjectionLines(x, y, z) {
  const lineGroups = [
    [new THREE.Vector3(x, 0, z), new THREE.Vector3(x, y, z)],
    [new THREE.Vector3(0, 0, z), new THREE.Vector3(x, 0, z)],
    [new THREE.Vector3(x, 0, 0), new THREE.Vector3(x, 0, z)]
  ];

  lineGroups.forEach(points => {
    const geometry = new THREE.BufferGeometry().setFromPoints(points);
    const material = new THREE.LineDashedMaterial({
      color: 0x94a3b8,
      dashSize: 0.18,
      gapSize: 0.12,
      transparent: true,
      opacity: 0.95
    });
    const line = new THREE.Line(geometry, material);
    line.computeLineDistances();
    scene.add(line);
  });
}

function getCoordinateValue(user, key, index) {
  const numericValue = Number(user[key]);
  if (Number.isFinite(numericValue)) {
    return numericValue;
  }

  if (key === 'x') {
    return (index % 5) * 2 + 1;
  }

  if (key === 'y') {
    return Math.floor(index / 5) * 2 + 1;
  }

  return ((index * 3) % 10) + 1;
}

users.forEach((user, index) => {
  user.x = getCoordinateValue(user, 'x', index);
  user.y = getCoordinateValue(user, 'y', index);
  user.z = getCoordinateValue(user, 'z', index);
});

const xs = users.map(u => u.x);
const ys = users.map(u => u.y);
const zs = users.map(u => u.z);

const minX = Math.min(...xs);
const maxX = Math.max(...xs);
const minY = Math.min(...ys);
const maxY = Math.max(...ys);
const minZ = Math.min(...zs);
const maxZ = Math.max(...zs);

const loader = new THREE.TextureLoader();

users.forEach(user => {
  const texture = loader.load(
    user.user_image
      ? "<?= base_url('uploads/user_profile/') ?>" + user.user_image
      : "<?= base_url('uploads/user_profile/user.png') ?>"
  );

  const material = new THREE.SpriteMaterial({ map: texture });
  const sprite = new THREE.Sprite(material);

  const x = scaleValue(user.x, minX, maxX, graphMin, graphMax);
  const y = scaleValue(user.y, minY, maxY, graphMin, graphMax);
  const z = scaleValue(user.z, minZ, maxZ, graphMin, graphMax);

  sprite.position.set(x, y, z);
  sprite.scale.set(0.8, 0.8, 1);

  scene.add(sprite);
  sprites.push(sprite);

  addProjectionLines(x, y, z);

  const label = makeTextSprite(
    `${user.name || user.email} (${user.x.toFixed(1)}, ${user.y.toFixed(1)}, ${user.z.toFixed(1)})`
  );
  label.position.set(x, y + 0.85, z);
  scene.add(label);
  labelSprites.push(label);
});

camera.position.set(8, 8, 8);

function animate() {
  requestAnimationFrame(animate);

  sprites.forEach(sprite => {
    const distance = camera.position.distanceTo(sprite.position);
    const scale = 2 / Math.max(distance, 0.1);
    sprite.scale.set(scale, scale, 1);
  });

  labelSprites.forEach(label => {
    label.quaternion.copy(camera.quaternion);
  });

  controls.update();
  renderer.render(scene, camera);
}

animate();

window.addEventListener('resize', () => {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
});
</script>
