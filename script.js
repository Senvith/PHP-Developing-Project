const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');
const navBtn = document.getElementById('btn')

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});


loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});


navBtn.addEventListener('click' , () =>{
    container.classList.remove("active");
});

navBtn.addEventListener('click' , () =>{
    container.classList.add("active");
});

