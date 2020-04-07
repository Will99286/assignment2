const crewButton = document.querySelector('#crew-button');
crewButton.addEventListener('click', crewDisplay);

function crewDisplay(e) {
	e.stopPropagation;
	const crewList = document.querySelector('#crew-table');
	crewList.style.display = "block";
	const castList = document.querySelector('#cast-table');
	castList.style.display = "none";


}
const castButton = document.querySelector('#cast-button');
castButton.addEventListener('click', castDisplay);

function castDisplay(e) {
	e.stopPropagation;
	const crewList = document.querySelector('#crew-table');
	crewList.style.display = "none";
	const castList = document.querySelector('#cast-table');
	castList.style.display = "block";


}

const smallPoster = document.querySelector('#smallPoster');
const largePoster = document.querySelector('#largePoster');


smallPoster.addEventListener('click',
	(e) => {
		smallPoster.style.display = "none";
		largePoster.style.display = "inline-block";
	}
);

largePoster.addEventListener("click",
	(e) => {
		largePoster.style.display = "none";
		smallPoster.style.display = "inline-block";

	}

);