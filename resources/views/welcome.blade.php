<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Laut Dalam - Welcome</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: #0a192f;
            color: #ffffff;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Ocean Background */
        .ocean-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: 
                radial-gradient(ellipse at 20% 80%, rgba(64, 224, 208, 0.3) 0%, transparent 40%),
                radial-gradient(ellipse at 80% 20%, rgba(64, 224, 208, 0.2) 0%, transparent 40%),
                radial-gradient(ellipse at 40% 40%, rgba(32, 178, 170, 0.25) 0%, transparent 50%),
                linear-gradient(135deg, #0a192f 0%, #1a365d 50%, #0f3460 100%);
        }
        
        /* Animated Ocean Waves */
        .ocean-waves {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: url('https://media.giphy.com/media/l3q2K5jinAlChoCLS/giphy.gif') repeat-x;
            background-size: contain;
            opacity: 0.4;
            animation: waves 20s linear infinite;
            z-index: -1;
        }
        
        @keyframes waves {
            0% { background-position: 0 0; }
            100% { background-position: 1000px 0; }
        }
        
        /* Bubbles Animation */
        .bubbles {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }
        
        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(64, 224, 208, 0.1);
            border-radius: 50%;
            animation: bubble-rise linear infinite;
        }
        
        @keyframes bubble-rise {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 0.5;
            }
            90% {
                opacity: 0.5;
            }
            100% {
                transform: translateY(-100vh) scale(1.5);
                opacity: 0;
            }
        }
        
        /* Main Content Container */
        .main-content {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }
        
        /* Top Navigation Bar */
        .top-nav {
            padding: 20px 5%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: relative;
            z-index: 10;
        }
        
        .top-nav a {
            text-decoration: none;
            color: #ffffff;
            font-size: 1rem;
        }
        
        /* Centered Content */
        .center-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            text-align: center;
        }
        
        /* Logo Animation */
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
            animation: float 6s ease-in-out infinite;
        }
        
        .logo {
            font-size: 4rem;
            color: #40e0d0;
            text-shadow: 0 0 30px rgba(64, 224, 208, 0.5);
            margin-bottom: 15px;
        }
        
        .logo-text {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #40e0d0, #00ffff, #20b2aa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 10px;
        }
        
        .logo-subtitle {
            font-size: 1rem;
            color: #b0e0e6;
            opacity: 0.8;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        /* Welcome Message */
        .welcome-message {
            max-width: 600px;
            margin: 0 auto 30px;
        }
        
        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
        }
        
        .welcome-subtitle {
            font-size: 1.1rem;
            color: #b0e0e6;
            line-height: 1.5;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 30px auto;
            flex-wrap: wrap;
            max-width: 500px;
        }
        
        .btn {
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            min-width: 160px;
            justify-content: center;
            cursor: pointer;
            border: none;
            outline: none;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s ease;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #40e0d0, #20b2aa);
            color: white;
            box-shadow: 0 8px 25px rgba(64, 224, 208, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 12px 35px rgba(64, 224, 208, 0.4);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(64, 224, 208, 0.3);
            color: #e0f7fa;
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #40e0d0;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(64, 224, 208, 0.2);
        }
        
        .btn i {
            font-size: 1.2rem;
        }
        
        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px auto;
            max-width: 400px;
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(64, 224, 208, 0.1);
        }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #40e0d0;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #b0e0e6;
        }
        
        /* Fish Animation */
        .fish-container {
            position: fixed;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .fish {
            position: absolute;
            width: 40px;
            height: 20px;
            background: url('https://media.giphy.com/media/l0MYt5jPR6QX5pnqM/giphy.gif') no-repeat;
            background-size: contain;
            animation: swim linear infinite;
            filter: brightness(1.2);
            opacity: 0.6;
        }
        
        @keyframes swim {
            0% {
                transform: translateX(-100px) translateY(0) rotateY(0deg);
            }
            49% {
                transform: translateX(calc(100vw + 100px)) translateY(var(--fish-y)) rotateY(0deg);
            }
            50% {
                transform: translateX(calc(100vw + 100px)) translateY(var(--fish-y)) rotateY(180deg);
            }
            99% {
                transform: translateX(-100px) translateY(calc(var(--fish-y) + 50px)) rotateY(180deg);
            }
            100% {
                transform: translateX(-100px) translateY(calc(var(--fish-y) + 50px)) rotateY(0deg);
            }
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: #80d0d0;
            font-size: 0.8rem;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        /* Decorative Corals - Smaller */
        .coral-1 {
            position: fixed;
            bottom: 0;
            left: 2%;
            width: 80px;
            height: 120px;
            background: url('https://media.giphy.com/media/3o6Zt6hxL5hP2XqZ5a/giphy.gif') no-repeat;
            background-size: contain;
            opacity: 0.2;
            z-index: -1;
        }
        
        .coral-2 {
            position: fixed;
            bottom: 0;
            right: 2%;
            width: 70px;
            height: 100px;
            background: url('https://tenor.com/gADC5gftMBe.gif') no-repeat;
            background-size: contain;
            opacity: 0.2;
            transform: scaleX(-1);
            z-index: -1;
        }
        
        /* Typing Animation */
        .typing-text {
            border-right: 2px solid #40e0d0;
            white-space: nowrap;
            overflow: hidden;
            animation: typing 2.5s steps(30, end), blink-caret 0.75s step-end infinite;
            margin: 0 auto;
            max-width: 100%;
            font-size: 1.8rem;
        }
        
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #40e0d0; }
        }
        
        /* Responsive Design - Mobile First */
        @media (max-width: 768px) {
            .logo {
                font-size: 3rem;
            }
            
            .logo-text {
                font-size: 2rem;
            }
            
            .logo-subtitle {
                font-size: 0.9rem;
            }
            
            .welcome-title {
                font-size: 1.6rem;
            }
            
            .typing-text {
                font-size: 1.5rem;
                white-space: normal;
                animation: none;
                border: none;
            }
            
            .welcome-subtitle {
                font-size: 1rem;
            }
            
            .btn {
                padding: 10px 20px;
                font-size: 0.95rem;
                min-width: 140px;
            }
            
            .action-buttons {
                gap: 10px;
                margin: 20px auto;
            }
            
            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                max-width: 350px;
            }
            
            .stat-item {
                padding: 10px;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .top-nav {
                padding: 15px 5%;
            }
            
            .ocean-waves {
                height: 100px;
            }
        }
        
        @media (max-width: 480px) {
            .logo-text {
                font-size: 1.6rem;
            }
            
            .typing-text {
                font-size: 1.3rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
                width: 100%;
                max-width: 300px;
            }
            
            .btn {
                width: 100%;
                max-width: 280px;
            }
            
            .quick-stats {
                grid-template-columns: 1fr;
                max-width: 250px;
            }
            
            .ocean-waves {
                height: 80px;
            }
            
            .coral-1, .coral-2 {
                display: none;
            }
        }
        
        @media (min-width: 1024px) {
            .logo {
                font-size: 5rem;
            }
            
            .logo-text {
                font-size: 3.5rem;
            }
            
            .welcome-title {
                font-size: 2.5rem;
            }
            
            .btn {
                padding: 14px 35px;
                font-size: 1.1rem;
                min-width: 180px;
            }
            
            .quick-stats {
                grid-template-columns: repeat(4, 1fr);
                max-width: 600px;
                gap: 20px;
            }
            
            .stat-number {
                font-size: 2.2rem;
            }
        }
        
        /* No Scroll Needed */
        html, body {
            overflow-y: hidden;
            height: 100%;
        }
        
        .main-content {
            height: 100vh;
        }
        
        /* For very small screens */
        @media (max-height: 600px) {
            .logo-container {
                margin-bottom: 15px;
            }
            
            .welcome-message {
                margin-bottom: 15px;
            }
            
            .action-buttons {
                margin: 15px auto;
            }
            
            .quick-stats {
                margin: 10px auto;
            }
            
            .footer {
                padding: 10px;
                font-size: 0.7rem;
            }
        }
        
        /* Smooth animations */
        .center-content > * {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .center-content > *:nth-child(1) { animation-delay: 0.2s; }
        .center-content > *:nth-child(2) { animation-delay: 0.4s; }
        .center-content > *:nth-child(3) { animation-delay: 0.6s; }
        .center-content > *:nth-child(4) { animation-delay: 0.8s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Ocean Background -->
    <div class="ocean-bg"></div>
    <div class="ocean-waves"></div>
    
    <!-- Bubbles -->
    <div class="bubbles" id="bubbles"></div>
    
    <!-- Fish Animation -->
    <div class="fish-container" id="fish-container"></div>
    
    <!-- Decorative Corals -->
    <div class="coral-1"></div>
    <div class="coral-2"></div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary" style="min-width: auto; padding: 8px 20px;">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                @endauth
            @endif
        </div>
        
        <!-- Centered Content -->
        <div class="center-content">
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo">
                    <i class="bi bi-water"></i>
                </div>
                <h1 class="logo-text">Perpustakaan Laut Dalam</h1>
                <p class="logo-subtitle">Menyelam dalam Samudra Pengetahuan</p>
            </div>
            
            <!-- Welcome Message -->
            <div class="welcome-message">
                <h1 class="welcome-title typing-text">Selamat Datang</h1>
                <p class="welcome-subtitle">
                    Temukan harta karun pengetahuan di perpustakaan digital kami. 
                    Akses ribuan buku dari berbagai genre kapan saja, di mana saja.
                </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary">
                                <i class="bi bi-person-plus"></i>
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
            
            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="stat-item">
                    <div class="stat-number" data-count="1000">0</div>
                    <div class="stat-label">Buku</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="50">0</div>
                    <div class="stat-label">Kategori</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="24">0</div>
                    <div class="stat-label">Jam</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="5000">0</div>
                    <div class="stat-label">Anggota</div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Perpustakaan Laut Dalam. All rights reserved.</p>
        </footer>
    </div>
    
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create bubbles
            const bubblesContainer = document.getElementById('bubbles');
            for (let i = 0; i < 15; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                const size = Math.random() * 40 + 15;
                const left = Math.random() * 100;
                const duration = Math.random() * 15 + 8;
                const delay = Math.random() * 8;
                
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${left}%`;
                bubble.style.animationDuration = `${duration}s`;
                bubble.style.animationDelay = `${delay}s`;
                
                bubblesContainer.appendChild(bubble);
            }
            
            // Create fish
            const fishContainer = document.getElementById('fish-container');
            for (let i = 0; i < 3; i++) {
                const fish = document.createElement('div');
                fish.classList.add('fish');
                const duration = Math.random() * 25 + 15;
                const delay = Math.random() * 8;
                const fishY = Math.random() * 80 + 10;
                
                fish.style.setProperty('--fish-y', `${fishY}vh`);
                fish.style.animationDuration = `${duration}s`;
                fish.style.animationDelay = `${delay}s`;
                fish.style.top = `${fishY}vh`;
                
                fishContainer.appendChild(fish);
            }
            
            // Animate stats
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-count'));
                let current = 0;
                const increment = target / 50; // Faster animation
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    stat.textContent = Math.floor(current);
                }, 30);
            });
            
            // Prevent scrolling
            document.body.style.overflow = 'hidden';
            
            // Check if on mobile and adjust layout
            function adjustForMobile() {
                if (window.innerWidth <= 480) {
                    const centerContent = document.querySelector('.center-content');
                    if (centerContent) {
                        centerContent.style.paddingTop = '20px';
                    }
                }
            }
            
            adjustForMobile();
            window.addEventListener('resize', adjustForMobile);
        });
        
        // Interactive background effect
        document.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            const oceanBg = document.querySelector('.ocean-bg');
            if (oceanBg) {
                oceanBg.style.backgroundPosition = `${x * 30}% ${y * 30}%`;
            }
        });
        
        // Dynamic particle effects on button click
        function createParticle(e) {
            if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A') {
                for (let i = 0; i < 3; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('bubble');
                    const size = Math.random() * 15 + 5;
                    const left = e.clientX;
                    const top = e.clientY;
                    
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${left}px`;
                    particle.style.top = `${top}px`;
                    particle.style.position = 'fixed';
                    particle.style.animationDuration = '0.8s';
                    particle.style.zIndex = '1000';
                    particle.style.opacity = '0.7';
                    
                    document.body.appendChild(particle);
                    
                    setTimeout(() => {
                        particle.remove();
                    }, 800);
                }
            }
        }
        
        document.addEventListener('click', createParticle);
        
        // Auto-focus on login button for better UX
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.querySelector('a[href*="login"]');
            if (loginBtn && !window.location.href.includes('login')) {
                loginBtn.focus();
            }
        });
    </script>
</body>
</html>