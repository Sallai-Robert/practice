<template>
    <div class="min-h-screen bg-linear-to-br from-purple-100 to-purple-200 flex items-center justify-center p-6">

        <div class="w-full max-w-3xl bg-white shadow-2xl rounded-2xl overflow-hidden">

            <!-- Header -->
            <div class="bg-purple-900 text-white p-6">
                <h1 class="text-3xl font-bold">Create New Book</h1>
                <p class="text-purple-200 mt-2">Add book details and upload PDFs</p>
            </div>

            <!-- Form -->
            <form class="p-8 space-y-6">

                <!-- Title -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Book Title
                    </label>
                    <input v-model="form.title" type="text" placeholder="Enter book title"
                        class="w-full px-4 py-3 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition" />
                </div>

                <!-- Author -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Author
                    </label>
                    <input v-model="form.author" type="text" placeholder="Enter author name"
                        class="w-full px-4 py-3 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition" />
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea v-model="form.description" rows="4" placeholder="Write a short description..."
                        class="w-full px-4 py-3 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"></textarea>
                </div>

                <!-- PDF Original -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Original PDF
                    </label>
                    <input type="file" accept="application/pdf" @change="handleOriginalUpload" class="w-full text-sm text-gray-600
              file:mr-4 file:py-2 file:px-4
              file:rounded-lg file:border-0
              file:text-sm file:font-semibold
              file:bg-purple-200 file:text-purple-900
              hover:file:bg-purple-300" />
                </div>

                <!-- PDF Printable -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Printable PDF
                    </label>
                    <input type="file" accept="application/pdf" @change="handlePrintableUpload" class="w-full text-sm text-gray-600
              file:mr-4 file:py-2 file:px-4
              file:rounded-lg file:border-0
              file:text-sm file:font-semibold
              file:bg-purple-200 file:text-purple-900
              hover:file:bg-purple-300" />
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button @click="submit" type="button"
                        class="w-full bg-purple-900 hover:bg-purple-800 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">
                        Create Book
                    </button>
                </div>

            </form>
        </div>

    </div>
</template>

<script setup>
import { reactive } from 'vue'

const submit = async () => {
    const formData = new FormData()

    formData.append('title', form.title)
    formData.append('author', form.author)
    formData.append('description', form.description)

    if (form.pdf_original) {
        formData.append('pdf_original', form.pdf_original)
    }

    if (form.pdf_printable) {
        formData.append('pdf_printable', form.pdf_printable)
    }

    const resp = await fetch('/api/books/create', {
        method: 'POST',
        body: formData,
        // DO NOT set Content-Type manually
    })

    const data = await resp.json()
    console.log(data)
}


const form = reactive({
    title: '',
    author: '',
    description: '',
    pdf_original: null,
    pdf_printable: null,
})

function handleOriginalUpload(event) {
    form.pdf_original = event.target.files[0]
    console.log('Original PDF selected:', form.pdf_original)
}

function handlePrintableUpload(event) {
    form.pdf_printable = event.target.files[0]
    console.log('Printable PDF selected:', form.pdf_printable)
}
</script>
