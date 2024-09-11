<main class="p-5">
    <h1 class="text-center text-lg text-blue-400">Hello World</h1>
  
    <div class="my-4 h-10 w-full rounded-md border-2 border-violet-800 bg-violet-200 p-2">
      <p class="text-center font-mono font-extrabold">A div</p>
    </div>
    <!-- Layout -->
    <div class="fixed top-0 h-10 w-10 bg-red-500">Fix</div>
    <!-- Display -->
    <div class="flex justify-between space-x-4">
      <div class="h-10 w-10 rounded-full bg-blue-500"></div>
      <div class="h-10 w-10 rounded-full bg-blue-500"></div>
      <div class="h-10 w-10 rounded-full bg-blue-500"></div>
    </div>
    <div class="grid grid-cols-5 gap-2">
      <div class="h-12 bg-violet-500"></div>
      <div class="h-12 bg-violet-500"></div>
      <div class="h-12 bg-violet-500"></div>
      <div class="h-12 bg-violet-500"></div>
      <div class="h-12 bg-violet-500"></div>
    </div>
    <div class="sm:block hidden" >
      <p>I am available in medium device </p>
    </div>
     <div class="max-sm:block hidden" >
      <p>I am available in less than smaller device</p>
    </div>
    <button class="my-2 bg-blue-500 rounded-md px-4 py-2 hover:bg-blue-700  focus:outline-none focus:ring focus:ring-blue-300 active:bg-blue-800 ">
      Click Me
    </button>
    <ul class="my-2 space-y-2">
      <li class="p-2 first:bg-yellow-100">Item 1</li>
      <li class="p-2 first:bg-yellow-100 odd:bg-blue-100 even:bg-green-100">Item 2</li>
      <li class="p-2 first:bg-yellow-100 odd:bg-blue-100 even:bg-green-100">Item 3</li>
      <li class="p-2 first:bg-yellow-100 odd:bg-blue-100 even:bg-green-100">Item 4</li>
      <li class="p-2 first:bg-yellow-100 odd:bg-blue-100 even:bg-green-100">Item 5</li>
    </ul>
    <!-- Design User Interface -->
    <!-- Theme Dark -->
    <div class="m-10 bg-white rounded-lg shadow-xl px-4 py-4 ring-1 ring-slate-900/5">
      <h3 class="text-base font-medium tracking-tight text-slate-900">This is a text      element
      </h3>
      <p>This is an even longer p element</p>
      <button 
        id="toggleDark"
        class="text-blue-900 px-4 py-2 text-sm font-medium mt-8 bg-blue-100 rounded-md"
        onclick="document.body.classList.toggle('dark')"
      >
        Toggle Dark Mode
      </button>
    </div>
  </main>
  