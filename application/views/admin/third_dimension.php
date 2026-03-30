

<div class="page-body pt-1 px-2">
    <!-- <?php $this->load->view('map/header')?> -->
    <h5 class="text-center">Third Dimension</h5>
    <div id="chart" style="width:100%; height:100vh;"></div>
</div>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<script>
    // 🔥 Sample data (replace with CI3 data later)
    const x = [];
    const y = [];
    const z = [];

    for (let i = 0; i < 300; i++) {
        x.push((Math.random() - 0.5) * 10);
        y.push((Math.random() - 0.5) * 10);
        z.push((Math.random() - 0.5) * 10);
    }
    console.log(x)
    console.log(y)
    console.log(z)
    // 🔥 Scatter plot
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