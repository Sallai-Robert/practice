<template>
  <div class="min-h-screen bg-slate-50 p-6 lg:p-12">
    
    <div class="max-w-7xl mx-auto mb-12">
      <div class="bg-gradient-to-r from-purple-900 via-purple-800 to-indigo-900 rounded-3xl shadow-2xl p-10 text-center md:text-left flex flex-col md:flex-row justify-between items-center">
        <div>
          <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">
            The <span class="text-purple-300">Archive</span>
          </h1>
          <p class="text-purple-100 mt-3 text-lg max-w-md">
            Your curated collection of literature, available in original and printable formats.
          </p>
        </div>
        <div class="mt-8 md:mt-0">
          <a href="/books/create" 
             class="px-8 py-4 bg-white text-purple-900 font-bold rounded-2xl shadow-lg hover:bg-purple-50 transition-all transform hover:scale-105 inline-flex items-center">
            <span class="mr-2">+</span> Add New Entry
          </a>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto">
      <div v-if="books.length === 0"
           class="text-center py-32 bg-white rounded-3xl shadow-sm border border-dashed border-purple-200">
        <div class="text-6xl mb-4">📚</div>
        <h3 class="text-2xl font-bold text-gray-800">Your library is currently empty</h3>
        <p class="text-gray-500 mt-2 mb-8">Ready to start your collection?</p>
        <a href="/books/create" class="text-purple-600 font-bold hover:underline">Upload your first book &rarr;</a>
      </div>

      <div v-else class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
        <div
          v-for="book in books"
          :key="book.id"
          class="group bg-white rounded-3xl shadow-sm hover:shadow-2xl border border-gray-100 p-8 transition-all duration-500 hover:-translate-y-2 flex flex-col justify-between"
        >
          <div>
            <div class="flex justify-between items-start mb-4">
              <span class="px-3 py-1 text-[10px] uppercase tracking-widest font-bold rounded-full bg-purple-100 text-purple-700">
                by {{ book.uploader.name || "anonymous" }}
              </span>
              <div class="text-gray-300 group-hover:text-purple-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 group-hover:text-purple-900 transition-colors leading-tight">
              {{ book.title }}
            </h2>

            <p class="text-purple-600 font-semibold mt-2">
              {{ book.author }}
            </p>

            <div class="h-px bg-gradient-to-r from-purple-100 to-transparent my-6"></div>

            <p class="text-gray-600 text-sm leading-relaxed line-clamp-4">
              {{ book.description }}
            </p>
          </div>

          <div class="mt-8 space-y-3">
            <a :href="'/books/' + book.id + '/download/original'"
               class="flex items-center justify-center w-full py-3 bg-purple-900 text-white rounded-xl font-bold text-sm hover:bg-purple-800 transition shadow-lg shadow-purple-100">
              Download Original
            </a>
            
            <a v-if="book.pdf_printable" 
               :href="book.pdf_printable" 
               download
               class="flex items-center justify-center w-full py-3 bg-purple-50 text-purple-900 rounded-xl font-bold text-sm hover:bg-purple-100 transition border border-purple-100">
              Printable Version
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
const page = usePage();

// Log this to your console to see if 'auth.user' exists
console.log(page.props.auth);
defineProps({
  books: Array
})
</script>