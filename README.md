# Crypto Onboarding Guide Generator

A modern, AI-powered single-page application (SPA) that generates personalized cryptocurrency learning roadmaps based on user level, goals, and time commitment.

## Features
- **AI-Powered Roadmaps**: Tailored learning paths using advanced AI models.
- **Multi-language Support**: English, Persian, and Arabic (RTL support).
- **Modern UI/UX**: Pixel-perfect design with Glassmorphism effects and soft animations.
- **Database-less**: Uses file-based storage for history.
- **Fast & Lightweight**: Built with pure HTML/CSS (Tailwind CDN) and PHP (Laravel).

## Prerequisites
- PHP >= 8.2
- Composer

## Installation

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd crypto-onboarding-guide
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up environment variables**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure AI Settings**:
   Edit the `.env` file and provide your `AI_TOKEN`:
   ```env
   AI_BASE_URL=https://ai.barivan.workers.dev/v1/chat/completions
   AI_TOKEN=your_token_here
   AI_MODEL=gpt-oss-120b
   ```

5. **Run the server**:
   ```bash
   php artisan serve
   ```
   Open `http://localhost:8000` in your browser.

## Tech Stack
- **Backend**: Laravel 11 (PHP)
- **Frontend**: Tailwind CSS (CDN), FontAwesome, Google Fonts
- **AI Integration**: Barivan AI Workers
