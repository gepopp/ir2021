<div x-show.transition="chapters.length > 0">
	<div class="flex pb-3 mb-3 border-b border-primary-100">
		<div class="border border-primary-100 flex-1 text-center  cursor-pointer py-3"
		     :class="tab == 'chapters' ? 'bg-primary-100 text-white' : 'text-primary-100'"
		     @click="tab = 'chapters'">Kapitel
		</div>
		<div class="border border-primary-100 flex-1 text-center cursor-pointer py-3"
		     :class="tab == 'comments' ? 'bg-primary-100 text-white' : 'text-primary-100'"
		     @click="tab = 'comments'">Kommentare
		</div>
	</div>
</div>
<div x-show="chapters.length > 0 && tab == 'chapters'" x-key="chapter.index">
	<ol class="ml-2">
		<template x-for="chapter in chapters">
			<li class="cursor-pointer mb-2" @click="jump(chapter.startTime - 1)">
				<span x-text="chapter.title" :class="chapter.index == current_chapter ? 'font-semibold underline' :''" class="line-clamp-1"></span>
			</li>
		</template>
	</ol>
</div>