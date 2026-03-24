<div class="timeline-output text-output">
    <div id="chart"></div>
    <span class="edit-item">
        <i class="bi bi-pencil" title="Edit"></i>
    </span>
    <span class="delete-item">
        <i class="bi bi-trash delete-item" title="Delete"></i>
    </span>
</div>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<script>
    const data = <?= json_encode($item) ?>;

    const x = [Number(data.x_cord)];
    const y = [Number(data.y_cord)];
    const z = [Number(data.z_cord)];

    const trace = {
        x: x,
        y: y,
        z: z,
        mode: 'markers',
        type: 'scatter3d',
        marker: {
            size: 4,
            color: z,                 // color based on Z value
            colorscale: 'RdBu',       // red ↔ blue like your image
            opacity: 0.8
        }
    };

    // 🔥 Layout (axes + grid)
    const layout = {
        scene: {
            xaxis: {
                title: 'X',
                showgrid: true,
                zeroline: true
            },
            yaxis: {
                title: 'Y',
                showgrid: true,
                zeroline: true
            },
            zaxis: {
                title: 'Z',
                showgrid: true,
                zeroline: true
            },

            // 🔥 IMPORTANT: Camera position
            camera: {
                eye: { x: 1.5, y: 1.5, z: 1.5 } // diagonal view
            },

            // 🔥 Keep proportions correct
            aspectmode: 'cube'
        },

        margin: { l: 0, r: 0, b: 0, t: 0 }
    };

    // Render
    Plotly.newPlot('chart', [trace], layout);
</script>