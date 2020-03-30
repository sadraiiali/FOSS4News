let comment_section = document.getElementById('comment_section');
document.getElementById('comment-btn').addEventListener('click', (e) => {
    if (e.target.innerText === '+') {
        e.target.innerText = ' - ';
        comment_section.classList.remove('d-none');
    } else {
        e.target.innerText = '+';
        comment_section.classList.add('d-none');
    }
});
