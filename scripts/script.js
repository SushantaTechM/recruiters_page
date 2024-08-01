// document.getElementById('login-toggle-checkbox').addEventListener('change', function() {
//     if (this.checked) {
//         document.getElementById('agent-login-box').style.display = 'block';
//         document.getElementById('user-login-box').style.display = 'none';
//         document.getElementById('agent-login-label').classList.add('active');
//         document.getElementById('user-login-label').classList.remove('active');
//         document.getElementById('agent-login-label').style.color = "red";
//         document.getElementById('user-login-label').style.color = "white";
        
//     } else {
//         document.getElementById('agent-login-box').style.display = 'none';
//         document.getElementById('user-login-box').style.display = 'block';
//         document.getElementById('agent-login-label').classList.remove('active');
//         document.getElementById('user-login-label').classList.add('active');
//         document.getElementById('agent-login-label').style.color = "white";
//         document.getElementById('user-login-label').style.color = "red";
//     }
// });

// document.getElementById('user-login-label').addEventListener('click', function() {
//     document.getElementById('login-toggle-checkbox').checked = false;
//     document.getElementById('agent-login-box').style.display = 'none';
//     document.getElementById('user-login-box').style.display = 'block';
//     this.classList.add('active');
//     document.getElementById('agent-login-label').classList.remove('active');
//     document.getElementById('agent-login-label').style.color = "white";
//     document.getElementById('user-login-label').style.color = "red";
// });

// document.getElementById('agent-login-label').addEventListener('click', function() {
//     document.getElementById('login-toggle-checkbox').checked = true;
//     document.getElementById('agent-login-box').style.display = 'block';
//     document.getElementById('user-login-box').style.display = 'none';
//     this.classList.add('active');
//     document.getElementById('user-login-label').classList.remove('active');
//     document.getElementById('agent-login-label').style.color = "red";
//     document.getElementById('user-login-label').style.color = "white";
// });