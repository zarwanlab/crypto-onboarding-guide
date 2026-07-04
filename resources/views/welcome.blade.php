<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Onboarding Guide Generator</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&family=Vazirmatn:wght@400;700;900&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0D47A1',
                        secondary: '#00BCD4',
                        background: '#F8FAFC',
                    },
                    borderRadius: {
                        '4xl': '2.5rem',
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.3);
            --soft-shadow: 0 10px 30px -10px rgba(13, 71, 161, 0.1);
        }

        body {
            font-family: 'Inter', 'Vazirmatn', sans-serif;
            background-color: #F8FAFC;
            background-image: 
                radial-gradient(circle at 0% 0%, rgba(13, 71, 161, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(0, 188, 212, 0.05) 0%, transparent 50%);
            min-height: 100vh;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--soft-shadow);
        }

        .dark-glass {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .fadeInSlide {
            animation: fadeInSlide 0.6s ease-out forwards;
        }

        @keyframes fadeInSlide {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hover-scale {
            transition: all 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px -15px rgba(13, 71, 161, 0.2);
        }

        [dir="rtl"] {
            font-family: 'Vazirmatn', sans-serif;
        }

        /* Decorative Background Circles */
        .bg-decoration {
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.2;
            animation: float 20s infinite alternate ease-in-out;
        }

        @media (min-width: 768px) {
            .bg-decoration {
                width: 500px;
                height: 500px;
                filter: blur(100px);
                opacity: 0.3;
            }
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 50px) scale(1.1); }
        }

        .bg-decoration-2 {
            animation-delay: -5s;
            animation-duration: 25s;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* Toast Animation */
        #toast-container {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            pointer-events: none;
        }
        .toast {
            background: rgba(15, 23, 42, 0.9);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            backdrop-filter: blur(8px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
            margin-top: 0.5rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }
        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="text-slate-900 overflow-x-hidden">
    <!-- Decorations -->
    <div class="bg-decoration bg-primary -top-40 start-[-10rem]"></div>
    <div class="bg-decoration bg-secondary -bottom-40 end-[-10rem] bg-decoration-2"></div>
    <div class="bg-decoration bg-primary/20 top-1/2 start-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] blur-[120px]"></div>

    <!-- Header -->
    <header class="sticky top-0 z-50 glass-card px-4 md:px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20 shrink-0">
                <i class="fas fa-rocket text-lg"></i>
            </div>
            <h1 class="text-lg md:text-xl font-black tracking-tight text-slate-900 line-clamp-1" data-i18n="app_title">Crypto Onboarding Guide</h1>
        </div>
        
        <div class="flex items-center gap-2 md:gap-4">
            <div class="relative">
                <button onclick="toggleLangDropdown(event)" class="flex items-center gap-2 px-3 md:px-4 py-2 rounded-full bg-slate-100 hover:bg-slate-200 transition-colors text-sm md:text-base outline-none">
                    <i class="fa-solid fa-globe text-primary pointer-events-none"></i>
                    <span id="current-lang" class="hidden xs:inline pointer-events-none">English</span>
                    <i class="fa-solid fa-chevron-down text-[10px] pointer-events-none"></i>
                </button>
                <div id="lang-dropdown" class="absolute end-0 mt-2 w-32 md:w-40 glass-card rounded-2xl py-2 opacity-0 invisible translate-y-2 transition-all duration-300 shadow-xl z-[60]">
                    <button onclick="changeLang('en')" class="w-full px-4 py-2 text-start hover:bg-primary/5 transition-colors text-sm md:text-base flex items-center justify-between">
                        <span>English</span>
                        <i class="fas fa-check text-primary text-[10px] opacity-0" id="check-en"></i>
                    </button>
                    <button onclick="changeLang('fa')" class="w-full px-4 py-2 text-start hover:bg-primary/5 transition-colors text-sm md:text-base flex items-center justify-between">
                        <span>فارسی</span>
                        <i class="fas fa-check text-primary text-[10px] opacity-0" id="check-fa"></i>
                    </button>
                    <button onclick="changeLang('ar')" class="w-full px-4 py-2 text-start hover:bg-primary/5 transition-colors text-sm md:text-base flex items-center justify-between">
                        <span>العربية</span>
                        <i class="fas fa-check text-primary text-[10px] opacity-0" id="check-ar"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-0 sm:px-6 py-6 md:py-12">
        <!-- Form Section -->
        <section id="input-section" class="glass-card rounded-none sm:rounded-4xl p-6 md:p-12 fadeInSlide">
            <div class="text-center mb-8 md:mb-10 px-4">
                <h2 class="text-2xl md:text-4xl font-black text-slate-900 mb-3 md:mb-4" data-i18n="hero_title">Create Your Personal Crypto Roadmap</h2>
                <p class="text-slate-500 text-sm md:text-base max-w-lg mx-auto" data-i18n="hero_desc">Define your goals and level to get a step-by-step learning guide powered by AI.</p>
            </div>

            <form id="roadmap-form" class="space-y-6 md:space-y-8 px-4 sm:px-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                    <!-- Level Selection -->
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ms-2" data-i18n="label_level">Knowledge Level</label>
                        <select name="level" class="w-full px-5 py-3.5 md:px-6 md:py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none cursor-pointer text-sm md:text-base">
                            <option value="beginner" data-i18n="opt_beginner">Beginner</option>
                            <option value="intermediate" data-i18n="opt_intermediate">Intermediate</option>
                            <option value="advanced" data-i18n="opt_advanced">Advanced</option>
                        </select>
                    </div>

                    <!-- Goal Selection -->
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ms-2" data-i18n="label_goal">Primary Goal</label>
                        <select name="goal" class="w-full px-5 py-3.5 md:px-6 md:py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none cursor-pointer text-sm md:text-base">
                            <option value="trading" data-i18n="opt_trading">Trading</option>
                            <option value="investing" data-i18n="opt_investing">Investing</option>
                            <option value="web3" data-i18n="opt_web3">Web3 & Development</option>
                            <option value="defi" data-i18n="opt_defi">DeFi (Decentralized Finance)</option>
                        </select>
                    </div>

                    <!-- Time Selection -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 ms-2" data-i18n="label_time">Daily Time Commitment</label>
                        <div class="grid grid-cols-3 gap-2 md:gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="time" value="30min" class="hidden peer" checked>
                                <div class="px-2 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_30min">30 Mins</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="time" value="1hour" class="hidden peer">
                                <div class="px-2 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_1hour">1 Hour</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="time" value="2hour" class="hidden peer">
                                <div class="px-2 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_2hour">2+ Hours</div>
                            </label>
                        </div>
                    </div>

                    <!-- What describes you best? -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 ms-2" data-i18n="label_describes_you">What describes you best?</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 md:gap-3">
                            <label class="cursor-pointer">
                                <input type="checkbox" name="describes_you[]" value="student" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_student">Student</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="describes_you[]" value="developer" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_developer">Developer</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="describes_you[]" value="investor" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_investor">Investor</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="describes_you[]" value="entrepreneur" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_entrepreneur">Entrepreneur</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="describes_you[]" value="gamer" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_gamer">Gamer</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="describes_you[]" value="freelancer" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_freelancer">Freelancer</div>
                            </label>
                        </div>
                    </div>

                    <!-- What motivates you? -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 ms-2" data-i18n="label_motivates_you">What motivates you?</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 md:gap-3">
                            <label class="cursor-pointer">
                                <input type="checkbox" name="motivates_you[]" value="passive_income" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_passive_income">Passive Income</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="motivates_you[]" value="career" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_career">Career</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="motivates_you[]" value="curiosity" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_curiosity">Curiosity</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="motivates_you[]" value="financial_freedom" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_financial_freedom">Financial Freedom</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="motivates_you[]" value="build_startup" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_build_startup">Build Startup</div>
                            </label>
                        </div>
                    </div>

                    <!-- Have you ever? -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 ms-2" data-i18n="label_have_you_ever">Have you ever?</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 md:gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="experience" value="never_bought_crypto" class="hidden peer" checked>
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_never_bought_crypto">Never bought crypto</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="experience" value="bought_crypto_once" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_bought_crypto_once">Bought crypto once</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="experience" value="holding_coins" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_holding_coins">Holding coins</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="experience" value="traded_before" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_traded_before">Traded before</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="experience" value="used_defi" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_used_defi">Used DeFi</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="experience" value="used_wallets" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_used_wallets">Used Wallets</div>
                            </label>
                        </div>
                    </div>

                    <!-- Investment Budget -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 ms-2" data-i18n="label_investment_budget">Investment Budget</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 md:gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="investment_budget" value="just_learning" class="hidden peer" checked>
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_just_learning">Just Learning</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="investment_budget" value="under_100" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_under_100">Under $100</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="investment_budget" value="100_1000" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_100_1000">$100–1000</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="investment_budget" value="1000_10000" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_1000_10000">$1000–10000</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="investment_budget" value="10000_plus" class="hidden peer">
                                <div class="px-3 py-3.5 md:px-4 md:py-4 text-center rounded-2xl border border-slate-200 bg-slate-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all text-xs md:text-sm font-bold" data-i18n="opt_10000_plus">$10000+</div>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" id="generate-btn" class="w-full py-4 md:py-5 bg-primary text-white font-black text-base md:text-lg rounded-2xl shadow-xl shadow-primary/30 hover:shadow-2xl hover:shadow-primary/40 transition-all flex items-center justify-center gap-3 group">
                    <span data-i18n="btn_generate">Generate Learning Path</span>
                    <i class="fas fa-wand-magic-sparkles group-hover:rotate-12 transition-transform"></i>
                </button>
            </form>
        </section>

        <!-- Loading State -->
        <section id="loading-state" class="hidden py-16 md:py-20 text-center space-y-6 fadeInSlide px-6">
            <div class="relative w-16 h-16 md:w-20 md:h-20 mx-auto">
                <div class="absolute inset-0 border-4 border-primary/20 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-t-primary rounded-full animate-spin"></div>
            </div>
            <p class="text-slate-500 text-sm md:text-base font-bold animate-pulse" data-i18n="loading_msg">Analyzing market trends and crafting your path...</p>
        </section>

        <!-- Result Section -->
        <section id="result-section" class="hidden space-y-6 md:space-y-8 fadeInSlide">
            <div class="glass-card rounded-none sm:rounded-4xl p-6 md:p-12 relative overflow-hidden">
                <div class="absolute top-0 end-0 w-32 h-32 bg-secondary/10 rounded-full blur-3xl -me-16 -mt-16"></div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                    <div class="flex items-center justify-between w-full md:w-auto">
                        <button onclick="goBack()" class="p-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition-all" title="Back">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <h3 class="text-xl md:text-2xl font-black text-slate-900 md:hidden" data-i18n="result_title">Your Roadmap</h3>
                    </div>
                    
                    <h3 class="hidden md:block text-2xl font-black text-slate-900" data-i18n="result_title">Your Crypto Roadmap</h3>
                    
                    <div class="flex justify-center gap-2">
                        <button onclick="copyToClipboard()" class="flex-1 md:flex-none p-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition-all flex items-center justify-center gap-2" title="Copy">
                            <i class="fas fa-copy"></i>
                            <span class="md:hidden text-xs font-bold">Copy</span>
                        </button>
                        <button onclick="downloadRoadmap()" class="flex-1 md:flex-none p-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition-all flex items-center justify-center gap-2" title="Download">
                            <i class="fas fa-download"></i>
                            <span class="md:hidden text-xs font-bold">Save</span>
                        </button>
                        <button onclick="shareRoadmap()" class="flex-1 md:flex-none p-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition-all flex items-center justify-center gap-2" title="Share">
                            <i class="fas fa-share-nodes"></i>
                            <span class="md:hidden text-xs font-bold">Share</span>
                        </button>
                    </div>
                </div>

                <div id="roadmap-content" class="prose prose-slate max-w-none prose-sm md:prose-base prose-headings:font-black prose-headings:text-slate-900 prose-p:text-slate-600 prose-li:text-slate-600">
                    <!-- AI Content will be injected here -->
                </div>

                <div class="mt-10 md:mt-12 flex flex-col sm:flex-row gap-4">
                    <button class="flex-1 py-4 bg-emerald-500 text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/20 hover:scale-[1.02] transition-all flex items-center justify-center gap-2 text-sm md:text-base">
                        <i class="fas fa-play"></i>
                        <span data-i18n="btn_start">Start Learning Plan</span>
                    </button>
                    <button onclick="window.print()" class="flex-1 py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-lg shadow-slate-900/20 hover:scale-[1.02] transition-all flex items-center justify-center gap-2 text-sm md:text-base">
                        <i class="fas fa-bookmark"></i>
                        <span data-i18n="btn_save">Save Roadmap</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- History Section -->
        <section id="history-section" class="mt-12 md:mt-16 space-y-6 fadeInSlide hidden px-4 sm:px-0">
            <h3 class="text-xl font-black text-slate-900" data-i18n="history_title">Recent Roadmaps</h3>
            <div id="history-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- History items will be injected here -->
            </div>
        </section>
    </main>

    <footer class="py-12 text-center">
        <p class="text-slate-400 text-sm font-medium">Made with ❤️ by Zarwan</p>
    </footer>

    <!-- Toast Container -->
    <div id="toast-container"></div>

    <!-- Translations & Logic -->
    <script>
        const translations = {
            en: {
                app_title: "Crypto Onboarding Guide",
                hero_title: "Create Your Personal Crypto Roadmap",
                hero_desc: "Define your goals and level to get a step-by-step learning guide powered by AI.",
                label_level: "Knowledge Level",
                opt_beginner: "Beginner",
                opt_intermediate: "Intermediate",
                opt_advanced: "Advanced",
                label_goal: "Primary Goal",
                opt_trading: "Trading",
                opt_investing: "Investing",
                opt_web3: "Web3 & Development",
                opt_defi: "DeFi (Decentralized Finance)",
                label_time: "Daily Time Commitment",
                opt_30min: "30 Mins",
                opt_1hour: "1 Hour",
                opt_2hour: "2+ Hours",
                label_describes_you: "What describes you best?",
                opt_student: "Student",
                opt_developer: "Developer",
                opt_investor: "Investor",
                opt_entrepreneur: "Entrepreneur",
                opt_gamer: "Gamer",
                opt_freelancer: "Freelancer",
                label_motivates_you: "What motivates you?",
                opt_passive_income: "Passive Income",
                opt_career: "Career",
                opt_curiosity: "Curiosity",
                opt_financial_freedom: "Financial Freedom",
                opt_build_startup: "Build Startup",
                label_have_you_ever: "Have you ever?",
                opt_never_bought_crypto: "Never bought crypto",
                opt_bought_crypto_once: "Bought crypto once",
                opt_holding_coins: "Holding coins",
                opt_traded_before: "Traded before",
                opt_used_defi: "Used DeFi",
                opt_used_wallets: "Used Wallets",
                label_investment_budget: "Investment Budget",
                opt_just_learning: "Just Learning",
                opt_under_100: "Under $100",
                opt_100_1000: "$100–1000",
                opt_1000_10000: "$1000–10000",
                opt_10000_plus: "$10000+",
                btn_generate: "Generate Learning Path",
                loading_msg: "Analyzing market trends and crafting your path...",
                result_title: "Your Crypto Roadmap",
                btn_start: "Start Learning Plan",
                btn_save: "Save Roadmap",
                history_title: "Recent Roadmaps",
                view_roadmap: "View Roadmap"
            },
            fa: {
                app_title: "راهنمای ورود به دنیای کریپتو",
                hero_title: "مسیر یادگیری شخصی خود را بسازید",
                hero_desc: "سطح و هدف خود را مشخص کنید تا یک نقشه راه گام‌به‌گام با هوش مصنوعی دریافت کنید.",
                label_level: "سطح دانش",
                opt_beginner: "مبتدی",
                opt_intermediate: "متوسط",
                opt_advanced: "پیشرفته",
                label_goal: "هدف اصلی",
                opt_trading: "ترید و معامله‌گری",
                opt_investing: "سرمایه‌گذاری",
                opt_web3: "وب ۳ و برنامه‌نویسی",
                opt_defi: "دیفای (امور مالی غیرمتمرکز)",
                label_time: "زمان روزانه",
                opt_30min: "۳۰ دقیقه",
                opt_1hour: "۱ ساعت",
                opt_2hour: "۲+ ساعت",
                label_describes_you: "چه چیزی شما را بهتر توصیف می‌کند؟",
                opt_student: "دانشجو",
                opt_developer: "توسعه‌دهنده",
                opt_investor: "سرمایه‌گذار",
                opt_entrepreneur: "کارآفرین",
                opt_gamer: "گیمر",
                opt_freelancer: "فریلنسر",
                label_motivates_you: "چه چیزی به شما انگیزه می‌دهد؟",
                opt_passive_income: "درآمد غیرفعال",
                opt_career: "شغل",
                opt_curiosity: "کنجکاوی",
                opt_financial_freedom: "آزادی مالی",
                opt_build_startup: "ساخت استارتاپ",
                label_have_you_ever: "آیا تا به حال؟",
                opt_never_bought_crypto: "هرگز کریپتو نخریده‌ام",
                opt_bought_crypto_once: "یک بار کریپتو خریده‌ام",
                opt_holding_coins: "هولد کردن کوین",
                opt_traded_before: "قبلاً ترید کرده‌ام",
                opt_used_defi: "از دیفای استفاده کرده‌ام",
                opt_used_wallets: "از کیف پول استفاده کرده‌ام",
                label_investment_budget: "بودجه سرمایه‌گذاری",
                opt_just_learning: "فقط یادگیری",
                opt_under_100: "زیر ۱۰۰ دلار",
                opt_100_1000: "۱۰۰ تا ۱۰۰۰ دلار",
                opt_1000_10000: "۱۰۰۰ تا ۱۰۰۰۰ دلار",
                opt_10000_plus: "بیشتر از ۱۰۰۰۰ دلار",
                btn_generate: "تولید مسیر یادگیری",
                loading_msg: "در حال تحلیل بازار و طراحی مسیر شما...",
                result_title: "نقشه راه کریپتوی شما",
                btn_start: "شروع برنامه یادگیری",
                btn_save: "ذخیره نقشه راه",
                history_title: "مسیرهای اخیر",
                view_roadmap: "مشاهده مسیر"
            },
            ar: {
                app_title: "دليل دخول عالم الكريبتو",
                hero_title: "أنشئ خارطة طريق الكريبتو الخاصة بك",
                hero_desc: "حدد مستواك وأهدافك للحصول على دليل تعليمي خطوة بخطوة مدعوم بالذكاء الاصطناعي.",
                label_level: "مستوى المعرفة",
                opt_beginner: "مبتدئ",
                opt_intermediate: "متوسط",
                opt_advanced: "متقدم",
                label_goal: "الهدف الأساسي",
                opt_trading: "التداول",
                opt_investing: "الاستثمار",
                opt_web3: "ويب 3 والبرمجة",
                opt_defi: "دیفای (التمويل اللامركزي)",
                label_time: "الوقت اليومي",
                opt_30min: "30 دقيقة",
                opt_1hour: "ساعة واحدة",
                opt_2hour: "ساعتان فأكثر",
                label_describes_you: "ماذا يصفك بشكل أفضل؟",
                opt_student: "طالب",
                opt_developer: "مطور",
                opt_investor: "مستثمر",
                opt_entrepreneur: "رائد أعمال",
                opt_gamer: "لاعب",
                opt_freelancer: "مستقل",
                label_motivates_you: "ما الذي يحفزك؟",
                opt_passive_income: "دخل سلبي",
                opt_career: "مهنة",
                opt_curiosity: "فضول",
                opt_financial_freedom: "حرية مالية",
                opt_build_startup: "بناء شركة ناشئة",
                label_have_you_ever: "هل سبق لك؟",
                opt_never_bought_crypto: "لم أشترِ عملات مشفرة قط",
                opt_bought_crypto_once: "اشتريت عملات مشفرة مرة واحدة",
                opt_holding_coins: "أحتفظ بالعملات",
                opt_traded_before: "تداولت من قبل",
                opt_used_defi: "استخدمت التمويل اللامركزي (DeFi)",
                opt_used_wallets: "استخدمت المحافظ",
                label_investment_budget: "ميزانية الاستثمار",
                opt_just_learning: "فقط للتعلم",
                opt_under_100: "أقل من 100 دولار",
                opt_100_1000: "100-1000 دولار",
                opt_1000_10000: "1000-10000 دولار",
                opt_10000_plus: "أكثر من 10000 دولار",
                btn_generate: "إنشاء مسار التعلم",
                loading_msg: "جاري تحليل السوق وإعداد مسارك...",
                result_title: "خارطة طريق الكريبتو الخاصة بك",
                btn_start: "بدء خطة التعلم",
                btn_save: "حفظ خارطة الطريق",
                history_title: "خارطة الطريق الأخيرة",
                view_roadmap: "عرض خارطة الطريق"
            }
        };

        let currentLang = 'en';

        function toggleLangDropdown(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('lang-dropdown');
            const isOpen = !dropdown.classList.contains('invisible');
            
            if (isOpen) {
                dropdown.classList.add('opacity-0', 'invisible', 'translate-y-2');
            } else {
                dropdown.classList.remove('opacity-0', 'invisible', 'translate-y-2');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            const dropdown = document.getElementById('lang-dropdown');
            dropdown.classList.add('opacity-0', 'invisible', 'translate-y-2');
        });

        function updateUI() {
            document.documentElement.lang = currentLang;
            document.documentElement.dir = (currentLang === 'fa' || currentLang === 'ar') ? 'rtl' : 'ltr';
            
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (translations[currentLang][key]) {
                    el.textContent = translations[currentLang][key];
                }
            });

            document.getElementById('current-lang').textContent = currentLang === 'en' ? 'English' : (currentLang === 'fa' ? 'فارسی' : 'العربية');
            
            // Update Checkmarks
            ['en', 'fa', 'ar'].forEach(l => {
                const check = document.getElementById(`check-${l}`);
                if (check) {
                    check.classList.toggle('opacity-100', currentLang === l);
                    check.classList.toggle('opacity-0', currentLang !== l);
                }
            });

            // Update URL
            const url = new URL(window.location);
            url.searchParams.set('lang', currentLang);
            window.history.pushState({}, '', url);
        }

        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.textContent = message;
            container.appendChild(toast);
            
            // Force reflow
            toast.offsetHeight;
            
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function changeLang(lang) {
            currentLang = lang;
            updateUI();
        }

        // Initialize from URL
        const urlParams = new URLSearchParams(window.location.search);
        const langParam = urlParams.get('lang');
        if (langParam && translations[langParam]) {
            currentLang = langParam;
        }
        updateUI();
        loadHistory();

        async function loadHistory() {
            try {
                const response = await fetch('/api/history');
                const data = await response.json();
                
                if (data.history && data.history.length > 0) {
                    const historySection = document.getElementById('history-section');
                    const historyList = document.getElementById('history-list');
                    historySection.classList.remove('hidden');
                    historyList.innerHTML = '';
                    
                    data.history.forEach((item, index) => {
                        const card = document.createElement('div');
                        card.className = 'glass-card p-5 md:p-6 rounded-3xl hover-scale cursor-pointer flex flex-col justify-between transition-all active:scale-95';
                        card.onclick = () => showFromHistory(item.output);
                        
                        card.innerHTML = `
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="text-[9px] md:text-[10px] font-black uppercase tracking-wider text-primary bg-primary/5 px-2 py-1 rounded-md border border-primary/10">${item.input.level}</span>
                                        <span class="text-[9px] md:text-[10px] font-black uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-1 rounded-md border border-slate-200">${item.input.lang}</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium">${new Date(item.timestamp).toLocaleDateString([], {month: 'short', day: 'numeric'})}</span>
                                </div>
                                <h4 class="font-bold text-slate-900 capitalize text-sm md:text-base line-clamp-1">${item.input.goal}</h4>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[10px] font-bold text-primary flex items-center gap-1">
                                    <span data-i18n="view_roadmap">${translations[currentLang].view_roadmap}</span>
                                    <i class="fas fa-arrow-right text-[8px] mt-0.5"></i>
                                </span>
                                <i class="fas fa-chevron-right text-slate-300 text-[10px]"></i>
                            </div>
                        `;
                        historyList.appendChild(card);
                    });
                }
            } catch (error) {
                console.error('History load error:', error);
            }
        }

        function showFromHistory(roadmapHtml) {
            document.getElementById('result-section').classList.remove('hidden');
            document.getElementById('roadmap-content').innerHTML = roadmapHtml;
            document.getElementById('result-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
         }

         function goBack() {
             document.getElementById('result-section').classList.add('hidden');
             window.scrollTo({ top: 0, behavior: 'smooth' });
         }

        // Form Logic
        document.getElementById('roadmap-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());
            
            // Disable button and show loading
            const submitBtn = document.getElementById('generate-btn');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            
            document.getElementById('loading-state').classList.remove('hidden');
            document.getElementById('result-section').classList.add('hidden');

            // Scroll to loading state
            document.getElementById('loading-state').scrollIntoView({ behavior: 'smooth', block: 'center' });

            try {
                const response = await fetch('/api/generate-roadmap', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ...data, lang: currentLang })
                });
                
                const result = await response.json();
                
                if (!response.ok) {
                    throw new Error(result.error || 'AI Service Error');
                }
                
                document.getElementById('loading-state').classList.add('hidden');
                const resultSection = document.getElementById('result-section');
                resultSection.classList.remove('hidden');
                document.getElementById('roadmap-content').innerHTML = result.roadmap;
                
                // Smooth scroll to result
                setTimeout(() => {
                    resultSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);

                loadHistory(); // Refresh history
                
            } catch (error) {
                console.error('Error:', error);
                alert(currentLang === 'fa' ? `خطا: ${error.message}` : `Error: ${error.message}`);
                document.getElementById('loading-state').classList.add('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });

        function downloadRoadmap() {
            const content = document.getElementById('roadmap-content').innerText;
            const blob = new Blob([content], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'crypto-roadmap.txt';
            a.click();
        }

        async function copyToClipboard() {
            const content = document.getElementById('roadmap-content').innerText;
            try {
                await navigator.clipboard.writeText(content);
                showToast(currentLang === 'fa' ? 'کپی شد!' : (currentLang === 'ar' ? 'تم النسخ!' : 'Copied!'));
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }

        function shareRoadmap() {
            if (navigator.share) {
                navigator.share({
                    title: 'My Crypto Roadmap',
                    text: 'Check out my personalized crypto learning guide!',
                    url: window.location.href
                });
            } else {
                alert('Sharing not supported on this browser.');
            }
        }
    </script>
</body>
</html>
