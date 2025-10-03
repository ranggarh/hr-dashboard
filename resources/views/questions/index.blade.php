{{-- filepath: resources/views/questions/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Soal')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('assessments.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                {{-- <h2 class="text-3xl font-bold text-gray-900">Kelola Soal</h2> --}}
                <div class="flex items-center space-x-3">
                    <div>
                        <p class="text-lg font-semibold text-gray-900">{{ $assessment->title }}</p>
                        <p class="text-sm text-gray-500">Assessment Test</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-24">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            <span class="font-medium">Tambah Soal Baru</span>
                        </h3>
                    </div>

                    <form action="{{ route('questions.store', $assessment->id) }}" method="POST"
                        enctype="multipart/form-data" class="p-6 space-y-5">
                        @csrf

                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar (Opsional)</label>
                            <input type="file" name="image" id="imageInput" accept="image/*" class="block w-full">
                            <div id="imagePreview" class="mt-3 hidden">
                                <img src="" alt="Preview"
                                    class="w-full h-32 object-cover rounded-lg border border-gray-200">
                            </div>
                        </div>

                        <!-- Question Input -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pertanyaan <span
                                    class="text-red-500">*</span></label>
                            <textarea name="question_text" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-md" required></textarea>
                        </div>

                        <!-- Question Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Soal <span
                                    class="text-red-500">*</span></label>
                            <select name="question_type" class="w-full px-4 py-3 border border-gray-300 rounded-md"
                                required>
                                <option value="multiple_choice">Multiple Choice</option>
                                <option value="essay">Essay</option>
                                <option value="true_false">True/False</option>
                                <option value="short_answer">Short Answer</option>
                            </select>
                        </div>

                        <!-- Answer Input -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jawaban <span
                                    class="text-red-500">*</span></label>
                            <div id="answerContainer" class="space-y-2">
                                <!-- Multiple Choice (default) -->
                                <div id="multipleChoiceAnswers">
                                    <div class="flex items-center space-x-2 w-full">
                                        <input type="text" name="answers[0][answer_text]"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-md"
                                            placeholder="Jawaban 1" required>
                                        <label class="flex items-center space-x-1 text-xs">
                                            <input type="checkbox" name="answers[0][is_correct]" value="1"
                                                class="rounded">
                                            <span>Benar</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Essay -->
                                <div id="essayAnswer" class="hidden">
                                    <input type="text" name="answers[0][answer_text]"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md"
                                        placeholder="Jawaban benar (opsional)" disabled>
                                </div>
                                <!-- True/False -->
                                <div id="trueFalseAnswer" class="hidden">
                                    <label class="inline-flex items-center mr-4">
                                        <input type="radio" name="answers[0][answer_text]" value="true" class="rounded"
                                            required>
                                        <span class="ml-2">True</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answers[0][answer_text]" value="false" class="rounded"
                                            required>
                                        <span class="ml-2">False</span>
                                    </label>
                                </div>
                                <!-- Short Answer -->
                                <div id="shortAnswer" class="hidden">
                                    <input type="text" name="answers[0][answer_text]"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md"
                                        placeholder="Jawaban benar (opsional)" disabled>
                                </div>
                            </div>
                            <button type="button" id="addAnswerBtn"
                                class="mt-3 w-full py-2 border-2 border-dashed border-gray-300 rounded-md text-sm font-medium text-gray-600">
                                + Tambah Jawaban
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 rounded-md">
                            Simpan Soal
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column - Question List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                <span>Daftar Soal</span>
                            </h3>
                            <span
                                class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $assessment->questions->count() }} Soal
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        @if ($assessment->questions->count() > 0)
                            <div class="space-y-4">
                                @foreach ($assessment->questions as $index => $question)
                                    <div
                                        class="group relative bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-md p-5 hover:shadow-md hover:border-blue-300 transition-all duration-200">
                                        <!-- Question Number Badge -->
                                        <div
                                            class="absolute -top-3 -left-3 w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                                            <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                        </div>

                                        <!-- Image Preview -->
                                        @if ($question->image)
                                            <div class="mb-4 ml-6">
                                                <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image"
                                                    class="h-32 w-auto rounded-lg border-2 border-gray-200 shadow-sm object-cover">
                                            </div>
                                        @endif

                                        <!-- Question Text -->
                                        <div class="mb-4 ml-6">
                                            <div class="flex items-start space-x-2">
                                                <p class="text-gray-900 font-medium leading-relaxed">
                                                    {{ $question->question }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-4 ml-6">
                                            <div class="flex items-start space-x-2">
                                                <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                                <p class="text-gray-900 font-medium leading-relaxed">
                                                    {{ $question->question_text }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Answers -->
                                        <div class="ml-6 bg-blue-50 rounded-lg p-4 border border-blue-100">
                                            <div class="flex items-start space-x-2">
                                                <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Jawaban:
                                                    </p>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($question->answers as $answer)
                                                            <span
                                                                class="bg-white px-3 py-1.5 rounded-lg text-sm font-medium text-gray-700 border border-blue-200 shadow-sm">
                                                                {{ $answer->answer_text }}
                                                                @if ($answer->is_correct)
                                                                    <span class="text-green-500 font-bold ml-1">✔</span>
                                                                @endif
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div
                                            class="absolute top-5 right-5 flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <button
                                                class="p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                class="p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div
                                    class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Soal</h3>
                                <p class="text-gray-500 text-sm">Tambahkan soal pertama menggunakan form di sebelah kiri
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image Preview
            document.getElementById('imageInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('imagePreview');
                        const img = preview.querySelector('img');
                        img.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Dynamic Answer Field
            let answerCount = 1;
            const addAnswerBtn = document.getElementById('addAnswerBtn');
            const answerContainer = document.getElementById('answerContainer');
            const multipleChoiceAnswers = document.getElementById('multipleChoiceAnswers');
            const essayAnswer = document.getElementById('essayAnswer');
            const trueFalseAnswer = document.getElementById('trueFalseAnswer');
            const shortAnswer = document.getElementById('shortAnswer');
            const questionType = document.querySelector('select[name="question_type"]');

            function showAnswerFields(type) {
                multipleChoiceAnswers.classList.add('hidden');
                essayAnswer.classList.add('hidden');
                trueFalseAnswer.classList.add('hidden');
                shortAnswer.classList.add('hidden');
                addAnswerBtn.classList.add('hidden');

                if (type === 'multiple_choice') {
                    multipleChoiceAnswers.classList.remove('hidden');
                    addAnswerBtn.classList.remove('hidden');
                    // Enable all inputs
                    Array.from(multipleChoiceAnswers.querySelectorAll('input')).forEach(i => i.disabled = false);
                } else if (type === 'essay') {
                    essayAnswer.classList.remove('hidden');
                    essayAnswer.querySelector('input').disabled = false;
                } else if (type === 'true_false') {
                    trueFalseAnswer.classList.remove('hidden');
                    Array.from(trueFalseAnswer.querySelectorAll('input')).forEach(i => i.disabled = false);
                } else if (type === 'short_answer') {
                    shortAnswer.classList.remove('hidden');
                    shortAnswer.querySelector('input').disabled = false;
                }
            }

            // Initial state
            showAnswerFields(questionType.value);

            questionType.addEventListener('change', function() {
                showAnswerFields(this.value);
            });

            // Add Answer Field for Multiple Choice
            addAnswerBtn.addEventListener('click', function() {
                answerCount++;
                const newAnswer = document.createElement('div');
                newAnswer.className = 'flex items-center space-x-2 w-full';
                newAnswer.innerHTML = `
            <input type="text" name="answers[${answerCount - 1}][answer_text]" class="w-full px-4 py-3 border border-gray-300 rounded-md" placeholder="Jawaban ${answerCount}" required>
            <label class="flex items-center space-x-1 text-xs">
                <input type="checkbox" name="answers[${answerCount - 1}][is_correct]" value="1" class="rounded">
                <span>Benar</span>
            </label>
            <button type="button" class="remove-answer p-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;
                multipleChoiceAnswers.appendChild(newAnswer);

                // Remove answer
                newAnswer.querySelector('.remove-answer').addEventListener('click', function() {
                    newAnswer.remove();
                });
            });
        </script>
    @endpush
@endsection
