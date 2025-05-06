const openSingleWaveModal = document.querySelector('#single-wave');
const singleWaveModal = document.querySelector("#modal-single-wave");


openSingleWaveModal.addEventListener('click', function () {
    singleWaveModal.showModal();
});

const openSingleLightModal = document.querySelector('#single-light');
const singleLightModal = document.querySelector("#modal-single-light");


openSingleLightModal.addEventListener('click', function () {
    singleLightModal.showModal();
});

const openSingleSurfModal = document.querySelector('#single-surf');
const singleSurfModal = document.querySelector("#modal-single-surf");


openSingleSurfModal.addEventListener('click', function () {
    singleSurfModal.showModal();
});

const openSinglePuebloModal = document.querySelector('#single-pueblo');
const singlePuebloModal = document.querySelector("#modal-single-pueblo");


openSinglePuebloModal.addEventListener('click', function () {
    singlePuebloModal.showModal();
});

const openSingleDaisyModal = document.querySelector('#single-daisy');
const singleDaisyModal = document.querySelector("#modal-single-daisy");


openSingleDaisyModal.addEventListener('click', function () {
    singleDaisyModal.showModal();
});

const openSingleNouvelleVagueModal = document.querySelector('#single-nouvelle-vague');
const singleNouvelleVagueModal = document.querySelector("#modal-single-nouvellevague");


openSingleNouvelleVagueModal.addEventListener('click', function () {
    singleNouvelleVagueModal.showModal();
});

const openSingleCallaModal = document.querySelector('#single-calla');
const singleCallaModal = document.querySelector("#modal-single-calla");


openSingleCallaModal.addEventListener('click', function () {
    singleCallaModal.showModal();
});

const openSingleDriedFlowerModal = document.querySelector('#single-dried-flower');
const singleDriedFlowerModal = document.querySelector("#modal-single-driedflower");


openSingleDriedFlowerModal.addEventListener('click', function () {
    singleDriedFlowerModal.showModal();
});

const openEPWaveModal = document.querySelector('#ep-wave');
const epWaveModal = document.querySelector("#modal-ep-wave");


openEPWaveModal.addEventListener('click', function () {
    epWaveModal.showModal();
});

const openEPSummerFlowsModal = document.querySelector('#ep-summer-flows');
const epSummerFlowsModal = document.querySelector("#modal-ep-summerflows");


openEPSummerFlowsModal.addEventListener('click', function () {
    epSummerFlowsModal.showModal();
});

const openAlbumFlawsAndAllModal = document.querySelector('#album-flaws-and-all');
const albumFlawsAndAllModal = document.querySelector("#modal-album-flawsandall");


openAlbumFlawsAndAllModal.addEventListener('click', function () {
    albumFlawsAndAllModal.showModal();
});

const openAlbumPlayWithEarthModal = document.querySelector('#album-play-with-earth');
const albumPlayWithEarthModal = document.querySelector("#modal-album-playwithearth");


openAlbumPlayWithEarthModal.addEventListener('click', function () {
    albumPlayWithEarthModal.showModal();
});



const modals = document.querySelectorAll('.modal');
modals.forEach((modal) => {
    modal.addEventListener("click", e => {
        const dialogDimensions = modal.getBoundingClientRect()
        if (
            e.clientX < dialogDimensions.left ||
            e.clientX > dialogDimensions.right ||
            e.clientY < dialogDimensions.top ||
            e.clientY > dialogDimensions.bottom
        ) {
            modal.close()
        }
    });
});
