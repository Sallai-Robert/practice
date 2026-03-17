<template>
  <div class="min-h-screen bg-slate-50">
    <header class="bg-gradient-to-r from-purple-900 via-purple-800 to-indigo-900 text-white py-20 px-8">
      <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2 mb-10 md:mb-0">
          <h1 class="text-5xl font-extrabold tracking-tight mb-4">
            Your Personal <span class="text-purple-300">Sanctuary</span> for Stories.
          </h1>
          <p class="text-xl text-purple-100 mb-8 leading-relaxed">
            Welcome to the Books Library. Explore our curated collection, 
            download originals, or grab print-ready versions of your favorite reads.
          </p>
          <div class="flex flex-wrap gap-4">
            <a href="#browse" 
               class="px-8 py-3 bg-white text-purple-900 font-bold rounded-xl shadow-lg hover:bg-purple-100 transition duration-300">
              Browse Books
            </a>
            <div class="flex gap-2">
              <a href="/login" 
                 class="px-6 py-3 bg-purple-600 border border-purple-400 text-white font-semibold rounded-xl hover:bg-purple-500 transition">
                Log In
              </a>
              <a href="/register" 
                 class="px-6 py-3 bg-transparent border border-white text-white font-semibold rounded-xl hover:bg-white hover:text-purple-900 transition">
                Register
              </a>
            </div>
          </div>
        </div>
        
        <div class="md:w-1/3 flex justify-center">
          <div class="text-8xl animate-bounce">📚</div>
        </div>
      </div>
    </header>

    <main class="max-w-6xl mx-auto py-16 px-8">
      
      <section class="grid md:grid-cols-2 gap-12 items-start mb-20">
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Philosophy</h2>
          <div class="space-y-4 text-gray-600 leading-relaxed">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
            <p>
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
        </div>
        <div class="bg-purple-100 p-8 rounded-2xl border-2 border-dashed border-purple-300">
          <h3 class="text-xl font-bold text-purple-900 mb-4">Why Join Us?</h3>
          <ul class="space-y-3 text-purple-800">
            <li class="flex items-center">✨ Unlimited access to PDF originals</li>
            <li class="flex items-center">✨ Exclusive printable formats</li>
            <li class="flex items-center">✨ Personalized reading lists</li>
          </ul>
        </div>
      </section>

      <section id="browse">
        <div class="flex justify-between items-end mb-8">
          <div>
            <h2 class="text-3xl font-bold text-gray-900">Available Books</h2>
            <p class="text-gray-500">Discover something new today</p>
          </div>
          <a href="/books" class="text-purple-600 font-semibold hover:underline">View All &rarr;</a>
        </div>
        <div v-if="books.length === 0" class="text-center py-10 bg-white rounded-2xl shadow">
          <p class="text-gray-500 italic">No books currently listed in the preview.</p>
        </div>

        <div v-else class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
          <div v-for="book in books.slice(0, 3)" :key="book.id" 
               class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 transition hover:shadow-xl">
            <h3 class="text-lg font-bold text-purple-900">{{ book.title }}</h3>
            <p class="text-sm text-purple-600 mb-4">{{ book.author }}</p>
            <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ book.description }}</p>
            <a :href="'/books/' + book.id" class="text-sm font-bold text-indigo-600 hover:text-indigo-800">
              Details & Download
            </a>
          </div>
        </div>
      </section>

    </main>

    <footer class="bg-gray-100 border-t border-gray-200 py-8 text-center text-gray-500 text-sm">
      &copy; 2026 Books Library. All rights reserved.
    </footer>
  </div>
</template>

<script setup>
defineProps({
  books: Array
})
</script>