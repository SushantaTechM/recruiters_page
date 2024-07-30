const tabs = document.querySelectorAll('.tab');
const contents = document.querySelectorAll('.tab-content');
 
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(item => item.classList.remove('active'));
        tab.classList.add('active');
 
        contents.forEach(content => {
            content.style.display = 'none';
        });
 
        const activeTab = tab.getAttribute('data-tab');
        document.getElementById(activeTab).style.display = 'block';
    });
});
 