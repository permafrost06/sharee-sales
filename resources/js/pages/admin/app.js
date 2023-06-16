import { find, gsapTL, addClasses, rmClasses, findAll } from "../../utils";

const sideBar = find('#sidebar-main');

find("#sidenav-resize").addEventListener('click', () => {
    if (sideBar.classList.contains('collapsed')) {
        rmClasses(sideBar, 'collapsed md:w-[60px]');
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
            addClasses(sideBar, 'collapsed md:w-[60px]');
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


findAll('[data-collapse]').forEach((collapseHandle) => {
    const byWidth = collapseHandle.getAttribute('data-axis') === 'x';
    const target = find(collapseHandle.getAttribute('data-collapse'));
    if (!target) {
        console.warn('Target not found for collapsable');
        return;
    }
    collapseHandle.addEventListener('click', () => {
        if (target.classList.contains('hidden')) {
            return;
        }
        gsapTL().to(target, {
            duration: 0.5,
            [byWidth?'width':'height']: 0
        }).then(() => {
            target.classList.add('hidden');
        });
    })
});

findAll('[data-expand]').forEach((expandHandle) => {
    const byWidth = expandHandle.getAttribute('data-axis') === 'x';
    const target = find(expandHandle.getAttribute('data-expand'));
    if (!target) {
        console.warn('Target not found for collapsable');
        return;
    }
    
    expandHandle.addEventListener('click', () => {
        if (!target.classList.contains('hidden')) {
            return;
        }
        target.classList.remove('hidden');
        gsapTL().fromTo(target, {
            [byWidth?'width':'height']: 0
        }, {
            duration: 0.5,
            [byWidth?'width':'height']: 'auto'
        });
    });
    
});