<template>
  <div class="min-h-screen bg-slate-50 p-6 lg:p-12">
    <div class="max-w-5xl mx-auto">
      
      <a href="/" class="inline-flex items-center text-purple-600 font-semibold mb-6 hover:text-purple-800 transition">
        <span class="mr-2">←</span> Back to Library
      </a>

      <div class="bg-white shadow-2xl rounded-3xl overflow-hidden flex flex-col md:flex-row border border-purple-100">
        
        <div class="md:w-1/3 bg-gradient-to-br from-purple-900 to-indigo-900 p-10 text-white flex flex-col justify-between">
          <div>
            <div class="text-4xl mb-4">📖</div>
            <h1 class="text-3xl font-extrabold mb-4 leading-tight">Add to the Collection</h1>
            <p class="text-purple-200 leading-relaxed">
              Share a new masterpiece with the community. Please ensure you upload both the original and printable versions if available.
            </p>
          </div>
          
          <div class="hidden md:block">
            <div class="text-xs uppercase tracking-widest text-purple-400 font-bold mb-2">Requirement</div>
            <p class="text-sm text-purple-200">Files must be in PDF format and under 50MB.</p>
          </div>
        </div>

        <div class="md:w-2/3 p-8 lg:p-12 bg-white">
          <form @submit.prevent="submit" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Book Title</label>
                <input v-model="form.title" type="text" placeholder="e.g. The Great Gatsby"
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-purple-100 focus:border-purple-600 outline-none transition-all" />
              </div>

              <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Author</label>
                <input v-model="form.author" type="text" placeholder="Full Name"
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-purple-100 focus:border-purple-600 outline-none transition-all" />
              </div>
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Synopsis</label>
              <textarea v-model="form.description" rows="4" placeholder="Briefly describe the book..."
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-purple-100 focus:border-purple-600 outline-none transition-all resize-none"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-4">
              <div class="p-4 rounded-2xl bg-purple-50 border border-purple-100">
                <label class="block text-sm font-bold text-purple-900 mb-3 uppercase tracking-wide text-center">Original PDF</label>
                <input type="file" accept="application/pdf" @change="handleOriginalUpload" 
                  class="block w-full text-xs text-gray-500 file:mr-auto file:block file:w-full file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-purple-600 file:text-white hover:file:bg-purple-700 file:cursor-pointer" />
              </div>

              <div class="p-4 rounded-2xl bg-indigo-50 border border-indigo-100">
                <label class="block text-sm font-bold text-indigo-900 mb-3 uppercase tracking-wide text-center">Printable PDF</label>
                <input type="file" accept="application/pdf" @change="handlePrintableUpload" 
                  class="block w-full text-xs text-gray-500 file:mr-auto file:block file:w-full file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 file:cursor-pointer" />
              </div>
            </div>

            <button :disabled="loading" type="submit"
              class="w-full bg-purple-900 hover:bg-purple-800 disabled:bg-gray-400 text-white font-bold py-4 rounded-xl shadow-xl shadow-purple-200 transition-all transform active:scale-[0.98] flex items-center justify-center">
              <span v-if="!loading">Publish to Library</span>
              <span v-else class="flex items-center">
                <svg class="animate-spin h-5 w-5 mr-3 border-2 border-white border-t-transparent rounded-full" viewBox="0 0 24 24"></svg>
                Processing...
              </span>
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  author: '',
  description: '',
  pdf_original: null,
  pdf_printable: null,
})

const submit = () => {
  // Inertia automatically converts this to FormData if it detects files
  form.post('/books/create', {
    onSuccess: () => {
      // This runs only if the server returns a successful Inertia redirect
      console.log('Book created successfully!')
    },
    // You can also handle errors specifically
    onError: (errors) => {
      console.error(errors)
    }
  })
}

function handleOriginalUpload(event) {
  form.pdf_original = event.target.files[0]
}

function handlePrintableUpload(event) {
  form.pdf_printable = event.target.files[0]
}
</script>

<!-- <template>
  <button :disabled="form.processing" type="submit">
     {{ form.processing ? 'Uploading...' : 'Publish to Library' }}
  </button>
</template> -->