<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Comic Neue', cursive, sans-serif;
        }
        
        body {
            background-color: #f0f8ff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
            overflow-x: hidden;
        }

        /* Container */
        .container {
            max-width: 800px;
            padding: 60px 40px;
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        /* Character Animation */
        .character {
            width: 200px;
            height: 200px;
            margin: 0 auto 30px;
            position: relative;
        }
        
        .character-body {
            width: 120px;
            height: 150px;
            background: #ff9e7d;
            border-radius: 60px 60px 40px 40px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s ease infinite;
        }
        
        .character-face {
            width: 80px;
            height: 80px;
            background: #ffe0b2;
            border-radius: 50%;
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .eyes {
            display: flex;
            justify-content: space-between;
            width: 50px;
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .eye {
            width: 12px;
            height: 12px;
            background: #333;
            border-radius: 50%;
            animation: blink 4s ease infinite;
        }
        
        .mouth {
            width: 30px;
            height: 10px;
            border-bottom: 3px solid #333;
            border-radius: 0 0 20px 20px;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .hair {
            width: 80px;
            height: 40px;
            background: #ff5722;
            border-radius: 40px 40px 0 0;
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .arm {
            width: 80px;
            height: 20px;
            background: #ff9e7d;
            border-radius: 10px;
            position: absolute;
            top: 50px;
        }
        
        .arm.left {
            left: -30px;
            transform: rotate(30deg);
            transform-origin: right center;
            animation: wave-left 3s ease infinite;
        }
        
        .arm.right {
            right: -30px;
            transform: rotate(-30deg);
            transform-origin: left center;
            animation: wave-right 3s ease infinite 0.5s;
        }
        
        .search-icon {
            position: absolute;
            bottom: 30px;
            right: 30px;
            font-size: 24px;
            color: #ff5722;
            animation: search 4s ease infinite;
        }

        /* Countdown Timer */
        .countdown {
            font-size: 14px;
            color: #ff5722;
            margin-top: 15px;
            font-weight: bold;
        }

        /* Floating Objects */
        .floating-object {
            position: absolute;
            opacity: 0.6;
            z-index: -1;
        }
        
        .object-1 {
            top: 10%;
            left: 5%;
            font-size: 40px;
            animation: float 8s ease infinite;
            color: #ff9e7d;
        }
        
        .object-2 {
            top: 70%;
            right: 5%;
            font-size: 50px;
            animation: float 7s ease infinite 1s;
            color: #ff5722;
        }
        
        .object-3 {
            bottom: 10%;
            left: 15%;
            font-size: 30px;
            animation: float 9s ease infinite 0.5s;
            color: #ff9e7d;
        }

        /* Content */
        h1 {
            font-size: 120px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #ff5722;
            text-shadow: 3px 3px 0 rgba(0,0,0,0.1);
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
        }
        
        p {
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
            color: #666;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Button */
        .home-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 35px;
            background: #ff5722;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 87, 34, 0.4);
            border: none;
            cursor: pointer;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        
        .home-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 87, 34, 0.5);
            background: #ff7043;
        }
        
        .home-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .home-btn:hover::after {
            transform: translateX(0);
        }

        /* Animations */
        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-20px); }
        }
        
        @keyframes blink {
            0%, 45%, 55%, 100% { height: 12px; }
            50% { height: 2px; }
        }
        
        @keyframes wave-left {
            0%, 100% { transform: rotate(30deg); }
            50% { transform: rotate(10deg); }
        }
        
        @keyframes wave-right {
            0%, 100% { transform: rotate(-30deg); }
            50% { transform: rotate(-10deg); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes search {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(15deg); }
            75% { transform: rotate(-15deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 80px;
            }
            
            h2 {
                font-size: 24px;
            }
            
            .container {
                padding: 40px 20px;
            }
            
            .character {
                width: 150px;
                height: 150px;
            }
            
            .character-body {
                width: 90px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Objects -->
    <div class="floating-object object-1">
        <i class="fas fa-question"></i>
    </div>
    <div class="floating-object object-2">
        <i class="fas fa-search"></i>
    </div>
    <div class="floating-object object-3">
        <i class="fas fa-map-signs"></i>
    </div>

    <div class="container">
        <div class="character">
            <div class="hair"></div>
            <div class="character-face">
                <div class="eyes">
                    <div class="eye"></div>
                    <div class="eye"></div>
                </div>
                <div class="mouth"></div>
            </div>
            <div class="character-body">
                <div class="arm left"></div>
                <div class="arm right"></div>
            </div>
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
        </div>
        
        <h1>404</h1>
        <h2>Oops! We're Lost</h2>
        <p>Our little explorer couldn't find the page you're looking for. Maybe it's hiding or went on an adventure. Let's get you back home!</p>
        <a href="https://sknindustries.com/" class="home-btn" id="homeButton">
            <i class="fas fa-home"></i>
            Take Me Home
        </a>
        <div class="countdown" id="countdown">Redirecting you shortly...</div>
    </div>

    <script>
        // Make character interactive
        const character = document.querySelector('.character');
        const homeButton = document.getElementById('homeButton');
        const countdownElement = document.getElementById('countdown');
        
        character.addEventListener('mouseenter', () => {
            character.style.animationPlayState = 'paused';
        });
        
        character.addEventListener('mouseleave', () => {
            character.style.animationPlayState = 'running';
        });
        
        // Add confetti on button click
        homeButton.addEventListener('click', (e) => {
            e.preventDefault();
            triggerConfetti();
            setTimeout(() => {
                window.location.href = homeButton.getAttribute('href');
            }, 1000);
        });
        
        // Auto-click the button after 1 second
        setTimeout(() => {
            countdownElement.textContent = "Taking you home now...";
            homeButton.click();
        }, 1000);
        
        function triggerConfetti() {
            // Create confetti
            for (let i = 0; i < 50; i++) {
                createConfetti();
            }
        }
        
        function createConfetti() {
            const confetti = document.createElement('div');
            confetti.innerHTML = ['🎉', '✨', '🎈', '🌟', '😊'][Math.floor(Math.random() * 5)];
            confetti.style.position = 'fixed';
            confetti.style.fontSize = Math.random() * 20 + 10 + 'px';
            confetti.style.left = Math.random() * window.innerWidth + 'px';
            confetti.style.top = -30 + 'px';
            confetti.style.zIndex = '9999';
            confetti.style.opacity = Math.random() * 0.5 + 0.5;
            confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
            confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
            
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }
        
        // Add fall animation for confetti
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes fall {
                to {
                    transform: translateY(${window.innerHeight + 100}px) rotate(360deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>