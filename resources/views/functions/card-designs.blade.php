@extends('layouts.app')

@section('title', 'Card Designs')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 15px;">Card Design Collection</h1>
        <p style="color: #666; font-size: 16px;">Explore various card designs and layouts for your applications</p>
    </div>

    <!-- Card Style Selector -->
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; margin-bottom: 30px;">
        <h2 style="font-size: 20px; font-weight: 600; color: #1a1a1a; margin-bottom: 20px;">Card Styles</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
            <button onclick="switchCardStyle('default')" id="card-default" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Default</button>
            <button onclick="switchCardStyle('minimalistic')" id="card-minimalistic" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Minimalistic</button>
            <button onclick="switchCardStyle('modern')" id="card-modern" style="padding: 10px 20px; background: #6f42c1; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Modern</button>
            <button onclick="switchCardStyle('glassmorphism')" id="card-glassmorphism" style="padding: 10px 20px; background: #6610f2; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Glassmorphism</button>
            <button onclick="switchCardStyle('neumorphism')" id="card-neumorphism" style="padding: 10px 20px; background: #e83e8c; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Neumorphism</button>
            <button onclick="switchCardStyle('dark')" id="card-dark" style="padding: 10px 20px; background: #343a40; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Dark</button>
        </div>
    </div>

    <!-- Card Showcase -->
    <div  style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">
        @foreach($cardData as $card)
        <div class="card-item" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease;">
            <div class="card-image" style="position: relative;">
                <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" style="width: 100%; height: 200px; object-fit: cover;">
                <div class="card-badge" style="position: absolute; top: 10px; right: 10px; background: #dc3545; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: 600;">{{ $card['badge'] }}</div>
            </div>
            <div class="card-content" style="padding: 20px;">
                <div class="card-header" style="margin-bottom: 10px;">
                    <h3 class="card-title" style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin: 0 0 5px 0;">{{ $card['title'] }}</h3>
                    <p class="card-subtitle" style="font-size: 14px; color: #666; margin: 0;">{{ $card['subtitle'] }}</p>
                </div>
                <p class="card-description" style="color: #666; font-size: 14px; margin-bottom: 15px; line-height: 1.5;">{{ $card['description'] }}</p>
                <div class="card-rating" style="display: flex; align-items: center; margin-bottom: 15px;">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star" style="color: {{ $i <= $card['rating'] ? '#ffc107' : '#e9ecef' }}; font-size: 16px; margin-right: 2px;">★</span>
                    @endfor
                    <span class="rating-text" style="margin-left: 8px; font-size: 14px; color: #666;">{{ $card['rating'] }}</span>
                </div>
                <div class="card-tags" style="display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 15px;">
                    @foreach($card['tags'] as $tag)
                    <span class="card-tag" style="background: #f8f9fa; color: #495057; padding: 4px 8px; border-radius: 12px; font-size: 12px;">{{ $tag }}</span>
                    @endforeach
                </div>
                <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="card-price" style="font-size: 20px; font-weight: 700; color: #28a745;">{{ $card['price'] }}</div>
                    <button class="card-button" style="background: #007bff; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500; transition: background 0.3s ease;">Buy Now</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Additional Card Variants -->
    <div style="margin-bottom: 30px;">
        <!-- Profile Cards -->
        <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; margin-bottom: 30px;">
            <h2 style="font-size: 24px; font-weight: 600; color: #1a1a1a; margin-bottom: 25px;">Profile Cards</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="profile-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; text-align: center;">
                    <div class="profile-image" style="margin-bottom: 20px;">
                        <img src="https://picsum.photos/100/100?random=10" alt="Profile" style="width: 80px; height: 80px; border-radius: 50%; margin: 0 auto; display: block;">
                    </div>
                    <div class="profile-info">
                        <h3 style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin: 0 0 5px 0;">John Doe</h3>
                        <p style="font-size: 14px; color: #666; margin: 0 0 20px 0;">Frontend Developer</p>
                        <div class="social-links" style="display: flex; justify-content: center; gap: 15px; margin-bottom: 20px;">
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">LinkedIn</a>
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">Twitter</a>
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">GitHub</a>
                        </div>
                        <button class="profile-button" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Follow</button>
                    </div>
                </div>

                <div class="profile-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; text-align: center;">
                    <div class="profile-image" style="margin-bottom: 20px;">
                        <img src="https://picsum.photos/100/100?random=11" alt="Profile" style="width: 80px; height: 80px; border-radius: 50%; margin: 0 auto; display: block;">
                    </div>
                    <div class="profile-info">
                        <h3 style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin: 0 0 5px 0;">Jane Smith</h3>
                        <p style="font-size: 14px; color: #666; margin: 0 0 20px 0;">UI/UX Designer</p>
                        <div class="social-links" style="display: flex; justify-content: center; gap: 15px; margin-bottom: 20px;">
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">Dribbble</a>
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">Behance</a>
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">Instagram</a>
                        </div>
                        <button class="profile-button" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Follow</button>
                    </div>
                </div>

                <div class="profile-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; text-align: center;">
                    <div class="profile-image" style="margin-bottom: 20px;">
                        <img src="https://picsum.photos/100/100?random=12" alt="Profile" style="width: 80px; height: 80px; border-radius: 50%; margin: 0 auto; display: block;">
                    </div>
                    <div class="profile-info">
                        <h3 style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin: 0 0 5px 0;">Bob Johnson</h3>
                        <p style="font-size: 14px; color: #666; margin: 0 0 20px 0;">Full Stack Developer</p>
                        <div class="social-links" style="display: flex; justify-content: center; gap: 15px; margin-bottom: 20px;">
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">GitHub</a>
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">Stack Overflow</a>
                            <a href="#" class="social-link" style="color: #007bff; text-decoration: none; font-size: 14px;">Medium</a>
                        </div>
                        <button class="profile-button" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 500;">Follow</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistic Cards -->
        <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; margin-bottom: 30px;">
            <h2 style="font-size: 24px; font-weight: 600; color: #1a1a1a; margin-bottom: 25px;">Statistic Cards</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="stat-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; display: flex; align-items: center;">
                    <div class="stat-icon" style="margin-right: 20px;">
                        <svg style="width: 32px; height: 32px; color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number" style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin: 0;">12,345</h3>
                        <p class="stat-label" style="font-size: 14px; color: #666; margin: 0;">Users</p>
                        <p class="stat-change positive" style="font-size: 14px; font-weight: 500; color: #28a745; margin: 0;">+12%</p>
                    </div>
                </div>

                <div class="stat-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; display: flex; align-items: center;">
                    <div class="stat-icon" style="margin-right: 20px;">
                        <svg style="width: 32px; height: 32px; color: #28a745;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number" style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin: 0;">$89,432</h3>
                        <p class="stat-label" style="font-size: 14px; color: #666; margin: 0;">Revenue</p>
                        <p class="stat-change positive" style="font-size: 14px; font-weight: 500; color: #28a745; margin: 0;">+8%</p>
                    </div>
                </div>

                <div class="stat-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; display: flex; align-items: center;">
                    <div class="stat-icon" style="margin-right: 20px;">
                        <svg style="width: 32px; height: 32px; color: #ffc107;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4l1-12z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number" style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin: 0;">2,156</h3>
                        <p class="stat-label" style="font-size: 14px; color: #666; margin: 0;">Orders</p>
                        <p class="stat-change positive" style="font-size: 14px; font-weight: 500; color: #28a745; margin: 0;">+15%</p>
                    </div>
                </div>

                <div class="stat-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; display: flex; align-items: center;">
                    <div class="stat-icon" style="margin-right: 20px;">
                        <svg style="width: 32px; height: 32px; color: #dc3545;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number" style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin: 0;">94.3%</h3>
                        <p class="stat-label" style="font-size: 14px; color: #666; margin: 0;">Satisfaction</p>
                        <p class="stat-change negative" style="font-size: 14px; font-weight: 500; color: #dc3545; margin: 0;">-2%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Cards -->
        <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px;">
            <h2 style="font-size: 24px; font-weight: 600; color: #1a1a1a; margin-bottom: 25px;">Feature Cards</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="feature-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; text-align: center;">
                    <div class="feature-icon" style="margin-bottom: 20px;">
                        <svg style="width: 48px; height: 48px; color: #007bff; margin: 0 auto; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title" style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin: 0 0 10px 0;">Lightning Fast</h3>
                        <p class="feature-description" style="color: #666; font-size: 14px; margin: 0;">Optimized performance for blazing fast user experience</p>
                    </div>
                </div>

                <div class="feature-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; text-align: center;">
                    <div class="feature-icon" style="margin-bottom: 20px;">
                        <svg style="width: 48px; height: 48px; color: #28a745; margin: 0 auto; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title" style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin: 0 0 10px 0;">Secure</h3>
                        <p class="feature-description" style="color: #666; font-size: 14px; margin: 0;">Enterprise-grade security with advanced encryption</p>
                    </div>
                </div>

                <div class="feature-card" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 25px; text-align: center;">
                    <div class="feature-icon" style="margin-bottom: 20px;">
                        <svg style="width: 48px; height: 48px; color: #6f42c1; margin: 0 auto; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title" style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin: 0 0 10px 0;">User Friendly</h3>
                        <p class="feature-description" style="color: #666; font-size: 14px; margin: 0;">Intuitive interface designed for the best user experience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div style="background: #f8f9fa; border-radius: 8px; padding: 25px; margin-top: 30px;">
        <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px;">Card Implementation Example:</h2>
        <pre style="background: #1a1a1a; color: #00ff00; padding: 20px; border-radius: 5px; overflow-x: auto; font-family: monospace; font-size: 14px; line-height: 1.5; margin: 0;"><code id="card-code">
