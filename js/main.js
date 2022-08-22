const sections = document.querySelectorAll('section');
const navli = document.querySelectorAll('ul li');


window.addEventListener('scroll',()=>{
	
	let current = '';

	sections.forEach( section => {
		const sectionTop = section.offsetTop;
		const sectionHeight	 = section.clientHeight;
		if(pageYOffset >= (sectionTop - sectionHeight / 3)){
			current = section.getAttribute('id')
		}
	})
	navli.forEach( li => {
		li.classList.remove('active');
		if(li.classList.contains(current)){
			li.classList.add('active')
		}
	})
})

window.addEventListener('scroll', function(){
	let nav = document.querySelector('nav');

	nav.classList.toggle('scrolling-active', window.scrollY > 100);
})