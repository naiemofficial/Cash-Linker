document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('click', (event) => {
        const rightModalSidebar = document.getElementById('rightModalSidebar');
        const modalBackdrop = document.getElementById('modalBackdrop');

        const target = event.target;


        if (target.id === 'openRightModalSidebar') {
            rightModalSidebar.classList.add('modal-sidebar-right-show');
            modalBackdrop.classList.add('modal-backdrop-show');
        }

        if (target.id === 'closeRightModalSidebar' || target.id === 'modalBackdrop') {
            rightModalSidebar.classList.remove('modal-sidebar-right-show');
            modalBackdrop.classList.remove('modal-backdrop-show');
        }
    });
});
