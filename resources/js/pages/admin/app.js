import { find, gsapTL } from "../../utils";

const sideBar = find('#sidebar-main');
const sideBarBtn = find("#sidenav-resize");

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