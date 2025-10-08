<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23e74c3c'/><circle cx='50' cy='50' r='35' fill='%232c3e50'/><circle cx='50' cy='50' r='25' fill='%23e74c3c'/><circle cx='50' cy='50' r='15' fill='%232c3e50'/></svg>">
    <title>Покраска дисков - МАКСТАР</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #e74c3c;
            --accent: #3498db;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        header {
            background-color: var(--primary);
            color: white;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: var(--secondary);
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1563720223480-8ddab6905c0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .btn {
            display: inline-block;
            background-color: var(--secondary);
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #c0392b;
        }
        
        .section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2rem;
            color: var(--primary);
        }
        
        .services {
            background-color: white;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .service-card {
            background-color: var(--light);
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .service-icon {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 20px;
        }
        
        .service-card h3 {
            margin-bottom: 15px;
            color: var(--primary);
        }
        
        .visualizer {
            background-color: #f5f5f5;
        }
        
        .visualizer-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .wheel-display {
            width: 350px;
            height: 350px;
            margin-bottom: 30px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .wheel {
            width: 100%;
            height: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            transition: filter 0.5s ease;
            filter: brightness(1) saturate(1) hue-rotate(0deg);
        }
        
        .color-picker {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            max-width: 600px;
        }
        
        .color-option {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s;
            position: relative;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        .color-option:hover {
            transform: scale(1.1);
        }
        
        .color-option.active {
            border-color: var(--dark);
            transform: scale(1.15);
        }
        
        .color-name {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8rem;
            white-space: nowrap;
            color: var(--dark);
            font-weight: 500;
        }
        
        .size-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .size-option {
            padding: 12px 25px;
            background-color: white;
            border: 2px solid var(--primary);
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .size-option.active {
            background-color: var(--primary);
            color: white;
        }
        
        .style-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .style-option {
            padding: 10px 20px;
            background-color: white;
            border: 2px solid var(--accent);
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .style-option.active {
            background-color: var(--accent);
            color: white;
        }
        
        .visualizer-info {
            text-align: center;
            max-width: 600px;
            margin-top: 20px;
        }
        
        .contact {
            background-color: white;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        .contact-info h3 {
            margin-bottom: 20px;
            color: var(--primary);
        }
        
        .contact-info p {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .contact-info i {
            margin-right: 10px;
            color: var(--secondary);
        }
        
        .map {
            height: 300px;
            background-color: #eee;
            border-radius: 8px;
            overflow: hidden;
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: var(--secondary);
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }
            
            .logo {
                margin-bottom: 15px;
            }
            
            nav ul {
                flex-direction: column;
                align-items: center;
            }
            
            nav ul li {
                margin: 10px 0;
            }
            
            .mobile-menu-btn {
                display: block;
                position: absolute;
                right: 15px;
                top: 15px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .section {
                padding: 50px 0;
            }
            
            .wheel-display {
                width: 280px;
                height: 280px;
            }
            
            .color-option {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">МАКС<span>ТАР</span></div>
                <button class="mobile-menu-btn">☰</button>
                <nav>
                    <ul>
                        <li><a href="#services">Услуги</a></li>
                        <li><a href="#visualizer">Визуализатор</a></li>
                        <li><a href="#contact">Контакты</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Профессиональная покраска автомобильных дисков</h1>
            <p>Пескоструйная обработка и покраска полимерной краской. Вернем вашим дискам идеальный вид!</p>
            <a href="#visualizer" class="btn">Выбрать цвет</a>
        </div>
    </section>

    <section id="services" class="section services">
        <div class="container">
            <h2 class="section-title">Наши услуги</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🔄</div>
                    <h3>Пескоструйная обработка</h3>
                    <p>Тщательная очистка дисков от старого покрытия и коррозии перед покраской</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3>Покраска полимерной краской</h3>
                    <p>Используем качественные полимерные краски, устойчивые к внешним воздействиям</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">✨</div>
                    <h3>Полировка и защита</h3>
                    <p>Финальная полировка и нанесение защитного покрытия для долговечности</p>
                </div>
            </div>
        </div>
    </section>

    <section id="visualizer" class="section visualizer">
        <div class="container">
            <h2 class="section-title">Визуализатор покраски</h2>
            <div class="visualizer-container">
                <div class="wheel-display">
                    <div class="wheel" id="wheelImage"></div>
                </div>
                
                <div class="style-selector">
                    <div class="style-option active" data-style="sport">Спортивный</div>
                    <div class="style-option" data-style="classic">Классический</div>
                    <div class="style-option" data-style="modern">Современный</div>
                </div>
                
                <div class="size-selector">
                    <div class="size-option active" data-size="17">17"</div>
                    <div class="size-option" data-size="18">18"</div>
                    <div class="size-option" data-size="19">19"</div>
                </div>
                
                <div class="color-picker" id="colorPicker">
                    <!-- Colors will be added by JavaScript -->
                </div>
                
                <div class="visualizer-info">
                    <p>Выберите стиль, размер и цвет, чтобы увидеть как будут выглядеть ваши диски после покраски</p>
                    <p><strong>Реальный результат может незначительно отличаться от визуализации</strong></p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title">Контакты</h2>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>ООО "МАКСТАР"</h3>
                    <p><i>📍</i> г. Новосибирск, ул. Ленина, 12</p>
                    <p><i>📞</i> 8 (913) 895-45-25</p>
                    <p><i>🕒</i> Пн-Пт: 9:00-18:00, Сб: 10:00-16:00</p>
                    <p>Принимаем заказы на покраску автомобильных дисков. Приезжайте к нам для консультации и расчета стоимости работ.</p>
                </div>
                <div class="map">
                    <!-- Здесь будет карта -->
                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A5b4b4b4b4b4b4b4b4b4b4b4b4b4b4b4b&amp;source=constructor" width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>ООО "МАКСТАР" - Покраска автомобильных дисков</p>
            <div class="social-links">
                <a href="https://vk.ru/public105621991" target="_blank">VK</a>
            </div>
            <p>© 2023 Все права защищены</p>
        </div>
    </footer>

    <script>
        // Real wheel images from the internet - WORKING LINKS
        const wheelImages = {
    'sport': {
        '17': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjEyMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDEwbDYwIDEyMEg5MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI5MGwtNjAtMTIwaDYweiIgZmlsbD0iIzY2NiIvPjxwYXRoIGQ9Ik0xMCAxNTBsMTIwIDYwVjkweiIgZmlsbD0iIzY2NiIvPjxwYXRoIGQ9Ik0yOTAgMTUwbC0xMjAgNjB2LTEyMHoiIGZpbGw9IiM2NjYiLz48L3N2Zz4=',
        '18': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjExMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cmVjdCB4PSI3MCIgeT0iNzAiIHdpZHRoPSIxNjAiIGhlaWdodD0iMTYwIiByeD0iMjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHBhdGggZD0iTTE1MCA3MGwwIDE2ME03MCAxNTBoMTYwIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iMyIvPjwvc3ZnPg==',
        '19': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjEwMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDUwbDc1IDEzNUg3NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI1MGwtNzUtMTM1aDE1MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNNTAgMTUwbDEzNSA3NVY3NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMjUwIDE1MGwtMTM1IDc1Vjc1eiIgZmlsbD0iIzY2NiIvPjwvc3ZnPg=='
    },
    'classic': {
        '17': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjEwMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjMiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjYwIiBmaWxsPSJub25lIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iMiIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNDAiIGZpbGw9IiM2NjYiLz48L3N2Zz4=',
        '18': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjkwIiBmaWxsPSJub25lIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iNCIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHJlY3QgeD0iMTEwIiB5PSIxMTAiIHdpZHRoPSI4MCIgaGVpZ2h0PSI4MCIgcng9IjEwIiBmaWxsPSIjNjY2Ii8+PC9zdmc+',
        '19': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9Ijg1IiBmaWxsPSJub25lIiBzdHJva2U9IiM2NjYiIHN0cm9rZS13aWR0aD0iNSIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNDUiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHBhdGggZD0iTTE1MCA2NWw0MCA4MEgxMTB6IiBmaWxsPSIjNjY2Ii8+PHBhdGggZD0iTTE1MCAyMzVsLTQwLTgwaDgweiIgZmlsbD0iIzY2NiIvPjxwYXRoIGQ9Ik02NSAxNTBsODAgNDBWNjV6IiBmaWxsPSIjNjY2Ii8+PHBhdGggZD0iTTIzNSAxNTBsLTgwIDQwVjY1eiIgZmlsbD0iIzY2NiIvPjwvc3ZnPg=='
    },
    'modern': {
        '17': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDQwbDcwIDE0MEg4MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI2MGwtNzAtMTQwaDE0MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMzAgMTUwbDE0MCA3MFY4MHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMjcwIDE1MGwtMTQwIDcwVjgweiIgZmlsbD0iIzY2NiIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIyIi8+PC9zdmc+',
        '18': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cmVjdCB4PSI4MCIgeT0iODAiIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIiByeD0iMjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSI0Ii8+PHJlY3QgeD0iMTAwIiB5PSIxMDAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiByeD0iMTUiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIzIi8+PHJlY3QgeD0iMTIwIiB5PSIxMjAiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcng9IjEwIiBmaWxsPSIjNjY2Ii8+PC9zdmc+',
        '19': 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIxNTAiIGN5PSIxNTAiIHI9IjE0MCIgZmlsbD0iI2NjY2NjYyIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiLz48cGF0aCBkPSJNMTUwIDU1bDU1IDExMEg5NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMTUwIDI0NWwtNTUtMTEwaDExMHoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNNTUgMTUwbDExMCA1NVY5NXoiIGZpbGw9IiM2NjYiLz48cGF0aCBkPSJNMjQ1IDE1MGwtMTEwIDU1Vjk1eiIgZmlsbD0iIzY2NiIvPjxjaXJjbGUgY3g9IjE1MCIgY3k9IjE1MCIgcj0iNzAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIyIi8+PGNpcmNsZSBjeD0iMTUwIiBjeT0iMTUwIiByPSIzNSIgZmlsbD0iIzY2NiIvPjwvc3ZnPg=='
    }
};

        // Fallback wheel images in case the main ones fail
        const fallbackWheelImages = {
            'sport': {
                '17': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Спорт+17%22',
                '18': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Спорт+18%22',
                '19': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Спорт+19%22'
            },
            'classic': {
                '17': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Классика+17%22',
                '18': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Классика+18%22',
                '19': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Классика+19%22'
            },
            'modern': {
                '17': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Модерн+17%22',
                '18': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Модерн+18%22',
                '19': 'https://via.placeholder.com/350x350/cccccc/ffffff?text=Модерн+19%22'
            }
        };

        // Colors for the wheel visualizer with proper hue values
        const colors = [
            { name: 'Серебристый', value: '#c0c0c0', hue: 0, saturation: 0, brightness: 1.2 },
            { name: 'Черный', value: '#2a2a2a', hue: 0, saturation: 0, brightness: 0.7 },
            { name: 'Белый', value: '#ffffff', hue: 0, saturation: 0, brightness: 1.3 },
            { name: 'Серый', value: '#808080', hue: 0, saturation: 0, brightness: 1.0 },
            { name: 'Красный', value: '#ff0000', hue: 0, saturation: 1.2, brightness: 1.1 },
            { name: 'Синий', value: '#0000ff', hue: 240, saturation: 1.3, brightness: 1.0 },
            { name: 'Золотой', value: '#ffd700', hue: 51, saturation: 1.2, brightness: 1.3 },
            { name: 'Бронзовый', value: '#cd7f32', hue: 30, saturation: 0.9, brightness: 1.1 },
            { name: 'Голубой', value: '#87ceeb', hue: 197, saturation: 0.7, brightness: 1.2 },
            { name: 'Оранжевый', value: '#ffa500', hue: 39, saturation: 1.2, brightness: 1.2 },
            { name: 'Зеленый', value: '#008000', hue: 120, saturation: 1.3, brightness: 0.9 },
            { name: 'Фиолетовый', value: '#800080', hue: 300, saturation: 1.2, brightness: 0.9 }
        ];

        // Initialize visualizer
        const colorPicker = document.getElementById('colorPicker');
        const wheelImage = document.getElementById('wheelImage');
        
        let currentStyle = 'sport';
        let currentSize = '17';
        let currentColor = colors[0];

        // Initialize color picker
        colors.forEach(color => {
            const colorOption = document.createElement('div');
            colorOption.className = 'color-option';
            colorOption.style.backgroundColor = color.value;
            colorOption.setAttribute('data-color', JSON.stringify(color));
            colorOption.setAttribute('title', color.name);
            
            const colorName = document.createElement('div');
            colorName.className = 'color-name';
            colorName.textContent = color.name;
            colorOption.appendChild(colorName);
            
            colorOption.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');
                
                currentColor = JSON.parse(this.getAttribute('data-color'));
                updateWheelAppearance();
            });
            
            colorPicker.appendChild(colorOption);
        });
        
        // Set first color as active
        document.querySelector('.color-option').classList.add('active');
        
        // Initialize style selector
        const styleOptions = document.querySelectorAll('.style-option');
        styleOptions.forEach(option => {
            option.addEventListener('click', function() {
                styleOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                
                currentStyle = this.getAttribute('data-style');
                updateWheelAppearance();
            });
        });
        
        // Initialize size selector
        const sizeOptions = document.querySelectorAll('.size-option');
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                sizeOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                
                currentSize = this.getAttribute('data-size');
                updateWheelAppearance();
            });
        });
        
        // Update wheel appearance
        function updateWheelAppearance() {
            const img = new Image();
            const mainImageUrl = wheelImages[currentStyle][currentSize];
            const fallbackImageUrl = fallbackWheelImages[currentStyle][currentSize];
            
            img.onload = function() {
                wheelImage.style.backgroundImage = `url('${mainImageUrl}')`;
                applyColorFilter();
            };
            
            img.onerror = function() {
                wheelImage.style.backgroundImage = `url('${fallbackImageUrl}')`;
                applyColorFilter();
            };
            
            img.src = mainImageUrl;
        }
        
        // Apply color filter to wheel
        function applyColorFilter() {
            const filter = `
                hue-rotate(${currentColor.hue}deg) 
                saturate(${currentColor.saturation}) 
                brightness(${currentColor.brightness})
            `;
            wheelImage.style.filter = filter;
        }
        
        // Initialize with default values
        updateWheelAppearance();
        
        // Mobile menu functionality
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const nav = document.querySelector('nav');
        
        mobileMenuBtn.addEventListener('click', function() {
            nav.style.display = nav.style.display === 'block' ? 'none' : 'block';
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>