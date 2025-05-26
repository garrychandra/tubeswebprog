document.addEventListener('DOMContentLoaded', function() {
    // Handle singles
    const singles = document.querySelectorAll('[id^="single-"]');
    singles.forEach(single => {
        const id = single.id;
        const modalId = `modal-${id}`;
        const modal = document.querySelector(`#${modalId}`);
        
        if (modal) {
            single.addEventListener('click', () => modal.showModal());
        }
    });

    // Handle EPs
    const eps = document.querySelectorAll('[id^="ep-"]');
    eps.forEach(ep => {
        const id = ep.id;
        const modalId = `modal-${id}`;
        const modal = document.querySelector(`#${modalId}`);
        
        if (modal) {
            ep.addEventListener('click', () => modal.showModal());
        }
    });

    // Handle albums
    const albums = document.querySelectorAll('[id^="album-"]');
    albums.forEach(album => {
        const id = album.id;
        const modalId = `modal-${id}`;
        const modal = document.querySelector(`#${modalId}`);
        
        if (modal) {
            album.addEventListener('click', () => modal.showModal());
        }
    });

    // Close modal when clicking outside
    const modals = document.querySelectorAll('.modal');
    modals.forEach((modal) => {
        modal.addEventListener("click", e => {
            const dialogDimensions = modal.getBoundingClientRect();
            if (
                e.clientX < dialogDimensions.left ||
                e.clientX > dialogDimensions.right ||
                e.clientY < dialogDimensions.top ||
                e.clientY > dialogDimensions.bottom
            ) {
                modal.close();
            }
        });
    });
});
