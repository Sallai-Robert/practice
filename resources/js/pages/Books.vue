<template>
  <div class="min-h-screen bg-gradient-to-br from-purple-100 to-purple-200 p-8">
    
    <!-- Page Header -->
    <div class="max-w-6xl mx-auto mb-10">
      <div class="bg-purple-900 text-white rounded-2xl shadow-xl p-8">
        <h1 class="text-4xl font-bold">Books Library</h1>
        <p class="text-purple-200 mt-2">
          Browse all available books in your collection
        </p>
      </div>
    </div>

    <!-- Books Grid -->
    <div class="max-w-6xl mx-auto">
      
      <div v-if="books.length === 0"
           class="text-center py-20 bg-white rounded-2xl shadow-lg">
        <p class="text-purple-900 text-xl font-semibold">
          No books available yet 📚
        </p>
        <p class="text-gray-500 mt-2">
          Start by adding a new book.
        </p>
      </div>

      <div v-else
           class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

        <div
          v-for="book in books"
          :key="book.id"
          class="bg-white rounded-2xl shadow-lg p-6 transition duration-300 hover:shadow-2xl hover:-translate-y-1 border border-purple-100"
        >
          <h2 class="text-xl font-bold text-purple-900">
            {{ book.title }}
          </h2>

          <p class="text-purple-600 font-medium mt-1">
            {{ book.author }}
          </p>

          <div class="h-px bg-purple-200 my-4"></div>

          <p class="text-gray-700 text-sm leading-relaxed">
            {{ book.description }}
          </p>
          <!-- <p>
            {{ book.pdf_original }}
            {{ book.pdf_printable }}
          </p> -->
          <div class="flex flex-col items-start mt-4">
              <div>
                <a :href="'/books/' + book.id + '/download/original'"
                   class="inline-block mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                  Download Original PDF
                </a>
            </div>
            <div>
                <a :href="book.pdf_printable" download
                   class="inline-block mt-4 ml-2 px-4 py-2 bg-purple-200 text-purple-900 rounded-lg hover:bg-purple-300 transition">
                  Download Printable PDF
                </a>
            </div>
          </div>
          <!-- Decorative Footer Accent -->
          <div class="mt-6 flex justify-end">
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-200 text-purple-900">
              Book
            </span>
          </div>
        </div>

      </div>

    </div>

  </div>
</template>

<script setup>
defineProps({
  books: Array
})
</script>
