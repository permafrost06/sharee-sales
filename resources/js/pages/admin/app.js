import { find, gsapTL, addClasses, rmClasses } from "../../utils";

const sideBar = find('#sidebar-main');

find("#sidenav-resize").addEventListener('click', () => {
    if (sideBar.classList.contains('collapsed')) {
        rmClasses(sideBar, 'collapsed md:w-[100px]');
        gsapTL().fromTo(sideBar, {
            width: '100px'
        }, {
            duration: 0.1,
            width: 'auto'
        }).then(()=>{
            sideBar.removeAttribute('style');
        });
    } else {
        gsapTL().to(sideBar, {
            width: '100px',
            duration: 0.1
        }).then(() => {
            addClasses(sideBar, 'collapsed md:w-[100px]');
            sideBar.removeAttribute('style');
        });
    }
});

find('#sidenav-opener').addEventListener('click', () => {
    sideBar.classList.remove('hidden');
    gsapTL().fromTo(sideBar, {
        translateX: '-100%'
    }, {
        translateX: 0,
        duration: 0.1
    });
});

find('#sidenav-closer').addEventListener('click', () => {
    gsapTL().to(sideBar, {
        translateX: '-100%',
        duration: 0.1
    }).then(()=>{
        sideBar.removeAttribute('style');
        sideBar.classList.add('hidden');
    });
});