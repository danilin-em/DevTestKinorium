const Tree = function (el) {
    if (!el) {
        return;
    }
    const li_ul = el.querySelectorAll('li>ul');
    for (const x of li_ul) {
        x.style.display = 'none';
        x.parentNode.addEventListener('mouseenter', () => {
            x.style.display = 'block';
        });
        x.parentNode.addEventListener('mouseleave', () => {
            x.style.display = 'none';
        });
    }
};
