<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="view-transition" content="same-origin">
    <title><?php echo $__env->yieldContent('title', 'Đăng nhập'); ?> - Nhà xe Mạnh Hùng</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        [x-cloak] { display: none !important; }
        
        .glass-auth {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .liquid-gradient {
            background: linear-gradient(135deg, #ff5b24 0%, #ff8f6b 100%);
        }

        .animate-blob {
            animation: blob 7s infinite;
        }
        
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white font-sans antialiased overflow-hidden">

    <!-- Back to Home Button (Fixed to Top Left) -->
    <a href="/" class="fixed top-8 left-8 flex items-center gap-2 px-5 py-2.5 rounded-full glass text-white/50 hover:text-white hover:bg-white/10 transition-all group z-[100]">
        <i data-lucide="home" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
        <span class="text-xs font-bold uppercase tracking-widest">Trang chủ</span>
    </a>

    <!-- Background Atmosphere -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-brand-primary/10 blur-[120px] animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-brand-accent/5 blur-[100px] animate-blob animation-delay-2000"></div>
        <div class="absolute top-[30%] right-[20%] w-[30%] h-[30%] rounded-full bg-blue-500/5 blur-[100px] animate-blob animation-delay-4000"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 md:p-8">
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-[2.5rem] overflow-hidden glass-auth shadow-2xl shadow-black/50 border border-white/5">
            
            <!-- Left Side: Brand Experience (Hidden on mobile) -->
            <div class="hidden lg:flex flex-col justify-between p-16 relative overflow-hidden bg-brand-dark/40">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=1200" 
                         class="w-full h-full object-cover opacity-20 scale-110">
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-primary/20 to-transparent"></div>
                </div>

                <div class="relative z-10">
                    <a href="/" class="flex items-center gap-4 group">
                        <div class="w-12 h-12 rounded-2xl liquid-gradient flex items-center justify-center shadow-lg shadow-brand-primary/20 group-hover:scale-110 transition-transform duration-500">
                            <i data-lucide="bus" class="text-white w-7 h-7"></i>
                        </div>
                        <span class="font-heading text-2xl font-black tracking-tight uppercase">Mạnh <span class="text-brand-accent">Hùng</span></span>
                    </a>
                </div>

                <div class="relative z-10 space-y-6">
                    <h2 class="text-5xl font-black italic leading-[1.1] tracking-tighter">
                        TRẢI NGHIỆM <br/> 
                        <span class="text-brand-accent italic">DỊCH VỤ 5 SAO</span>
                    </h2>
                    <p class="text-lg text-white/50 max-w-md leading-relaxed">
                        Đăng nhập để quản lý các chuyến đi, nhận ưu đãi đặc biệt và trải nghiệm quy trình đặt vé nhanh nhất Việt Nam.
                    </p>
                </div>

                <div class="relative z-10 flex items-center gap-4 text-sm text-white/30 font-medium">
                    <span class="w-12 h-[1px] bg-white/10"></span>
                    <span>© 2026 MẠNH HÙNG TRANSPORT</span>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="p-8 md:p-16 lg:p-20 bg-white/[0.02] flex flex-col justify-center relative">
                <div class="max-w-md mx-auto w-full space-y-10">
                    <div class="text-center lg:text-left space-y-3">
                        <div class="lg:hidden flex justify-center mb-8">
                             <div class="w-16 h-16 rounded-2xl liquid-gradient flex items-center justify-center">
                                <i data-lucide="bus" class="text-white w-8 h-8"></i>
                            </div>
                        </div>
                        <h1 class="text-3xl font-black tracking-tight"><?php echo $__env->yieldContent('auth_title'); ?></h1>
                        <p class="text-white/40 font-medium"><?php echo $__env->yieldContent('auth_subtitle'); ?></p>
                    </div>

                    <div class="space-y-8">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/layout/AuthLayout.blade.php ENDPATH**/ ?>