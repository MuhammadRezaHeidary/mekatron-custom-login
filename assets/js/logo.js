let login_logo = document.getElementById('login').getElementsByTagName('h1')[0].getElementsByTagName('a')[0];

login_logo.href = mekatron_logo_options.link;
login_logo.target = mekatron_logo_options.target;
login_logo.innerHTML = mekatron_logo_options.content;