<!-- Default Card HTML -->
&lt;div class="card-item"&gt;
    &lt;div class="card-image"&gt;
        &lt;img src="image.jpg" alt="Card Image" class="w-full h-48 object-cover"&gt;
        &lt;div class="card-badge"&gt;New&lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="card-content"&gt;
        &lt;div class="card-header"&gt;
            &lt;h3 class="card-title"&gt;Card Title&lt;/h3&gt;
            &lt;p class="card-subtitle"&gt;Subtitle&lt;/p&gt;
        &lt;/div&gt;
        &lt;p class="card-description"&gt;Card description text&lt;/p&gt;
        &lt;div class="card-footer"&gt;
            &lt;div class="card-price"&gt;$99.99&lt;/div&gt;
            &lt;button class="card-button"&gt;Buy Now&lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
        </code></pre>
    </div>
</div>

<style>
/* Card hover effects */
.card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.card-button:hover {
    opacity: 0.9;
}

.profile-button:hover {
    opacity: 0.9;
}

.social-link:hover {
    opacity: 0.8;
}

/* Card style variations */
.card-minimalistic .card-item {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 0;
    box-shadow: none;
}

.card-minimalistic .card-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.card-minimalistic .card-badge {
    background: #000;
    color: white;
    border-radius: 0;
    padding: 8px 12px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.card-minimalistic .card-title {
    font-size: 16px;
    font-weight: 400;
    color: #1a1a1a;
}

.card-minimalistic .card-subtitle {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #6c757d;
}

.card-minimalistic .card-description {
    color: #495057;
    font-size: 14px;
    line-height: 1.6;
}

.card-minimalistic .card-button {
    background: #000;
    color: white;
    padding: 10px 25px;
    border-radius: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 12px;
}

.card-modern .card-item {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: none;
}

.card-modern .card-badge {
    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
    color: white;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 500;
}

.card-modern .card-title {
    font-size: 20px;
    font-weight: 700;
    color: #1a1a1a;
}

.card-modern .card-subtitle {
    font-size: 14px;
    color: #007bff;
    font-weight: 500;
}

.card-modern .card-button {
    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
    color: white;
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: 500;
}

.card-glassmorphism {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    padding: 20px;
}

.card-glassmorphism .card-item {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.3);
}

