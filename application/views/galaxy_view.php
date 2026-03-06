<!DOCTYPE html>
<html>

<head>
    <title>User Galaxy Network</title>

    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: #000;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100vh;
            z-index: 1;
        }

        /* Floating user profiles */
        .profile {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #fff;
            z-index: 2;
            animation: float 6s infinite ease-in-out;
        }

        /* Floating Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Canvas for arrows/lines */
        #networkCanvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }
    </style>
</head>

<body>

    <div id="particles-js"></div>
    <canvas id="networkCanvas"></canvas>

    <!-- Profile Images -->
    <img src="<?= base_url('uploads/user_profile/67fa4e249a6d4.png'); ?>" class="profile" style="top: 100px; left: 200px;">
    <img src="<?= base_url('uploads/user_profile//67fa4edbf2b94.png'); ?>" class="profile" style="top: 300px; left: 500px;">
    <img src="<?= base_url('uploads/user_profile/688fafb32f132.png'); ?>" class="profile" style="top: 150px; left: 800px;">
    <img src="<?= base_url('uploads/user_profile/687576d32de91.jpg'); ?>" class="profile" style="top: 450px; left: 350px;">

    <script>
        /* -------------------------------
   Particles.js Galaxy Background
--------------------------------- */
        particlesJS("particles-js", {
            particles: {
                number: {
                    value: 200
                },
                size: {
                    value: 2
                },
                move: {
                    speed: 1
                },
                color: {
                    value: "#ffffff"
                },
                line_linked: {
                    enable: false
                }
            }
        });


        /* -------------------------------
           Draw Connection Arrows
        --------------------------------- */
        const canvas = document.getElementById('networkCanvas');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener("resize", resizeCanvas);

        // Profile coordinates
        const profiles = [{
                x: 200,
                y: 100
            },
            {
                x: 500,
                y: 300
            },
            {
                x: 800,
                y: 150
            },
            {
                x: 350,
                y: 450
            }
        ];

        // Draw line with arrow
        function drawArrow(from, to) {
            const headlen = 15;
            const dx = to.x - from.x;
            const dy = to.y - from.y;
            const angle = Math.atan2(dy, dx);

            ctx.beginPath();
            ctx.strokeStyle = "#00eaff";
            ctx.lineWidth = 2;
            ctx.moveTo(from.x, from.y);
            ctx.lineTo(to.x, to.y);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(to.x, to.y);
            ctx.lineTo(to.x - headlen * Math.cos(angle - Math.PI / 6),
                to.y - headlen * Math.sin(angle - Math.PI / 6));
            ctx.lineTo(to.x - headlen * Math.cos(angle + Math.PI / 6),
                to.y - headlen * Math.sin(angle + Math.PI / 6));
            ctx.lineTo(to.x, to.y);
            ctx.fillStyle = "#00eaff";
            ctx.fill();
        }

        // Animate arrows
        function animateLines() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            drawArrow(profiles[0], profiles[1]);
            drawArrow(profiles[1], profiles[2]);
            drawArrow(profiles[2], profiles[3]);
            drawArrow(profiles[3], profiles[0]);

            requestAnimationFrame(animateLines);
        }
        animateLines();
    </script>

</body>

</html>