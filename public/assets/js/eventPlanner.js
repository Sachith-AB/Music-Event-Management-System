function loadComponent(component) {
    const viewContent = document.getElementById('dash-view-content');

    fetch(`http://localhost/Music-Event-Management-System\app\views\components\eventPlanner\dash-overriew.php`)
        .then(response => response.text())
        .then(html => {
            viewContent.innerHTML = html;
        })
        .catch(error => console.error('Error loading component:', error));
}
