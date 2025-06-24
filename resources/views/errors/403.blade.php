<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Dilarang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1f3a 0%, #2d4a8e 50%, #4a6fa5 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Grid pattern background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
            z-index: 1;
        }

        /* Floating squares */
        .floating-square {
            position: absolute;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            animation: floatSquare 8s ease-in-out infinite;
        }

        .floating-square:nth-child(1) {
            top: 15%;
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
            transform: rotate(15deg);
        }

        .floating-square:nth-child(2) {
            top: 70%;
            left: 85%;
            width: 25px;
            height: 25px;
            animation-delay: 2s;
            transform: rotate(-20deg);
        }

        .floating-square:nth-child(3) {
            top: 40%;
            left: 80%;
            width: 15px;
            height: 15px;
            animation-delay: 4s;
            transform: rotate(45deg);
        }

        .floating-square:nth-child(4) {
            top: 20%;
            left: 75%;
            width: 18px;
            height: 18px;
            animation-delay: 1s;
            transform: rotate(-10deg);
        }

        .floating-square:nth-child(5) {
            top: 80%;
            left: 20%;
            width: 22px;
            height: 22px;
            animation-delay: 3s;
            transform: rotate(30deg);
        }

        @keyframes floatSquare {

            0%,
            100% {
                transform: translateY(0px) rotate(var(--rotation, 0deg));
                opacity: 0.3;
            }

            50% {
                transform: translateY(-15px) rotate(calc(var(--rotation, 0deg) + 180deg));
                opacity: 0.7;
            }
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 1000px;
            width: 100%;
            padding: 2rem;
            z-index: 10;
            gap: 3rem;
        }

        .robot-section {
            flex: 0 0 auto;
        }

        .content-section {
            flex: 1;
            text-align: left;
            color: white;
            max-width: 500px;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
            animation: glow 2s ease-in-out infinite alternate;
            line-height: 1;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
            }

            to {
                text-shadow: 0 0 40px rgba(255, 255, 255, 0.6), 0 0 50px rgba(74, 144, 226, 0.4);
            }
        }

        .robot {
            width: 180px;
            height: 200px;
            position: relative;
            animation: robotBob 3s ease-in-out infinite;
        }

        @keyframes robotBob {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* Robot Head */
        .robot-head {
            width: 100px;
            height: 85px;
            background: linear-gradient(145deg, #1e3c72, #3a5998);
            border: 2px solid #4a90e2;
            border-radius: 15px;
            margin: 0 auto;
            position: relative;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .robot-antenna {
            position: absolute;
            top: -12px;
            width: 3px;
            height: 12px;
            background: #4a90e2;
            border-radius: 2px;
        }

        .robot-antenna.left {
            left: 25px;
        }

        .robot-antenna.right {
            right: 25px;
        }

        .robot-antenna::after {
            content: '';
            position: absolute;
            top: -6px;
            left: -3px;
            width: 9px;
            height: 9px;
            background: #ff4757;
            border-radius: 50%;
            animation: blink 1.5s infinite;
            box-shadow: 0 0 8px rgba(255, 71, 87, 0.6);
        }

        @keyframes blink {

            0%,
            85% {
                opacity: 1;
            }

            90%,
            95% {
                opacity: 0.3;
            }
        }

        .robot-eyes {
            display: flex;
            justify-content: space-between;
            padding: 20px 20px 0;
        }

        .robot-eye {
            width: 20px;
            height: 20px;
            background: #ff4757;
            border-radius: 50%;
            box-shadow: 0 0 12px rgba(255, 71, 87, 0.8);
            animation: eyeGlow 2s ease-in-out infinite alternate;
        }

        @keyframes eyeGlow {
            from {
                box-shadow: 0 0 12px rgba(255, 71, 87, 0.8);
            }

            to {
                box-shadow: 0 0 18px rgba(255, 71, 87, 1);
            }
        }

        .robot-mouth {
            width: 50px;
            height: 6px;
            background: #2c3e50;
            border-radius: 8px;
            margin: 12px auto;
            position: relative;
            overflow: hidden;
        }

        .robot-mouth::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 71, 87, 0.7), transparent);
            animation: mouthScan 2.5s linear infinite;
        }

        @keyframes mouthScan {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* Robot Body */
        .robot-body {
            width: 120px;
            height: 90px;
            background: linear-gradient(145deg, #1e3c72, #3a5998);
            border: 2px solid #4a90e2;
            border-radius: 12px;
            margin: 8px auto 0;
            position: relative;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .robot-screen {
            width: 70px;
            height: 45px;
            background: #0f0f0f;
            border: 2px solid #4a90e2;
            border-radius: 6px;
            margin: 15px auto;
            position: relative;
            overflow: hidden;
        }

        .robot-screen::after {
            content: 'FORBIDDEN';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #ff4757;
            font-size: 7px;
            font-weight: bold;
            animation: screenFlicker 2s infinite;
            font-family: monospace;
        }

        @keyframes screenFlicker {

            0%,
            88% {
                opacity: 1;
            }

            92%,
            96% {
                opacity: 0.5;
            }
        }

        .robot-buttons {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 8px;
        }

        .robot-button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            animation: buttonBlink 4s infinite;
        }

        .robot-button:nth-child(1) {
            background: #2ecc71;
            animation-delay: 0s;
        }

        .robot-button:nth-child(2) {
            background: #f39c12;
            animation-delay: 1.3s;
        }

        .robot-button:nth-child(3) {
            background: #e74c3c;
            animation-delay: 2.6s;
        }

        @keyframes buttonBlink {

            0%,
            75% {
                opacity: 1;
            }

            80%,
            85% {
                opacity: 0.4;
            }
        }

        /* Robot Arms */
        .robot-arm {
            position: absolute;
            top: 95px;
            width: 12px;
            height: 50px;
            background: linear-gradient(145deg, #1e3c72, #3a5998);
            border: 2px solid #4a90e2;
            border-radius: 8px;
            animation: armWave 5s ease-in-out infinite;
        }

        .robot-arm.left {
            left: -15px;
            transform-origin: top center;
        }

        .robot-arm.right {
            right: -15px;
            transform-origin: top center;
            animation-delay: 2.5s;
        }

        @keyframes armWave {

            0%,
            100% {
                transform: rotate(0deg);
            }

            20% {
                transform: rotate(-12deg);
            }

            80% {
                transform: rotate(12deg);
            }
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .error-message {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: #6c5ce7;
            color: white;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:hover {
            background: #5f4bdb;
        }

        .terminal {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 1.2rem;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            backdrop-filter: blur(10px);
        }

        .terminal-line {
            margin: 0.3rem 0;
            opacity: 0;
            animation: terminalType 0.6s ease-out forwards;
        }

        .terminal-line:nth-child(1) {
            animation-delay: 0.5s;
        }

        .terminal-line:nth-child(2) {
            animation-delay: 1s;
        }

        .terminal-line:nth-child(3) {
            animation-delay: 1.5s;
        }

        @keyframes terminalType {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }

            to {
                opacity: 0.8;
                transform: translateX(0);
            }
        }

        .status-code {
            color: #ff4757;
        }

        .status-text {
            color: #4a90e2;
        }

        .terminal-prompt {
            color: #2ecc71;
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
                font-size: 5rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .robot {
                width: 140px;
                height: 160px;
            }

            .robot-head {
                width: 80px;
                height: 68px;
            }

            .robot-body {
                width: 95px;
                height: 72px;
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
    <!-- Background floating squares -->
    <div class="floating-square"></div>
    <div class="floating-square"></div>
    <div class="floating-square"></div>
    <div class="floating-square"></div>
    <div class="floating-square"></div>

    <div class="container">
        <div class="robot-section">
            <div class="robot">
                <div class="robot-head">
                    <div class="robot-antenna left"></div>
                    <div class="robot-antenna right"></div>
                    <div class="robot-eyes">
                        <div class="robot-eye"></div>
                        <div class="robot-eye"></div>
                    </div>
                    <div class="robot-mouth"></div>
                </div>
                <div class="robot-body">
                    <div class="robot-screen"></div>
                    <div class="robot-buttons">
                        <div class="robot-button"></div>
                        <div class="robot-button"></div>
                        <div class="robot-button"></div>
                    </div>
                </div>
                <div class="robot-arm left"></div>
                <div class="robot-arm right"></div>
            </div>
        </div>

        <div class="content-section">
            <div class="error-code">403</div>
            <h1 class="error-title">Akses Dilarang</h1>
            <p class="error-message">
                Sistem mendeteksi kesalahan. Anda tidak memiliki akses untuk halaman ini.
            </p>

            <div class="action-buttons">
                <button class="btn btn-primary" onclick="goBack()">
                    Kembali ke Beranda
                </button>
                <button class="btn btn-secondary" onclick="reportIssue()">
                    Laporkan Masalah
                </button>
            </div>

            <div class="terminal">
                <div class="terminal-line">
                    <span class="status-code">●</span> <span class="terminal-prompt">GET</span> /halaman-tterlarang.html
                </div>
                <div class="terminal-line">
                    <span class="status-code">●</span> <span class="status-text">ERROR:</span> 403 Akses ditolak
                </div>
                <div class="terminal-line">
                    <span class="status-code">●</span> <span class="terminal-prompt">SISTEM:</span> Anda tidak memiliki izin akses halaman ini
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        function reportIssue() {
            alert('Fitur pelaporan masalah akan segera tersedia. Silakan hubungi administrator sistem.');
        }

        // Interactive robot effects
        document.addEventListener('mousemove', (e) => {
            const robot = document.querySelector('.robot');
            const rect = robot.getBoundingClientRect();
            const robotCenterX = rect.left + rect.width / 2;
            const robotCenterY = rect.top + rect.height / 2;

            const deltaX = e.clientX - robotCenterX;
            const deltaY = e.clientY - robotCenterY;

            const rotateX = (deltaY / window.innerHeight) * 5;
            const rotateY = (deltaX / window.innerWidth) * 5;

            robot.style.transform = `perspective(800px) rotateX(${-rotateX}deg) rotateY(${rotateY}deg)`;
        });

        document.addEventListener('mouseleave', () => {
            const robot = document.querySelector('.robot');
            robot.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg)';
        });

        // Robot click animation
        document.querySelector('.robot').addEventListener('click', () => {
            const robot = document.querySelector('.robot');
            robot.style.animation = 'none';
            robot.style.transform = 'scale(1.05) rotate(2deg)';

            setTimeout(() => {
                robot.style.animation = 'robotBob 3s ease-in-out infinite';
                robot.style.transform = 'scale(1) rotate(0deg)';
            }, 150);
        });
    </script>
</body>

</html>