.card-glassmorphism .card-item:hover {
    background: rgba(255,255,255,0.3);
}

.card-glassmorphism .card-badge {
    background: rgba(255,255,255,0.3);
    color: #1a1a1a;
    border-radius: 20px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.card-glassmorphism .card-title {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.card-glassmorphism .card-subtitle {
    font-size: 14px;
    color: #495057;
}

.card-glassmorphism .card-button {
    background: rgba(255,255,255,0.3);
    color: #1a1a1a;
    padding: 10px 25px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
}

.card-glassmorphism .card-button:hover {
    background: rgba(255,255,255,0.5);
}

.card-neumorphism .card-item {
    background: #e0e5ec;
    border-radius: 25px;
    box-shadow: 20px 20px 40px #a3b1c6, -20px -20px 40px #ffffff;
    border: none;
}

.card-neumorphism .card-item:hover {
    box-shadow: inset 8px 8px 16px #a3b1c6, inset -8px -8px 16px #ffffff;
}

.card-neumorphism .card-badge {
    background: #e0e5ec;
    color: #495057;
    border-radius: 20px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 500;
    box-shadow: inset 5px 5px 10px #a3b1c6, inset -5px -5px 10px #ffffff;
}

.card-neumorphism .card-title {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.card-neumorphism .card-button {
    background: #e0e5ec;
    color: #1a1a1a;
    padding: 10px 25px;
    border-radius: 20px;
    box-shadow: 5px 5px 10px #a3b1c6, -5px -5px 10px #ffffff;
}

.card-neumorphism .card-button:hover {
    background: #d1d9e6;
}

.card-dark .card-item {
    background: #2d3748;
    border-radius: 8px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    border: 1px solid #4a5568;
}

.card-dark .card-badge {
    background: #6f42c1;
    color: white;
    border-radius: 20px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 500;
}

.card-dark .card-title {
    font-size: 18px;
    font-weight: 600;
    color: white;
}

.card-dark .card-subtitle {
    font-size: 14px;
    color: #a0aec0;
}

.card-dark .card-description {
    color: #cbd5e0;
    font-size: 14px;
}

.card-dark .card-price {
    color: #48bb78;
}

.card-dark .card-button {
    background: #6f42c1;
    color: white;
    padding: 10px 25px;
    border-radius: 5px;
}

.card-dark .card-button:hover {
    background: #553c9a;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-showcase {
        grid-template-columns: 1fr;
    }

    .stat-card {
        flex-direction: column;
        text-align: center;
    }

    .stat-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }
}
</style>

<script>
function switchCardStyle(style) {
    var buttons = document.querySelectorAll('[id^="card-"]');

    // Remove all card style classes
    showcase.className = showcase.className.replace(/card-\w+/g, '');

    // Add new style class
    showcase.classList.add('card-' + style);

    // Reset all buttons to default colors
    buttons.forEach(function(btn) {
        btn.style.background = getDefaultButtonColor(btn.id);
        btn.style.opacity = '0.8';
    });

    // Highlight active button
    var activeBtn = document.getElementById('card-' + style);
    if (activeBtn) {
        activeBtn.style.background = getActiveButtonColor(style);
        activeBtn.style.opacity = '1';
    }

    // Update code example
    updateCodeExample(style);
}

function getDefaultButtonColor(buttonId) {
    var colorMap = {
        'card-default': '#007bff',
        'card-minimalistic': '#6c757d',
        'card-modern': '#6f42c1',
        'card-glassmorphism': '#6610f2',
        'card-neumorphism': '#e83e8c',
        'card-dark': '#343a40'
    };
    return colorMap[buttonId] || '#007bff';
}

function getActiveButtonColor(style) {
    var colorMap = {
        'default': '#0056b3',
        'minimalistic': '#495057',
        'modern': '#553c9a',
        'glassmorphism': '#520dc2',
        'neumorphism': '#c42a6b',
        'dark': '#1d2124'
    };
    return colorMap[style] || '#0056b3';
}

function updateCodeExample(style) {
    var codeElement = document.getElementById('card-code');
    var examples = {
        'default': '<!-- Default Card HTML -->\n&lt;div class="card-item"&gt;\n    &lt;div class="card-image"&gt;\n        &lt;img src="image.jpg" alt="Card Image" style="width: 100%; height: 200px; object-fit: cover;"&gt;\n        &lt;div class="card-badge"&gt;New&lt;/div&gt;\n    &lt;/div&gt;\n    &lt;div class="card-content"&gt;\n        &lt;div class="card-header"&gt;\n            &lt;h3 class="card-title"&gt;Card Title&lt;/h3&gt;\n            &lt;p class="card-subtitle"&gt;Subtitle&lt;/p&gt;\n        &lt;/div&gt;\n        &lt;p class="card-description"&gt;Card description text&lt;/p&gt;\n        &lt;div class="card-footer"&gt;\n            &lt;div class="card-price"&gt;$99.99&lt;/div&gt;\n            &lt;button class="card-button"&gt;Buy Now&lt;/button&gt;\n        &lt;/div&gt;\n    &lt;/div&gt;\n&lt;/div&gt;',
        'minimalistic': '<!-- Minimalistic Card CSS -->\n.card-minimalistic .card-item {\n    background: white;\n    border: 1px solid #e9ecef;\n    border-radius: 0;\n    box-shadow: none;\n}\n\n.card-minimalistic .card-badge {\n    background: #000;\n    color: white;\n    border-radius: 0;\n    text-transform: uppercase;\n    letter-spacing: 1px;\n}\n\n.card-minimalistic .card-button {\n    background: #000;\n    color: white;\n    border-radius: 0;\n    text-transform: uppercase;\n    letter-spacing: 1px;\n}',
        'modern': '<!-- Modern Card CSS -->\n.card-modern .card-item {\n    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);\n    border-radius: 12px;\n    box-shadow: 0 8px 25px rgba(0,0,0,0.1);\n}\n\n.card-modern .card-badge {\n    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);\n    color: white;\n    border-radius: 8px;\n    font-weight: 500;\n}\n\n.card-modern .card-button {\n    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);\n    color: white;\n    border-radius: 8px;\n    font-weight: 500;\n}',
        'glassmorphism': '<!-- Glassmorphism Card CSS -->\n.card-glassmorphism .card-item {\n    background: rgba(255,255,255,0.2);\n    backdrop-filter: blur(10px);\n    border-radius: 16px;\n    box-shadow: 0 8px 32px rgba(0,0,0,0.3);\n    border: 1px solid rgba(255,255,255,0.3);\n}\n\n.card-glassmorphism .card-badge {\n    background: rgba(255,255,255,0.3);\n    color: #1a1a1a;\n    border-radius: 20px;\n    backdrop-filter: blur(10px);\n}\n\n.card-glassmorphism .card-button {\n    background: rgba(255,255,255,0.3);\n    color: #1a1a1a;\n    border-radius: 20px;\n    backdrop-filter: blur(10px);\n}',
        'neumorphism': '<!-- Neumorphism Card CSS -->\n.card-neumorphism .card-item {\n    background: #e0e5ec;\n    border-radius: 25px;\n    box-shadow: 20px 20px 40px #a3b1c6, -20px -20px 40px #ffffff;\n}\n\n.card-neumorphism .card-badge {\n    background: #e0e5ec;\n    color: #495057;\n    border-radius: 20px;\n    box-shadow: inset 5px 5px 10px #a3b1c6, inset -5px -5px 10px #ffffff;\n}\n\n.card-neumorphism .card-button {\n    background: #e0e5ec;\n    color: #1a1a1a;\n    border-radius: 20px;\n    box-shadow: 5px 5px 10px #a3b1c6, -5px -5px 10px #ffffff;\n}',
        'dark': '<!-- Dark Card CSS -->\n.card-dark .card-item {\n    background: #2d3748;\n    border-radius: 8px;\n    box-shadow: 0 8px 25px rgba(0,0,0,0.3);\n    border: 1px solid #4a5568;\n}\n\n.card-dark .card-badge {\n    background: #6f42c1;\n    color: white;\n    border-radius: 20px;\n}\n\n.card-dark .card-button {\n    background: #6f42c1;\n    color: white;\n    border-radius: 5px;\n}'
    };

    codeElement.textContent = examples[style] || examples['default'];
}

// Initialize with default style
document.addEventListener('DOMContentLoaded', function() {
    switchCardStyle('default');

    // Add button hover effects
    var buttons = document.querySelectorAll('[id^="card-"]');
    buttons.forEach(function(btn) {
        btn.addEventListener('mouseenter', function() {
            if (this.style.opacity !== '1') {
                this.style.opacity = '0.9';
            }
        });

        btn.addEventListener('mouseleave', function() {
            if (this.style.opacity !== '1') {
                this.style.opacity = '0.8';
            }
        });
    });

    // Add card hover effects
    var cards = document.querySelectorAll('.card-item');
    cards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';
        });
    });
});
</script>
@endsection
