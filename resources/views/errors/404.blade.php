<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(ellipse at center, #0f0f23 0%, #000000 70%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
            color: white;
        }

        /* Animated stars */
        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle 3s ease-in-out infinite;
        }

        .star:nth-child(1) {
            top: 20%;
            left: 10%;
            width: 2px;
            height: 2px;
            animation-delay: 0s;
        }

        .star:nth-child(2) {
            top: 30%;
            left: 80%;
            width: 3px;
            height: 3px;
            animation-delay: 1s;
        }

        .star:nth-child(3) {
            top: 60%;
            left: 20%;
            width: 1px;
            height: 1px;
            animation-delay: 2s;
        }

        .star:nth-child(4) {
            top: 80%;
            left: 70%;
            width: 2px;
            height: 2px;
            animation-delay: 0.5s;
        }

        .star:nth-child(5) {
            top: 15%;
            left: 60%;
            width: 1px;
            height: 1px;
            animation-delay: 1.5s;
        }

        .star:nth-child(6) {
            top: 70%;
            left: 90%;
            width: 2px;
            height: 2px;
            animation-delay: 2.5s;
        }

        .star:nth-child(7) {
            top: 40%;
            left: 5%;
            width: 1px;
            height: 1px;
            animation-delay: 3s;
        }

        .star:nth-child(8) {
            top: 85%;
            left: 30%;
            width: 3px;
            height: 3px;
            animation-delay: 0.8s;
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        /* Floating planets */
        .planet {
            position: absolute;
            border-radius: 50%;
            animation: orbit 20s linear infinite;
        }

        .planet.small {
            top: 25%;
            right: 15%;
            width: 30px;
            height: 30px;
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            box-shadow: 0 0 20px rgba(255, 107, 107, 0.3);
        }

        .planet.medium {
            top: 65%;
            left: 10%;
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #4834d4, #686de0);
            box-shadow: 0 0 30px rgba(72, 52, 212, 0.4);
            animation-delay: -10s;
        }

        @keyframes orbit {
            0% {
                transform: rotate(0deg) translateX(20px) rotate(0deg);
            }

            100% {
                transform: rotate(360deg) translateX(20px) rotate(-360deg);
            }
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            width: 100%;
            padding: 2rem;
            z-index: 10;
            gap: 4rem;
        }

        .astronaut-section {
            flex: 0 0 auto;
        }

        .content-section {
            flex: 1;
            text-align: left;
            max-width: 600px;
        }

        .error-code {
            font-size: 10rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #ff6b6b, #4834d4, #00d2d3);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
            line-height: 1;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .astronaut {
            width: 220px;
            height: 280px;
            position: relative;
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(-2deg);
            }

            50% {
                transform: translateY(-15px) rotate(2deg);
            }
        }

        /* Astronaut Helmet */
        .astronaut-helmet {
            width: 120px;
            height: 120px;
            background: linear-gradient(145deg, #f1f2f6, #ddd);
            border: 4px solid #57606f;
            border-radius: 50%;
            margin: 0 auto;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .helmet-reflection {
            position: absolute;
            top: 15px;
            left: 15px;
            width: 40px;
            height: 60px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.2));
            border-radius: 20px;
            animation: reflection 2s ease-in-out infinite;
        }

        @keyframes reflection {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 0.9;
            }
        }

        .astronaut-face {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 80px;
        }

        .astronaut-eyes {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 0 10px;
        }

        .astronaut-eye {
            width: 12px;
            height: 12px;
            background: #2f3542;
            border-radius: 50%;
            animation: blink 4s infinite;
        }

        @keyframes blink {

            0%,
            90%,
            100% {
                transform: scaleY(1);
            }

            95% {
                transform: scaleY(0.1);
            }
        }

        .astronaut-mouth {
            width: 20px;
            height: 10px;
            border: 2px solid #2f3542;
            border-top: none;
            border-radius: 0 0 20px 20px;
            margin: 0 auto;
        }

        /* Astronaut Body */
        .astronaut-body {
            width: 100px;
            height: 120px;
            background: linear-gradient(145deg, #f1f2f6, #c4c4c4);
            border: 3px solid #57606f;
            border-radius: 20px;
            margin: 10px auto 0;
            position: relative;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .body-panel {
            width: 60px;
            height: 40px;
            background: #2f3640;
            border: 2px solid #57606f;
            border-radius: 8px;
            margin: 20px auto 15px;
            position: relative;
            overflow: hidden;
        }

        .panel-screen {
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #00d2d3, #4834d4);
            animation: screenPulse 2s ease-in-out infinite;
        }

        @keyframes screenPulse {

            0%,
            100% {
                opacity: 0.8;
            }

            50% {
                opacity: 1;
            }
        }

        .body-buttons {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }

        .body-button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            animation: buttonGlow 3s infinite;
        }

        .body-button:nth-child(1) {
            background: #ff6b6b;
            animation-delay: 0s;
        }

        .body-button:nth-child(2) {
            background: #4834d4;
            animation-delay: 1s;
        }

        .body-button:nth-child(3) {
            background: #00d2d3;
            animation-delay: 2s;
        }

        @keyframes buttonGlow {

            0%,
            70% {
                box-shadow: 0 0 5px currentColor;
            }

            80%,
            90% {
                box-shadow: 0 0 15px currentColor;
            }
        }

        /* Astronaut Arms */
        .astronaut-arm {
            position: absolute;
            top: 140px;
            width: 18px;
            height: 70px;
            background: linear-gradient(145deg, #f1f2f6, #c4c4c4);
            border: 2px solid #57606f;
            border-radius: 12px;
            animation: armFloat 3s ease-in-out infinite;
        }

        .astronaut-arm.left {
            left: -25px;
            transform-origin: top center;
            animation-delay: 0s;
        }

        .astronaut-arm.right {
            right: -25px;
            transform-origin: top center;
            animation-delay: 1.5s;
        }

        @keyframes armFloat {

            0%,
            100% {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(15deg);
            }
        }

        /* Astronaut Legs */
        .astronaut-legs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 5px;
        }

        .astronaut-leg {
            width: 20px;
            height: 60px;
            background: linear-gradient(145deg, #f1f2f6, #c4c4c4);
            border: 2px solid #57606f;
            border-radius: 12px;
            animation: legKick 5s ease-in-out infinite;
        }

        .astronaut-leg:nth-child(2) {
            animation-delay: 2.5s;
        }

        @keyframes legKick {

            0%,
            90%,
            100% {
                transform: rotate(0deg);
            }

            95% {
                transform: rotate(10deg);
            }
        }

        .error-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #ff6b6b;
        }

        .error-message {
            font-size: 1.3rem;
            margin-bottom: 3rem;
            opacity: 0.9;
            line-height: 1.6;
            color: #a4b0be;
        }

        .action-buttons {
            display: flex;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .btn {
            padding: 16px 32px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #ff4757);
            color: white;
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #4834d4, #686de0);
            color: white;
            box-shadow: 0 6px 20px rgba(72, 52, 212, 0.4);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .space-log {
            background: rgba(15, 15, 35, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
            border-left: 4px solid #ff6b6b;
        }

        .log-line {
            margin: 0.4rem 0;
            opacity: 0;
            animation: logAppear 0.8s ease-out forwards;
        }

        .log-line:nth-child(1) {
            animation-delay: 0.5s;
        }

        .log-line:nth-child(2) {
            animation-delay: 1s;
        }

        .log-line:nth-child(3) {
            animation-delay: 1.5s;
        }

        .log-line:nth-child(4) {
            animation-delay: 2s;
        }

        @keyframes logAppear {
            from {
                opacity: 0;
                transform: translateX(-15px);
            }

            to {
                opacity: 0.8;
                transform: translateX(0);
            }
        }

        .log-timestamp {
            color: #4834d4;
        }

        .log-status {
            color: #ff6b6b;
        }

        .log-message {
            color: #00d2d3;
        }

        .log-location {
            color: #a4b0be;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .content-section {
                text-align: center;
            }

            .error-code {
                font-size: 6rem;
            }

            .error-title {
                font-size: 2.2rem;
            }

            .astronaut {
                width: 180px;
                height: 230px;
            }

            .astronaut-helmet {
                width: 100px;
                height: 100px;
            }

            .astronaut-body {
                width: 85px;
                height: 100px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Background stars -->
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>

    <!-- Floating planets -->
    <div class="planet small"></div>
    <div class="planet medium"></div>

    <div class="container">
        <div class="astronaut-section">
            <div class="astronaut">
                <div class="astronaut-helmet">
                    <div class="helmet-reflection"></div>
                    <div class="astronaut-face">
                        <div class="astronaut-eyes">
                            <div class="astronaut-eye"></div>
                            <div class="astronaut-eye"></div>
                        </div>
                        <div class="astronaut-mouth"></div>
                    </div>
                </div>
                <div class="astronaut-body">
                    <div class="body-panel">
                        <div class="panel-screen"></div>
                    </div>
                    <div class="body-buttons">
                        <div class="body-button"></div>
                        <div class="body-button"></div>
                        <div class="body-button"></div>
                    </div>
                </div>
                <div class="astronaut-arm left"></div>
                <div class="astronaut-arm right"></div>
                <div class="astronaut-legs">
                    <div class="astronaut-leg"></div>
                    <div class="astronaut-leg"></div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="error-code">404</div>
            <h1 class="error-title">Halaman Tidak Ditemukan</h1>
            <p class="error-message">
                Oops! Sepertinya Anda tersesat. Halaman yang Anda cari telah dihapus atau bahkan tidak pernah ada
            </p>

            <div class="action-buttons">
                <button class="btn btn-primary" onclick="goHome()">
                    Kembali
                </button>
                <button class="btn btn-secondary" onclick="reportIssue()">
                    Laporkan
                </button>
            </div>

            <div class="space-log">
                <div class="log-line">
                    <span class="log-message">› kami punya masalah...</span>
                </div>
                <div class="log-line">
                    <span class="log-message">› Halaman tidak ditemukan</span>
                </div>
                <div class="log-line">
                    <span class="log-location">› Koordinat terakhir yang diketahui: /halaman-tak-dikenal</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goHome() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }
        function reportIssue() {
            alert('Fitur pelaporan masalah akan segera tersedia. Silakan hubungi administrator sistem.');
        }

        function searchPage() {
            const searchQuery = prompt('Masukkan kata kunci halaman yang ingin dicari:');
            if (searchQuery) {
                // Redirect ke halaman pencarian atau beranda dengan query
                window.location.href = `/?search=${encodeURIComponent(searchQuery)}`;
            }
        }

        // Interactive astronaut effects
        document.addEventListener('mousemove', (e) => {
            const astronaut = document.querySelector('.astronaut');
            const rect = astronaut.getBoundingClientRect();
            const astronautCenterX = rect.left + rect.width / 2;
            const astronautCenterY = rect.top + rect.height / 2;

            const deltaX = e.clientX - astronautCenterX;
            const deltaY = e.clientY - astronautCenterY;

            const rotateX = (deltaY / window.innerHeight) * 8;
            const rotateY = (deltaX / window.innerWidth) * 8;

            astronaut.style.transform = `perspective(1000px) rotateX(${-rotateX}deg) rotateY(${rotateY}deg)`;
        });

        document.addEventListener('mouseleave', () => {
            const astronaut = document.querySelector('.astronaut');
            astronaut.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
        });

        // Astronaut click animation
        document.querySelector('.astronaut').addEventListener('click', () => {
            const astronaut = document.querySelector('.astronaut');
            astronaut.style.animation = 'none';
            astronaut.style.transform = 'scale(1.1) rotate(10deg)';

            // Create temporary "boost" effect
            const boostEffect = document.createElement('div');
            boostEffect.style.cssText = `
                position: absolute;
                bottom: -20px;
                left: 50%;
                transform: translateX(-50%);
                width: 40px;
                height: 60px;
                background: linear-gradient(to top, #ff6b6b, transparent);
                border-radius: 50%;
                animation: boost 0.5s ease-out;
                pointer-events: none;
            `;

            const boostKeyframes = `
                @keyframes boost {
                    0% { opacity: 0; transform: translateX(-50%) scaleY(0); }
                    50% { opacity: 1; transform: translateX(-50%) scaleY(1); }
                    100% { opacity: 0; transform: translateX(-50%) scaleY(1.2); }
                }
            `;

            if (!document.querySelector('#boost-style')) {
                const style = document.createElement('style');
                style.id = 'boost-style';
                style.textContent = boostKeyframes;
                document.head.appendChild(style);
            }

            astronaut.appendChild(boostEffect);

            setTimeout(() => {
                astronaut.style.animation = 'float 4s ease-in-out infinite';
                astronaut.style.transform = 'scale(1) rotate(0deg)';
                boostEffect.remove();
            }, 300);
        });

        // Add shooting star effect occasionally
        function createShootingStar() {
            const shootingStar = document.createElement('div');
            shootingStar.style.cssText = `
                position: absolute;
                top: ${Math.random() * 50}%;
                left: -10px;
                width: 2px;
                height: 2px;
                background: white;
                border-radius: 50%;
                box-shadow: 0 0 10px white, -100px 0 6px white, -200px 0 4px white;
                animation: shootingStar 2s linear;
                pointer-events: none;
            `;

            const shootingKeyframes = `
                @keyframes shootingStar {
                    0% { transform: translateX(0) translateY(0) rotate(45deg); opacity: 1; }
                    100% { transform: translateX(100vw) translateY(50px) rotate(45deg); opacity: 0; }
                }
            `;

            if (!document.querySelector('#shooting-style')) {
                const style = document.createElement('style');
                style.id = 'shooting-style';
                style.textContent = shootingKeyframes;
                document.head.appendChild(style);
            }

            document.body.appendChild(shootingStar);

            setTimeout(() => {
                shootingStar.remove();
            }, 2000);
        }

        // Create shooting star every 8-15 seconds
        setInterval(() => {
            if (Math.random() > 0.3) {
                createShootingStar();
            }
        }, Math.random() * 7000 + 8000);
    </script>
</body>

</html>
