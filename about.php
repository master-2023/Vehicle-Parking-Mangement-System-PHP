<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollreveal/4.0.9/scrollreveal.min.js"></script>
    <style>
        body {
            background-color: #1e1e42;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-6 flex flex-col md:flex-row items-center justify-between">
        <div class="text-left max-w-md">
            <h1 class="text-4xl font-bold text-green-400">Grow</h1>
            <h1 class="text-4xl font-bold text-purple-400">Professionally</h1>
            <h1 class="text-4xl font-bold text-white">with the Best</h1>
            <p class="mt-4 text-gray-300">In a world filled with opportunities, having a mentor can make all the difference...</p>
            <div class="mt-4">
                <input type="email" placeholder="example@domain.com" class="p-2 rounded-l-md text-black">
                <button class="bg-green-500 text-white p-2 rounded-r-md">Subscribe →</button>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-6 md:mt-0">
            <div class="bg-blue-400 rounded-full w-24 h-24"></div>
            <div class="bg-yellow-400 rounded-full w-24 h-24 flex items-center justify-center"><img src="image1.jpg" class="rounded-full w-20 h-20"></div>
            <div class="bg-green-400 rounded-full w-24 h-24"></div>
            <div class="bg-purple-400 rounded-full w-24 h-24"></div>
            <div class="bg-pink-400 rounded-full w-24 h-24 flex items-center justify-center"><img src="image2.jpg" class="rounded-full w-20 h-20"></div>
            <div class="bg-orange-400 rounded-full w-24 h-24"></div>
            <div class="bg-pink-400 rounded-full w-24 h-24"></div>
            <div class="bg-green-400 rounded-full w-24 h-24 flex items-center justify-center"><img src="image3.jpg" class="rounded-full w-20 h-20"></div>
            <div class="bg-purple-400 rounded-full w-24 h-24"></div>
        </div>
    </div>
    
    <div class="container mx-auto mt-12 p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-gradient-to-b from-green-400 to-blue-500 rounded-lg p-6 shadow-lg reveal">
                <img src="image1.jpg" class="rounded-lg mb-4">
                <h2 class="text-white text-lg font-bold">Personalized Guidance</h2>
                <p class="text-gray-200">Whether you are pursuing a career change, entrepreneurship, or personal development...</p>
                <button class="mt-4 bg-white text-black p-2 rounded-md">Learn More →</button>
            </div>
            <div class="bg-gradient-to-b from-green-400 to-blue-500 rounded-lg p-6 shadow-lg reveal">
                <img src="image2.jpg" class="rounded-lg mb-4">
                <h2 class="text-white text-lg font-bold">Accelerated Growth</h2>
                <p class="text-gray-200">With a mentor, you can fast-track your journey to success...</p>
                <button class="mt-4 bg-white text-black p-2 rounded-md">Learn More →</button>
            </div>
            <div class="bg-gradient-to-b from-green-400 to-blue-500 rounded-lg p-6 shadow-lg reveal">
                <img src="image3.jpg" class="rounded-lg mb-4">
                <h2 class="text-white text-lg font-bold">Inspiration & Motivation</h2>
                <p class="text-gray-200">A mentor isn't just an advisor; they are a source of inspiration...</p>
                <button class="mt-4 bg-white text-black p-2 rounded-md">Learn More →</button>
            </div>
            <div class="bg-gradient-to-b from-green-400 to-blue-500 rounded-lg p-6 shadow-lg reveal">
                <img src="image4.jpg" class="rounded-lg mb-4">
                <h2 class="text-white text-lg font-bold">Networking & Connections</h2>
                <p class="text-gray-200">Your mentor can open doors to valuable connections...</p>
                <button class="mt-4 bg-white text-black p-2 rounded-md">Learn More →</button>
            </div>
        </div>
    </div>
    
    <script>
        ScrollReveal().reveal('.reveal', { delay: 300, distance: '50px', origin: 'bottom', duration: 800 });
    </script>
</body>
</html>
