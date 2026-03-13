<!DOCTYPE html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xe Khách Mạnh Hùng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/_sdk/element_sdk.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/customer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/boxchat.css')); ?>">
</head>

<div class="support-float" id="chatButton">

<svg xmlns="http://www.w3.org/2000/svg"
     width="28"
     height="28"
     fill="white"
     viewBox="0 0 16 16">

<path d="M8 0C3.58 0 0 3.134 0 7c0 2.084 1.06 3.954 2.75 5.239
L2 16l3.101-1.588A8.9 8.9 0 0 0 8 15c4.42 0 8-3.134
8-7s-3.58-8-8-8z"/>

</svg>

</div>

<div id="chatBox" class="chat-box">

<div class="chat-header">
AI Support
<span id="closeChat">✕</span>
</div>

<div class="chat-body">

<div class="ai-msg">
Xin chào 👋 <br>
Tôi có thể giúp gì cho bạn?
</div>

<div class="ai-options">

<button onclick="goTicket('payment')">
💳 Thanh toán
</button>

<button onclick="goTicket('ticket')">
🎫 Vé xe
</button>

<button onclick="goTicket('complaint')">
⚠ Khiếu nại
</button>

</div>

</div>

</div>

<script>

let chatButton = document.getElementById("chatButton")
let chatBox = document.getElementById("chatBox")
let closeChat = document.getElementById("closeChat")

chatButton.onclick = function(){
chatBox.style.display = "flex"
}

closeChat.onclick = function(){
chatBox.style.display = "none"
}

function goTicket(type){

window.location.href = "/customer/support?type=" + type

}

</script>

<body class="h-full bg-gray-50">
    <div id="app-wrapper" class="w-full h-full overflow-auto">

        <!-- Header + search -->
        <?php echo $__env->make('layout.customer.blocks.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- Hero Section with Search -->

        
        <?php echo $__env->yieldContent('content-main'); ?>
        <!-- Contact Section -->
        <!-- Footer -->
        <?php echo $__env->make('layout.customer.blocks.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </div>

    <link rel="stylesheet" href="<?php echo e(asset('js/customer.js')); ?>">

</body>

</html>
<?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/layout/customer/CustomerLayout.blade.php ENDPATH**/ ?>