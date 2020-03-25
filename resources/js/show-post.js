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

comment_section.getElementsByTagName('button')[0].addEventListener('click', ev => {
    var request = new XMLHttpRequest();
    request.withCredentials = true;
    request.open('POST', location.href + '/comment', true);
    request.setRequestHeader('X-CSRF-TOKEN', document.getElementsByTagName('meta')[2].content);
    request.onload = function () {
        console.log(request.response);
    };
    let body = {
        'body': comment_section.getElementsByTagName('textarea')[0].value
    };
    request.send('{body:"folan"}');
});
