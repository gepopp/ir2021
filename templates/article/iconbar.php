<div x-data="readingFunctions(<?php echo get_current_user_id() ?>)"
     x-init="load()"
     x-cloak>
    <div class="w-full bg-white text-gray-900 flex justify-between p-5 relative">
        <div x-show.transition.in.fade.300ms="showHint" class="absolute top-0 left-0 bg-gray-900 -mt-100 lg:mt-16 mb-20 lg:-ml-48 ml-10 p-5 text-white w-64 shadow-lg rounded bg-opacity-75 z-50">
            <div class="flex justify-start">
                <svg class="w-4 h-4 text-white cursor-pointer" @click="close(false)" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex justify-between">
                <div>
                    <h3 class="font-serif text-lg"><?php _e('Lesezeichen und später Lesen', 'ir21') ?></h3>

                </div>
                <div>
                    <svg class="w-10 h-10 text-white mr-2 animate-bounce hidden lg:block" fill="currentColor" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.54,93.44c-0.52-0.53-0.97-1.11-1.65-1.51c-0.2-0.12-0.33-0.27-0.44-0.44c-0.38-0.61-1.02-1.06-1.46-1.63
	c-0.09-0.12-0.2-0.26-0.35-0.33c-0.73-0.36-1.17-0.95-1.69-1.47c-1.42-1.43-2.82-2.87-4.24-4.31c-0.37-0.38-0.73-0.76-1.2-1.06
	c-0.18-0.11-0.29-0.3-0.41-0.46c-0.46-0.63-0.95-1.24-1.71-1.65c-0.3-0.16-0.5-0.4-0.64-0.69c-0.13-0.28-0.28-0.55-0.59-0.71
	c-0.66-0.34-1.11-0.86-1.59-1.35c-0.89-0.92-1.95-1.67-3.09-2.35c-0.75-0.44-0.71-1.15-0.44-1.57c0.67-1.03,1.45-2.01,2.5-2.81
	c0.13-0.1,0.27-0.2,0.42-0.25c1.07-0.36,2.07-0.86,3.23-1.04c1.03-0.16,1.98-0.55,2.93-0.92c0.79-0.3,1.59-0.6,2.24-1.1
	c0.17-0.13,0.38-0.24,0.59-0.29c0.46-0.12,0.81-0.38,1.2-0.59c0.34-0.19,0.7-0.35,1.05-0.52c0.25-0.12,0.51-0.23,0.74-0.38
	c0.46-0.3,0.93-0.57,1.48-0.76c0.42-0.14,0.75-0.47,1.17-0.62c0.81-0.3,1.5-0.73,2.21-1.16c0.47-0.28,1.02-0.47,1.5-0.73
	c0.49-0.27,0.92-0.61,1.49-0.74c0.96-0.55,2.02-0.94,2.97-1.51c1.17-0.71,2.34-1.43,3.53-2.11c1.05-0.61,2.15-1.15,3.19-1.78
	c0.47-0.28,1.04-0.42,1.36-0.87c0.08-0.11,0.28-0.17,0.42-0.25c0.29-0.16,0.6-0.3,0.86-0.49c0.3-0.22,0.53-0.52,0.84-0.73
	c0.31-0.21,0.71-0.33,1.03-0.54c1.2-0.77,2.4-1.55,3.44-2.48c0.16-0.14,0.37-0.23,0.55-0.35c0.27-0.18,0.61-0.33,0.8-0.56
	c0.55-0.72,1.36-1.21,2.11-1.75c0.76-0.53,1.43-1.14,2.14-1.71c0.62-0.5,1.11-1.12,1.83-1.55c0.87-1.04,1.99-1.9,2.9-2.92
	c0.77-0.86,1.58-1.69,2.32-2.56c0.71-0.84,1.38-1.7,2.06-2.55c0.18-0.23,0.16-0.48-0.04-0.68c-0.22-0.23-0.42-0.5-0.7-0.65
	c-0.61-0.32-1.04-0.78-1.51-1.21c-0.88-0.78-1.87-1.46-2.85-2.15c-0.67-0.47-1.42-0.85-1.99-1.43c-0.18-0.18-0.46-0.3-0.7-0.43
	c-0.63-0.35-1.26-0.7-1.9-1.04c-0.3-0.16-0.51-0.39-0.69-0.65c-0.19-0.26-0.29-0.57-0.11-0.84c0.26-0.39,0.21-0.75,0.03-1.13
	c-0.09-0.19-0.02-0.39,0.07-0.57c0.02-0.05,0.04-0.09,0.08-0.13c0.59-0.67,1.17-1.34,1.78-1.99c0.1-0.11,0.27-0.18,0.43-0.23
	c0.49-0.16,0.97-0.32,1.48-0.43c0.68-0.14,1.33-0.33,1.95-0.6c0.82-0.36,1.7-0.63,2.48-1.06c0.15-0.08,0.3-0.15,0.47-0.2
	c1.49-0.42,2.76-1.25,4.23-1.7c0.72-0.41,1.48-0.76,2.23-1.14c0.45-0.22,0.89-0.44,1.37-0.63c0.89-0.35,1.76-0.71,2.56-1.22
	c0.64-0.41,1.42-0.65,2.14-0.97c0.26-0.11,0.51-0.24,0.78-0.33c0.87-0.29,1.63-0.74,2.34-1.25c0.84-0.62,1.89-0.95,2.81-1.46
	c0.59-0.12,1.01-0.47,1.48-0.76c0.38-0.23,0.73-0.5,1.15-0.66c0.51-0.19,0.7-0.65,1.15-0.88c0.44-0.23,0.96-0.38,1.33-0.67
	c0.73-0.56,1.42-1.15,1.92-1.89c0.17-0.25,0.35-0.56,0.62-0.7c0.71-0.38,1.04-1.05,1.72-1.45c0.48-0.28,0.95-0.56,1.52-0.68
	c0.39-0.08,0.78-0.2,1.17-0.27c0.1-0.02,0.25,0.02,0.32,0.08c0.4,0.35,0.8,0.71,1.18,1.08c0.11,0.11,0.17,0.26,0.22,0.4
	C90.94,7.49,91.2,8.24,91.46,9c0.06,0.19,0.18,0.39,0.15,0.57c-0.13,0.82,0.29,1.54,0.48,2.3c0.25,1.01,0.52,2.02,0.81,3.02
	c0.27,0.91,0.56,1.81,0.88,2.7c0.37,1.04,0.59,2.09,0.6,3.18c0.01,1.28,0.18,2.55,0.36,3.82c0.12,0.84,0.13,1.67,0.08,2.5
	c-0.03,0.64-0.02,1.29,0.1,1.91c0.19,0.93,0.15,1.86,0.14,2.79c0,0.25-0.02,0.49,0,0.74c0.03,0.63,0.16,1.27-0.03,1.9
	c-0.07,0.23,0.03,0.49,0.03,0.73c0.02,0.64-0.11,1.28,0.03,1.91c-0.23,0.62-0.09,1.27-0.17,1.91c-0.07,0.54-0.08,1.08-0.11,1.62
	c-0.01,0.19-0.02,0.39-0.05,0.58c-0.04,0.24-0.16,0.48-0.16,0.72c0.01,1.03-0.26,2.04-0.22,3.08c0.04,1.13-0.11,2.25-0.44,3.36
	c-0.21,0.71-0.36,1.43-0.2,2.19c0.17,0.81-0.14,1.55-0.7,2.22c-0.27,0.32-0.52,0.65-1,0.78c-0.09,0.02-0.18,0.14-0.21,0.22
	c-0.08,0.23-0.14,0.48-0.2,0.72c-0.09,0.36-0.33,0.64-0.67,0.83c-0.77,0.45-1.6,0.8-2.54,0.88c-0.22,0.02-0.49,0.01-0.67-0.09
	c-0.48-0.26-1.01-0.48-1.42-0.85c-0.71-0.65-1.58-1.14-2.39-1.7c-1.3-0.9-2.72-1.67-4.12-2.44c-0.88-0.49-1.75-0.96-2.37-1.71
	c-0.2-0.24-0.51-0.4-0.84-0.51c-0.29-0.1-0.6-0.05-0.77,0.17c-0.66,0.87-1.32,1.73-1.8,2.69c-0.52,1.04-1.09,2.07-1.66,3.09
	c-0.27,0.49-0.63,0.94-0.89,1.43c-0.43,0.81-1.02,1.54-1.32,2.4c-0.06,0.18-0.2,0.36-0.33,0.52c-0.44,0.58-0.87,1.15-1.12,1.82
	c-0.1,0.27-0.32,0.52-0.52,0.76c-0.83,1-1.43,2.14-2.39,3.08c-0.07,0.07-0.13,0.16-0.18,0.25c-0.69,1.32-1.87,2.36-2.83,3.53
	c-0.16,0.2-0.41,0.35-0.6,0.53c-0.22,0.22-0.44,0.46-0.64,0.7c-0.34,0.4-0.65,0.81-0.99,1.21c-0.44,0.52-0.91,1-1.47,1.44
	c-0.68,0.52-1.25,1.16-1.84,1.76c-0.45,0.46-0.95,0.86-1.45,1.27c-0.5,0.41-1.04,0.78-1.44,1.27c-0.26,0.32-0.69,0.53-0.97,0.84
	c-0.78,0.87-1.75,1.57-2.73,2.27c-0.53,0.65-1.37,1.02-1.97,1.62c-0.56,0.55-1.29,0.98-1.97,1.45c-1.26,0.87-2.52,1.73-3.79,2.59
	c-0.27,0.18-0.57,0.34-0.85,0.51c-0.19,0.11-0.4,0.21-0.54,0.35c-0.49,0.5-1.06,0.9-1.79,1.13c-0.15,0.05-0.3,0.16-0.41,0.27
	c-0.66,0.7-1.56,1.13-2.4,1.63c-0.42,0.26-0.83,0.54-1.24,0.81c-0.32,0.21-0.61,0.48-0.96,0.62c-0.64,0.26-1.18,0.58-1.6,1.07
	c-0.2,0.23-0.53,0.37-0.86,0.48c-1.1,0.33-2.07,0.88-2.98,1.48c-0.86,0.56-1.81,0.85-2.89,0.88c-0.39,0.01-0.67-0.12-0.9-0.36
	C25.2,94.12,24.87,93.78,24.54,93.44z M21.49,84.14c0.01-0.01,0.02-0.02,0.03-0.02c0.96,0.99,1.9,1.99,2.87,2.97
	c0.85,0.87,1.74,1.71,2.59,2.58c0.27,0.27,0.62,0.44,0.96,0.62c0.09,0.05,0.24,0.09,0.33,0.06c1.02-0.34,2.12-0.51,2.96-1.18
	c0.21-0.17,0.46-0.32,0.72-0.4c0.62-0.19,1.11-0.53,1.6-0.87c0.72-0.5,1.44-0.99,2.17-1.48c0.27-0.18,0.54-0.4,0.85-0.51
	c0.87-0.32,1.58-0.82,2.28-1.34c0.48-0.35,1.01-0.67,1.44-1.06c0.45-0.41,1.04-0.61,1.53-0.96c2.04-1.45,4.11-2.89,6.17-4.33
	c0.36-0.25,0.68-0.52,0.93-0.87c0.33-0.46,0.76-0.85,1.34-1.13c0.24-0.11,0.45-0.31,0.62-0.51c1-1.21,2.35-2.16,3.41-3.33
	c0.73-0.5,1.3-1.13,1.83-1.77c0.37-0.45,0.87-0.8,1.21-1.25c0.38-0.5,0.84-0.94,1.31-1.37c0.16-0.14,0.31-0.3,0.43-0.46
	c0.51-0.72,1.19-1.32,1.78-1.99c0.69-0.79,1.44-1.53,1.91-2.44c0.07-0.13,0.2-0.24,0.28-0.37c0.41-0.6,0.73-1.25,1.23-1.77
	c0.54-0.56,0.71-1.23,1.08-1.83c0.16-0.26,0.37-0.5,0.54-0.76c0.29-0.43,0.6-0.84,0.83-1.29c0.38-0.77,0.97-1.45,1.24-2.27
	c0.08-0.23,0.27-0.43,0.41-0.65c0.14-0.21,0.33-0.42,0.41-0.65c0.25-0.71,0.68-1.35,1.07-2.01c0.67-1.15,1.18-2.35,1.96-3.45
	c0.15-0.21,0.24-0.45,0.31-0.69c0.33-1.07,1.02-1.96,1.83-2.81c0.55-0.59,1.24-1.02,2.04-1.33c0.14-0.05,0.35-0.03,0.5,0.02
	c0.27,0.09,0.51,0.23,0.77,0.34c0.59,0.23,1.09,0.55,1.49,0.99c0.28,0.31,0.57,0.63,0.93,0.87c1,0.67,1.89,1.45,2.9,2.1
	c0.88,0.56,1.73,1.16,2.72,1.58c0.47,0.2,0.9,0.44,1.32,0.71c0.46,0.3,0.98,0.52,1.48,0.77c0.23,0.12,0.4,0.06,0.58-0.15
	c0.27-0.32,0.51-0.64,0.55-1.07c0.04-0.39,0.19-0.77,0.28-1.15c0.23-0.96,0.42-1.93,0.32-2.92c-0.1-0.93,0.15-1.86,0.02-2.8
	c0.23-0.76-0.01-1.58,0.41-2.32c0.05-0.49,0.12-0.98,0.14-1.47c0.01-0.29-0.05-0.59-0.05-0.88c-0.01-1.42,0.11-2.85,0-4.27
	c-0.11-1.47-0.01-2.95-0.35-4.41c-0.08-0.33-0.05-0.69-0.02-1.03c0.1-1.04,0.01-2.06-0.17-3.08c-0.19-1.12-0.37-2.24-0.51-3.36
	c-0.14-1.18-0.26-2.35-0.78-3.46c-0.13-0.27-0.17-0.57-0.25-0.86c-0.21-0.77-0.48-1.53-0.63-2.3c-0.17-0.83-0.64-1.58-0.83-2.4
	c-0.15-0.65-0.59-0.66-1.17-0.47c-0.32,0.1-0.62,0.28-0.89,0.45c-0.69,0.45-1.38,0.9-2.02,1.4c-0.94,0.74-2.19,1.11-3.08,1.89
	c-0.38,0.12-0.76,0.23-1.14,0.36c-0.16,0.05-0.3,0.15-0.45,0.22c-0.4,0.19-0.8,0.39-1.21,0.58c-1.31,0.62-2.63,1.24-3.93,1.87
	c-0.65,0.31-1.27,0.7-1.96,0.93c-0.71,0.24-1.31,0.63-2.01,0.87c-1.45,0.5-2.76,1.24-4.14,1.85c-0.67,0.29-1.32,0.6-2.02,0.85
	c-1.01,0.36-2.03,0.74-2.98,1.2c-1.11,0.54-2.25,1.01-3.44,1.4c-0.55,0.18-1,0.48-1.41,0.83c-0.03,0.03-0.05,0.12-0.03,0.14
	c0.56,0.49,1.07,1.03,1.69,1.46c0.95,0.64,1.91,1.27,2.74,2.03c0.2,0.18,0.45,0.31,0.67,0.46c0.72,0.49,1.46,0.96,2.14,1.5
	c0.59,0.47,1.22,0.9,1.96,1.2c0.31,0.12,0.63,0.27,0.88,0.47c0.58,0.44,1.04,0.93,0.71,1.67c-0.1,0.22-0.1,0.48-0.11,0.73
	c-0.01,0.26-0.09,0.48-0.27,0.68c-0.24,0.27-0.45,0.58-0.72,0.83c-0.28,0.25-0.51,0.53-0.75,0.81c-0.78,0.92-1.47,1.89-2.31,2.76
	c-0.87,0.91-1.58,1.94-2.57,2.77c-0.38,0.64-1.11,0.99-1.66,1.49c-0.55,0.5-0.99,1.09-1.66,1.5c-0.42,0.26-0.86,0.53-1.17,0.87
	c-0.42,0.47-0.96,0.86-1.37,1.32c-0.68,0.76-1.53,1.33-2.37,1.93c-1.5,1.08-3.06,2.11-4.44,3.31c-0.12,0.1-0.23,0.25-0.37,0.3
	c-0.98,0.29-1.52,1.04-2.3,1.53c-0.21,0.32-0.54,0.49-0.92,0.64c-0.36,0.14-0.69,0.36-1.02,0.56c-1.04,0.61-1.9,1.45-3.13,1.84
	c-0.21,0.07-0.37,0.24-0.56,0.35c-0.24,0.14-0.46,0.33-0.72,0.41c-0.9,0.27-1.57,0.83-2.31,1.3c-0.47,0.29-0.89,0.66-1.4,0.87
	c-0.69,0.28-1.3,0.65-1.89,1.05c-0.5,0.34-1.05,0.6-1.61,0.86c-0.54,0.25-1.18,0.4-1.57,0.88c-0.12,0.14-0.39,0.19-0.6,0.28
	c-0.26,0.12-0.54,0.2-0.76,0.35c-0.81,0.57-1.86,0.8-2.63,1.41c-1.17,0.34-2,1.16-3.15,1.54c-0.42,0.14-0.73,0.52-1.15,0.65
	c-0.94,0.3-1.63,0.94-2.58,1.22c-0.21,0.06-0.4,0.2-0.58,0.33c-1.01,0.69-2.13,1.16-3.39,1.44c-0.5,0.11-0.98,0.29-1.47,0.44
	c-0.11,0.03-0.21,0.08-0.31,0.14c-0.1,0.05-0.18,0.12-0.27,0.18c-0.33,0.22-0.41,0.51-0.17,0.76c1.17,1.22,2.35,2.44,3.52,3.66
	c0.11,0.11,0.22,0.24,0.37,0.31c0.81,0.43,1.34,1.08,1.93,1.69C18.7,81.25,20.09,82.7,21.49,84.14z"/>
                    </svg>
                </div>
            </div>
            <p class="text-sm">
                <?php _e('Mit unseren neuen Funktionen können Sie Lesezeichen anlegen, um Ihre Inhalte schneller wiederzufinden, oder einen Artikel zum später Lesen vormerken – Sie erhalten dann ein Erinnerungsmail nach einigen Tagen.', 'ir21') ?>
            </p>
            <p class="text-right text-primary-100 underline cursor-pointer" @click="close(true)">verstanden</p>
            <svg class="w-10 h-10 text-white mr-2 block lg:hidden transform rotate-180" fill="currentColor" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.54,93.44c-0.52-0.53-0.97-1.11-1.65-1.51c-0.2-0.12-0.33-0.27-0.44-0.44c-0.38-0.61-1.02-1.06-1.46-1.63
	c-0.09-0.12-0.2-0.26-0.35-0.33c-0.73-0.36-1.17-0.95-1.69-1.47c-1.42-1.43-2.82-2.87-4.24-4.31c-0.37-0.38-0.73-0.76-1.2-1.06
	c-0.18-0.11-0.29-0.3-0.41-0.46c-0.46-0.63-0.95-1.24-1.71-1.65c-0.3-0.16-0.5-0.4-0.64-0.69c-0.13-0.28-0.28-0.55-0.59-0.71
	c-0.66-0.34-1.11-0.86-1.59-1.35c-0.89-0.92-1.95-1.67-3.09-2.35c-0.75-0.44-0.71-1.15-0.44-1.57c0.67-1.03,1.45-2.01,2.5-2.81
	c0.13-0.1,0.27-0.2,0.42-0.25c1.07-0.36,2.07-0.86,3.23-1.04c1.03-0.16,1.98-0.55,2.93-0.92c0.79-0.3,1.59-0.6,2.24-1.1
	c0.17-0.13,0.38-0.24,0.59-0.29c0.46-0.12,0.81-0.38,1.2-0.59c0.34-0.19,0.7-0.35,1.05-0.52c0.25-0.12,0.51-0.23,0.74-0.38
	c0.46-0.3,0.93-0.57,1.48-0.76c0.42-0.14,0.75-0.47,1.17-0.62c0.81-0.3,1.5-0.73,2.21-1.16c0.47-0.28,1.02-0.47,1.5-0.73
	c0.49-0.27,0.92-0.61,1.49-0.74c0.96-0.55,2.02-0.94,2.97-1.51c1.17-0.71,2.34-1.43,3.53-2.11c1.05-0.61,2.15-1.15,3.19-1.78
	c0.47-0.28,1.04-0.42,1.36-0.87c0.08-0.11,0.28-0.17,0.42-0.25c0.29-0.16,0.6-0.3,0.86-0.49c0.3-0.22,0.53-0.52,0.84-0.73
	c0.31-0.21,0.71-0.33,1.03-0.54c1.2-0.77,2.4-1.55,3.44-2.48c0.16-0.14,0.37-0.23,0.55-0.35c0.27-0.18,0.61-0.33,0.8-0.56
	c0.55-0.72,1.36-1.21,2.11-1.75c0.76-0.53,1.43-1.14,2.14-1.71c0.62-0.5,1.11-1.12,1.83-1.55c0.87-1.04,1.99-1.9,2.9-2.92
	c0.77-0.86,1.58-1.69,2.32-2.56c0.71-0.84,1.38-1.7,2.06-2.55c0.18-0.23,0.16-0.48-0.04-0.68c-0.22-0.23-0.42-0.5-0.7-0.65
	c-0.61-0.32-1.04-0.78-1.51-1.21c-0.88-0.78-1.87-1.46-2.85-2.15c-0.67-0.47-1.42-0.85-1.99-1.43c-0.18-0.18-0.46-0.3-0.7-0.43
	c-0.63-0.35-1.26-0.7-1.9-1.04c-0.3-0.16-0.51-0.39-0.69-0.65c-0.19-0.26-0.29-0.57-0.11-0.84c0.26-0.39,0.21-0.75,0.03-1.13
	c-0.09-0.19-0.02-0.39,0.07-0.57c0.02-0.05,0.04-0.09,0.08-0.13c0.59-0.67,1.17-1.34,1.78-1.99c0.1-0.11,0.27-0.18,0.43-0.23
	c0.49-0.16,0.97-0.32,1.48-0.43c0.68-0.14,1.33-0.33,1.95-0.6c0.82-0.36,1.7-0.63,2.48-1.06c0.15-0.08,0.3-0.15,0.47-0.2
	c1.49-0.42,2.76-1.25,4.23-1.7c0.72-0.41,1.48-0.76,2.23-1.14c0.45-0.22,0.89-0.44,1.37-0.63c0.89-0.35,1.76-0.71,2.56-1.22
	c0.64-0.41,1.42-0.65,2.14-0.97c0.26-0.11,0.51-0.24,0.78-0.33c0.87-0.29,1.63-0.74,2.34-1.25c0.84-0.62,1.89-0.95,2.81-1.46
	c0.59-0.12,1.01-0.47,1.48-0.76c0.38-0.23,0.73-0.5,1.15-0.66c0.51-0.19,0.7-0.65,1.15-0.88c0.44-0.23,0.96-0.38,1.33-0.67
	c0.73-0.56,1.42-1.15,1.92-1.89c0.17-0.25,0.35-0.56,0.62-0.7c0.71-0.38,1.04-1.05,1.72-1.45c0.48-0.28,0.95-0.56,1.52-0.68
	c0.39-0.08,0.78-0.2,1.17-0.27c0.1-0.02,0.25,0.02,0.32,0.08c0.4,0.35,0.8,0.71,1.18,1.08c0.11,0.11,0.17,0.26,0.22,0.4
	C90.94,7.49,91.2,8.24,91.46,9c0.06,0.19,0.18,0.39,0.15,0.57c-0.13,0.82,0.29,1.54,0.48,2.3c0.25,1.01,0.52,2.02,0.81,3.02
	c0.27,0.91,0.56,1.81,0.88,2.7c0.37,1.04,0.59,2.09,0.6,3.18c0.01,1.28,0.18,2.55,0.36,3.82c0.12,0.84,0.13,1.67,0.08,2.5
	c-0.03,0.64-0.02,1.29,0.1,1.91c0.19,0.93,0.15,1.86,0.14,2.79c0,0.25-0.02,0.49,0,0.74c0.03,0.63,0.16,1.27-0.03,1.9
	c-0.07,0.23,0.03,0.49,0.03,0.73c0.02,0.64-0.11,1.28,0.03,1.91c-0.23,0.62-0.09,1.27-0.17,1.91c-0.07,0.54-0.08,1.08-0.11,1.62
	c-0.01,0.19-0.02,0.39-0.05,0.58c-0.04,0.24-0.16,0.48-0.16,0.72c0.01,1.03-0.26,2.04-0.22,3.08c0.04,1.13-0.11,2.25-0.44,3.36
	c-0.21,0.71-0.36,1.43-0.2,2.19c0.17,0.81-0.14,1.55-0.7,2.22c-0.27,0.32-0.52,0.65-1,0.78c-0.09,0.02-0.18,0.14-0.21,0.22
	c-0.08,0.23-0.14,0.48-0.2,0.72c-0.09,0.36-0.33,0.64-0.67,0.83c-0.77,0.45-1.6,0.8-2.54,0.88c-0.22,0.02-0.49,0.01-0.67-0.09
	c-0.48-0.26-1.01-0.48-1.42-0.85c-0.71-0.65-1.58-1.14-2.39-1.7c-1.3-0.9-2.72-1.67-4.12-2.44c-0.88-0.49-1.75-0.96-2.37-1.71
	c-0.2-0.24-0.51-0.4-0.84-0.51c-0.29-0.1-0.6-0.05-0.77,0.17c-0.66,0.87-1.32,1.73-1.8,2.69c-0.52,1.04-1.09,2.07-1.66,3.09
	c-0.27,0.49-0.63,0.94-0.89,1.43c-0.43,0.81-1.02,1.54-1.32,2.4c-0.06,0.18-0.2,0.36-0.33,0.52c-0.44,0.58-0.87,1.15-1.12,1.82
	c-0.1,0.27-0.32,0.52-0.52,0.76c-0.83,1-1.43,2.14-2.39,3.08c-0.07,0.07-0.13,0.16-0.18,0.25c-0.69,1.32-1.87,2.36-2.83,3.53
	c-0.16,0.2-0.41,0.35-0.6,0.53c-0.22,0.22-0.44,0.46-0.64,0.7c-0.34,0.4-0.65,0.81-0.99,1.21c-0.44,0.52-0.91,1-1.47,1.44
	c-0.68,0.52-1.25,1.16-1.84,1.76c-0.45,0.46-0.95,0.86-1.45,1.27c-0.5,0.41-1.04,0.78-1.44,1.27c-0.26,0.32-0.69,0.53-0.97,0.84
	c-0.78,0.87-1.75,1.57-2.73,2.27c-0.53,0.65-1.37,1.02-1.97,1.62c-0.56,0.55-1.29,0.98-1.97,1.45c-1.26,0.87-2.52,1.73-3.79,2.59
	c-0.27,0.18-0.57,0.34-0.85,0.51c-0.19,0.11-0.4,0.21-0.54,0.35c-0.49,0.5-1.06,0.9-1.79,1.13c-0.15,0.05-0.3,0.16-0.41,0.27
	c-0.66,0.7-1.56,1.13-2.4,1.63c-0.42,0.26-0.83,0.54-1.24,0.81c-0.32,0.21-0.61,0.48-0.96,0.62c-0.64,0.26-1.18,0.58-1.6,1.07
	c-0.2,0.23-0.53,0.37-0.86,0.48c-1.1,0.33-2.07,0.88-2.98,1.48c-0.86,0.56-1.81,0.85-2.89,0.88c-0.39,0.01-0.67-0.12-0.9-0.36
	C25.2,94.12,24.87,93.78,24.54,93.44z M21.49,84.14c0.01-0.01,0.02-0.02,0.03-0.02c0.96,0.99,1.9,1.99,2.87,2.97
	c0.85,0.87,1.74,1.71,2.59,2.58c0.27,0.27,0.62,0.44,0.96,0.62c0.09,0.05,0.24,0.09,0.33,0.06c1.02-0.34,2.12-0.51,2.96-1.18
	c0.21-0.17,0.46-0.32,0.72-0.4c0.62-0.19,1.11-0.53,1.6-0.87c0.72-0.5,1.44-0.99,2.17-1.48c0.27-0.18,0.54-0.4,0.85-0.51
	c0.87-0.32,1.58-0.82,2.28-1.34c0.48-0.35,1.01-0.67,1.44-1.06c0.45-0.41,1.04-0.61,1.53-0.96c2.04-1.45,4.11-2.89,6.17-4.33
	c0.36-0.25,0.68-0.52,0.93-0.87c0.33-0.46,0.76-0.85,1.34-1.13c0.24-0.11,0.45-0.31,0.62-0.51c1-1.21,2.35-2.16,3.41-3.33
	c0.73-0.5,1.3-1.13,1.83-1.77c0.37-0.45,0.87-0.8,1.21-1.25c0.38-0.5,0.84-0.94,1.31-1.37c0.16-0.14,0.31-0.3,0.43-0.46
	c0.51-0.72,1.19-1.32,1.78-1.99c0.69-0.79,1.44-1.53,1.91-2.44c0.07-0.13,0.2-0.24,0.28-0.37c0.41-0.6,0.73-1.25,1.23-1.77
	c0.54-0.56,0.71-1.23,1.08-1.83c0.16-0.26,0.37-0.5,0.54-0.76c0.29-0.43,0.6-0.84,0.83-1.29c0.38-0.77,0.97-1.45,1.24-2.27
	c0.08-0.23,0.27-0.43,0.41-0.65c0.14-0.21,0.33-0.42,0.41-0.65c0.25-0.71,0.68-1.35,1.07-2.01c0.67-1.15,1.18-2.35,1.96-3.45
	c0.15-0.21,0.24-0.45,0.31-0.69c0.33-1.07,1.02-1.96,1.83-2.81c0.55-0.59,1.24-1.02,2.04-1.33c0.14-0.05,0.35-0.03,0.5,0.02
	c0.27,0.09,0.51,0.23,0.77,0.34c0.59,0.23,1.09,0.55,1.49,0.99c0.28,0.31,0.57,0.63,0.93,0.87c1,0.67,1.89,1.45,2.9,2.1
	c0.88,0.56,1.73,1.16,2.72,1.58c0.47,0.2,0.9,0.44,1.32,0.71c0.46,0.3,0.98,0.52,1.48,0.77c0.23,0.12,0.4,0.06,0.58-0.15
	c0.27-0.32,0.51-0.64,0.55-1.07c0.04-0.39,0.19-0.77,0.28-1.15c0.23-0.96,0.42-1.93,0.32-2.92c-0.1-0.93,0.15-1.86,0.02-2.8
	c0.23-0.76-0.01-1.58,0.41-2.32c0.05-0.49,0.12-0.98,0.14-1.47c0.01-0.29-0.05-0.59-0.05-0.88c-0.01-1.42,0.11-2.85,0-4.27
	c-0.11-1.47-0.01-2.95-0.35-4.41c-0.08-0.33-0.05-0.69-0.02-1.03c0.1-1.04,0.01-2.06-0.17-3.08c-0.19-1.12-0.37-2.24-0.51-3.36
	c-0.14-1.18-0.26-2.35-0.78-3.46c-0.13-0.27-0.17-0.57-0.25-0.86c-0.21-0.77-0.48-1.53-0.63-2.3c-0.17-0.83-0.64-1.58-0.83-2.4
	c-0.15-0.65-0.59-0.66-1.17-0.47c-0.32,0.1-0.62,0.28-0.89,0.45c-0.69,0.45-1.38,0.9-2.02,1.4c-0.94,0.74-2.19,1.11-3.08,1.89
	c-0.38,0.12-0.76,0.23-1.14,0.36c-0.16,0.05-0.3,0.15-0.45,0.22c-0.4,0.19-0.8,0.39-1.21,0.58c-1.31,0.62-2.63,1.24-3.93,1.87
	c-0.65,0.31-1.27,0.7-1.96,0.93c-0.71,0.24-1.31,0.63-2.01,0.87c-1.45,0.5-2.76,1.24-4.14,1.85c-0.67,0.29-1.32,0.6-2.02,0.85
	c-1.01,0.36-2.03,0.74-2.98,1.2c-1.11,0.54-2.25,1.01-3.44,1.4c-0.55,0.18-1,0.48-1.41,0.83c-0.03,0.03-0.05,0.12-0.03,0.14
	c0.56,0.49,1.07,1.03,1.69,1.46c0.95,0.64,1.91,1.27,2.74,2.03c0.2,0.18,0.45,0.31,0.67,0.46c0.72,0.49,1.46,0.96,2.14,1.5
	c0.59,0.47,1.22,0.9,1.96,1.2c0.31,0.12,0.63,0.27,0.88,0.47c0.58,0.44,1.04,0.93,0.71,1.67c-0.1,0.22-0.1,0.48-0.11,0.73
	c-0.01,0.26-0.09,0.48-0.27,0.68c-0.24,0.27-0.45,0.58-0.72,0.83c-0.28,0.25-0.51,0.53-0.75,0.81c-0.78,0.92-1.47,1.89-2.31,2.76
	c-0.87,0.91-1.58,1.94-2.57,2.77c-0.38,0.64-1.11,0.99-1.66,1.49c-0.55,0.5-0.99,1.09-1.66,1.5c-0.42,0.26-0.86,0.53-1.17,0.87
	c-0.42,0.47-0.96,0.86-1.37,1.32c-0.68,0.76-1.53,1.33-2.37,1.93c-1.5,1.08-3.06,2.11-4.44,3.31c-0.12,0.1-0.23,0.25-0.37,0.3
	c-0.98,0.29-1.52,1.04-2.3,1.53c-0.21,0.32-0.54,0.49-0.92,0.64c-0.36,0.14-0.69,0.36-1.02,0.56c-1.04,0.61-1.9,1.45-3.13,1.84
	c-0.21,0.07-0.37,0.24-0.56,0.35c-0.24,0.14-0.46,0.33-0.72,0.41c-0.9,0.27-1.57,0.83-2.31,1.3c-0.47,0.29-0.89,0.66-1.4,0.87
	c-0.69,0.28-1.3,0.65-1.89,1.05c-0.5,0.34-1.05,0.6-1.61,0.86c-0.54,0.25-1.18,0.4-1.57,0.88c-0.12,0.14-0.39,0.19-0.6,0.28
	c-0.26,0.12-0.54,0.2-0.76,0.35c-0.81,0.57-1.86,0.8-2.63,1.41c-1.17,0.34-2,1.16-3.15,1.54c-0.42,0.14-0.73,0.52-1.15,0.65
	c-0.94,0.3-1.63,0.94-2.58,1.22c-0.21,0.06-0.4,0.2-0.58,0.33c-1.01,0.69-2.13,1.16-3.39,1.44c-0.5,0.11-0.98,0.29-1.47,0.44
	c-0.11,0.03-0.21,0.08-0.31,0.14c-0.1,0.05-0.18,0.12-0.27,0.18c-0.33,0.22-0.41,0.51-0.17,0.76c1.17,1.22,2.35,2.44,3.52,3.66
	c0.11,0.11,0.22,0.24,0.37,0.31c0.81,0.43,1.34,1.08,1.93,1.69C18.7,81.25,20.09,82.7,21.49,84.14z"/>
            </svg>
        </div>


        <div x-show.transition.fade.300ms="bookmarkSet" @click.away="bookmarkSet = false" class="absolute top-0 left-0 bg-gray-900 -mt-100 lg:mt-16 mb-20 lg:-ml-48 ml-10 p-5 text-white w-64 shadow-lg rounded bg-opacity-75 z-50">
            <div class="flex justify-start">
                <svg class="w-4 h-4 text-white cursor-pointer" @click="bookmarkSet = false" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex justify-between">
                <div>
                    <h3 class="font-serif text-2xl"><?php _e('Lesezeichen gesetzt!', 'ir21') ?></h3>
                </div>
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                </svg>
            </div>
            <p class="text-sm">
                <?php echo sprintf(__('Ihre Lesezeichen finden Sie in Ihrem <a href="%s" target="_blank" class="text-primary-100 underline">Userprofil</a>.', get_field('field_601bc4580a4fc'))) ?>

            </p>
        </div>

        <div x-show.transition.fade.300ms="reminderSet" @click.away="reminderSet = false" class="absolute top-0 left-0 bg-gray-900 -mt-100 lg:mt-16 mb-20 lg:-ml-48 ml-10 p-5 text-white w-64 shadow-lg rounded bg-opacity-75 z-50">
            <div class="flex justify-start">
                <svg class="w-4 h-4 text-white cursor-pointer" @click="reminderSet = false" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex justify-between">
                <div>
                    <h3 class="font-serif text-2xl"><?php _e('Erinnerung gesetzt!', 'ir21') ?></h3>
                </div>
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                </svg>
            </div>
            <p class="text-sm">
                <?php echo sprintf(__(' Wir senden Ihnen in 3 Tagen ein Erinnerungsmail. Sie können den Zeitpunkt dieses Mails in Ihrem <a href="%s" target="_blank" class="text-primary-100 underline">Userprofil</a> ändern..', get_field('field_601bc4580a4fc'))) ?>
            </p>
        </div>


        <div x-show.transition.fade.300ms="loginRequired" @click.away="loginRequired = false" class="absolute top-0 left-0 bg-gray-900 -mt-100 lg:mt-16 mb-20 lg:-ml-48 ml-10 p-5 text-white w-64 shadow-lg rounded bg-opacity-75 z-50">
            <div class="flex justify-start">
                <svg class="w-6 h-6 text-white cursor-pointer" @click="loginRequired = false" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex justify-between">
                <div>
                    <h3 class="font-serif text-2xl"><?php _e('Login erforderlich!', 'ir21') ?></h3>
                </div>
                <svg class="w-12 h-12 text-warning" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm">
                <?php _e('Um Lesezeichen und Erinnerungen zu setzen müssen Sie eingeloggt sein.', 'ir21') ?>
            </p>
            <div class="flex flex-col space-y-3">
                <div>
                    <a href="<?php echo home_url('login') ?>" class="bg-primary-100 text-white text-center block w-full py-2" style="color:white !important;"><?php _e('Login', 'ir21') ?></a>
                </div>

            </div>

        </div>
        <div class="bg-primary-100 rounded-full flex justify-center items-center p-2 shadow-lg hover:shadow-none cursor-pointer"
             @click="setBookmark(<?php echo get_the_ID() ?>)">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
            </svg>
        </div>

        <div class="bg-primary-100 rounded-full flex justify-center items-center p-2 shadow-lg hover:shadow-none"
             @click="remindReading(<?php echo get_the_ID() ?>)"
        >
            <svg class="w-6 h-6 text-white cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
            </svg>
        </div>

        <div class="bg-primary-100 rounded-full flex justify-center items-center p-2 shadow-lg hover:shadow-none">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="w-full h-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="currentColor" class="w-6 h-6 text-white">
                    <path class="st0" d="M43.67,8.51C47.16,5.7,51.5,4.62,55.89,4.5c4.96-0.12,11.2-1.12,15.64,1.47c0.12,0.07,0.22,0.2,0.27,0.32
			c0.3,0.02,0.57,0.3,0.52,0.62c-0.4,2.34-0.85,4.69-1.02,7.06c-0.15,1.7-0.07,3.49-0.67,5.11c-0.15,0.35-0.4,0.57-0.67,0.67
			c-0.07,0.15-0.2,0.27-0.35,0.32c-3.92,1.07-9.2-2.37-11.92,2.27c-1.92,3.32-0.7,7.96-0.6,11.52c2.44-0.52,4.91-0.15,7.41-0.25
			c1.85-0.1,4.14-0.6,5.64,0.72c0.12,0.1,0.17,0.27,0.15,0.42c1.7,3.52,0.05,9.03-0.22,12.7c-0.05,0.5-0.37,0.75-0.77,0.82
			c-0.07,0.25-0.27,0.5-0.65,0.6c-3.92,1.25-8.53,0.6-12.55-0.15c0.55,7.53-0.37,15.49-0.3,23.05c0.1,7.33,1.22,15.31-0.05,22.55
			c-0.05,0.2-0.15,0.32-0.27,0.45c-0.07,0.2-0.22,0.37-0.47,0.45c-2.82,0.67-6.14,0.67-9.03,0.35c-2.15-0.22-4.89,0.17-6.91-0.7
			c-0.42,0.17-1.05-0.05-1.07-0.65c-0.25-8.06-0.62-15.94-0.45-24.04c0.17-7.11-0.3-14.54,0.77-21.62c-0.15,0.07-0.3,0.15-0.47,0.17
			c-1.95,0.17-3.87,0.35-5.81,0.17c-0.8-0.07-1.97-0.15-2.62-0.72c-0.42,0.15-0.9,0.05-1.17-0.4c-0.97-1.55-0.4-3.84-0.3-5.54
			c0.12-2.24-0.37-5.06,0.72-7.11c-0.12-0.52,0.2-1.15,0.85-1.07c1.57,0.15,3.12,0.15,4.69,0.05c0.9-0.07,1.87-0.3,2.84-0.47
			c-0.8-3.89,0.2-9,0.72-12.75C38.4,16.17,39.83,11.61,43.67,8.51z M70.48,7.67c-7.68-0.95-18.96-2.39-25.14,2.67
			c-6.01,4.94-6.31,16.11-5.74,23.65c0.25,0.3,0.35,0.7-0.07,1c0,0.02-0.05,0.02-0.05,0.05c-0.2,0.27-0.52,0.45-0.9,0.45
			c-1.17,0.47-2.57,0.52-3.79,0.62c-1.57,0.12-3.17,0.1-4.71-0.15c0.27,1.9,0.17,4.04,0.1,5.86c-0.07,1.65-0.5,3.52-0.12,5.14
			c0.9-0.1,1.95,0.12,2.77,0.07c1.67-0.05,3.34-0.22,5.01-0.17c0.4,0.02,0.67,0.2,0.82,0.45c0.32-0.22,0.95-0.12,1.02,0.32
			c1.22,7.36,0.27,15.16,0.1,22.57c-0.17,7.96-0.37,15.94-0.27,23.87c2.12-0.75,4.22-0.6,6.46-0.4c2.62,0.2,5.31-0.22,7.91,0.07
			c0.75-8.16,0.12-17.11-0.12-25.29c-0.15-5.79-1.47-14.62,1.37-20.13c-0.22-0.4-0.12-1,0.42-1.07c4.19-0.62,8.38,1.02,12.55-0.25
			c0.05-0.02,0.1-0.02,0.15-0.02c-0.1-2.29-0.12-4.54,0.07-6.86c0.12-1.62,0.15-3.34,0.75-4.86c-1.75,0.2-3.62,0.25-5.31,0.27
			c-2.34,0-4.94-0.07-7.23-0.75c-0.6,0.25-1.47-0.02-1.5-0.87c-0.22-4.41-1.82-10.33,1.62-14.02c2.47-2.64,8.16-3.17,11.7-1.6
			C69.21,14.9,68.61,10.76,70.48,7.67z"/>
                    <path class="st0" d="M39.78,70.2c0.17-7.41,1.12-15.21-0.1-22.57c-0.07-0.45-0.7-0.55-1.02-0.32c-0.15-0.25-0.42-0.42-0.82-0.45
			c-1.67-0.05-3.34,0.12-5.01,0.17c-0.82,0.05-1.87-0.17-2.77-0.07c-0.37-1.62,0.05-3.49,0.12-5.14c0.07-1.82,0.17-3.97-0.1-5.86
			c1.55,0.25,3.14,0.27,4.71,0.15c1.22-0.1,2.62-0.15,3.79-0.62c0.37,0,0.7-0.17,0.9-0.45c0-0.02,0.05-0.02,0.05-0.05
			c0.42-0.3,0.32-0.7,0.07-1c-0.57-7.53-0.27-18.71,5.74-23.65c6.19-5.06,17.46-3.62,25.14-2.67c-1.87,3.09-1.27,7.23-2.15,10.63
			c-3.54-1.57-9.23-1.05-11.7,1.6c-3.44,3.69-1.85,9.6-1.62,14.02c0.02,0.85,0.9,1.12,1.5,0.87c2.29,0.67,4.89,0.75,7.23,0.75
			c1.7-0.02,3.57-0.07,5.31-0.27c-0.6,1.52-0.62,3.24-0.75,4.86c-0.2,2.32-0.17,4.56-0.07,6.86c-0.05,0-0.1,0-0.15,0.02
			c-4.17,1.27-8.36-0.37-12.55,0.25c-0.55,0.07-0.65,0.67-0.42,1.07c-2.84,5.51-1.52,14.34-1.37,20.13
			c0.25,8.18,0.87,17.14,0.12,25.29c-2.59-0.3-5.29,0.12-7.91-0.07c-2.24-0.2-4.34-0.35-6.46,0.4C39.4,86.13,39.6,78.15,39.78,70.2z
			"/>
                </svg>
            </a>
        </div>


        <div class="bg-primary-100 rounded-full flex justify-center items-center p-2 shadow-lg hover:shadow-none">
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" target="_blank" class="w-full h-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="currentColor" class="w-6 h-6 text-white">
                    <path class="st0" d="M95.02,60.96c0.05,1.85,0.15,3.68,0.23,5.54c-0.15,0.03-0.3,0.1-0.45,0.15c-0.6,8.22-0.33,16.54-0.23,24.82
				c0,0.63-0.88,0.7-1.1,0.23c-0.03-0.05-0.05-0.15-0.05-0.23c0.08-6.72-0.05-13.36-0.2-20.08c-0.03-1.58-0.4-5.01,0.43-7.07
				c-0.03-4.41-0.18-8.87-1.05-12.91C88.6,33.08,68.3,32.2,56.11,42.58c-0.05,0.3-0.13,0.58-0.25,0.85c-0.15,0.3-0.68,0.3-0.83,0
				c-0.55-1.13-0.45-2.46-0.55-3.71c-0.15-1.35-0.25-2.68-0.23-4.04c-2.78,0.48-5.84,0.25-8.57,0.33c-2.71,0.08-5.72,0.33-8.45-0.23
				c1.18,9.35,0.93,19.38,0.58,28.75c-0.23,5.72-0.45,11.43-0.48,17.17c0,2.83,0.18,6.04-0.4,8.87c6.02-0.68,11.71-0.03,17.72,0.23
				c2.06-10.33-6.22-36.97,9.65-39.4c17.15-2.61,10.55,31.71,12.16,39.48c0,0.08-0.03,0.13,0,0.18c2.98-0.63,6.14-0.9,9.17-0.85
				c2.41,0.03,5.04-0.1,7.54,0.1c0.05,0.38,0.13,0.75,0.18,1.15c0,0.08,0.03,0.15,0.08,0.23c0.03,0.18,0.1,0.33,0.15,0.5
				c-2.36,0.33-4.84-0.03-7.22-0.13c-3.73-0.15-7.6,0.8-11.3,0.13c-0.23-0.05-0.33-0.23-0.33-0.4c-0.08-0.1-0.15-0.23-0.2-0.4
				c-1.43-6.07,0.08-13.36-0.2-19.65c-0.1-2.56-0.15-5.11-0.4-7.67c-0.65-6.49-4.29-13.36-12.16-10.43
				c-7.8,2.88-5.72,16.74-5.69,23.04c0.03,2.41,0.15,4.86,0.1,7.29c0.1,0.03,0.18,0.08,0.2,0.2c0.45,2.71-0.23,5.74-0.53,8.45
				c-0.03,0.18-0.3,0.23-0.33,0.05c-0.05-0.25-0.05-0.48-0.1-0.7c-0.05,0.03-0.08,0.08-0.13,0.08c-2.73,0.83-5.64-0.2-8.42-0.4
				c-3.58-0.25-7.17,0.35-10.75-0.03c-0.4,0.1-0.83-0.05-0.95-0.55c-0.9-3.41,0.18-7.82,0.15-11.33c0-6.24,0.38-12.46,0.53-18.7
				c0.13-5.84-0.03-11.71-0.33-17.55c-0.15-2.66-0.65-5.64,0.65-7.95c-0.08-0.03-0.2-0.03-0.28-0.05c-0.4-0.15-0.48-0.75,0-0.85
				c3.13-0.63,6.57-0.18,9.78-0.2c3.26,0,7.02-0.6,10.18,0.3c0.33,0.1,0.3,0.53,0,0.63c-0.15,0.05-0.28,0.05-0.43,0.1
				c0.15,1.43,0.35,2.86,0.53,4.26c0.08,0.73,0.2,1.45,0.2,2.16c9.3-9.27,24.09-10.7,33.01-0.23
				C94.19,47.52,94.72,53.51,95.02,60.96z"/>
                    <path class="st0" d="M93.41,91.46c0,0.08,0.03,0.18,0.05,0.23h-0.03c-0.05-0.08-0.08-0.15-0.08-0.23
				c-0.05-0.4-0.13-0.78-0.18-1.15c-2.51-0.2-5.14-0.08-7.54-0.1c-3.03-0.05-6.19,0.23-9.17,0.85c-0.03-0.05,0-0.1,0-0.18
				c-1.6-7.77,4.99-42.09-12.16-39.48c-15.87,2.43-7.6,29.08-9.65,39.4c-6.02-0.25-11.71-0.9-17.72-0.23
				c0.58-2.83,0.4-6.04,0.4-8.87c0.03-5.74,0.25-11.46,0.48-17.17c0.35-9.37,0.6-19.4-0.58-28.75c2.73,0.55,5.74,0.3,8.45,0.23
				c2.73-0.08,5.79,0.15,8.57-0.33c-0.03,1.35,0.08,2.68,0.23,4.04c0.1,1.25,0,2.58,0.55,3.71c0.15,0.3,0.68,0.3,0.83,0
				c0.13-0.28,0.2-0.55,0.25-0.85c12.18-10.38,32.49-9.5,36.47,8.82c0.88,4.04,1.03,8.5,1.05,12.91c-0.83,2.06-0.45,5.49-0.43,7.07
				C93.36,78.1,93.49,84.74,93.41,91.46z"/>
                    <path class="st0" d="M25.83,34.66c0.55,3.46,0.35,6.99,0.28,10.48c-0.08,2.66,0,5.36-0.25,8.02c0.53,5.49,0,11.13-0.3,16.59
				c-0.4,7.12-0.53,14.29-1.03,21.38c0.23,0,0.45,0.03,0.68,0.03c0.83-0.03,0.83,1.23,0,1.23c-0.45,0-0.93,0-1.38,0
				c-0.03,0-0.03,0-0.05,0c-3.18,0-6.34,0.1-9.5-0.05c-1.85-0.1-4.81,0.53-6.64-0.15c-0.4,0.35-1.25,0.18-1.3-0.53
				c-0.2-2.51-0.25-5.11,0.1-7.65c-0.1,0.05-0.23,0.08-0.33,0.13C5.86,78,6.71,71.56,6.71,65.62c0-4.96,0.5-9.88,0.53-14.81
				c0-5.04-0.63-10.1-0.13-15.12c0.03-0.1,0.1-0.18,0.15-0.28c-0.03-0.03-0.05-0.05-0.05-0.1c0,0-0.03-0.03-0.03-0.05
				c0-0.1,0.08-0.2,0.18-0.25c1.48-0.88,4.69-0.45,6.37-0.5c3.89-0.15,7.62,0.03,11.53-0.4c0.3-0.03,0.5,0.23,0.53,0.5
				C25.81,34.64,25.83,34.64,25.83,34.66z M24.63,45.14c0.08-3.31,0.05-6.64,0.53-9.9c-3.38,1.2-6.99,0.58-10.5,0.58
				c-1.78,0-4.39,0.63-6.32,0.18c1.2,8.72,0.58,17.35,0.23,26.09c-0.23,5.09,0.05,10.18-0.35,15.27c-0.18,2.08-0.4,4.11-0.48,6.12
				c-0.05,0-0.08,0.03-0.13,0.05c0.28,2.41,0.15,4.89,0.2,7.32c1.33-0.78,3.68-0.35,4.96-0.2c3.51,0.33,6.87,0.5,10.33,0.5
				c-0.4-7.09,0.25-14.29,0.63-21.38c0.3-5.16,0.4-10.48,1-15.64C24.38,51.15,24.58,48.1,24.63,45.14z"/>
                    <path class="st0" d="M25.18,10.77c3.48,4.26,2.56,12.16-1.96,15.37c-4.81,3.43-12.93,2.88-16.62-1.96
				c-2.68-3.56-2.31-8.4,0.15-11.78c-0.33,0.13-0.58-0.33-0.33-0.55C11.17,7.14,20.39,4.86,25.18,10.77z M24,24.18
				c3.26-4.09,2.38-11.91-2.56-14.24c-3.66-1.73-7.24-0.6-10.7,0.83c-5.19,3.13-5.56,10.68-0.65,14.26
				C14.15,28.02,20.62,28.39,24,24.18z"/>
                    <path class="st0" d="M25.16,35.24c-0.48,3.26-0.45,6.59-0.53,9.9c-0.05,2.96-0.25,6.02,0.1,8.97c-0.6,5.16-0.7,10.48-1,15.64
				c-0.38,7.09-1.03,14.29-0.63,21.38c-3.46,0-6.82-0.18-10.33-0.5c-1.28-0.15-3.63-0.58-4.96,0.2c-0.05-2.43,0.08-4.91-0.2-7.32
				c0.05-0.03,0.08-0.05,0.13-0.05c0.08-2.01,0.3-4.04,0.48-6.12c0.4-5.09,0.13-10.18,0.35-15.27c0.35-8.75,0.98-17.37-0.23-26.09
				c1.93,0.45,4.54-0.18,6.32-0.18C18.16,35.81,21.77,36.44,25.16,35.24z"/>
                    <path class="st0" d="M21.45,9.95c4.94,2.33,5.82,10.15,2.56,14.24c-3.38,4.21-9.85,3.84-13.91,0.85
				c-4.91-3.58-4.54-11.13,0.65-14.26C14.2,9.34,17.79,8.22,21.45,9.95z"/>
                </svg>
            </a>
        </div>
    </div>
</div>